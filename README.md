# LibreSign Website

## Local development

### Starting the stack

```bash
docker compose up
```

The `php` container builds the static site on startup and keeps `php-fpm` running so you can exec into it at any time:

```bash
docker compose exec php bash
```

The site is then served by nginx at <http://localhost/>.

### Asset and build commands

| Goal | Command | Exits? |
|---|---|---|
| Dev server with hot-reload (HMR) | `npm run dev` | No — stays alive waiting for changes |
| Watch mode (rebuild on save, no HMR) | `npm run watch` | No — stays alive |
| **Build assets + local site** (for local nginx) | `npm run build-assets` | Yes |
| Staging build | `npm run staging` | Yes |
| Production build | `npm run prod` | Yes |

> **Note:** `npm run dev` starts the Vite development server on port `3000` (mapped to the host via `HTTP_PORT_BROWSERSYNC`, default `3000`). It runs an initial Jigsaw build, prints "Initial Jigsaw build completed." and then waits for file changes with HMR. It is not supposed to exit — press Ctrl+C to stop it.

### Force a full local rebuild

Use this when you want to regenerate `build_local` manually and return to the prompt:

```bash
docker compose exec php bash -lc "npm run build-assets"
```

## Translations
Help to translate the project on Weblate platform: https://hosted.weblate.org/projects/libresign-coop-site/site/

### Maintainer notes
- `lang/` is managed by Weblate and automation PRs.
- Source strings are refreshed automatically by GitHub Actions daily at `02:00` (cron).
- Normal builds must not modify `lang/`.

## Production fragment sync

- Header and footer fragments are **not** pushed during the Jigsaw build anymore.
- Fragment publication now runs only in the production deploy workflow, after the site build/deploy step.
- The workflow only publishes fragments when the deployed `main` commit is associated with a merged PR in `LibreSign/site`.
- The only sensitive repository configuration for production publication is the shared HMAC secret: `LIBRESIGN_FRAGMENT_WEBHOOK_SECRET`.
- Webhook URLs are regular repository configuration (`LIBRESIGN_HEADER_WEBHOOK_URL` and `LIBRESIGN_FOOTER_WEBHOOK_URL`), not GitHub secrets.
- The webhook consumer should validate both the HMAC headers (`X-LibreSign-Timestamp` and `X-LibreSign-Signature`) and the `deployment` payload fields such as repository, ref, event, and merged PR metadata.
