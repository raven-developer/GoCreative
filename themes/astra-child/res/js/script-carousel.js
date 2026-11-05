function initLogoSlider(container, index) {
  const FORCE_MOTION = true; // testing only
  const DURATION = 50;

  const direction = container.classList.contains("gc-slider--rtl")
    ? "rtl"
    : "ltr";

  const reduceMotion =
    !FORCE_MOTION &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const swiper = new Swiper(container, {
    slidesPerView: "auto",
    spaceBetween: 12,
    loop: false,
    allowTouchMove: false,
    speed: 0,
  });

  const wrapper = swiper.wrapperEl;
  const originalSlides = [...wrapper.children];

  if (direction === "rtl") {
    originalSlides.reverse().forEach(function (slide) {
      wrapper.appendChild(slide);
    });
  }

  function addSet() {
    originalSlides.forEach(function (slide) {
      const clone = slide.cloneNode(true);
      clone.removeAttribute("id");
      clone.setAttribute("aria-hidden", "true");
      clone.inert = true;

      clone.querySelectorAll("img").forEach(function (img) {
        img.setAttribute("alt", "");
      });

      wrapper.appendChild(clone);
    });
  }

  addSet();

  const cycleWidth =
    wrapper.children[originalSlides.length].offsetLeft -
    originalSlides[0].offsetLeft;

  console.log("logoSwiper", index, direction, "cycle width:", cycleWidth);

  if (cycleWidth <= 0 || reduceMotion) return;

  const needed = Math.ceil(
    Math.max(window.screen.width, container.clientWidth) / cycleWidth,
  );

  for (let i = 0; i < needed; i++) addSet();

  let offset = 0;
  let previousTime = null;
  const speed = cycleWidth / DURATION;

  function animate(time) {
    if (previousTime === null) previousTime = time;

    const delta = Math.min(time - previousTime, 100);
    previousTime = time;

    if (!document.hidden) {
      offset = (offset + speed * (delta / 1000)) % cycleWidth;

      const x = direction === "rtl" ? -offset : offset - cycleWidth;

      wrapper.style.transform = "translate3d(" + x + "px, 0, 0)";
    }

    requestAnimationFrame(animate);
  }

  requestAnimationFrame(animate);
}

function initAllLogoSliders() {
  document.querySelectorAll(".gc-slider.swiper").forEach(initLogoSlider);
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initAllLogoSliders);
} else {
  initAllLogoSliders();
}
