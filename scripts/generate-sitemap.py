#!/usr/bin/env python3
"""Generate sitemap.xml and sitemap.txt with lastmod dates from git history."""

from __future__ import annotations

import subprocess
import sys
from datetime import datetime, timezone
from pathlib import Path

SITE = "https://redseed.cc"
ROOT = Path(__file__).resolve().parent.parent

# (public URL path, source file relative to repo root, changefreq, priority)
PAGES: list[tuple[str, str, str, str]] = [
    ("", "index.html", "weekly", "1.0"),
    ("games.html", "games.html", "monthly", "0.9"),
    ("dusk_point_reloaded_mikos_journey.html", "dusk_point_reloaded_mikos_journey.html", "monthly", "0.9"),
    ("a_sweet_meeting_rebirth.html", "a_sweet_meeting_rebirth.html", "monthly", "0.9"),
    ("hi/", "hi/index.html", "monthly", "0.85"),
    ("hi/miko.html", "hi/miko.html", "monthly", "0.9"),
    ("hi/sweet-meeting.html", "hi/sweet-meeting.html", "monthly", "0.9"),
    ("korisfable.html", "korisfable.html", "monthly", "0.9"),
    ("korisfablesteam.html", "korisfablesteam.html", "monthly", "0.8"),
    ("niara_rotk/", "niara_rotk/index.html", "monthly", "0.9"),
    ("blogs.html", "blogs.html", "weekly", "0.7"),
    ("blog.html", "blog.html", "weekly", "0.6"),
    ("privacy_policy.html", "privacy_policy.html", "yearly", "0.3"),
    ("terms_and_conditions.html", "terms_and_conditions.html", "yearly", "0.3"),
]


def page_url(url_path: str) -> str:
    return f"{SITE}/{url_path}" if url_path else f"{SITE}/"


def git_lastmod(relative_path: str) -> str:
    file_path = ROOT / relative_path
    if not file_path.exists():
        return datetime.now(timezone.utc).strftime("%Y-%m-%d")

    try:
        result = subprocess.run(
            ["git", "log", "-1", "--format=%cs", "--", relative_path],
            cwd=ROOT,
            capture_output=True,
            text=True,
            check=True,
        )
        date = result.stdout.strip()
        if date:
            return date
    except (subprocess.CalledProcessError, FileNotFoundError):
        pass

    mtime = datetime.fromtimestamp(file_path.stat().st_mtime, tz=timezone.utc)
    return mtime.strftime("%Y-%m-%d")


def build_sitemap_xml() -> str:
    lines = [
        '<?xml version="1.0" encoding="UTF-8"?>',
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
    ]

    for url_path, source_file, changefreq, priority in PAGES:
        lines.extend(
            [
                "  <url>",
                f"    <loc>{page_url(url_path)}</loc>",
                f"    <lastmod>{git_lastmod(source_file)}</lastmod>",
                f"    <changefreq>{changefreq}</changefreq>",
                f"    <priority>{priority}</priority>",
                "  </url>",
            ]
        )

    lines.append("</urlset>")
    return "\n".join(lines) + "\n"


def build_sitemap_txt() -> str:
    return "\n".join(page_url(url_path) for url_path, _, _, _ in PAGES) + "\n"


def main() -> int:
    missing = [src for _, src, _, _ in PAGES if not (ROOT / src).exists()]
    if missing:
        print("Warning: missing source files:", ", ".join(missing), file=sys.stderr)

    xml = build_sitemap_xml()
    txt = build_sitemap_txt()

    xml_path = ROOT / "sitemap.xml"
    txt_path = ROOT / "sitemap.txt"
    xml_path.write_text(xml, encoding="utf-8", newline="\n")
    txt_path.write_text(txt, encoding="utf-8", newline="\n")

    import xml.etree.ElementTree as ET

    ET.fromstring(xml)
    print(f"Wrote {xml_path} ({len(PAGES)} URLs, valid XML)")
    print(f"Wrote {txt_path} ({len(PAGES)} URLs)")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
