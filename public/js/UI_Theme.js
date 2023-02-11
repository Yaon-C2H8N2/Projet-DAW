// document.getElementById("link").getAttribute("href");

const darkThemeMq = window.matchMedia("(prefers-color-scheme: dark)");
if (darkThemeMq.matches) {
  document.getElementById("link").href = "../css/dark_mode.css";
} else {
  document.getElementById("link").href = "../css/light_mode.css";
}
