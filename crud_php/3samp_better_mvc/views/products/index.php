
<p><a href="/products/create" class="btn btn-success">Create Product</a></p>

<h1>Product List</h1>

<form action="index.php" method="GET">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <button class="btn btn-outline-warning" type="submit">Search</button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Create date</th>
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
                <img src="../<?php echo $product['image'] ?>">
            <?php endif; ?>
        </td>
        <td>
            <?php echo $product['price']?>
        </td>
        <td>
            <?php echo $product['create_date']?>
        </td>
        <td>
            <a href="/products/update?id=<?php echo $product['id'] ?>">
                <button type="button" class="btn-sm btn-primary">Edit</button>
            </a>
            <form action="/products/delete" method="POST" style="display: inline">
                <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                <button type="submit" class="btn-sm btn-outline-danger">Delete</button>
            </form>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
