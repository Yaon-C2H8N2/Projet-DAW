/**
 * @details Ajuste le thème de l'UI en fonction du thème de l'ordinateur
 */

var darkMode;
var bouton_mode_sombre = document.getElementById("bouton_mode_sombre_dialog");
var bouton_mode_automatique = document.getElementById("bouton_mode_automatique_dialog");


//Creation de la variable dans le navigateur si non existante
if (localStorage.getItem("dark-mode") === null) {
    darkMode = "localStorage".getItem("dark-mode");
    localStorage.setItem("dark-mode", "auto");
    bouton_mode_automatique.checked = true;
    bouton_mode_sombre.checked = false;
    console.log("Creation de var : dark-mode en mode auto");
}

/**
 * Detecter le changement de theme de la machine et adapter en consequence
 */
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {

    //On change le theme que si on est en mode auto
    if (localStorage.getItem("dark-mode") === "auto") {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.style.setProperty("--body-background-color", " #333336");

        } else {
            document.documentElement.style.setProperty("--body-background-color", "#4451dd");
        }
    }
});

LoadTheme();

/**
 *  Fonction qui adapte le thème du site en fonction des états des boutons et du thème de l'ordi
 */
function LoadTheme() {
    //CAS OU MODE AUTO
    if (localStorage.getItem("dark-mode") === "auto") {
        ModeAuto();
    }
    //CAS OU MODE MANUEL ET PAR DEFAULT MODE CLAIR
    else {
        bouton_mode_automatique.checked = false;
        if (localStorage.getItem("dark-mode") === "manuel:light")
            ModeClair();
        else
            ModeSombre();
    }
}

/**
 * Fonction qui met le mode de l'UI en mode auto
 */
function ModeAuto() {

    if (bouton_mode_automatique.checked) {
        localStorage.setItem("dark-mode", "auto");

        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.style.setProperty("--body-background-color", " #333336");
        } else {
            document.documentElement.style.setProperty("--body-background-color", "#4451dd");
        }
        bouton_mode_sombre.checked = false;
    } else {
        ModeClair();
    }
}


function ModeSombre() {
    localStorage.setItem("dark-mode", "manuel:dark");
    bouton_mode_sombre.checked = true;
    bouton_mode_automatique.checked = false;
    document.documentElement.style.setProperty("--body-background-color", " #333336");
}

function ModeClair() {
    localStorage.setItem("dark-mode", "manuel:light");
    bouton_mode_sombre.checked = false;
    bouton_mode_automatique.checked = false;
    document.documentElement.style.setProperty("--body-background-color", "#4451dd");
}

/**
 * Changer le theme manuellement du site
 */
function ChangeColorUI() {
    if (localStorage.getItem("dark-mode") === "manuel:light") {
        ModeSombre();
    } else {
        ModeClair();
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
    bouton_mode_automatique.checked = true;
    ModeAuto();
    localStorage.clear();
    console.log("Le stockage local est vide : les paramètres seront par défauts");
}

function RemoveLocalStorageByName(name) {
    localStorage.removeItem(name.toString());
}
