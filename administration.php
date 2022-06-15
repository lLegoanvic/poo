<?php
require 'inclureClasses.php';

$db = new PDO('mysql:host=localhost; dbname=poo', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new UtilisateurManager($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <meta charset="utf-8"/>
    <style type="text/css">
        table, td{
            border: 1px solid black;
        }
        table {
            margin: auto;
            text-align: center;
            border-collapse: collapse;
        }
        td {
            padding: 3px;
        }
    </style>
</head>
<body>
<p><a href="index.php">Index</a> </p>
<table>

    <tr><th>Nom</th><th>Prénom</th><th>Tel</th><th>Email</th></tr>

    <?php
    /** @var Utilisateurs $utilisateur */
    foreach ($manager->getListeUtilisateurs() as $utilisateur)
    {
        echo '<tr><td>', $utilisateur->getNom(), '</td><td>', $utilisateur->getPrenom(),'</td><td>', $utilisateur->getTel(),'</td><td>', $utilisateur->getEmail(),'</td>';
    }

    ?>

</table>







</body>
</html>