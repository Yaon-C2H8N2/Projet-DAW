<link rel="stylesheet" type="text/css" href="/css/navBar.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.min.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.min.css"/>
<div id="navBar">
    <a id="home" href="/">Neptune</a>
    <nav>
        <ul>
            <li class="right"><a href="/coursPanel">Cours</a></li>
            <li class="right"><a href="/forum">Forum</a></li>
            <?php if (!isset($_SESSION['userInfo'])) {
                echo "<li class='right'><a href='/userAuth'>Se connecter</a></li>";
                echo "<li class='right'><a href='/userCreate'>S'inscrire</a></li>";
            } else {
                echo "<li class='right'><a href='/compte'>Compte</a></li>";
                echo "<li class='right'><a href='/logout'>Se déconnecter</a></li>";
            }
            ?>

            <button class="right" style="background-color: transparent; border: none;" id="Reglage"
                    onclick="Dialog_ON()" title="Réglage">
                <img src="/img/Reglage.png" alt="Reglage" width="15" height="15">
            </button>

            <div id="dialog" class="dialog">
                <div class="dialog_contenu">
                    <h2 style="text-align: center; text-transform: uppercase">Réglage</h2>

                    <div class="dialog_items">
                        <div>
                            <label class="toggle">
                                <input class="toggle-checkbox" type="checkbox" id="bouton_mode_sombre_dialog"
                                       name="dialog_bouton_color_ui" onchange="ChangeColorUI()">
                                <div class="toggle-switch"></div>
                                <span class="toggle-label">Mode Sombre</span>
                            </label>
                            <hr>
                        </div>

                        <div>
                            <label class="toggle">
                                <input class="toggle-checkbox" checked type="checkbox"
                                       id="bouton_mode_automatique_dialog" name="dialog_bouton_color_ui"
                                       onchange="ModeAuto()">
                                <div class="toggle-switch"></div>
                                <span class="toggle-label">Mode automatique</span>
                            </label>
                            <hr>
                        </div>

                        <?php
                        if (isset($_SESSION['userInfo'])) {
                            include_once '../app/models/Utility.php';

                            if ($admin = getUser()->isAdmin) {
                                echo '
                                <div>
                                    <div class="div_bouton_adm">
                                        <button onclick="searchUserPage()">Rechercher un utilisateur</button>
                                        <button onclick="QCMPage()">Créer un QCM</button>
                                        <button onclick="courseCreationPage()">Créer un cours</button>
                                        <button onclick="GestionSite()">Gérer le site</button>
                                    </div>
                                    <hr>
                                </div>';
                            }
                        }
                        ?>

                    </div>

                    <button class="close_button_dialog" onclick="Dialog_OFF()">Fermer</button>
                </div>

                <div style="  position: relative;">
                    <p style="position: absolute;bottom: 0;left: 50%;transform: translateX(-50%);">Version 1.0</p>
                </div>
            </div>

            <script>
                function Dialog_ON() {
                    document.getElementById("dialog").style.display = "block";
                }

                function Dialog_OFF() {
                    document.getElementById("dialog").style.display = "none";
                }

                function searchUserPage() {
                    window.location.href = "/admin/searchUser";
                }

                function QCMPage() {
                    window.location.href = "/admin/qcmCreation";
                }

                function courseCreationPage() {
                    window.location.href = "/admin/courseCreation";
                }

                function GestionSite() {
                    window.location.href = "/admin/gerer";
                }
            </script>
        </ul>
    </nav>
</div>