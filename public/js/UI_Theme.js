/**
 * @details Ajuste le thème de l'UI en fonction du thème de l'ordinateur
 */

var navBar = false;
var light_color = getComputedStyle(document.documentElement).getPropertyValue('--body-background-light');
var dark_color = getComputedStyle(document.documentElement).getPropertyValue('--body-background-dark');

if (!isCssIncluded('UI_Theme.css')) {
    console.log('Le fichier "UI_Theme.css" n\'est pas inclus dans le document');
    document.body.style.color = "white";
    document.body.style.height = "100%";
    document.body.style.margin = "10vh 0 10vh 0";
    document.body.style.padding = "0";
    light_color = "#4451dd";
    dark_color = "#333336";
} else {
    document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-light'));
}

if (document.getElementById("navBar")) {
    var bouton_mode_sombre = document.getElementById("bouton_mode_sombre_dialog");
    var bouton_mode_automatique = document.getElementById("bouton_mode_automatique_dialog");
    navBar = true;
} else {
    console.log("Navbar non présente");
}

//Creation de la variable dans le navigateur si non existante
if (localStorage.getItem("dark-mode") === null) {
    localStorage.setItem("dark-mode", "auto");
    if (navBar) {
        bouton_mode_automatique.checked = true;
        bouton_mode_sombre.checked = false;
    }
    console.log("Creation de var : dark-mode en mode auto");
}

/**
 * Détecter le changement de theme de la machine et adapter en consequence
 */
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function () {

    //On change le theme que si on est en mode auto
    if (localStorage.getItem("dark-mode") === "auto") {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.style.backgroundColor = dark_color;
            document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-dark'));
        } else {
            document.body.style.backgroundColor = light_color;
            document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-light'));
        }
    }
});

LoadTheme();

/**
 *  Fonction qui adapte le thème du site en fonction des états des boutons et du thème de l'ordi
 */
function LoadTheme() {
    //CAS OU MODE AUTO
    if (localStorage.getItem("dark-mode") === "auto" || !navBar) {
        ModeAuto();
        localStorage.setItem("dark-mode", "auto");
    }
    //CAS OU MODE MANUEL ET PAR DEFAULT MODE CLAIR
    else {
        if (navBar) {
            bouton_mode_automatique.checked = false;
        }

        if (localStorage.getItem("dark-mode") === "manuel:light") ModeClair(); else ModeSombre();
    }
}

/**
 * Fonction qui met le mode de l'UI en mode auto
 */
function ModeAuto() {
    localStorage.setItem("dark-mode", "auto");
    if (navBar) {
        if (bouton_mode_automatique.checked) {

            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.body.style.backgroundColor = dark_color;
                document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-dark'));
            } else {
                document.body.style.backgroundColor = light_color;
                document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-light'));
            }
            bouton_mode_sombre.checked = false;
        } else {
            ModeClair();
        }
    } else {  //Si la navbar n'est pas présente dans la vue
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.style.backgroundColor = dark_color;
            document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-dark'));
        } else {
            document.body.style.backgroundColor = light_color;
            document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-light'));
        }
    }
}

function ModeSombre() {
    localStorage.setItem("dark-mode", "manuel:dark");
    if (navBar) {
        bouton_mode_sombre.checked = true;
        bouton_mode_automatique.checked = false;
    }
    document.body.style.backgroundColor = dark_color;
    document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-dark'));
}

function ModeClair() {
    localStorage.setItem("dark-mode", "manuel:light");
    if (navBar) {
        bouton_mode_sombre.checked = false;
        bouton_mode_automatique.checked = false;
    }
    document.body.style.backgroundColor = light_color;
    document.documentElement.style.setProperty("--body-background-color", getComputedStyle(document.documentElement).getPropertyValue('--body-background-light'));
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

function isCssIncluded(fichier) {
    for (var i = 0; i < document.styleSheets.length; i++) {
        var styleSheet = document.styleSheets[i];
        if (styleSheet.href && styleSheet.href.includes(fichier)) {
            return true;
        }
    }
    return false;
}
