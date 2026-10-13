export function createPronunciationController({ button, status, audio }) {
  const reset = () => {
    button.disabled = false;
    button.removeAttribute('aria-busy');
  };

  const play = async () => {
    audio.currentTime = 0;
    button.disabled = true;
    button.setAttribute('aria-busy', 'true');
    status.textContent = 'Playing LibreSign pronunciation.';

    try {
      await audio.play();
    } catch {
      status.textContent = 'Pronunciation playback is not available on this device.';
      reset();
    }
  };

  audio.addEventListener('ended', () => {
    status.textContent = 'Pronunciation playback finished.';
    reset();
  });

  audio.addEventListener('error', () => {
    status.textContent = 'Pronunciation playback is not available on this device.';
    reset();
  });

  button.addEventListener('click', play);

  return { play };
}

export function initBrandPronunciation({ documentRef = document } = {}) {
  const button = documentRef.querySelector('[data-brand-pronunciation]');
  const status = documentRef.querySelector('[data-brand-pronunciation-status]');
  const audio = documentRef.querySelector('[data-brand-pronunciation-audio]');

  if (!button || !status || !audio || typeof audio.play !== 'function') {
    return false;
  }

  createPronunciationController({ button, status, audio });
  return true;
}
