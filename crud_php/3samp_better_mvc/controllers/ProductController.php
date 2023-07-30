<?php

namespace app\controllers;
use app\Router;
use app\models\Product;

class ProductController{
    public static function index(Router $router){
        $search = $_GET['search']?? '';
        $products = $router->db->getProduct($search);
        $router->renderView('products/index',['products'=>$products, 'search'=>$search]);
    }
    public static function create(Router $router){
        $error = [];
        $productData = ['title'=>'','pdesc'=>'','image'=>'','price'=>''];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $productData['title'] = $_POST['title'];
            $productData['pdesc'] = $_POST['pdesc'];
            $productData['price'] = (float)$_POST['price'];
            $productData['imageFile'] = $_FILES['image']?? null;

            $product = new Product();
            $product->load($productData);
            $error = $product->save();
            if(empty($error)){
                header('Location: /products');
                exit;
            }            
        }
        $router->renderView('products/create',['product'=>$productData, 'error'=>$error]);
    }
    public static function update(Router $router){
        $error = [];
        $id = $_GET['id']?? null;
        if(!$id){
            header('Location: /products');
            exit;
        }
        $productData = $router->db->getProductById($id);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $productData['title'] = $_POST['title'];
            $productData['pdesc'] = $_POST['pdesc'];
            $productData['price'] = (float)$_POST['price'];
            $productData['imageFile'] = $_FILES['image']?? null;
            $product = new Product();
            $product->load($productData);
            $error = $product->save();
            if(empty($error)){
                header('Location: /products');
                exit;
            }            
        }
        $router->renderView('products/update', ['product'=>$productData, 'error'=>$error]);
    }

    public static function delete(Router $router){
        $id = $_POST['id']?? null;
        if(!$id){
            header('Location: /products');
            exit;
        }
        $router->db->deleteProduct($id);
        header('Location: /products');
    }
}

?>