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

  ?>