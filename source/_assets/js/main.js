require('bootstrap/dist/js/bootstrap.bundle.min.js');
require('aos/dist/aos.css');

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

  //===== close navbar-collapse when a  clicked
  let navbarToggler = document.querySelector(".navbar-toggler");
  const navbarCollapse = document.querySelector(".navbar-collapse");

  document.querySelectorAll(".ud-menu-scroll").forEach((e) =>
    e.addEventListener("click", () => {
      navbarToggler.classList.remove("active");
      navbarCollapse.classList.remove("show");
    })
  );
  navbarToggler.addEventListener("click", function () {
    navbarToggler.classList.toggle("active");
    navbarCollapse.classList.toggle("show");
  });

  // ===== submenu
  const submenuButton = document.querySelectorAll(".nav-item-has-children");
  submenuButton.forEach((elem) => {
    elem.querySelector("a").addEventListener("click", () => {
      elem.querySelector(".ud-submenu").classList.toggle("show");
    });
  });

  // ===== selector
  const selectorButton = document.querySelectorAll(".selector");
  selectorButton.forEach((elem) => {
    elem.querySelector("button").addEventListener("click", () => {
      elem.querySelector(".ud-submenu").classList.toggle("show");
    });
  });

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
