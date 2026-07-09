const HEADER_ROOT_SELECTOR = '.libresign-site-header-fragment';
const DESKTOP_BREAKPOINT = 1200;

const root = document.querySelector(HEADER_ROOT_SELECTOR);

if (root) {
  const header = root.querySelector('[data-libresign-header]');
  const spacer = root.querySelector('.libresign-site-header-fragment__spacer');
  const navToggle = root.querySelector('[data-libresign-header-toggle]');
  const mainNavigation = root.querySelector('#main-navigation');
  const dropdownToggles = Array.from(root.querySelectorAll('[data-libresign-dropdown-toggle]'));
  const skipLink = root.querySelector('.skip-to-content');

  const updateHeaderOffset = () => {
    if (!header || !spacer) {
      return;
    }

    const offset = header.offsetHeight || 76;
    root.style.setProperty('--header-offset', `${offset}px`);
    spacer.style.height = `${offset}px`;
  };

  const closeAllDropdowns = (exceptToggle = null) => {
    dropdownToggles.forEach((toggle) => {
      const menuId = toggle.getAttribute('aria-controls');
      const menu = menuId ? root.querySelector(`#${menuId}`) : null;
      const shouldStayOpen = exceptToggle === toggle;

      toggle.classList.toggle('show', shouldStayOpen);
      toggle.setAttribute('aria-expanded', shouldStayOpen ? 'true' : 'false');

      if (menu) {
        menu.classList.toggle('show', shouldStayOpen);
        menu.hidden = !shouldStayOpen;
      }
    });
  };

  const setNavigationOpen = (isOpen) => {
    if (!navToggle || !mainNavigation) {
      return;
    }

    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    navToggle.classList.toggle('is-open', isOpen);
    mainNavigation.classList.toggle('show', isOpen);
    mainNavigation.hidden = !isOpen;

    if (!isOpen) {
      closeAllDropdowns();
    }
  };

  if (mainNavigation) {
    mainNavigation.hidden = window.innerWidth < DESKTOP_BREAKPOINT;
  }

  dropdownToggles.forEach((toggle) => {
    const menuId = toggle.getAttribute('aria-controls');
    const menu = menuId ? root.querySelector(`#${menuId}`) : null;

    if (menu) {
      menu.hidden = true;
    }

    toggle.addEventListener('click', (event) => {
      event.preventDefault();

      const isOpen = toggle.classList.contains('show');
      if (isOpen) {
        closeAllDropdowns();
        return;
      }

      closeAllDropdowns(toggle);
    });
  });

  if (navToggle && mainNavigation) {
    navToggle.addEventListener('click', () => {
      const isOpen = navToggle.getAttribute('aria-expanded') === 'true';
      setNavigationOpen(!isOpen);
    });
  }

  if (skipLink) {
    skipLink.addEventListener('click', (event) => {
      const preferredTarget = document.querySelector('#main-content, #wp--skip-link--target, main');
      const href = skipLink.getAttribute('href') || '';
      const target = href.startsWith('#') ? document.querySelector(href) : null;
      const focusTarget = target || preferredTarget;

      if (!focusTarget) {
        return;
      }

      event.preventDefault();

      if (!focusTarget.hasAttribute('tabindex')) {
        focusTarget.setAttribute('tabindex', '-1');
      }

      focusTarget.focus({ preventScroll: false });
      focusTarget.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  document.addEventListener('click', (event) => {
    if (!root.contains(event.target)) {
      closeAllDropdowns();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeAllDropdowns();
      setNavigationOpen(false);
      navToggle?.focus();
    }
  });

  const handleResize = () => {
    updateHeaderOffset();

    if (!mainNavigation) {
      return;
    }

    if (window.innerWidth >= DESKTOP_BREAKPOINT) {
      mainNavigation.hidden = false;
      mainNavigation.classList.remove('show');
      navToggle?.setAttribute('aria-expanded', 'false');
      navToggle?.classList.remove('is-open');
    } else {
      const isOpen = navToggle?.getAttribute('aria-expanded') === 'true';
      mainNavigation.hidden = !isOpen;
      if (!isOpen) {
        mainNavigation.classList.remove('show');
      }
    }
  };

  if (typeof ResizeObserver !== 'undefined' && header) {
    const observer = new ResizeObserver(updateHeaderOffset);
    observer.observe(header);
  }

  window.addEventListener('resize', handleResize);
  window.addEventListener('load', updateHeaderOffset);

  handleResize();
  updateHeaderOffset();
}
