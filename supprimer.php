<?php
    if(isset($_POST['supprimer'])){
        require_once 'include/database.php';
        $id = $_POST['id'];
        $stag = $bdh->prepare('DELETE FROM stagiaire WHERE id=?');
        $stag->execute([$id]);
        header('location: index.php');
    }

?>