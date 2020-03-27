<?php 
    require 'jwt.php';


    if(empty($_POST['user']) && empty($_POST['id_user'])):
    ?>
    <html>
        <body>
        <form method="post">
        <h2>Gerar JWT</h2>
        User<br/>
        <input type="text" name="user"><br/><br/>

        id_user<br/>
        <input type="number" name="id_user"><br/><br/>

        <input type="submit" value="Gerar">
        </body>
        </form>
    </html>
    <?php
    exit;
    endif;
    
    $jwt = new JWT();
    $user = $_POST['user'];
    $id_user = $_POST['id_user'];
    echo $jwt = $jwt->create(array("user"=>$user, "id_user" => $id_user));
    ?> 
    <a href="jwt_validate.php?jwt=<?php echo $jwt;?>">Validar JWT</a>
    <?php
?>
