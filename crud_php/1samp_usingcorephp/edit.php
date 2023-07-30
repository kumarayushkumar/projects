<?php

  function randomString($n){
    $char = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    $str = '';
    
    for($i=0; $i<$n; $i++){
      $index = rand(0, strlen($char)-1);
      $str = $str.$char[$index];
    }

    return $str;
  }

  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=samp','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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
    $title = $_POST['title'];
    $pdesc = $_POST['des'];
    $price = $_POST['price'];

    if(!$title && !$price){ 
      $error = array("Please provide title and price"); 
    } elseif(!$title){ 
      $error = array("Please provide title"); 
    } elseif(!$price){ 
      $error = array("Please provide price"); 
    }

    if(!is_dir('images')){ mkdir('images'); }

    if(empty($error)){
     
      $image = $_FILES['image'] ?? null;
      $imagePath = $product['image'];

      if($image && $image['tmp_name']){

        if($product['image']){ unlink($imagePath); }

        $imagePath = 'images/'.randomString(8).'/'.$image['name'];

        mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'], $imagePath);
      }
      
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

<!Doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
    <style>
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
    
  <?php if(!empty($error)): ?>
    <div class="alert alert-danger">
      <?php foreach($error as $err): ?> 
        <div><?php echo $err;?></div>
      <?php endforeach;?>
    </div>
  <?php endif;?>

  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Product Title</label>
      <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
    </div>
    <div class="mb-3">
      <label for="des" class="form-label">Product Description</label>
      <input type="text" class="form-control" name="des" value="<?php echo $pdesc; ?>">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Product Price</label>
      <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Product Image</label>
        <?php if($product['image']): ?>
         <img src="<?php echo $product['image'] ?> ">
        <?php endif; ?>
      <input class="form-control" type="file" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  
</body>
</html>