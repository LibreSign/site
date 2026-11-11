import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';

const pricing = readFileSync(new URL('../../source/pricing.blade.php', import.meta.url), 'utf8');

test('pricing distinguishes the free API from optional paid integration services', () => {
  assert.match(pricing, /Professional API integration services/);
  assert.match(pricing, /The LibreSign API is part of the free and open-source software; no paid plan is required to use it\./);
  assert.match(pricing, /Our team offers optional integration services/);
  assert.match(pricing, /href="https:\/\/docs\.libresign\.coop\/"/);
});

test('pricing retains the contact action for professional integration services', () => {
  assert.match(pricing, /locale_url\(\$page, 'contact-us'\)[\s\S]*?Discuss integration/);
});
