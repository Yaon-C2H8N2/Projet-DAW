/**
 * @details Ajuste le thème de l'UI en fonction du thème de l'ordinateur
 */

var darkMode;
var bouton_mode_sombre = document.getElementById("bouton_mode_sombre_dialog");
var bouton_mode_automatique = document.getElementById("bouton_mode_automatique_dialog");


if (localStorage.length === 0) {
    console.log("1ère arrivée sur le site");
}
//Creation de la variable dans le navigateur si non existante
if (localStorage.getItem("dark-mode") === null) {
    darkMode = localStorage.getItem("dark-mode");
    localStorage.setItem("dark-mode", "auto");
    bouton_mode_automatique.checked = true;
    bouton_mode_sombre.checked = false;
    console.log("Creation de var : dark-mode en mode auto");
}

LoadTheme();

/**
 * @brief Fonction qui adapte le thème du site en fonction des états des boutons et du thème de l'ordi
 */
function LoadTheme() {
    console.log("Avant " + localStorage.getItem("dark-mode"));
    //CAS OU MODE AUTO
    if (localStorage.getItem("dark-mode") === "auto") {
        bouton_mode_automatique.checked = true;
        bouton_mode_sombre.checked = false;

        //SI ORDI EST EN MODE SOMBRE
        if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
            document.getElementById("link").href = "../css/dark_mode.css";
            document.body.style.transition = "all 1000ms ease-in-out"; // Transition de 1 seconde pour toutes les propriétés CSS
        }
        //CAS OU ORDI EST EN MODE CLAIR
        else {
            document.getElementById("link").href = "../css/light_mode.css";
            document.body.style.transition = "all 1000ms ease-in-out"; // Transition de 1 seconde pour toutes les propriétés CSS
        }
    }
    //CAS OU MODE MANUEL
    else {
        bouton_mode_automatique.checked = false;
        if (localStorage.getItem("dark-mode") === "manuel:light")
            ModeClair();
        else
            ModeSombre();

    }
    console.log("Apres " + localStorage.getItem("dark-mode"));
    console.log("--------------------------------------------");

}

/**
 * @brief Fonction qui met le mode de l'UI en mode auto
 */
function ModeAuto() {
    console.log("Avant " + localStorage.getItem("dark-mode"));
    bouton_mode_sombre.checked = false;
    if (bouton_mode_automatique.checked) {
        localStorage.setItem("dark-mode", "auto");
        document.getElementById("link").href = "../css/dark_mode.css";
        document.body.style.transition = "all 1000ms ease-in-out"; // Transition de 1 seconde pour toutes les propriétés CSS
    } else {
        localStorage.setItem("dark-mode", "manuel:light");
        document.getElementById("link").href = "../css/light_mode.css";
        document.body.style.transition = "all 1000ms ease-in-out"; // Transition de 1 seconde pour toutes les propriétés CSS
    }
    console.log("Apres " + localStorage.getItem("dark-mode"));
    console.log("--------------------------------------------");
    window.location.reload();
}

/**
 * @details Fonction qui change de couleur le fond du bg en prenant en compte les anciens états et en mettant à jour les nouveaux
 */
function ChangeColorUI() {
    console.log("Avant " + localStorage.getItem("dark-mode"));

    if (document.getElementById("link").getAttribute("href") === "../css/dark_mode.css")
        ModeClair();
    else
        ModeSombre();
    bouton_mode_automatique.checked = false;
    console.log("Apres " + localStorage.getItem("dark-mode"));
    console.log("--------------------------------------------");
    window.location.reload();
}

function ModeSombre() {
    //document.body.style.transition = "all 1000ms ease-in-out"; // Transition de 1 seconde pour toutes les propriétés CSS
    document.getElementById("link").href = "../css/dark_mode.css";
    localStorage.setItem("dark-mode", "manuel:dark");
    bouton_mode_sombre.checked = true;
}

function ModeClair() {
    //document.body.style.transition = "all 1000ms ease-in-out"; // Transition de 1 seconde pour toutes les propriétés CSS
    document.getElementById("link").href = "../css/light_mode.css";
    localStorage.setItem("dark-mode", "manuel:light");
    bouton_mode_sombre.checked = false;
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
    bouton_mode_automatique.checked = true;
    ModeAuto();
    localStorage.clear();
    console.log("Le stockage local est vide : les paramètres seront par défauts");
}

function RemoveLocalStorageByName(name) {
    localStorage.removeItem(name.toString());
}
