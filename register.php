
<?php 

require 'config.php';

if(!empty($_POST)){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];


  if($username == '' || $email == '' || $password == ''){
    echo"<script> alert ('Fill the form data')</script>";
  }else{

    // query prepare
    $sql = "SELECT COUNT(email) AS num FROM user WHERE email = :email";
    $stmt = $pdo->prepare($sql);


    // bind statement
    $stmt->bindValue(':email',$email);

    // execute statement
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    if ( $row['num'] > 0 ){
      echo "<script> alert('This Email Already Exists!!!')</script>";
    }else {
      $passwordHash = password_hash($password,PASSWORD_BCRYPT);

      $sql = "INSERT INTO user(username,email,password) VALUES(:username,:email,:password)";

      $stmt = $pdo->prepare($sql);


      $stmt -> bindValue(':username',$username);
      $stmt -> bindValue(':email',$email);
      $stmt -> bindValue(':password',$passwordHash);

      $result = $stmt->execute();

      if($result){
        echo "<script> alert ('Registration Successfully!..Thanks For Your Registrations!!..Please Login!!');
        window.location.href='login.php';</script>";
      }
     
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

    <title>Register page</title>
</head>
<body>

    
    <div class="card">
      <div class="card-body">
       <form class="" action="register.php" method="post">
       <h2 class="text-center mb-4 ">Registration Form</h2>
        <div class="form-group">
         <label for="username">Username</label>
         <input  class="form-control mb-2" type="text" name="username" id=""  value="" required>
        </div>

        <div class="form-group">
         <label for="email">Email</label>
         <input class="form-control mb-2" type="email" name="email" id=""  value="" required>
        </div>

        <div class="form-group mb-4">
         <label for="password">Password</label>
         <input class="form-control mb-2" type="password" name="password" id=""  value="" required>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Register">
          <h5 style="display:inline;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Don't Have An Account?<a href="login.php">Login Here</a></h5>
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
</html>