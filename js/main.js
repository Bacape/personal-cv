const navLinks = document.querySelectorAll(".nav-link");
const sections = document.querySelectorAll(".scroll-spy");
const hero = document.querySelector(".hero");
const header = document.querySelector(".header");

function scrollTo(element) {
  window.scroll({
    behavior: "smooth",
    left: 0,
    top: element.offsetTop - header.clientHeight,
  });
}

document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    scrollTo(document.querySelector(this.getAttribute("href")));
  });
});

window.onscroll = () => {
  const currentScroll =
    document.documentElement.scrollTop || document.body.scrollTop;
  const headerHeight = header.clientHeight;

  sections.forEach((v, i) => {
    const elementOffset = v.offsetTop;

    // is scrolled more than element from top
    if (currentScroll >= elementOffset - headerHeight) {
      // remove all current active classes
      navLinks.forEach((v) => v.classList.remove("active"));
      document
        .querySelector(`a[href*=${sections[i].id}]`)
        .classList.add("active");
    }
    return;
  });

  // remove all active classes if the scroll is under the first scroll-spy section
  if (currentScroll < sections[0].offsetTop) {
    navLinks.forEach((v) => v.classList.remove("active"));
  }
};

var i = 0,
  text;
text = "Bačovský Petr";

function typing() {
  if (i < text.length) {
    document.getElementById("hero-tittle").innerHTML += text.charAt(i);
    i++;
    setTimeout(typing, 250);
  }
}
typing();
