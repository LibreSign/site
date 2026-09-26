(function () {
  "use strict";

  function setupPricingComparisonStickyHeader() {
    const section = document.querySelector("#pricing-comparison");
    const stickyHeader = section?.querySelector(".pricing-comparison-sticky-header");
    const stickyViewport = stickyHeader?.querySelector(".pricing-comparison-sticky-header__viewport");
    const shell = section?.querySelector(".pricing-comparison-shell");
    const tableWrapper = shell?.querySelector(".table-responsive");
    const table = tableWrapper?.querySelector(".pricing-comparison-table");
    const tableHead = table?.querySelector("thead");

    if (!section || !stickyHeader || !stickyViewport || !shell || !tableWrapper || !table || !tableHead) {
      return;
    }

    const stickyTable = document.createElement("table");
    stickyTable.className = `${table.className} pricing-comparison-sticky-header-table`;
    stickyTable.setAttribute("role", "presentation");
    stickyTable.innerHTML = tableHead.outerHTML;
    stickyViewport.replaceChildren(stickyTable);

    const syncStickyColumnWidths = () => {
      const originalCells = [...tableHead.querySelectorAll("th")];
      const stickyCells = [...stickyTable.querySelectorAll("th")];

      originalCells.forEach((cell, index) => {
        const stickyCell = stickyCells[index];

        if (!stickyCell) {
          return;
        }

        const { width } = cell.getBoundingClientRect();
        const resolvedWidth = `${Math.round(width)}px`;

        stickyCell.style.width = resolvedWidth;
        stickyCell.style.minWidth = resolvedWidth;
        stickyCell.style.maxWidth = resolvedWidth;
      });
    };

    let frameRequested = false;

    const syncStickyHeader = () => {
      frameRequested = false;

      const headerOffset = Math.ceil(document.querySelector(".ud-header")?.getBoundingClientRect().height || 0);
      const wrapperRect = tableWrapper.getBoundingClientRect();
      const tableRect = table.getBoundingClientRect();
      const tableHeadRect = tableHead.getBoundingClientRect();
      const shouldShow = tableHeadRect.top <= headerOffset && tableRect.bottom > headerOffset + tableHeadRect.height;

      syncStickyColumnWidths();

      stickyHeader.style.top = `${headerOffset}px`;
      stickyHeader.style.left = `${wrapperRect.left}px`;
      stickyHeader.style.width = `${wrapperRect.width}px`;
      stickyTable.style.width = `${table.scrollWidth}px`;
      stickyTable.style.transform = `translateX(${-tableWrapper.scrollLeft}px)`;
      stickyHeader.classList.toggle("is-visible", shouldShow);
    };

    const requestSync = () => {
      if (frameRequested) {
        return;
      }

      frameRequested = true;
      window.requestAnimationFrame(syncStickyHeader);
    };

    tableWrapper.addEventListener("scroll", requestSync, { passive: true });
    window.addEventListener("scroll", requestSync, { passive: true });
    window.addEventListener("resize", requestSync);
    window.addEventListener("load", requestSync, { once: true });

    if (window.ResizeObserver) {
      const resizeObserver = new ResizeObserver(requestSync);
      resizeObserver.observe(tableWrapper);
      resizeObserver.observe(table);
      resizeObserver.observe(tableHead);
    }

    if (document.fonts?.ready) {
      document.fonts.ready.then(requestSync).catch(() => {});
    }

    requestSync();
  }

  setupPricingComparisonStickyHeader();
})();
