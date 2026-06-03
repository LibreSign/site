# LibreSign Website

## Local development

### Starting the stack

```bash
docker compose up -d
```

The `php` container builds the static site on startup and keeps `php-fpm` running so you can exec into it at any time:

```bash
docker compose exec php bash
```

The site is then served by nginx at <http://localhost:8086/>.

### Asset and build commands

| Goal | Command | Exits? |
|---|---|---|
| Dev server with hot-reload (HMR) | `npm run dev` | No — stays alive waiting for changes |
| Watch mode (rebuild on save, no HMR) | `npm run watch` | No — stays alive |
| Full asset build (for local nginx) | `npm run staging` | Yes |
| Production build | `npm run prod` | Yes |

> **Note:** `npm run dev` starts the Vite development server, runs an initial Jigsaw build, prints "Initial Jigsaw build completed." and then waits for file changes. It is not supposed to exit — press Ctrl+C to stop it.

### Force a full local rebuild

Use this when you want to regenerate `build_local` manually and return to the prompt:

```bash
docker compose exec php bash -lc "npm run staging && php vendor/bin/jigsaw build local"
```

## Translations
Help to translate the project on Weblate platform: https://hosted.weblate.org/projects/libresign-coop-site/site/

### Maintainer notes
- `lang/` is managed by Weblate and automation PRs.
- Source strings are refreshed automatically by GitHub Actions daily at `02:00` (cron).
- Normal builds must not modify `lang/`.
