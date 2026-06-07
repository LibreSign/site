import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'animate.css';

import AOS from 'aos';
AOS.init({
  duration: 800,
  easing: 'ease-in-out-quart',
  once: true,
  disable: 'mobile'
});

// ====== Split-link dropdown (Features nav item)
// Desktop (≥992px): CSS :hover opens submenu; click on link navigates normally.
// Mobile (<992px):  tap opens/closes submenu; navigation via "All Features →" inside.
(function () {
  const splitItem = document.querySelector('.ud-nav-split');
  if (!splitItem) return;

  const splitLink = splitItem.querySelector('.ud-nav-split-link');
  const submenu   = splitItem.querySelector('.ud-nav-submenu');

  splitLink.addEventListener('click', function (e) {
    if (window.innerWidth >= 992) return; // desktop: navigate normally
    e.preventDefault();
    const isOpen = submenu.classList.contains('show');
    // Close any other open submenus first
    document.querySelectorAll('.ud-nav-submenu.show').forEach(function (el) {
      el.classList.remove('show');
    });
    if (!isOpen) submenu.classList.add('show');
  });

  // Close when tapping outside the item
  document.addEventListener('click', function (e) {
    if (!splitItem.contains(e.target)) {
      submenu.classList.remove('show');
    }
  });

  // Close when the navbar collapses (hamburger closed)
  const navbar = document.getElementById('main-navigation');
  if (navbar) {
    navbar.addEventListener('hidden.bs.collapse', function () {
      submenu.classList.remove('show');
    });
  }
})();

(function () {
  "use strict";

  // Debounce function to improve performance
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  // Show or hide scroll-dependent elements
  function handleScrollElements() {
    const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    const backToTop = document.querySelector("#back-to-top");
    const footerContact = document.querySelector("#footer-contact");
    const shouldShow = scrollTop > 50;

    if (backToTop) {
      if (shouldShow) {
        backToTop.classList.add("visible");
        backToTop.setAttribute("aria-hidden", "false");
      } else {
        backToTop.classList.remove("visible");
        backToTop.setAttribute("aria-hidden", "true");
      }
    }

    if (footerContact) {
      if (shouldShow) {
        footerContact.classList.add("visible");
        footerContact.setAttribute("aria-hidden", "false");
      } else {
        footerContact.classList.remove("visible");
        footerContact.setAttribute("aria-hidden", "true");
      }
    }
  }

  // Attach scroll handler with debounce
  window.addEventListener("scroll", debounce(handleScrollElements, 10));

  // ====== scroll top js
  function scrollTo(element, to = 0, duration = 500) {
    const start = element.scrollTop;
    const change = to - start;
    const increment = 20;
    let currentTime = 0;

    const animateScroll = () => {
      currentTime += increment;

      const val = Math.easeInOutQuad(currentTime, start, change, duration);

      element.scrollTop = val;

      if (currentTime < duration) {
        setTimeout(animateScroll, increment);
      }
    };

    animateScroll();
  }

  Math.easeInOutQuad = function (t, b, c, d) {
    t /= d / 2;
    if (t < 1) return (c / 2) * t * t + b;
    t--;
    return (-c / 2) * (t * (t - 2) - 1) + b;
  };

  // Back to top button functionality
  const backToTopBtn = document.querySelector(".back-to-top");
  if (backToTopBtn) {
    backToTopBtn.addEventListener("click", (e) => {
      e.preventDefault();
      scrollTo(document.documentElement);
    });

    // Keyboard support
    backToTopBtn.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        scrollTo(document.documentElement);
      }
    });
  }

  // Footer contact functionality
  const footerContact = document.querySelector("#footer-contact");
  if (footerContact) {
    const handleContactClick = () => {
      // Add your contact/sales redirect logic here
      // For example: window.location.href = '/contact-us' or open a modal
      const contactLink = footerContact.getAttribute("data-contact-url");
      if (contactLink) {
        window.location.href = contactLink;
      }
    };

    footerContact.addEventListener("click", handleContactClick);

    // Keyboard support
    footerContact.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        handleContactClick();
      }
    });
  }

  // Initialize scroll elements state
  handleScrollElements();
})();
