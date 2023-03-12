<head>
    <link rel="stylesheet" type="text/css" href="/css/navBar.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<div id="navBar">
    <a id="home" href="/">Neptune</a>
    <nav>
        <ul>
            <li class="right"><a href="/cours">Cours</a></li>
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
                    onclick="Dialog_ON()">
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


                        <!--                        <div>-->
                        <!--                            <label>-->
                        <!--                                <input type="button"-->
                        <!--                                       id="bouton_mode_reset_dialog" title="NE PAS APPUYER DESSUS, QUE SI ON EST DEV"-->
                        <!--                                       value="RESET" onclick="ClearLocalStorage()">-->
                        <!--                                <span class="toggle-label">RESET LE STOCKAGE LOCAL</span>-->
                        <!--                            </label>-->
                        <!--                            <hr>-->
                        <!--                        </div>-->
                    </div>


                    <button class="close_button_dialog" onclick="Dialog_OFF()">Fermer</button>
                </div>
            </div>

            <script>
                function Dialog_ON() {
                    var dialog = document.getElementById("dialog");
                    dialog.style.display = "block";
                }

                function Dialog_OFF() {
                    var dialog = document.getElementById("dialog");
                    dialog.style.display = "none";
                }
            </script>
        </ul>
    </nav>
</div>