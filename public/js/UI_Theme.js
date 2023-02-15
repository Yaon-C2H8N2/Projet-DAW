// document.getElementById("link").getAttribute("href");

/**
 * @details Ajuste le thème de l'UI en fonction du thème de l'ordinateur
 */
const darkThemeMq = window.matchMedia("(prefers-color-scheme: dark)");
if (darkThemeMq.matches) {
    document.getElementById("link").href = "../css/dark_mode.css";
} else {
    document.getElementById("link").href = "../css/light_mode.css";
}

/**
 * @details Fonction pour changer le thème de l'UI via un bouton
 * @brief Si le href de l'élément link revoit la feuille de style du css en mode sombre, on met en thème light sinon on met en mode sombre
 */
function ChangeColorUI() {
    if (document.getElementById("link").getAttribute("href") === "../css/dark_mode.css") document.getElementById("link").href = "../css/light_mode.css";
    else document.getElementById("link").href = "../css/dark_mode.css";
}
