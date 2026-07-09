# Blogger API — publish to redseedgames.blogspot.com

Posts published here appear automatically on [redseed.cc](https://redseed.cc/) via the Blogger RSS feed (`blogs.html`, homepage, and `blog.html?postId=…`).

## One-time Google Cloud setup

1. Open [Google Cloud Console](https://console.cloud.google.com/).
2. Create a project (e.g. `Redseed Blogger`) or pick an existing one.
3. **Enable the API**
   - APIs & Services → **Library**
   - Search **Blogger API** → **Enable**
4. **OAuth consent screen**
   - APIs & Services → **OAuth consent screen**
   - User type: **External** (unless you use Google Workspace)
   - App name: `Redseed Blogger Publisher`
   - Add your Gmail as a **Test user** while the app is in *Testing* mode
5. **Create credentials**
   - APIs & Services → **Credentials** → **Create credentials** → **OAuth client ID**
   - Application type: **Desktop app**
   - Download the JSON file
   - Save it as:

     ```
     scripts/blogger/client_secret.json
     ```

## Local setup

```bash
cd scripts/blogger
python -m pip install -r requirements.txt
copy config.example.json config.json
```

On macOS/Linux, use `cp` instead of `copy`.

## First login (OAuth)

```bash
python publish_post.py auth
```

A browser window opens. Sign in with the **Google account that owns** [redseedgames.blogspot.com](https://redseedgames.blogspot.com/). Approve access. This creates `token.json` (do not commit it).

## Commands

List recent posts (get post IDs for updates):

```bash
python publish_post.py list
```

Publish a new post:

```bash
python publish_post.py publish ^
  --title "एक प्यारी मुलाक़ात : मुफ्त हिंदी विजुअल नॉवेल Google Play पर" ^
  --file "../blogger-drafts/ek-pyari-mulaqat-hindi-blog.html" ^
  --labels visualnovel hindi renpy
```

On bash:

```bash
python publish_post.py publish \
  --title "एक प्यारी मुलाक़ात : मुफ्त हिंदी विजुअल नॉवेल Google Play पर" \
  --file "../blogger-drafts/ek-pyari-mulaqat-hindi-blog.html" \
  --labels visualnovel hindi renpy
```

Save as draft first (review on Blogger before going live):

```bash
python publish_post.py publish --title "..." --file "..." --draft
```

Update the existing Hindi announcement (post ID from Feb 2025):

```bash
python publish_post.py publish \
  --update 7021344453665968120 \
  --title "एक प्यारी मुलाक़ात : मुफ्त हिंदी विजुअल नॉवेल Google Play पर" \
  --file "../blogger-drafts/ek-pyari-mulaqat-hindi-blog.html" \
  --labels visualnovel hindi renpy
```

## Files (never commit secrets)

| File | Purpose |
|------|---------|
| `client_secret.json` | OAuth client from Google Cloud (you download this) |
| `token.json` | Created after first `auth` / `publish` |
| `config.json` | Your blog ID and default labels |
| `config.example.json` | Safe template committed to git |

Blog ID for Redseed Game Studio: `8154537109302397167`

## Troubleshooting

**`access_denied` or app blocked** — Add your Google account under OAuth consent screen → Test users.

**`The caller does not have permission`** — You signed in with an account that is not an admin/owner of the Blogger blog.

**Token expired** — Delete `token.json` and run `python publish_post.py auth` again.

**Publish to production OAuth** — For long-term use, submit the OAuth app for Google verification, or keep it in Testing mode with test users listed (fine for personal/studio use).
