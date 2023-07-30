<?php

/** @var $pdo \PDO */
require_once '../../db.php';

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
<?php include_once "../../views/partials/header.php"; ?>
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
    <p>
      <a href="create.php" class="btn btn-success">Create Product</a>
    </p>
    
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
          <img src="../<?php echo $product['image'] ?> ">
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