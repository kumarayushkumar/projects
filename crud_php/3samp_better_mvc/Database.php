<?php

namespace app;
use PDO;
use app\models\Product;

class Database{
    public \PDO $pdo;
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=samp','root','');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getProduct($search='')
    {
        if($search){
            $statement = $this->pdo->prepare('SELECT * FROM products WHERE title LIKE :search ORDER BY create_date DESC');
            $statement->bindValue(':search', "%$search%");
        } else{
            $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');
        }
          
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM products WHERE id=:id");
        $query->bindValue(':id',$id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct(Product $product)
    {
        $query = $this->pdo->prepare("INSERT INTO products (title, pdesc, image, price, create_date) VALUES (:title, :pdesc, :image, :price, :date)");
        $query->bindValue(':title',$product->title);
        $query->bindValue(':pdesc',$product->pdesc);
        $query->bindValue(':image',$product->imagePath);
        $query->bindValue(':price',$product->price);
        $query->bindValue(':date',date("Y-m-d H:i:s"));
        $query->execute();
    }

    public function updateProduct(Product $product)
    {
        $query = $this->pdo->prepare("UPDATE products SET title=:title, pdesc=:pdesc, image=:image, price=:price WHERE id=:id");
        $query->bindValue(':title',$product->title);
        $query->bindValue(':pdesc',$product->pdesc);
        $query->bindValue(':image',$product->imagePath);
        $query->bindValue(':price',$product->price);
        $query->bindValue(':id',$product->id);
        $query->execute();
    }
    public function deleteProduct($id)
    {
        $query = $this->pdo->prepare("DELETE FROM products WHERE id=:id");
        $query->bindValue(':id',$id);
        $query->execute();
    }
}