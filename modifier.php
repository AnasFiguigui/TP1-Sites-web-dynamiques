<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'include/assets.php' ?>
</head>
<body>

    <?php

        //redirection a index.php si modifier is not isset
        if(!isset($_POST['id'])){
            header('location:index.php');
        }

        //partie include database et navbar
        include_once 'include/navbar.php';
        require_once 'include/database.php';

        $id = $_POST['id'];
        $stag = $bdh->prepare('SELECT * FROM stagiaire WHERE id=?');
        $stag->execute([$id]);

        $stagi = $stag->fetch(PDO::FETCH_OBJ);
        
        if(isset($_POST['confirmer'])){
            $nom= htmlspecialchars($_POST['nom']);;
            $prenom= htmlspecialchars($_POST['prenom']);;
            $age= htmlspecialchars($_POST['age']);;

            if(!empty($id) && !empty($nom) && !empty($prenom) && !empty($age)){ //if not empty faire:
                $stag= $bdh->prepare('UPDATE stagiaire SET nom=? , prenom=? , age=? WHERE id=?');
                $data=$stag->execute([$nom,$prenom,$age,$id]); //pour des raisons(SET/WHERE) $id doit etre a la derniere position exactement comme WHERE id
                if($data == true){
                    header('location:index.php');
                }else{
                    echo 'error';
                }
            }

        }
    ?>

        <!-- formulaire -->
        <section class="container py-5">
            <form method="POST">
                <input name="id" value="<?php echo $stagi->id?>" hidden> <!-- conservation de l'id dans un input -->
                <label for="nom" class="form-label">Entrer un nouveau nom:</label><br>
                <input type="text" name="nom" class="form-control" placeholder="<?php echo $stagi->nom ?>"><br>

                <label for="prenom" class="form-label">Entrer un nouveau prenom:</label><br>
                <input type="text" name="prenom" class="form-control" placeholder="<?php echo $stagi->prenom ?>"><br>
                
                <label for="age" class="form-label">Enter l'age:</label><br>
                <input type="number" name="age" class="form-control" placeholder="<?php echo $stagi->age ?>"><br>

                <button type="submit" class="btn btn-primary" name="confirmer">Confimer</button>
            </form>
        </section>
    <?php
        include_once 'include/footer.php';
    ?>
</body>
</html>