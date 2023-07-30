<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=samp','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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