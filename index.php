<?php 
require 'config.php';

session_start();

if(empty( $_SESSION['user_id']) || empty($_SESSION['logded_in'])){
    echo"<script>alert ('Please Login To Continue!');
     window.location.href='login.php'</script>";
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
    <script src="https://kit.fontawesome.com/ab51b88c37.js" crossorigin="anonymous"></script>
   
    <title>Index Page</title>
</head>
<body>

        <?php 
            $pdo_statement = $pdo->prepare("SELECT * FROM post ORDER BY id DESC");
            $pdo_statement->execute();
            $result = $pdo_statement->fetchAll();
        ?>
    <div class="card">
        <div class="card-body">
            <table  class="table table-striped table-hover">

            <h2 class="text-center" style="cursor:pointer;font-size:45px;" >Post Management</h2>
            <br>
            <div>
                <a class="btn btn-primary" href="add.php">Create New</a>
                <a style="float:right;"class="btn btn-danger" href="logout.php">Logout</a>
            </div>
            <br>
            <br>
            
            <thead>
                <tr>
                    <th width="10%" style='cursor:pointer;'>Image</th>
                    <th width="20%" style='cursor:pointer;'>Title</th>
                    <th width="30%" style='cursor:pointer;'>Description</th>
                    <th width="20%" style='cursor:pointer;'>Created At</th>
                    <th width="30%" style='cursor:pointer;'>Action</th>
                </tr>
            </thead>
            <tbody>
            
            <?php   if($result) : ?>
               
               <?php foreach ($result as $value) :?>
            

                    <tr>
                        <td style='cursor:pointer;' ><img class="service-icon rounded-circle" width="40px"  height="40px" src="images/<?php echo $value['img'] ?>"  alt=""></td>
                        <td style='cursor:pointer;'><?php echo $value ['title']?></td>
                        <td style='cursor:pointer;'><?php echo $value ['description']?></td>
                        <td style='cursor:pointer;'><?php echo date('d/m/y',strtotime($value ['create_at']))?></td>
                        <td style='cursor:pointer;'>
                            <a style='font-size:20px;cursor:pointer;' href="edit.php?id=<?php echo $value['id']?>"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp;&nbsp; | 
                            &nbsp;&nbsp;
                            <a style='font-size:20px;cursor:pointer;' href="delete.php?id=<?php echo $value['id']?>"><i class="fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>

            <?php endforeach ?>

            <?php endif ?>
                
            
            </tbody>
           
            </table>
            <br>
            <br>
            
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