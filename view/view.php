<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $pagetitle; ?></title>
</head>
<header style="border: 2px solid black;text-align:center;">
	<h3>
		<a href='index.php?controller=farlane'>Liste des farlane</a>
        <?php
        if (isset($_SESSION['mail']) && $_SESSION['admin']){
            echo "
            <a href='index.php?controller=utilisateur'>Liste des utilisateurs</a>
            <a href='index.php?controller=types'>Liste des types</a>";
        }

        if (isset($_SESSION['mail'])){
            echo "<a href='index.php?controller=utilisateur&action=disconnect'>Se déconnecter</a>";
            $nomEtPrenom = $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . ($_SESSION['admin'] ? ' (Admin)' : '');
            $confirme = !(isset($_SESSION['mail']) && $_SESSION['confirmed']) ? "(Pas confirmé)" : "";
            echo "<p>Connecté en tant que $nomEtPrenom $confirme</p>";
        }
        else echo "
        <a href='index.php?controller=utilisateur&action=connexion'>Connexion</a>
        <a href='index.php?controller=utilisateur&action=inscription'>Inscription</a>"
        ?>
	</h3>
</header>

<body>
	<?php
	require File::build_path(array("view", static::$object, "$view.php"));
	?>
</body>

<footer>
	<p style="border: 1px solid #000000;text-align:right;padding-right:1em;">
		Site de covoiturage d'Ascoz
	</p>
</footer>
</html>