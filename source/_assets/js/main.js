import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'animate.css';

import AOS from 'aos';
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
AOS.init({
  duration: 800,
  easing: 'ease-in-out-quart',
  once: true,
  disable: prefersReducedMotion || 'mobile'
});

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
        backToTop.removeAttribute("tabindex");
      } else {
        backToTop.classList.remove("visible");
        backToTop.setAttribute("aria-hidden", "true");
        backToTop.setAttribute("tabindex", "-1");
      }
    }

    if (footerContact) {
      if (shouldShow) {
        footerContact.classList.add("visible");
        footerContact.setAttribute("aria-hidden", "false");
        footerContact.setAttribute("tabindex", "0");
      } else {
        footerContact.classList.remove("visible");
        footerContact.setAttribute("aria-hidden", "true");
        footerContact.setAttribute("tabindex", "-1");
      }
    }
  }

  // Attach scroll handler with debounce
  window.addEventListener("scroll", debounce(handleScrollElements, 10), { passive: true });

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
