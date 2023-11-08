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
            <div class="card-header"><h1 class="mt-5">Registration Form</h1></div>
            <div class="card-body"> 
        <form method="post">
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
            </div>

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
            <input type="submit" class="btn btn-primary w-100" name="create" value="sign-up">
        </form>
        <?php
        if(isset($_POST['create'])){
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=md5($_POST['password']);
            $query=mysqli_query($connect, "insert into accounts(name,email,password) value('$name','$email','$password')");
            if($query){
                echo "<script>window.open('login.php','_self')</script>";
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