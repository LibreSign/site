import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';

const page = readFileSync(new URL('../../source/brand.blade.php', import.meta.url), 'utf8');

test('brand preview uses a same-origin image rather than a GitHub release download', () => {
  assert.match(page, /src="{{ \$page->baseUrl }}assets\/images\/logo\/logo\.svg"/);
  assert.doesNotMatch(page, /src="https:\/\/github\.com\/LibreSign\/brand\/releases\/download/);
});

test('both canonical manual formats are offered separately', () => {
  assert.match(page, /libresign-brand-manual\.pdf/);
  assert.match(page, /libresign-brand-manual-slides\.pdf/);
  assert.match(page, /Brand manual — A4 \(PDF\)/);
  assert.match(page, /Brand manual — 16:9 \(PDF\)/);
});
