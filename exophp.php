<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {/*vérifie si la requête est 'POST'.
      -Récupération données du form
      -Assure que le form a été soumis et données peuvent être traitées.
      -$nom, $prenom, $sexe, $statut $dateNaissance: stocke les données saisies dans form*/
    $nom = $_POST['nom'];/* '$_POST' contient les données envoyées
                        -données du form sont stockées dns varibl: "$nom, $prenom, $sexe, $statut et $dateNaissance."*/
    $prenom = $_POST['prenom'];
      echo '<pre>';
      var_dump($nom);
      echo '</pre>';
    $sexe = $_POST['sexe'];
    $statut = $_POST['statut'];
    $dateNaissance = $_POST['dateNaissance'];

    /* Calcule âge utilisateur
    date naissance convertie en "DateTime"
      -j'obtiens date actu en créant "DateTime" sans paramètre.
      -"diff()"pour calculer la diff entre les 2 dates.
      -âge sorti en utilisant propriété "y" (années dans "Interval")*/

    $dateNaissance = new DateTime($dateNaissance);/*$dateNaissance contient objet 'DateTime' qui représente date naissance utilisateur.*/
    $aujourdhui = new DateTime();/*nouv obj 'DateTime' sans paramètre,il représentera date et heure actu.
                                 '$aujourdhui' contient alors l'obj 'DateTime' qui représente date d'aujourd'hui.*/
    $interval = $dateNaissance->diff($aujourdhui);/*diff() de l'objet DateTime pour calculer la diff entre 2 dates.
                                                   -calcule la diff entre date de naissance utilisateur et date actu. 
                                                   -'$interval' devient 'DateInterval' qui représente la diff entre ces 2 dates.*/
    $age = $interval->y;/*'y' de 'DateInterval'représente le nmbr total d'années de diff. qui donne âge utilisateur. 
                        '$age' contient du coup âge utilisateur en 'années'.
    /*Calcul nmbr jrs avnt anniv :
      -nouv instance de "DateTime" grace à "année actuelle","mois","jour de naissance"
      -"diff()"pour calculer diff entre date et date actuelle.
      -"days" de 'Interval' pour avoir nmbr de jours restants avant anniv*/
    $prochainAnniversaire = (new DateTime())->setDate($aujourdhui->format('Y'), $dateNaissance->format('m'), $dateNaissance->format('d'));
if ($prochainAnniversaire < $aujourdhui) {
    $prochainAnniversaire->modify('+1 year');
}
$joursAvantAnniversaire = $aujourdhui->diff($prochainAnniversaire)->days;
    /* "new DateTime" crée objet 'DateTime' qui représente la date et l'heure actuelles.
       -'setDate()'modifie 'DateTime' créé pour qu'il représente la  date d'anniv utilisateur .
        grace à: année actuelle '($aujourdhui->format('Y'))', mois naissance utilisateur '($dateNaissance->format('m'))' et jour naissance utilisateur '($dateNaissance->format('d'))'
       -diff($aujourdhui) : pour calculer la diff entre 'prochaine date d'anniv utilisateur' et 'date actuelle'ce qui donnera "DateInterval" (qui représente nmbr jours/ mois/ années entre ces 2 dates.
       ->days : propriété de 'DateInterval' qui  représente 'nmbr total jours de différence'.
       ce qui donne le nmbr jours restants avant prochain anniv utilisateur.*/ 


    /* Calcule si matin/aprem ou soir.
        -heure actuelle pour déterminer période de la journée et définir l'image qui correspond.
         'fonction date()' pour obtenir heure actu et  instructions conditionnelles pour effectuer actions selon l'heure.*/
    
    $heure = date('H'); /*$heure = date('H'); : utilise fonction 'date('H')' du PHP pour obtenir heure actu au format "24 heures" ( ex: 17 pour 5 h de l'aprm). '$heure' contiendra du coup l'heure actu.*/ 
    if ($heure >= 8 && $heure < 12) { /* Si "heure" sup ou = à 8 et inf à 12, alors c'est le matin. "$momentJournee" est définie sur 'matin' et '$image' est définie sur le chemin de mon image matin('image/matin.gif').*/
        $momentJournee = 'matin';
        $image = 'image/matin.gif';
    } elseif ($heure >= 12 && $heure < 19) { /* Si heure sup ou = à 12 ET inf à 19, alors c'est l'aprèm.*/
        $momentJournee = 'après-midi';/*"$momentJournee" est définie sur 'après-midi' et $image sur chemin image après-midi ('image/aprem.gif').*/
        $image = 'image/aprem.gif';
    } else { /*Si aucune conditions remplies (si heure inf à 8 OU sup OU = à 19), alors c'est le soir.*/
        $momentJournee = 'soir';/* "$momentJournee" est définie sur 'soir' et "$image" sur chemin image soir ('image/soirée.gif').*/
        $image = 'image/soirée.gif';
    }
    ?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Résultat</title><br>
        <style>
            body {
                text-align: center;
                font-family: Arial, sans-serif;
                margin: 0 auto;
                width: 600px;
                padding: 50px;
            }
            main {
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: #e9d6ef;
                box-shadow: 0 0 6px #fff, 
                inset 0 0 6px #6F10E9, 
                0 0 10px #6F10E9, 
                inset 0 0 10px #6F10E9, 
                0 0 8px #6F10E9, 
                inset 0 0 8px #6F10E9;
            }
            @media screen and (max-width: 425px) {
                body {
                    width: 100%;
                    padding: 20px;
                }
                .centered-content {
                    width: 100%;
                    max-width: none;
                }
            }
        </style>
    </head>
    <body>
        <header class="result">
            <h1>Résultat </h1>
            <link rel="stylesheet" href="style.css">
        </header>
        
        <main>
            <div class="centered-content">
                <p>Bonjour <?php echo $sexe === 'Monsieur' ? 'Monsieur' : 'Madame'; ?> <?php echo $nom . " " . $prenom; ?>,
                <!-- vérifie si sexe utilisateur est 'Monsieur'. Si oui > 'Monsieur'. Si non > 'Madame'.!
                 /choisir entre "étudiant" ou "salarié" + "é" ou "ée" et "etudiant""(e)" selon sexe
                 -"echo $nom . " " . $prenom;": met bout a bout ls 2 chn de carct 'nom et le prénom' pour afficher nom complet.-->
                  Vous êtes <?php echo $statut === 'étudiant' ? ($sexe === 'Madame' ? 'étudiante' : 'étudiant') : ($sexe === 'Madame' ? 'salariée' : 'salarié'); ?>,<br>
                 <!--utilise opér ternaires imbriqués(syntx très condensée  pour écrire toute une condition sur une ligne et accélérer vitesse d’exéc ducode.) pour déterminer si utilisateur est "un(e) étudiant(e)" ou "un(e) salarié(e)", et en prenant compte du sexe utilisateur pour conjugaison du mot.-->
                  Vous êtes <?php echo $sexe === 'Madame' ? 'née' : 'né'; ?> le <?php echo $dateNaissance->format('d-m-Y'); ?>, vous avez donc <?php echo $age; ?> ans.<br>
                  <!--*'echo $sexe === 'Madame'?'née':'né';':opé ternr pour déterminer si utilisateur est 'né' ou 'née', selon son sexe
                      *'echo $dateNaissance->format('d-m-Y')': affiche date naissance utilisateur au format 'jj-mm-aaaa'.(day/month/Year)
                      *'echo $age;': affiche âge utilisateur, qu'il a calculer avant -->
                  
                   <?php if ($joursAvantAnniversaire == 0) : ?><!--démarre condition qui vérifie si la varbl '$joursAvantAnniversaire' (celle qui contient nmbr jours restants jusqu'à l'anniv ) est = à zéro. Si oui, signifie que c'est son l'anniv .-->
                             C'est votre anniversaire aujourd'hui, BON ANNIVERSAIRE !!!<!--Si condition précédente vraie (c'est-à-dire que c'est l'anniversaire de l'utilisateur), alors cette ligne de texte sera affichée.-->
                             <?php elseif ($joursAvantAnniversaire == 1) : ?><!--Si 1er condition est NON (pas l'anniversaire), alors nouv condition vérifie si la varbl '$joursAvantAnniversaire' est égale =1 . Si =1, signifie que l'anniv est demain.-->
                              Votre anniversaire est dans 1 jour.<!--Si condition précédente vraie (anniversaire est demain), alors texte affichée 'Votre anniversaire est dans 1 jour'-->
                   <?php else : ?><!--Si aucune des conditions  remplie (l'anniv ni aujourd'hui ni demain), alors  else s'exécutes.-->
                              Votre anniversaire est dans <?php echo $joursAvantAnniversaire; ?> jours.<!--Comme aucune  conditions remplie, affich avec le nmbr  jours restants avant l'anniv -->
                              <!-- 'echo $joursAvantAnniversaire; ?> '': remplacée par valeur actuelle de variable "$joursAvantAnniversaire".-->
                              <?php endif; ?><!--termine condition-->             
                </p>


                <img src="<?php echo $image; ?>" alt="Image du moment de la journée"><!--utilise varbl '$image', définie avant selon heure actu, pour afficher image correspondant au moment de la journée.-->
                <?php if ($joursAvantAnniversaire == 0) : ?>
                 <img src="image/anniv.jpg" alt="Image Joyeux Anniversaire">
                <?php endif; ?>
            </div>
        </main>
        
        <footer class="footresult">
            <p>GardèsMag © 2023 - Exercice Bonus PHP</p>
        </footer>
    </body>
    </html>
<?php
}
?>