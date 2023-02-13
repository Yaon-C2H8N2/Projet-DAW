<head>
    <link id="link" rel="stylesheet" type="text/css" href="css/navBar.css"/>
</head>

<div id="navBar">
    <a id="home" href="/">Neptune</a>
    <nav>
        <ul>
            <li class="right"><a href="/cours">Cours</a></li>
            <li class="right"><a href="/forum">Forum</a></li>
            <?php if (empty($_SESSION['id']))
                echo "<li class='right'><a href='/userAuth'>Se connecter</a></li>";
            else
                echo "<li class='right'><a href='/compte'>Compte</a></li>";
            ?>
        </ul>
    </nav>
</div>
