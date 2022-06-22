<?php
require 'inclureClasses.php';

$db = new PDO('mysql:host=localhost; dbname=poo', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new UtilisateurManager($db);
if(isset($_GET['modifier']))
{
    $utilisateur = $manager->getUtilisateur((int) $_GET['modifier']);
}

if (isset($_POST['nom']))
{
    $utilisateur = new Utilisateurs(
            [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'tel' => $_POST['tel'],
                'email' => $_POST['email']
            ]
    );
}

if (isset($_POST['id']))
{
    /** @var TYPE_NAME $utilisateur */
    $utilisateur->setId($_POST['id']);
}

/** @var TYPE_NAME $utilisateur */
if ($utilisateur->isUserValide() !== null)
{
    $manager->update($utilisateur);
    $message = 'utilisateur bien modifié';
}

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

<form id="login-form" class="form" action="" method="post">

    <div class="form-group">
        <label for="nom" class="text-body">Nom:</label><br>
        <input type="text" name="nom" id="nom" class="form-control" value="<?php if(isset($utilisateur)) echo $utilisateur->getNom();?>">
    </div>
    <div class="form-group">
        <label for="prenom" class="text-body">Prenom:</label><br>
        <input type="text" name="prenom" id="prenom" class="form-control"  value="<?php if(isset($utilisateur)) echo $utilisateur->getPrenom();?>">
    </div>

    <div class="form-group">
        <label for="tel" class="text-body">Tel:</label><br>
        <input type="text" name="tel" id="tel" class="form-control"  value="<?php if(isset($utilisateur)) echo $utilisateur->getTel();?>">
    </div>
    <div class="form-group">
        <label for="email" class="text-body">Adresse email:</label><br>
        <input type="email" name="email" id="email" class="form-control"  value="<?php if(isset($utilisateur)) echo $utilisateur->getEmail();?>">
    </div>
    <?php
    if (isset($utilisateur))
    {
        ?>
    <input type="hidden" name="id" value="<?=$utilisateur->getId()?>"/>
           <?php
    }
    ?>
    <div class="form-group">
        <input type="submit" name="modifier" class="btn btn-primary btn-md" value="modifier">
    </div>
</form>

<table>

    <tr><th>Nom</th><th>Prénom</th><th>Tel</th><th>Email</th><th>Modification</th></tr>

    <?php
    /** @var Utilisateurs $utilisateur */
    foreach ($manager->getListeUtilisateurs() as $utilisateur)
    {
        echo '<tr><td>', $utilisateur->getNom(), '</td><td>', $utilisateur->getPrenom(),'</td><td>', $utilisateur->getTel(),'</td><td>', $utilisateur->getEmail(),'</td><td><a href="?modifier=', $utilisateur->getId(),'">Modifier</a></td>';
    }

    ?>

</table>







</body>
</html>