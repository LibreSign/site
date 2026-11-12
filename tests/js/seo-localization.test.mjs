import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';

const layout = readFileSync(new URL('../../source/_layouts/main.blade.php', import.meta.url), 'utf8');
const pricing = readFileSync(new URL('../../source/pricing.blade.php', import.meta.url), 'utf8');
const catalog = JSON.parse(readFileSync(new URL('../../lang/en/main.json', import.meta.url), 'utf8'));

test('SEO title and descriptions use localized text in HTML, Open Graph and Twitter cards', () => {
  assert.match(layout, /\$localizedSeoTitle\s*=\s*\$page->t\(\$page->title\)/);
  assert.match(layout, /\$localizedSeoDescription\s*=\s*\$page->t\(\$page->description\)/);

  for (const metadata of [
    '<title>{{ $localizedSeoTitle }}</title>',
    '<meta property="og:title" content="{{ $localizedSeoTitle }}">',
    '<meta name="twitter:title" content="{{ $localizedSeoTitle }}">',
    '<meta name="description" content="{{ $localizedSeoDescription }}">',
    '<meta property="og:description" content="{{ $localizedSeoDescription }}">',
    '<meta name="twitter:description" content="{{ $localizedSeoDescription }}">',
  ]) {
    assert.ok(layout.includes(metadata), `Missing localized SEO field: ${metadata}`);
  }
});

test('pricing front matter uses keys already extracted to the Weblate English catalog', () => {
  const frontMatter = pricing.match(/^---\n([\s\S]*?)\n---/);
  assert.ok(frontMatter);

  const title = frontMatter[1].match(/^title: "([^"]+)"$/m)?.[1];
  const description = frontMatter[1].match(/^description: "([^"]+)"$/m)?.[1];

  assert.equal(title, 'LibreSign Plans and Pricing');
  assert.equal(description, 'LibreSign is preparing commercial plans for organizations that need support, managed services, cloud infrastructure, integrations, or dedicated guidance.');
  assert.equal(catalog[title], title);
  assert.equal(catalog[description], description);
  assert.match(pricing, /no paid plan is required to use it/);
  assert.match(pricing, /optional integration services/);
});

test('FAQ JSON-LD uses translated questions and answers and safely escapes HTML', () => {
  const faq = readFileSync(new URL('../../source/faq.blade.php', import.meta.url), 'utf8');

  assert.match(faq, /'name'\s*=>\s*\$page->t\(\$fq->question\)/);
  assert.match(faq, /'text'\s*=>\s*\$page->t\(\$fq->answer\)/);
  assert.match(faq, /JSON_HEX_TAG/);
});
