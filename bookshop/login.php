<?php include_once "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | bookshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <?php include_once "header.php" ?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-5 mx-auto">
         <div class="card">
            <div class="card-header"><h1 class="mt-5">Login Form</h1></div>
            <div class="card-body"> 
        <form method="post">
           
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

           

            <!-- Submit Button -->
            <input type="submit" class="btn btn-primary w-100" name="login" value="sign-up">
        </form>
        <?php
        if(isset($_POST['login'])){
            $email=$_POST['email'];
            $password=md5($_POST['password']);
            $query=mysqli_query($connect, "select * from accounts where email='$email' AND password='$password'");
            $count=mysqli_num_rows($query);
            $checkAccessLevel=mysqli_fetch_array($query);
            if($count > 0){
                $_SESSION['account']=$email;
                if($checkAccessLevel['isAdmin']==1){
                    $_SESSION['admin']=$email;

                    echo "<script>window.open('admin/index.php','_self')</script>";

                }
                else{
                    echo "<script>window.open('index.php','_self')</script>";

                }
            }
            else{
                echo "<Script>alert('failled')</script>";
            }

        }
        
        
        
        ?>
        </div>
         </div>
        </div>
      </div>
    </div>
</body>
</html>