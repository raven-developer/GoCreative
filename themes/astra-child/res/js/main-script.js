
(() => {

    // ========================================
    // GC SERVICES — HORIZONTAL SCROLL
    // ========================================

    const rail = document.querySelector(".gc-services--rail");
    const sticky = document.querySelector(".gc-services--sticky_rail");
    const track = document.querySelector(".gc-services--track");

    if (!rail || !sticky || !track) return;

    const mobile = window.matchMedia("(max-width: 767px)");

    let animationFrame = null;

    let travel = 0;
    let verticalDistance = 1;
    let stickyTop = 0;


    // ========================================
    // GET VISIBLE RIGHT BOUNDARY
    // ========================================

    function getVisibleRight() {

        let right = window.innerWidth;

        let el = sticky.parentElement;

        while (el && el !== document.documentElement) {

            const styles = getComputedStyle(el);
            const rect = el.getBoundingClientRect();

            // Horizontal clipping.

            if (
                styles.overflowX !== "visible" ||
                styles.overflowY !== "visible"
            ) {

                right = Math.min(right, rect.right);

            }

            el = el.parentElement;

        }

        return right;

    }


    // ========================================
    // CALCULATE HORIZONTAL TRAVEL
    // ========================================

    function getTravelDistance() {

        const stickyRect = sticky.getBoundingClientRect();

        const visibleRight = getVisibleRight();

        const visibleWidth = Math.max(
            0,
            visibleRight - stickyRect.left
        );

        return Math.max(
            0,
            track.scrollWidth - visibleWidth
        );

    }


    // ========================================
    // UPDATE HORIZONTAL POSITION
    // ========================================

    function updateRail() {

        animationFrame = null;

        if (mobile.matches) return;

        const railTop = rail.getBoundingClientRect().top;

        // Vertical scroll progress.

        const progress = Math.min(
            1,
            Math.max(
                0,
                (stickyTop - railTop) / verticalDistance
            )
        );

        // Horizontal translation.

        const position = travel * progress;

        track.style.transform = `translate3d(${-position}px, 0, 0)`;

    }


    // ========================================
    // REQUEST ANIMATION FRAME
    // ========================================

    function requestRailUpdate() {

        if (animationFrame !== null) return;

        animationFrame = requestAnimationFrame(updateRail);

    }


    // ========================================
    // RECALCULATE DIMENSIONS
    // ========================================

    function setRailHeight() {

        if (mobile.matches) {

            rail.style.height = "auto";

            track.style.transform = "";

            travel = 0;
            verticalDistance = 1;

            return;

        }

        // Read layout dimensions.

        const stickyHeight = sticky.offsetHeight;

        travel = getTravelDistance();

        verticalDistance = Math.max(1, travel);

        // Sticky positioning offset.

        stickyTop = parseFloat(
            getComputedStyle(sticky).top
        ) || 0;

        // Vertical distance equals horizontal travel.

        rail.style.height = `${stickyHeight + travel}px`;

        requestRailUpdate();

    }


    // ========================================
    // EVENT LISTENERS
    // ========================================

    function toggleEventListeners() {
        if ( mobile.matches ) {
            window.removeEventListener(
                "scroll",
                requestRailUpdate,
            );

            window.removeEventListener(
                "resize",
                setRailHeight,
            );

            window.removeEventListener(
                "load",
                setRailHeight
            );

            mobile.removeEventListener(
                "change",
                setRailHeight
            );
        } else {
            window.addEventListener(
                "scroll",
                requestRailUpdate,
                { passive: true }
            );

            window.addEventListener(
                "resize",
                setRailHeight,
                { passive: true }
            );

            window.addEventListener(
                "load",
                setRailHeight
            );

            mobile.addEventListener(
                "change",
                setRailHeight
            );
        }
    }


    // ========================================
    // RESIZE OBSERVER
    // ========================================

    const resizeObserver = new ResizeObserver(() => {

        setRailHeight();

    });

    resizeObserver.observe(sticky);
    resizeObserver.observe(track);


    // ========================================
    // FONT LOADING
    // ========================================

    if (document.fonts?.ready) {

        document.fonts.ready.then(setRailHeight);

    }


    // ========================================
    // INITIALIZATION
    // ========================================

    setRailHeight();
    toggleEventListeners();


})();
