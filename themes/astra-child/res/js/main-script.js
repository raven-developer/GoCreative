(() => {

    // ========================================
    // HORIZONTAL SCROLL
    // ========================================

    const rail = document.querySelector(".gc-services--rail");
    const sticky = document.querySelector(".gc-services--sticky_rail");
    const track = document.querySelector(".gc-services--track");

    const mobile = window.matchMedia("(max-width: 760px)");

    let animationFrame = null;

    // Horizontal travel in px, calculated in setRailHeight().
    let travel = 0;


    // ----------------------------------------
    // GET THE RIGHT EDGE OF THE VISIBLE AREA
    // ----------------------------------------

    // The sticky element can be wider than what the visitor sees,
    // because an ancestor with overflow hidden/clip (for example the
    // 1920px inner container) cuts it off. The track has to stop at
    // the nearest of those edges, not at the sticky element's own edge.

    function getVisibleRight() {

        let right = sticky.getBoundingClientRect().right;

        let el = sticky.parentElement;

        while (el && el !== document.documentElement) {

            if (getComputedStyle(el).overflowX !== "visible") {

                right = Math.min(
                    right,
                    el.getBoundingClientRect().right
                );

            }

            el = el.parentElement;

        }

        return right;

    }


    // ----------------------------------------
    // GET HORIZONTAL TRAVEL DISTANCE
    // ----------------------------------------

    function getTravelDistance() {

        if (!track || !sticky) return 0;

        const left = sticky.getBoundingClientRect().left;

        const visibleWidth = getVisibleRight() - left;

        return Math.max(
            0,
            track.scrollWidth - visibleWidth
        );

    }


    // ----------------------------------------
    // UPDATE HORIZONTAL POSITION
    // ----------------------------------------

    function updateRail() {

        animationFrame = null;

        if (!rail || !sticky || !track || mobile.matches) {
            return;
        }

        const railRect = rail.getBoundingClientRect();

        const verticalDistance = Math.max(
            1,
            rail.offsetHeight - sticky.offsetHeight
        );

        // The sticky element pins at its CSS "top" value
        // (admin bar + header), not at 0.

        const stickyTop = parseFloat(getComputedStyle(sticky).top) || 0;

        // Vertical scroll progress, 0 to 1.

        const scrollProgress = Math.min(
            1,
            Math.max(0, (stickyTop - railRect.top) / verticalDistance)
        );

        // Horizontal translation.

        const horizontalPosition = travel * scrollProgress;

        track.style.transform = `translate3d(${-horizontalPosition}px, 0, 0)`;

    }


    // ----------------------------------------
    // REQUEST ANIMATION FRAME
    // ----------------------------------------

    function requestRailUpdate() {

        if (!animationFrame) {

            animationFrame = requestAnimationFrame(
                updateRail
            );

        }

    }


    // ----------------------------------------
    // SET RAIL HEIGHT
    // ----------------------------------------

    function setRailHeight() {

        if (!rail || !sticky || !track) {
            return;
        }

        // Mobile uses native horizontal scrolling.

        if (mobile.matches) {

            rail.style.height = "auto";

            track.style.transform = "";

            return;

        }

        travel = getTravelDistance();

        const stickyHeight = sticky.offsetHeight;

        // Vertical scroll distance must equal
        // the horizontal distance travelled.

        rail.style.height = `${stickyHeight + travel}px`;

        requestRailUpdate();

    }


    // ----------------------------------------
    // EVENT LISTENERS
    // ----------------------------------------

    window.addEventListener(
        "scroll",
        requestRailUpdate,
        { passive: true }
    );

    window.addEventListener(
        "resize",
        setRailHeight
    );

    window.addEventListener(
        "load",
        setRailHeight
    );

    // Recalculate after fonts finish loading.

    if (document.fonts?.ready) {

        document.fonts.ready.then(setRailHeight);

    }

    // Recalculate when switching between
    // desktop and mobile breakpoints.

    mobile.addEventListener(
        "change",
        setRailHeight
    );


    // Initial calculation.

    setRailHeight();

})();

(() => {
  const s = document.querySelector(".gc-services--sticky_rail");
  const r = s.getBoundingClientRect();
  console.log("sticky", { left: Math.round(r.left), width: Math.round(r.width) });

  let el = s.parentElement;
  while (el && el !== document.documentElement) {
    const cs = getComputedStyle(el);
    const b = el.getBoundingClientRect();
    console.log(el.className.split(" ")[0] || el.tagName, {
      left: Math.round(b.left),
      width: Math.round(b.width),
      overflowX: cs.overflowX,
      maxWidth: cs.maxWidth
    });
    el = el.parentElement;
  }
})();