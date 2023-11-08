
<?php
include "connect.php";

if(!isset($_GET['book_id'])){

    echo "<script>window.open('index.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
include_once "header.php";
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-3">
        <div class="list-group">
        <a href="" class="list-group-item list-group-item-action active">category</a>
        <?php
        $q=mysqli_query($connect, "select * from categories");
        while($row=mysqli_fetch_array($q)){
            
            $cat_title=$row['cat_title'];
            $cat_id=$row['cat_id'];
            echo "<a href='index.php?cat_id=$cat_id' class='list-group-item list-group-item-action '>$cat_title</a>";
        }
        ?>
        
         </div>
        </div>
        <div class="col-9">
                <?php
                $book_id=$_GET['book_id'];
                $q=mysqli_query($connect,"select * from books JOIN categories ON books.category=categories.cat_id WHERE id='$book_id'");
                $data=mysqli_fetch_array($q);
                $count=mysqli_num_rows($q);
                if($count > 0){

                ?>
                ?>
             <div class="row">
                <div class="col-3 mt-3">
                    <div class="card">
                        <img src="<?="images/" .$data['cover_image'];?>"  class="w-100" style="height:200px; object-fit:cover">
                       
                    </div>
                </div>
                <div class="col-9">
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <td> <?=$data['title'];?></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td> <?=$data['cat_title'];?></td>
                        </tr>
                        <tr>
                            <th>No_Of_Pages</th>
                            <td> <?=$data['no_of_page'];?></td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td> <?=$data['author'];?></td>
                        </tr>
                        <tr>
                            <th>Isbn</th>
                            <td> <?=$data['isbn'];?></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>₹ <?=$data['discount_price'];?>/- <del> <?=$data['price'];?>/-</td>
                        </tr>
                        
                    </table>
                    <div class="d-flex gap-2">
                        <a href="" class='btn btn-success btn-lg'>By Now</a>
                        <a href="cart.php?book_id=<?=$data['id'];?>&atc=True" class='btn btn-warning btn-lg'>Add to card</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h5>Description</h5>
                    </div>
                    <div class="card-body">
                        <p><?=$data['description'];?></p>
                        </div>
                    </div>
                </div>
                <?php
                }
                else{
                    echo "<h2>Not found</h2>";
                }

                ?>
                        
                        <div class="row">
                            <div class="col-12">
                                <h2 class="my-4">Related books</h2>
                            </div>
                <?php
                
                        $q=mysqli_query($connect,"select * from books JOIN categories ON books.category=categories.cat_id where id <> '$book_id' ");
                        $count=mysqli_num_rows($q);
                if($count < 1){
                    echo "<h1 class='display-3'>not found any books</h1>";
                }
                
                while($data=mysqli_fetch_array($q)):
                ?>
                <div class="col-3 mt-3">
                    <div class="card">
                        <img src="<?="images/" .$data['cover_image'];?>"  class="w-100" style="height:200px; object-fit:cover">
                        <div class="card-body">
                            <h2 class="h5">Rs. <?=$data['discount_price'];?>/- <del> <?=$data['price'];?>/-</del></h2>
                            <h6 class="h6 text-truncate" title="<?=$data['title'];?>"> <?=$data['title'];?></h6>
                            <span class="bg-success text-white badge"> <?=$data['cat_title'];?></span>
                            <a href="view_book.php?book_id=<?=$data['id'];?>" class="btn btn-info">View</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
                    
            </div>
        </div>
    </div>

</body>
</html>
