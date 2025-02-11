<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>

    </style>

    <form action="index.php" method="POST">
        <h1>Bienvenue</h1>
        <input type="text" name="Matricule" placeholder="Matricule"><br>
        <input type="text" name="Nom" placeholder="Nom"><br>
        <input type="text" name="Prenom" placeholder="Prenom"><br>
        <input type="number" name="Age" placeholder="Age"><br>
        <button type="submit" name="enregistrer" value="enregistrer">enregistrer</button>
        <button type="submit" name="afficher">afficher les utilisateurs</button>
        <button>effacer</button>
        <div>
            <input type="text" placeholder="entrer le matricule">
            <button>modifier</button>
        </div>
        <div>
            <input type="text" placeholder="entrer le matricule">
            <button>supprimer</button>
        </div>



        <table>
            <thead>
                <th> Matricule</th>
                <th> Nom</th>
                <th>Prenom</th>
                <th>Age</th>
            </thead>
            <tbody>

            </tbody>

        </table>

        <?php

        $Matricule = $_POST['Matricule'];
        $Nom = $_POST['Nom'];
        $Prenom = $_POST['Prenom'];
        $Age = $_POST['Age'];
        $server = "localhost";
        $username = "root";
        $password = "";
        $db_name = "tdjava";

        $con = new mysqli($server, $username, $password, $db_name);
        if ($con->connect_error) {
            die("erreur de connexion:" . $con->connect_error);
        }
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['bouton1'])) {
            $requete = "INSERT INTO etudiant (Matricule,Nom,Prenom,Age) VALUES('$Matricule','$Nom','$Prenom','$Age')";
            $result = $con->query($requete);
        } else
        
 {
            echo "Requête invalide.";
        }
    }
        
        
        $con->close()

        
            ?>
</body>

</html>