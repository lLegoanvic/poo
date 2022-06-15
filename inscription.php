<?php
require 'inclureClasses.php';


$db = new PDO('mysql:host=localhost; dbname=poo', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$manager = new UtilisateurManager($db);

if(isset($_POST['nom']))
{
    $utilisateur = new Utilisateurs(
            [   'nom' =>$_POST['nom'],
                'prenom' =>$_POST['prenom'],
                'tel' =>$_POST['tel'],
                'email' =>$_POST['email']
            ]
    );

    if($utilisateur->isUserValide())
    {
        $manager->inserer($utilisateur);
    }

}

?>





<form id="login-form" class="form" action="" method="post">
    <div class="form-group">
        <label for="nom" class="text-body">Nom:</label><br>
        <input type="text" name="nom" id="nom" class="form-control">
    </div>
    <div class="form-group">
        <label for="prenom" class="text-body">Prenom:</label><br>
        <input type="text" name="prenom" id="prenom" class="form-control">
    </div>

    <div class="form-group">
        <label for="tel" class="text-body">Tel:</label><br>
        <input type="text" name="tel" id="tel" class="form-control">
    </div>
    <div class="form-group">
        <label for="email" class="text-body">Adresse email:</label><br>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" name="inscription" class="btn btn-primary btn-md" value="S'inscrire">
        <a href="connexion.php" class="btn btn-primary btn-md">Se connecter</a>
    </div>
</form>