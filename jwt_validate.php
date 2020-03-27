<?php
    $token = $_GET['jwt'];
    if(empty($token)){
        echo "jwt está vazio!";
    }

    require 'jwt.php';

    $jwt = new JWT();
    $data = $jwt->validate($token);

    if($data)
    {
        print_r($data);
        echo "token valido!";
    }
    else{
        echo "token invalido!";
    }
?>