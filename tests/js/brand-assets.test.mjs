import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';

const page = readFileSync(new URL('../../source/brand.blade.php', import.meta.url), 'utf8');

test('brand preview uses a same-origin image rather than a GitHub release download', () => {
  assert.match(page, /src="{{ \$page->baseUrl }}assets\/images\/logo\/logo-2\.svg"/);
  assert.doesNotMatch(page, /src="https:\/\/github\.com\/LibreSign\/brand\/releases\/download/);
});

test('preview logo uses the official primary colors for a light background', () => {
  const primaryLogo = readFileSync(new URL('../../source/assets/images/logo/logo-2.svg', import.meta.url), 'utf8');
  const fills = [...primaryLogo.matchAll(/fill="#([a-fA-F0-9]{6})"/g)].map((match) => match[1].toUpperCase());

  assert.ok(fills.includes('2A936A'), 'Official primary green is missing');
  assert.ok(fills.includes('707172'), 'Official dark wordmark is missing');
  assert.ok(!fills.includes('F5F5F5'), 'Reversed light wordmark must not be used on white');
  assert.ok(!fills.includes('CAFBC4'), 'Reversed light logo must not be used on white');
});

test('both canonical manual formats are offered separately', () => {
  assert.match(page, /libresign-brand-manual\.pdf/);
  assert.match(page, /libresign-brand-manual-slides\.pdf/);
  assert.match(page, /Brand manual — A4 \(PDF\)/);
  assert.match(page, /Brand manual — 16:9 \(PDF\)/);
});
