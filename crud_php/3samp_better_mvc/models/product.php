<?php

namespace app\models;
use app\Database;

class Product
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $pdesc = null;
    public ?string $imagePath = null;
    public ?float $price = null;
    public ?array $imageFile = null;

    public function load($data)
    {
        $this->id = $data['id']?? null;
        $this->title = $data['title'];
        $this->pdesc = $data['pdesc']?? '';
        $this->price = $data['price'];
        $this->imageFile = $data['imageFile']?? null;
        $this->imagePath = $data['image']?? null;
    }

    public function save()
    {
        $error = [];
        if(!$this->title && !$this->price){ 
            $error = array("Please provide title and price"); 
        } elseif(!$this->title){ 
             $error = array("Please provide title"); 
        } elseif(!$this->price){ 
            $error = array("Please provide price"); 
        }
    
        if(!is_dir(__DIR__.'/../public/images')){ mkdir(__DIR__.'/../public/images'); }
            if(empty($error)){
                function randomString($n){
                    $char = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
                    $str = '';
                    for($i=0; $i<$n; $i++){
                      $index = rand(0, strlen($char)-1);
                      $str = $str.$char[$index];
                    }
                    return $str;
                }
                if($this->imageFile && $this->imageFile['tmp_name']){
                    if($this->imagePath){ 
                        unlink(__DIR__.'/../public/'.$this->imagePath); 
                    }
                    $this->imagePath = 'images/'.randomString(8).'/'.$this->imageFile['name'];
                    mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
                    move_uploaded_file($this->imageFile['tmp_name'], __DIR__.'/../public/'.$this->imagePath);
                }

                $db = Database::$db;
                if($this->id){
                    $db->updateProduct($this);
                } else{
                    $db->createProduct($this);
                }
            }

        return $error;
    }
}
?>