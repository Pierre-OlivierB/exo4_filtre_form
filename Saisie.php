<?php
// Défnissez un fltre de type expression rationnelle qui permet de 
// vérifer que le prénom et le nom contiennent uniquement des lettres, des
// espaces et des traits d’union, 
// pour une longueur totale comprise entre 1 et 40 caractères. 
// En cas d’erreur, le fltre doit retourner NULL au lieu de FALSE.
// Tester si le script est appelé en traitement du formulaire.
if (isset($_POST['ok'])) { // oui
    // Récupérer les valeurs saisies dans le formulaire.
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $auteur = "$prenom $nom";
    if(isset($_POST('ok'))){
       $filtre= [
           'filtre'=>FILTER_VALIDATE_REGEXP,
           'options'=>['regexp'=>'/^[[:alpha:]-]{1-40}$/u'],
           'flags'=>FILTER_NULL_ON_FAILURE
                ];
        $filtres=['prenom'=>$filtre,
                    'nom'=>$filtre];
        $saisie=filter_input_array(INPUT_POST,$filtres);
        if (in_array(NULL,$saisie,true)) {
            $message='votre saisie n\'est pas correct';
        }
    }
//      filter_input(INPUT_POST,$a,FILTER_VALIDATE);
// }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Saisie</title>
    <style>
        label {
            display: block;
            width: 60px;
            float: left;
        }
    </style>
</head>

<body>
    <!-- Formulaire de saisie de l'auteur. -->
    <form action="saisie.php" method="post">
        <div>
            <b>Prénom et nom du nouvel auteur :</b>
            <br /><label>Prénom</label>
            <input type="text" name="prenom" size="40" maxlength="40" autofocus="autofocus" />
            <br /><label>Nom</label>
            <input type="text" name="nom" size="40" maxlength="40" />
            <br />
            <input type="submit" name="ok" value="Enregistrer" />
        </div>
    </form>
    <div><?= (isset($auteur)) ? $auteur : '' ?></div>
</body>

</html>