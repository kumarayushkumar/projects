<?php 

    $title = $_POST['title'];
    $pdesc = $_POST['des'];
    $price = $_POST['price'];
    $imagePath = '';

    if(!$title && !$price){ 
        $error = array("Please provide title and price"); 
    } elseif(!$title){ 
         $error = array("Please provide title"); 
    } elseif(!$price){ 
        $error = array("Please provide price"); 
    }

    if(!is_dir(__DIR__.'/public/images')){ mkdir(__DIR__.'/public/images'); }

    if(empty($error)){
     
      $image = $_FILES['image'] ?? null;
      $imagePath = $product['image'];

        if($image && $image['tmp_name']){

            if($product['image']){ unlink(__DIR__.'/public/'.$product['image']); }

            $imagePath = 'images/'.randomString(8).'/'.$image['name'];

            mkdir(dirname(__DIR__.'/public/'.$imagePath));
            move_uploaded_file($image['tmp_name'], __DIR__.'/public/'.$imagePath);
        }
    }
?>