<?php 

require 'config.php';

if(!empty($_POST)){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $create_at = $_POST['create_at'];
    $id = $_GET['id'];
   
   

    if($_FILES){
        $targetFile = 'images/'.($_FILES['image']['name']);
        $imageName = $_FILES['image']['name'];
        $imageType = pathinfo($targetFile,PATHINFO_EXTENSION);


            if($imageType != 'png' && $imageType != 'jpg' && $imageType != 'jpeg'){
                echo "<script> alert ('Image must be jpg, png or jpeg!');
                </script>";
                

            }else {
            move_uploaded_file($_FILES['image']['tmp_name'],$targetFile);

            $pdo_statement = $pdo->prepare("UPDATE post set title='$title',description='$desc',img='$imageName',create_at='$create_at' WHERE id='$id'");

            $result = $pdo_statement->execute();
            }

        }else {
            $pdo_statement = $pdo->prepare("UPDATE post set title='$title',description='$desc',create_at='$create_at' WHERE id='$id'");

            $result = $pdo_statement->execute();
        } 

        if($result){
            echo "<script> alert ('Update Successfully!!!') ;
            window.location.href='index.php';</script>";
        } 
 }
    


$pdo_statement = $pdo->prepare("SELECT * FROM post WHERE id = ".$_GET['id']);
$pdo_statement->execute();
$result = $pdo_statement->fetchALL();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Page</title>
</head>
<body>
    
<div class="card">
      <div class="card-body">
       <form class="" action="" method="post" enctype="multipart/form-data">
       <h2 class="text-center mb-4 ">Edit And Upgrate Posts</h2>

        <div class="form-group">
         <label for="email">Title</label>
         <input class="form-control mb-2" type="text" name="title" id=""  value="<?php echo $result[0]['title'] ?>" >
        </div>

        <div class="form-group mb-4">
         <label for="password">Description</label>
         <!-- <input class="form-control mb-2" type="text" name="description" id=""  value="" require> -->
         <textarea  class="form-control"name="description" id="" cols="10" rows="5" ><?php echo $result[0]['description'] ?></textarea>
        </div>

        <div class="form-group">
         <label for="email">Image</label><br><br>
         <img src="images/<?php echo $result[0]['img'] ?>" alt="" width="100" height = "100"><br><br>
         <input class="form-control mb-2" type="file" name="image" id=""  value="" >
        </div>

        <div class="form-group mb-4">
         <label for="password">Created At</label>
         <input class="form-control mb-2" type="date" name="create_at" id=""  value="<?php echo date('Y-m-d',strtotime($result[0]['create_at'])); ?>" >
         

        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Upgrate">
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