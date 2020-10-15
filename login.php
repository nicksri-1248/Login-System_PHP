<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <?php include '_navbar.php';?>
  <?php
   $login = false;
   if ($_SERVER['REQUEST_METHOD']  == 'POST'){
       
       include '_connectdatabase.php';
       $username= $_POST['username'];
       $password = $_POST['password'];
    
        
       
      //  $sql  = "SELECT * FROM `logindetails` where username= '$username' AND password= '$password'";
        $sql  = "SELECT * FROM `logindetails` where username= '$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num==1){
            while($row=mysqli_fetch_assoc($result)){
                if (password_verify($password, $row['password'])){
                   $login = true;
                   session_start();
                   $_SESSION['loggedin'] = true;
                   $_SESSION['username']= $username;
                   echo $username;
                   header("location: welcome.php");
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>Invailid Cridentials.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                }
                
             }
             
            
        }
         else{
             echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Error!</strong>Invailid Cridentials.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>';
          }
 
    }
    ?>



<?php
if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> You are loged in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

?>

   <div class="container my-3 col-md-8">
   <h2 style="text-align-center">Please login here</h2>
   <form action = "/Loginsys/login.php" method= "post">
  <div class="form-group">
    <label for="text">User Name</label>
    <input type="text" class="form-control" id="username" name= "username" aria-describedby="emailHelp">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" name= "password">
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