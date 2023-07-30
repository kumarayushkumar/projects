<?php

  /** @var $pdo \PDO */
  require_once '../../db.php';
  require_once '../../function.php';

  $error = array();
  $title = '';
  $pdesc = '';
  $price = '';
  $product = [
    'image' => ''
  ];

  if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once "../../validate.php";
  
    if(empty($error)){      
      $query = $pdo->prepare("INSERT INTO products (title, pdesc, image, price, create_date) VALUES (:title, :pdesc, :image, :price, :date)");
      $query->bindValue(':title',$title);
      $query->bindValue(':pdesc',$pdesc);
      $query->bindValue(':image',$imagePath);
      $query->bindValue(':price',$price);
      $query->bindValue(':date',date("Y-m-d H:i:s"));
      $query->execute();

      header('Location: in.php');
    }
  }

?>

<?php include_once "../../views/partials/header.php"; ?>
      body{ 
        margin: 2em 3em;
      }
    </style>
</head>
<body>
  <p>
    <a href="in.php" class="btn btn-primary">Go back to Products</a>
  </p>
  <h1>CRUD</h1>
    
  <?php include_once "../../views/products/form.php" ?>

</body>
</html>