#!/usr/bin/env python3
"""Publish or update posts on redseedgames.blogspot.com via Blogger API v3."""

from __future__ import annotations

import argparse
import json
import re
import sys
from pathlib import Path

from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build
from googleapiclient.errors import HttpError

SCRIPT_DIR = Path(__file__).resolve().parent
SCOPES = ["https://www.googleapis.com/auth/blogger"]
CLIENT_SECRET_FILE = SCRIPT_DIR / "client_secret.json"
TOKEN_FILE = SCRIPT_DIR / "token.json"
CONFIG_FILE = SCRIPT_DIR / "config.json"
CONFIG_EXAMPLE = SCRIPT_DIR / "config.example.json"


def load_config() -> dict:
    path = CONFIG_FILE if CONFIG_FILE.exists() else CONFIG_EXAMPLE
    if not path.exists():
        print("Missing config.json. Copy config.example.json to config.json.", file=sys.stderr)
        sys.exit(1)
    return json.loads(path.read_text(encoding="utf-8"))


def get_credentials() -> Credentials:
    if not CLIENT_SECRET_FILE.exists():
        print(
            "Missing client_secret.json.\n"
            "Download OAuth credentials from Google Cloud Console and save them as:\n"
            f"  {CLIENT_SECRET_FILE}\n"
            "See scripts/blogger/README.md for setup steps.",
            file=sys.stderr,
        )
        sys.exit(1)

    creds: Credentials | None = None
    if TOKEN_FILE.exists():
        creds = Credentials.from_authorized_user_file(str(TOKEN_FILE), SCOPES)

    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            creds.refresh(Request())
        else:
            flow = InstalledAppFlow.from_client_secrets_file(str(CLIENT_SECRET_FILE), SCOPES)
            creds = flow.run_local_server(port=0)
        TOKEN_FILE.write_text(creds.to_json(), encoding="utf-8")

    return creds


def get_service():
    return build("blogger", "v3", credentials=get_credentials(), cache_discovery=False)


def strip_html_comments(html: str) -> str:
    return re.sub(r"<!--.*?-->", "", html, flags=re.DOTALL).strip()


def load_body(path: Path) -> str:
    return strip_html_comments(path.read_text(encoding="utf-8"))


def cmd_auth(_: argparse.Namespace) -> int:
    get_credentials()
    print(f"Authenticated. Token saved to {TOKEN_FILE}")
    return 0


def cmd_list(args: argparse.Namespace) -> int:
    config = load_config()
    service = get_service()
    response = (
        service.posts()
        .list(blogId=config["blog_id"], maxResults=args.limit, status="live")
        .execute()
    )
    posts = response.get("items", [])
    if not posts:
        print("No live posts found.")
        return 0

    for post in posts:
        post_id = post.get("id", "")
        title = post.get("title", "(no title)")
        url = post.get("url", "")
        print(f"{post_id}\t{title}\t{url}")
    return 0


def cmd_publish(args: argparse.Namespace) -> int:
    config = load_config()
    body = load_body(args.file)
    labels = args.labels if args.labels else config.get("default_labels", [])

    post_body = {
        "title": args.title,
        "content": body,
        "labels": labels,
    }

    service = get_service()
    blog_id = config["blog_id"]

    try:
        if args.update:
            result = (
                service.posts()
                .update(
                    blogId=blog_id,
                    postId=args.update,
                    body=post_body,
                    publish=not args.draft,
                )
                .execute()
            )
            action = "Updated"
        else:
            result = (
                service.posts()
                .insert(
                    blogId=blog_id,
                    body=post_body,
                    isDraft=args.draft,
                )
                .execute()
            )
            action = "Draft saved" if args.draft else "Published"
    except HttpError as exc:
        print(f"Blogger API error: {exc}", file=sys.stderr)
        return 1

    post_id = result.get("id", "")
    url = result.get("url", "")
    print(f"{action} successfully.")
    print(f"Post ID: {post_id}")
    if url:
        print(f"URL: {url}")
    if post_id:
        print(f"On redseed.cc: https://redseed.cc/blog.html?postId={post_id}")
    return 0


def build_parser() -> argparse.ArgumentParser:
    parser = argparse.ArgumentParser(
        description="Publish Redseed Game Studio blog posts to Blogger."
    )
    sub = parser.add_subparsers(dest="command", required=True)

    auth_parser = sub.add_parser("auth", help="Run Google OAuth and save token.json")
    auth_parser.set_defaults(func=cmd_auth)

    list_parser = sub.add_parser("list", help="List recent live posts")
    list_parser.add_argument("--limit", type=int, default=10)
    list_parser.set_defaults(func=cmd_list)

    publish_parser = sub.add_parser("publish", help="Create or update a blog post")
    publish_parser.add_argument("--title", required=True, help="Post title")
    publish_parser.add_argument(
        "--file",
        type=Path,
        required=True,
        help="HTML file for post body (HTML comments are stripped)",
    )
    publish_parser.add_argument(
        "--labels",
        nargs="*",
        help="Blogger labels (defaults from config.json)",
    )
    publish_parser.add_argument(
        "--draft",
        action="store_true",
        help="Save as draft instead of publishing live",
    )
    publish_parser.add_argument(
        "--update",
        metavar="POST_ID",
        help="Update an existing post instead of creating a new one",
    )
    publish_parser.set_defaults(func=cmd_publish)

    return parser


def main() -> int:
    parser = build_parser()
    args = parser.parse_args()
    if not args.file.exists() if getattr(args, "file", None) else False:
        print(f"File not found: {args.file}", file=sys.stderr)
        return 1
    return args.func(args)


if __name__ == "__main__":
    raise SystemExit(main())
