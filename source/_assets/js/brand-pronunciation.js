const button = document.querySelector('[data-brand-pronunciation]');
const status = document.querySelector('[data-brand-pronunciation-status]');

if (button && status && 'speechSynthesis' in window && 'SpeechSynthesisUtterance' in window) {
  const synth = window.speechSynthesis;

  const pickVoice = (language) => {
    const prefix = language.toLowerCase().split('-')[0];
    return synth.getVoices().find((voice) => voice.lang.toLowerCase().startsWith(prefix));
  };

  const makeUtterance = (text, language) => {
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = language;
    utterance.rate = 0.9;

    const voice = pickVoice(language);
    if (voice) {
      utterance.voice = voice;
    }

    return utterance;
  };

  const reset = () => {
    button.disabled = false;
    button.removeAttribute('aria-busy');
  };

  button.hidden = false;

  button.addEventListener('click', () => {
    synth.cancel();
    button.disabled = true;
    button.setAttribute('aria-busy', 'true');
    status.textContent = 'Playing LibreSign pronunciation.';

    // "Libre" follows the Romance-language reading documented by the brand,
    // while "Sign" keeps its English pronunciation.
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
  });
}
