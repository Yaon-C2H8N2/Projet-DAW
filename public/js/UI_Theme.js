/**
 * @details Ajuste le thème de l'UI en fonction du thème de l'ordinateur
 */

var darkMode;

//Creation de la variable dans le navigateur si non existante
if (localStorage.getItem("dark-mode") === null) {
    darkMode = localStorage.getItem("dark-mode");
    localStorage.setItem("dark-mode", "auto");
    console.log("Creation de var : dark-mode en mode auto");
}

if (localStorage.getItem("dark-mode") === "auto") {
    var darkThemeMq = window.matchMedia("(prefers-color-scheme: dark)");
    if (darkThemeMq.matches) {
        document.getElementById("link").href = "../css/dark_mode.css";
    } else {
        document.getElementById("link").href = "../css/light_mode.css";
    }
} else {
    if (localStorage.getItem("dark-mode") === "manuel:light") {
        document.getElementById("link").href = "../css/light_mode.css";
    } else {
        document.getElementById("link").href = "../css/dark_mode.css";
    }
}

/**
 * @details Fonction qui change de couleur le fond du bg en prenant en compte les anciens états et en mettant à jour les nouveaux
 */
function ChangeColorUI() {
    localStorage.setItem("dark-mode", "manuel");
    if (document.getElementById("link").getAttribute("href") === "../css/dark_mode.css") {
        document.getElementById("link").href = "../css/light_mode.css";
        localStorage.setItem("dark-mode", "manuel:light");
    } else {
        document.getElementById("link").href = "../css/dark_mode.css";
        localStorage.setItem("dark-mode", "manuel:dark");
    }
}

//DEBUG
function DisplayAllLocalStorage() {
    const keys = Object.keys(localStorage);
    keys.forEach(key => {
        console.log(`${key}: ${localStorage.getItem(key)}`);
    });
}

/**
 * @details Fonction qui vide le stockage local du navigateur, utile quand on arrive sur le site
 */
function ClearLocalStorage() {
    localStorage.clear();
}
