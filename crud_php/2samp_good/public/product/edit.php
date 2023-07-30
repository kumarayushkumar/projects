<?php

  /** @var $pdo \PDO */
  require_once '../../db.php';
  require_once '../../function.php';

  $id = $_GET['id'];

  if(!$id){
    header('Location:in.php'); 
    exit;
  }

  $query = $pdo->prepare("SELECT * FROM products WHERE id=:id");
  $query->bindValue(':id',$id);
  $query->execute();
  $product = $query->fetch(PDO::FETCH_ASSOC);

  $error = array();
  $title = $product['title'];
  $pdesc = $product['pdesc'];
  $price = $product['price'];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once "../../validate.php";

    if(empty($error)){
      $query = $pdo->prepare("UPDATE products SET title=:title, pdesc=:pdesc, image=:image, price=:price WHERE id=:id");
      
      $query->bindValue(':title',$title);
      $query->bindValue(':pdesc',$pdesc);
      $query->bindValue(':image',$imagePath);
      $query->bindValue(':price',$price);
      $query->bindValue(':id',$id);
      $query->execute();

      header('Location: in.php');
    }
  }

?>

<?php include_once "../../views/partials/header.php"; ?>
      body{ 
        margin: 2em 3em;
      }

      img{
          width: 100px;;
      }
    </style>
</head>
<body>
  <h1>Update <?php echo $product['title'] ?></h1>
    
  <?php include_once "../../views/products/form.php" ?>
  
</body>
</html>