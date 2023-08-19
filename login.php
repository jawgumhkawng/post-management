<?php 
require 'config.php';

session_start(); 

if(!empty($_POST)){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $pdo->prepare($sql);


    //bind stament
    $stmt->bindValue(':email',$email);

    //execute stament
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($user)){

         echo "<script>alert ('Incorrect Credential,Try Again')</script>";

    }else{
        $validPassword = password_verify($password,$user['password']);
        if($validPassword){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logded_in'] = time();

            header('location: index.php');
            exit();

        }else{

            echo "<script>alert ('Incorrec Password,Try Again')</script>";

        }
    }
   


    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>login page</title>
</head>
<body>
 
    <div class="card">
      <div class="card-body">
       <form class="" action="login.php" method="post">
       <h2 class="text-center mb-4 ">Please Login Here</h2>

        <div class="form-group">
         <label for="email">Email</label>
         <input class="form-control mb-2" type="email" name="email" id=""  value="" required>
        </div>

        <div class="form-group mb-4">
         <label for="password">Password</label>
         <input class="form-control mb-2" type="password" name="password" id=""  value="" required>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Login">
          <h5 style="display:inline;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Have An Account?<a href="register.php">Please Register</a></h5>
        </div>
       </form>

      </div>
    </div>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</html>