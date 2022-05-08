<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once 'include/assets.php'; ?>
</head>
<body>
    <?php 
    include_once 'include/navbar.php';
    require_once 'include/database.php';
    ?>
    <section class="container py-5">
        <?php
            if(isset($_POST['ajouter'])){ //isset button ajouter 
                $nom = htmlspecialchars($_POST['nom']); //pour des raisons de securité il faut ajouter htmlspecialchars
                $prenom = htmlspecialchars($_POST['prenom']);
                $age = htmlspecialchars($_POST['age']);
                
                if(!empty($nom) && !empty($prenom) && !empty($age)){ //if not empty faire:
                    $stag = $bdh->prepare('INSERT INTO stagiaire VALUES(null,?,?,?)'); //prepare sert a verifier //:nom or "?" both methodes are the same
                    $stag->execute([$nom,$prenom,$age]); //execute ajoute a la BD apres la verification
                    header("location:index.php");
        ?>
                <?php
                }else{ //sinon si c'est vide alert!
                ?>
                    <div class="alert alert-danger" role="alert">
                        il faut remplir tous les champs !
                    </div>
        <?php
                }
            }
        ?>
    <form method="POST">
        <label for="nom" class="form-label">Entrer un nom:</label><br>
        <input type="text" name="nom" class="form-control"><br>

        <label for="prenom" class="form-label">Entrer un prenom:</label><br>
        <input type="text" name="prenom" class="form-control"><br>
        
        <label for="age" class="form-label">Enter l'age:</label><br>
        <input type="number" name="age" class="form-control"><br>

        <button type="submit" class="btn btn-primary" name="ajouter">Confimer</button>
    </form>
    </section>
    <?php include_once 'include/footer.php';?>
</body>
</html>