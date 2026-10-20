import test from 'node:test';
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';

const workflow = readFileSync(
  new URL('../../.github/workflows/preview-remove.yml', import.meta.url),
  'utf8',
);

test('preview removal checks out trusted code before invoking the deploy action', () => {
  const checkoutIndex = workflow.indexOf('      - name: Checkout trusted base branch');
  const removeIndex = workflow.indexOf('      - name: Remove preview');
  assert.ok(checkoutIndex >= 0, 'A checkout is required for git configuration');
  assert.ok(removeIndex > checkoutIndex, 'Checkout must precede preview removal');

  const checkout = workflow.slice(checkoutIndex, removeIndex);
  assert.match(checkout, /uses: actions\/checkout@[a-f0-9]{40}/);
  assert.match(checkout, /ref: \$\{\{ github\.event\.repository\.default_branch \}\}/);
  assert.match(checkout, /persist-credentials: false/);
});

test('preview removal can retry cleanup for a previously closed PR', () => {
  assert.match(workflow, /workflow_dispatch:\n    inputs:\n      pr_number:/);
  assert.match(workflow, /pr-number: \$\{\{ github\.event\.pull_request\.number \|\| inputs\.pr_number \}\}/);
  assert.match(workflow, /pull_request_target:\n    branches: \[main\]\n    types: \[closed\]/);
});
