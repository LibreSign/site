import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';

const workflow = readFileSync(
  new URL('../../.github/workflows/preview-fork-deploy.yml', import.meta.url),
  'utf8',
);

test('fork preview checks out trusted code before the Git-based deploy action', () => {
  const checkoutIndex = workflow.indexOf('      - name: Checkout trusted base branch');
  const deployIndex = workflow.indexOf('      - name: Deploy preview');
  assert.ok(checkoutIndex >= 0, 'GitHub Pages action needs a Git checkout');
  assert.ok(deployIndex > checkoutIndex, 'Trusted checkout must precede deployment');

  const checkout = workflow.slice(checkoutIndex, deployIndex);
  assert.match(checkout, /uses: actions\/checkout@[a-f0-9]{40}/);
  assert.match(checkout, /ref: \$\{\{ github\.event\.repository\.default_branch \}\}/);
  assert.match(checkout, /persist-credentials: false/);
  assert.doesNotMatch(checkout, /ref: \$\{\{ github\.event\.workflow_run/);
});

test('fork preview only deploys the matching open PR and completed revision', () => {
  assert.match(workflow, /workflow_run\.conclusion == 'success'/);
  assert.match(workflow, /workflow_run\.head_repository\.id != github\.event\.repository\.id/);
  assert.match(workflow, /\.headRefOid == \$sha and \.headRepository\.nameWithOwner == \$repo/);
  assert.match(workflow, /\.state == "OPEN" and \.baseRefName == "main"/);
});
