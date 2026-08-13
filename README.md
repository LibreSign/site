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

- Files under `lang/` must not be changed manually in regular pull requests.
- `lang/en/main.json` is refreshed automatically by the deploy workflow.
- Translations are managed by Weblate and returned to the repository through pull requests.
