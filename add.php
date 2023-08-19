<?php 

require 'config.php';

if(!empty($_POST)){

  //image upload
    $targetFile = 'images/'.($_FILES['image']['name']);
    $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);


    if($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg'){
        echo "<script> alert ('Image must be jpg, png or jpeg!');
        </script>";
    }else {
        move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);

     //create new
    $sql = "INSERT INTO post(title,description,img,create_at) VALUES(:title,:description,:image,:create_at)";

    $pdo_statement = $pdo->prepare($sql);

    $result = $pdo_statement->execute(

        array(':title'=>$_POST['title'],':description'=>$_POST['description'],':image'=>$_FILES['image']['name'],':create_at'=>$_POST['create_at']) );
        
        if($result){
            echo "<script> alert ('Post Created Successfully!');
            window.location.href='index.php';</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Create Page</title>
</head>
<body>
    
<div class="card">
      <div class="card-body">
       <form class="" action="add.php" method="post" enctype="multipart/form-data" >
       <h2 class="text-center mb-4 ">Create New Posts</h2>

        <div class="form-group">
         <label for="email">Title</label>
         <input class="form-control mb-2" type="text" name="title" id=""  placeholder="title.." value="" required>
        </div>

        <div class="form-group mb-4">
         <label for="description">Description</label>
         <!-- <input class="form-control mb-2" type="text" name="description" id=""  value="" require> -->
         <textarea  class="form-control"name="description" id="" cols="10" rows="5" placeholder="description..."required></textarea>
        </div>

        <div class="form-group">
         <label for="email">Image</label>
         <input class="form-control mb-2" type="file" name="image" id=""  value="<?php echo $result[0]['img'] ?>" required>
        </div>

        <div class="form-group mb-4">
         <label for="created_at">Created At</label>
         <input class="form-control mb-2" type="date" name="create_at" id=""  value="" required>
         

        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Submit">
          <a class="btn btn-danger" href="index.php">Back</a>
          
        </div>
       </form>

      </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<br>
<br>
<br>
<br>
<br>

</html>