import test from 'node:test';
import assert from 'node:assert/strict';

import {
  createPronunciationController,
  initBrandPronunciation,
  pickVoice,
} from '../../source/_assets/js/brand-pronunciation.mjs';

class FakeUtterance {
  constructor(text) {
    this.text = text;
    this.lang = '';
    this.rate = 1;
    this.voice = null;
    this.listeners = new Map();
  }

  addEventListener(type, callback) {
    this.listeners.set(type, callback);
  }

  emit(type) {
    const callback = this.listeners.get(type);
    if (callback) {
      callback();
    }
  }
}

function makeButton() {
  const listeners = new Map();
  const attributes = new Map();

  return {
    hidden: true,
    disabled: false,
    addEventListener(type, callback) {
      listeners.set(type, callback);
    },
    click() {
      listeners.get('click')?.();
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

test('pickVoice matches the requested language prefix case-insensitively', () => {
  const voices = [
    { lang: 'en-US', name: 'English' },
    { lang: 'ES-es', name: 'Spanish' },
  ];

  assert.equal(pickVoice(voices, 'es-MX'), voices[1]);
  assert.equal(pickVoice(voices, 'pt-BR'), undefined);
});

test('controller plays Libre first, then Sign, and restores the button', () => {
  const button = makeButton();
  const status = { textContent: '' };
  const spoken = [];
  let cancelled = 0;

  const synth = {
    getVoices: () => [{ lang: 'es-ES' }, { lang: 'en-US' }],
    cancel: () => { cancelled += 1; },
    speak: (utterance) => { spoken.push(utterance); },
  };

  createPronunciationController({
    button,
    status,
    synth,
    Utterance: FakeUtterance,
  });

  assert.equal(button.hidden, false);

  button.click();

  assert.equal(cancelled, 1);
  assert.equal(button.disabled, true);
  assert.equal(button.getAttribute('aria-busy'), 'true');
  assert.equal(status.textContent, 'Playing LibreSign pronunciation.');
  assert.equal(spoken.length, 1);
  assert.equal(spoken[0].text, 'Libre');
  assert.equal(spoken[0].lang, 'es');
  assert.equal(spoken[0].rate, 0.9);

  spoken[0].emit('end');

  assert.equal(spoken.length, 2);
  assert.equal(spoken[1].text, 'sign');
  assert.equal(spoken[1].lang, 'en');

  spoken[1].emit('end');

  assert.equal(status.textContent, 'Pronunciation playback finished.');
  assert.equal(button.disabled, false);
  assert.equal(button.getAttribute('aria-busy'), undefined);
});

test('controller restores the button when playback fails', () => {
  const button = makeButton();
  const status = { textContent: '' };
  const spoken = [];

  const synth = {
    getVoices: () => [],
    cancel: () => {},
    speak: (utterance) => { spoken.push(utterance); },
  };

  createPronunciationController({
    button,
    status,
    synth,
    Utterance: FakeUtterance,
  });

  button.click();
  spoken[0].emit('error');

  assert.equal(
    status.textContent,
    'Pronunciation playback is not available on this device.',
  );
  assert.equal(button.disabled, false);
  assert.equal(button.getAttribute('aria-busy'), undefined);
});

test('init does not expose the control when speech synthesis is unavailable', () => {
  const button = makeButton();
  const status = { textContent: '' };
  const documentRef = {
    querySelector(selector) {
      if (selector === '[data-brand-pronunciation]') return button;
      if (selector === '[data-brand-pronunciation-status]') return status;
      return null;
    },
  };

  const initialized = initBrandPronunciation({
    documentRef,
    windowRef: {},
  });

  assert.equal(initialized, false);
  assert.equal(button.hidden, true);
});

test('init exposes the control when speech synthesis is supported', () => {
  const button = makeButton();
  const status = { textContent: '' };
  const documentRef = {
    querySelector(selector) {
      if (selector === '[data-brand-pronunciation]') return button;
      if (selector === '[data-brand-pronunciation-status]') return status;
      return null;
    },
  };

  const windowRef = {
    speechSynthesis: {
      getVoices: () => [],
      cancel: () => {},
      speak: () => {},
    },
    SpeechSynthesisUtterance: FakeUtterance,
  };

  const initialized = initBrandPronunciation({
    documentRef,
    windowRef,
  });

  assert.equal(initialized, true);
  assert.equal(button.hidden, false);
});
