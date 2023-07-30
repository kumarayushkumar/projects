
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
      <input type="text" class="form-control" name="title" value="<?php echo $product['title']; ?>">
    </div>
    <div class="mb-3">
      <label for="pdesc" class="form-label">Product Description</label>
      <input type="text" class="form-control" name="pdesc" value="<?php echo $product['pdesc']; ?>">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Product Price</label>
      <input type="number" class="form-control" name="price" value="<?php echo $product['price']; ?>">
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Product Image</label>
        <?php if($product['image']): ?>
         <img src="../<?php echo $product['image'] ?> ">
        <?php endif; ?>
      <input class="form-control" type="file" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>