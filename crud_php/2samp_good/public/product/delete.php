<?php

    /** @var $pdo \PDO */
    require_once '../../db.php';

    $id = $_GET['id'];

    if(!$id){ 
        header('Location:in.php'); 
        exit;
    }

    $query = $pdo->prepare("DELETE FROM products WHERE id=:id");
    $query->bindValue(':id',$id);
    $query->execute();

    header('Location:in.php');

?>