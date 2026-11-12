import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';

const successStories = readFileSync(new URL('../../source/success-stories.blade.php', import.meta.url), 'utf8');
const carousel = readFileSync(new URL('../../source/_partials/testimonial_card.blade.php', import.meta.url), 'utf8');
const config = readFileSync(new URL('../../config.php', import.meta.url), 'utf8');

test('testimonials display translated source text and identify internal reviews', () => {
  assert.match(successStories, /\$page->t\(\$testimonial\['description'\]\)/);
  assert.match(successStories, /\$page->t\(\$testimonial\['origin'\]\)/);
  assert.match(successStories, /\$page->t\(\$testimonial\['affiliation'\]\)/);
  assert.match(config, /'author' => 'Daiane Alves',[\s\S]*?'affiliation' => 'President of LibreCode'/);
});

test('testimonials do not invent ratings absent from their source data', () => {
  assert.doesNotMatch(successStories, /5 out of 5 stars|ud-testimonial-ratings|lni-star-fat/);
  assert.doesNotMatch(carousel, /testimonial_color_stars|lni-star-fat/);
});
