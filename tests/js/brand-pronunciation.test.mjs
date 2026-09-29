import test from 'node:test';
import assert from 'node:assert/strict';

import {
  createPronunciationController,
  initBrandPronunciation,
} from '../../source/_assets/js/brand-pronunciation.mjs';

function makeButton() {
  const listeners = new Map();
  const attributes = new Map();

  return {
    disabled: false,
    addEventListener(type, callback) {
      listeners.set(type, callback);
    },
    async click() {
      return listeners.get('click')?.();
    },
    setAttribute(name, value) {
      attributes.set(name, value);
    },
    removeAttribute(name) {
      attributes.delete(name);
    },
    getAttribute(name) {
      return attributes.get(name);
    },
  };
}

function makeAudio({ rejectPlay = false } = {}) {
  const listeners = new Map();

  return {
    currentTime: 7,
    playCalls: 0,
    addEventListener(type, callback) {
      listeners.set(type, callback);
    },
    async play() {
      this.playCalls += 1;
      if (rejectPlay) {
        throw new Error('playback failed');
      }
    },
    emit(type) {
      listeners.get(type)?.();
    },
  };
}

test('controller restarts and plays the recorded pronunciation', async () => {
  const button = makeButton();
  const status = { textContent: '' };
  const audio = makeAudio();

  const controller = createPronunciationController({ button, status, audio });
  await controller.play();

  assert.equal(audio.currentTime, 0);
  assert.equal(audio.playCalls, 1);
  assert.equal(button.disabled, true);
  assert.equal(button.getAttribute('aria-busy'), 'true');
  assert.equal(status.textContent, 'Playing LibreSign pronunciation.');

  audio.emit('ended');

  assert.equal(status.textContent, 'Pronunciation playback finished.');
  assert.equal(button.disabled, false);
  assert.equal(button.getAttribute('aria-busy'), undefined);
});

test('controller restores the button when recorded audio cannot play', async () => {
  const button = makeButton();
  const status = { textContent: '' };
  const audio = makeAudio({ rejectPlay: true });

  const controller = createPronunciationController({ button, status, audio });
  await controller.play();

  assert.equal(
    status.textContent,
    'Pronunciation playback is not available on this device.',
  );
  assert.equal(button.disabled, false);
  assert.equal(button.getAttribute('aria-busy'), undefined);
});

test('controller handles media errors', () => {
  const button = makeButton();
  const status = { textContent: '' };
  const audio = makeAudio();

  createPronunciationController({ button, status, audio });

  button.disabled = true;
  button.setAttribute('aria-busy', 'true');
  audio.emit('error');

  assert.equal(
    status.textContent,
    'Pronunciation playback is not available on this device.',
  );
  assert.equal(button.disabled, false);
  assert.equal(button.getAttribute('aria-busy'), undefined);
});

test('init returns false when required elements are missing', () => {
  const documentRef = {
    querySelector() {
      return null;
    },
  };

  assert.equal(initBrandPronunciation({ documentRef }), false);
});

test('init wires the recorded audio control when all elements exist', () => {
  const button = makeButton();
  const status = { textContent: '' };
  const audio = makeAudio();

  const documentRef = {
    querySelector(selector) {
      if (selector === '[data-brand-pronunciation]') return button;
      if (selector === '[data-brand-pronunciation-status]') return status;
      if (selector === '[data-brand-pronunciation-audio]') return audio;
      return null;
    },
  };

  assert.equal(initBrandPronunciation({ documentRef }), true);
});
