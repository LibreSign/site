export function pickVoice(voices, language) {
  const prefix = language.toLowerCase().split('-')[0];
  return voices.find((voice) => voice.lang.toLowerCase().startsWith(prefix));
}

export function createPronunciationController({ button, status, synth, Utterance }) {
  const makeUtterance = (text, language) => {
    const utterance = new Utterance(text);
    utterance.lang = language;
    utterance.rate = 0.9;

    const voice = pickVoice(synth.getVoices(), language);
    if (voice) {
      utterance.voice = voice;
    }

    return utterance;
  };

  const reset = () => {
    button.disabled = false;
    button.removeAttribute('aria-busy');
  };

  const play = () => {
    synth.cancel();
    button.disabled = true;
    button.setAttribute('aria-busy', 'true');
    status.textContent = 'Playing LibreSign pronunciation.';

    const libre = makeUtterance('Libre', 'es');
    const sign = makeUtterance('sign', 'en');

    libre.addEventListener('end', () => synth.speak(sign), { once: true });
    libre.addEventListener('error', () => {
      status.textContent = 'Pronunciation playback is not available on this device.';
      reset();
    }, { once: true });

    sign.addEventListener('end', () => {
      status.textContent = 'Pronunciation playback finished.';
      reset();
    }, { once: true });
    sign.addEventListener('error', () => {
      status.textContent = 'Pronunciation playback is not available on this device.';
      reset();
    }, { once: true });

    synth.speak(libre);
  };

  button.hidden = false;
  button.addEventListener('click', play);

  return { play };
}

export function initBrandPronunciation({ documentRef = document, windowRef = window } = {}) {
  const button = documentRef.querySelector('[data-brand-pronunciation]');
  const status = documentRef.querySelector('[data-brand-pronunciation-status]');

  if (
    !button ||
    !status ||
    !('speechSynthesis' in windowRef) ||
    !('SpeechSynthesisUtterance' in windowRef)
  ) {
    return false;
  }

  createPronunciationController({
    button,
    status,
    synth: windowRef.speechSynthesis,
    Utterance: windowRef.SpeechSynthesisUtterance,
  });

  return true;
}
