(function () {
  "use strict";

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

  function scrollToTop() {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
  }

  window.addEventListener("scroll", debounce(handleScrollElements, 10));

  const backToTopBtn = document.querySelector("#back-to-top");
  if (backToTopBtn) {
    backToTopBtn.addEventListener("click", (event) => {
      event.preventDefault();
      scrollToTop();
    });

    backToTopBtn.addEventListener("keydown", (event) => {
      if (event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        scrollToTop();
      }
    });
  }

  const footerContact = document.querySelector("#footer-contact");
  if (footerContact) {
    const handleContactClick = () => {
      const contactLink = footerContact.getAttribute("data-contact-url");
      if (contactLink) {
        window.location.href = contactLink;
      }
    };

    footerContact.addEventListener("click", handleContactClick);
    footerContact.addEventListener("keydown", (event) => {
      if (event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        handleContactClick();
      }
    });
  }

  handleScrollElements();
})();
