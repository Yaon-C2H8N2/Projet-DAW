<head>
    <link id="link" rel="stylesheet" type="text/css" href="/css/navBar.css"/>
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
                    onclick="ChangeColorUI()">
                <img src="/img/Reglage.png" alt="Reglage" width="15" height="15">
            </button>

            <script src="/js/UI_Theme.js"></script>

        </ul>
    </nav>
</div>

<dialog>
    <p>Salutations, à tous et à toutes !</p>
</dialog>