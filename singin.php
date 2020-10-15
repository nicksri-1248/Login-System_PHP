<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>singin</title>
  </head>
  <body>
  <?php include '_navbar.php';?>
  <?php
   $showAlert = false;
   if ($_SERVER['REQUEST_METHOD']  == 'POST'){
       
       include '_connectdatabase.php';
       $username= $_POST['username'];
       $password = $_POST['password'];
       $cpssword= $_POST['cpassword'];
     //  $exits = false;
       $existsql = "SELECT * FROM `logindetails` WHERE username = '$username'";
       $result = mysqli_query($conn, $existsql);
       $numExistRow = mysqli_num_rows($result);
       if ($numExistRow > 0){
           echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>Alert!</strong> User already exist.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>';
       }
       else{
                if($password == $cpssword)
                 {
                   $hash  = password_hash($password, PASSWORD_DEFAULT);
                    $sql  = "INSERT INTO `logindetails` ( `username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp())";
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        $showAlert = true;
                        
                    }
                    else{
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> You have successfuly signin now login.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
            
                }
                else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Alert!</strong> Confarm that both password are same.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                }

            }
        }    
  ?>



<?php
if($showAlert){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Fail!</strong> You have to try again.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

?>

   <div class="container my-3 col-md-8">
   <h2>Please Singin here</h2>
   <form action = "/Loginsys/singin.php" method= "post">
  <div class="form-group">
    <label for="text">User Name</label>
    <input type="text" maxlenth class="form-control" id="username" name= "username" aria-describedby="emailHelp">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" name= "password">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Confram Password</label>
    <input type="password" class="form-control" id="cpassword" name ="cpassword">
    <small id="emailHelp" class="form-text text-muted">Both Password should be same.</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Singin</button>
</form>
   
   </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>