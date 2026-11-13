import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';

const read = (name) => readFileSync(new URL('../../source/' + name, import.meta.url), 'utf8');
const header = read('_layouts/header.blade.php');
const home = read('index.blade.php');
const features = read('features.blade.php');
const technical = read('tecnical-details.blade.php');
const faq = read('faq.blade.php');
const guide = read('_posts/api-documentation.md');
const layout = read('_layouts/main.blade.php');

test('all primary discovery paths link to the original API guide and version chooser', () => {
  for (const [name, source] of [['header', header], ['home', home], ['technical', technical], ['FAQ', faq]]) {
    assert.match(source, /posts\/libresign-api-guide/, name + ' lacks a link to the existing guide');
  }
  for (const [name, source] of [['header', header], ['technical', technical], ['FAQ', faq]]) {
    assert.match(source, /https:\/\/docs\.libresign\.coop\//, name + ' lacks official documentation');
  }
  assert.match(features, /category'\s*=>\s*'featured'/);
  assert.match(header, /headerLocaleUrl\('features'\)/);
  assert.match(faq, /foreach\(\$page->frequentlyQuestions/);
});

test('technical explanation distinguishes Nextcloud prerequisites, signers and authorized API access', () => {
  assert.match(technical, /compatible Nextcloud server/);
  assert.match(technical, /not an independent standalone signing server/);
  assert.match(technical, /authorized Nextcloud account/);
  assert.match(technical, /without a Nextcloud account/);
  assert.match(technical, /retrieves signed documents only with appropriate authorization/);
  assert.match(technical, /installed LibreSign version/);
});

test('existing guide identity, multilingual SEO and structured data are preserved', () => {
  assert.match(guide, /^title: LibreSign API Guide$/m);
  assert.match(guide, /^author: Vitor Mattos$/m);
  assert.match(guide, /^date: 2024-10-10$/m);
  assert.ok(layout.includes('rel="canonical" href="{{ $canonicalUrl }}"'));
  assert.match(layout, /\$absoluteSeoUrl\(translate_url\(\$page, \$localeCode\)\)/);
  assert.ok(layout.includes('property="og:url" content="{{ $canonicalUrl }}"'));
  assert.ok(layout.includes('name="twitter:url" content="{{ $canonicalUrl }}"'));
  assert.match(layout, /hreflang/);
  assert.match(layout, /structured-data/);
  assert.doesNotMatch(technical, /docs\.libresign\.coop\/(?:developer_manual|admin_manual)\//);
});

test('new interface strings use the Weblate extraction helper and not direct catalog edits', () => {
  for (const source of [header, home, technical, faq]) {
    assert.doesNotMatch(source, /lang\/en\/main\.json/);
  }
  assert.match(technical, /\$page->t\('Installation and integration requirements'\)/);
  assert.match(faq, /\$page->t\('For installation, access permissions/);
});
