#!/usr/bin/env bash
# Check the published revision, not an individual GitHub Pages workflow run.
# Shared Pages deployments may cancel each other while still publishing every PR.
set -euo pipefail

if [ "$#" -ne 3 ]; then
  echo "Usage: $0 PREVIEW_URL EXPECTED_SHA REVISION_FILE" >&2
  exit 2
fi

preview_url="${1%/}"
expected_sha="$2"
revision_file="$3"

if [[ ! "$preview_url" =~ ^https://libresign\.github\.io/site-preview/pr-preview/pr-[0-9]+$ ]]; then
  echo "::error::Invalid preview URL: $preview_url" >&2
  exit 2
fi
if [[ ! "$expected_sha" =~ ^[0-9a-f]{40}$ ]]; then
  echo "::error::Invalid expected commit SHA" >&2
  exit 2
fi
if [ ! -s "$revision_file" ] || [ "$(cat "$revision_file")" != "$expected_sha" ]; then
  echo "::error::Preview artifact does not match the PR revision" >&2
  exit 1
fi

max_attempts="${PREVIEW_CHECK_ATTEMPTS:-60}"
poll_seconds="${PREVIEW_CHECK_INTERVAL:-5}"
for ((attempt = 1; attempt <= max_attempts; attempt++)); do
  if served_sha="$(curl -fsSL --max-time 15 --proto '=https' --proto-redir '=https' \
    -H 'Cache-Control: no-cache' \
    "$preview_url/preview-revision.txt?sha=$expected_sha&attempt=$attempt" 2>/dev/null)" &&
    [ "$served_sha" = "$expected_sha" ]; then
    echo "Published preview matches $expected_sha: $preview_url/"
    exit 0
  fi
  if ((attempt < max_attempts)); then
    sleep "$poll_seconds"
  fi
done

echo "::error::GitHub Pages did not serve revision $expected_sha at $preview_url/" >&2
exit 1
