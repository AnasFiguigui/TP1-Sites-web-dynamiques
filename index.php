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

    <!-- partie include de la base de donnees (stagiaires) et la barre de navigation -->
    <?php
    include_once 'include/navbar.php';
    require_once 'include/database.php';
    $stag = $bdh->query('SELECT * FROM stagiaire'); //query import les valeurs de la BD
    $data = $stag->fetchAll(PDO::FETCH_OBJ); //$stag elle recupere les vrai valeurs
    ?>

    <!-- tableau des stagiaires importaient depuis la base de données -->
<table class="table">
  <thead>
    <tr>
      <th class="text-center" scope="col">#</th>
      <th class="text-center" scope="col">Nom</th>
      <th class="text-center" scope="col">Prenom</th>
      <th class="text-center" scope="col">Age</th>
      <th class="text-center" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        foreach($data as $stagi){
        ?>
        <tr>
            <td class="text-center"><?= $stagi->id ?></td>
            <td class="text-center"><?= $stagi->nom ?></td>
            <td class="text-center"><?= $stagi->prenom ?></td>
            <td class="text-center"><?= $stagi->age ?></td>
            <td class="text-center">
                <form method="post">
                    <input type="text" name="id" value="<?php echo $stagi->id ?>" hidden> <!-- la valeur de l'id dans l'input -->
                    <input type="submit" value="modifier" formaction="modifier.php" class="btn btn-warning" name="modifier"> <!-- redirection a modifier.php -->
                    <input type="submit" value="supprimer" formaction="supprimer.php" class="btn btn-danger" name="supprimer"> <!-- redirection a supprimer.php -->
                </form>
            </td>
        </tr>
        <?php
        }
        ?>
        
  </tbody>
</table>
    <?php
    include_once 'include/footer.php';
    ?>
</body>
</html>