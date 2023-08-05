const nav = document.querySelector("header ul"),
  navOpenBtn = document.querySelector(".menu-toggle"),
  navCloseBtn = document.querySelector(".closeBtn");
navOpenBtn.addEventListener("click", () => {
  nav.classList.add("openNav");
  nav.classList.remove("openSearch");
});
navCloseBtn.addEventListener("click", () => {
  nav.classList.remove("openNav");
});
