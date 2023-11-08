<?php
include "connect.php";
if(!isset($_SESSION['account'])){

    echo "<script>window.open('login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
include_once "header.php";
//calling orders and order items here
$user_id=$getUser['user_id'];
$order=mysqli_query($connect,"select * from orders LEFT JOIN coupon on orders.coupon_id = coupon.c_id where user_id='$user_id' and is_ordered='0'");
$myOrder=mysqli_fetch_array($order);
$count_myOrder=mysqli_num_rows($order);


?>

    <div class="container p-5">
        <div class="row">


            <div class="col-8">
                <h1>Checkout</h1>
                <div class="card">
                    <div class="card-header">Add Address</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="alt_name">Alternative Name</label>
                                    <input type="text" name="alt_name" value="<?=$getUser['name'];?>"
                                        class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="alt_contact">primary Contact</label>
                                    <input type="text" placeholder="eg:-+91 0000000" name="alt_contact" value=""
                                        class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for=""> Type</label>
                                    <select name="type" class="form-select">
                                        <option value="">Select Address type</option>
                                        <option value="0">Office</option>
                                        <option value="1">Home</option>
                                        <option value="2">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="street">Street</label>
                                    <input type="text" name="street" value="" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="area">area/village</label>
                                    <input type="text" name="area" value="" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="house_no">House holding number</label>
                                    <input type="text" name="house_no" value="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="landmark">Landmark</label>
                                    <input type="text" name="landmark" value="" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="city">City</label>
                                    <input type="text" name="city" value="" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="state">State</label>
                                    <input type="text" name="state" value="" class="form-control">
                                </div>
                                <div class="mb-3 col">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" name="pincode" value="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <input type="submit" name="save_Address" class="btn btn-primary w-100"
                                    value="save address">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <h2>Saved Address</h2>
                <form action="" method="post">
                <div class="grid">
                    <?php
                    $callingSavedAddress=mysqli_query($connect, "select * from address where user_id='$user_id'");
                    $count_address=mysqli_num_rows($callingSavedAddress);
                    if($count_address >0):
                       
                    while($add=mysqli_fetch_array($callingSavedAddress)):
                        ?>
                    
                   
                    <label class="card">
                        <input name="address_id" value="<?= $add['address_id'];?>" class="radio" type="radio" checked>

                        <span class="plan-details">
                            <span class="plan-type"><?= ($add['type']==0)? "Office" : (($add['type']==1) ? "Home" : "Other");?></span>
                            <span class="plan-cost"><?= $add['alt_name'];?></span>
                            <span><?= $add['house_no'] . " | " . $add['street'] . "-" .  $add['area'] . "<br> Landmark:" . $add['landmark'] . "<br>" . $add['city']. "(" . $add['city'] . " ) - " .$add['pincode'];?></span>
                            <span></span>
                            <span>1 concurrent build</span>
                            <a href="checkout.php?address_id=<?=$add['address_id'];?>" class="badge bg-danger text-white text-decoration-none ms-auto">Delete</a>
                        </span>
                        
                    </label>
                    <?php endwhile; ?>
                    
                </div>

                <div class="d-flex mt-5 justify-content-between">
                    <a href="cart.php" class="btn btn-dark">Go Back</a>
                    <input type="submit" value="Make Payment" class="btn btn-primary " name="make_payment">
                </div>
                </form>
                <?php else: ?>
                    <h6 class="text-muted">Empty Saved address</h6>

                    <?php endif; ?>



            </div>
        </div>

    </div>
    <?php
    if(isset($_POST['save_Address'])){
        $alt_name=$_POST['alt_name'];
        $alt_contact=$_POST['alt_contact'];
        $street=$_POST['street'];
        $area=$_POST['area'];
        $landmark=$_POST['landmark'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $pincode=$_POST['pincode'];
        $house_no=$_POST['house_no'];
        $type=$_POST['type'];
        $user_id=$getUser['user_id'];

        $queryForInsertAddress=mysqli_query($connect, "insert into address (alt_name, alt_contact,street,area,landmark,city,state,pincode,house_no,user_id,type ) value ('$alt_name','$alt_contact','$street','$area','$landmark','$city','$state','$pincode','$house_no','$user_id','$type')");
        if($queryForInsertAddress){
            echo "<script>window.open('checkout.php','_self')</script>";
        }
        else{
            echo "<script>('failed to save adress')</script>";
        }
       }
        
    //delete address directly
   if (isset($_GET['address_id'])){
    $id=$_GET['address_id'];
    $user_id=$getUser['user_id'];
    $queryForRemoveAddress=mysqli_query($connect, "delete from address where address_id='$id' and user_id='$user_id'");
    if($queryForRemoveAddress){
        echo "<script>window.open('checkout.php','_self')</script>";
    }
    else{
        echo "<script>('failed to delete address')</script>";
    }
   }
    
   if(isset($_POST['make_payment'])){
    $address_id=$_POST['address_id'];
    $order_id=$myOrder['order_id'];
    //update this address in order record
    $queryForAddressUpdate=mysqli_query($connect,"update orders SET  address_id='$address_id' where user_id ='$user_id' and order_id='$order_id'");
    if($queryForAddressUpdate){
        echo "<script>window.open('make_payment.php','_self')</script>";
    }
    else{
        echo "<script>('failed to proced')</script>";
    }
   

   }


?>
</body>

</html>