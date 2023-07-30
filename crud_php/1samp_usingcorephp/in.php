<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=samp','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$search = $_GET['search']?? '';

if($search){
  $statement = $pdo->prepare('SELECT * FROM products WHERE title LIKE :search ORDER BY create_date DESC');
  $statement->bindValue(':search', "%$search%");
} else{
  $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
}

$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD</title>
    <style>
       body {
           padding: 4em;
           text-decoration: none;
       } 
       img{
         width: 50px;
       }
    </style>
  </head>
  <body>
    <h1>CRUD</h1>

    <form action="in.php" method="GET">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </div>
    </form>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">title</th>
      <th scope="col">description</th>
      <th scope="col">image</th>
      <th scope="col">price</th>
      <th scope="col">create date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $i => $product): ?>
      <tr>
        <td scope="row"><?php echo $i + 1?></td>
        <td>
          <?php echo $product['title']?>
        </td>
        <td>
          <?php echo $product['pdesc']?>
        </td>
        <td>
          <?php if($product['image']): ?>
          <img src="<?php echo $product['image'] ?> ">
          <?php endif; ?>
        </td>
        <td>
          <?php echo $product['price']?>
        </td>
        <td>
          <?php echo $product['create_date']?>
        </td>
        <td>
          <a href="edit.php?id=<?php echo $product['id'] ?>">
            <button type="button" class="btn-sm btn-outline-primary">Edit</button>
          </a>
          <a href="delete.php?id=<?php echo $product['id'] ?>">
            <button type="button" class="btn-sm btn-outline-danger">Delete</button>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  </body>
</html>