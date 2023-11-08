<?php include_once "../connect.php" ;
if(!isset($_SESSION['admin'])){
    echo "<script>window.open('../login.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>
<body class="bg-secondary">
   
<?php include_once "admin_header.php" ?>
    <!-- Your admin content goes here -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-3">
               <?php include_once "sidebaar.php" ?>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-12 mb-3 d-flex justify-content-between">
                        <h2 class="text-white">insert new  book</h2>
                        <a href="manage_books.php" class="btn btn-success">go back</a>
                    </div>
                </div>
                <div class="card">
                <div class="card-header">
                    <h5>Insert book Details</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                       <div class="row">
                       <div class="mb-3 col">
                            <label for="author">author</label>
                            <input type="text" name="author" id="author" class="form-control">
                        </div>
                        <div class="mb-3 col">
                            <label for="no_of_page">no_of_page</label>
                            <input type="text" name="no_of_page" id="no_of_page" class="form-control">
                        </div>
                       </div>
                       <div class="row">
                       <div class="mb-3 col">
                            <label for="price">price</label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                        <div class="mb-3 col">
                            <label for="discount_price">discount_price</label>
                            <input type="text" name="discount_price" id="discount_price" class="form-control">
                        </div>
                       </div>
                      <div class="row">
                      <div class="mb-3 col">
                            <label for="category">category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">select category</option>
                                <?php
                                $q=mysqli_query($connect, "select * from categories");
                                while($row=mysqli_fetch_array($q)){
                                    $cat_id=$row['cat_id'];
                                    $cat_title=$row['cat_title'];
                                    echo "<option value='$cat_id'>$cat_title</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 col">
                            <label for="qty">qty</label>
                            <input type="text" name="qty" id="nos" class="form-control">
                        </div>
                        <div class="mb-3 col">
                            <label for="cover_image">cover_image</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control">
                        </div>
                      </div>
                        <div class="mb-3">
                            <label for="description">description</label>
                            <textarea rows="4" type="text" name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="isbn">isbn</label>
                            <input type="text" name="isbn" id="isbn" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="create_book" value="Insert book" class="btn btn-success w-100" >
                        </div>
                    </form>
                    <?php
                    if(isset($_POST['create_book'])){
                        $title=$_POST['title'];
                        $author=$_POST['author'];
                        $isbn=$_POST['isbn'];
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $discount_price=$_POST['discount_price'];
                        $category=$_POST['category'];
                        $cover_image=$_POST['cover_image'];
                        $qty=$_POST['nos'];
                        $no_of_page=$_POST['no_of_page'];


                        //image work
                        $cover_image=$_FILES['cover_image']['name'];
                        $tmp_cover_image=$_FILES['cover_image']['tmp_name'];

                        move_uploaded_file($tmp_cover_image,"../images/$cover_image");
                        $query=mysqli_query($connect,"insert into books (title,author,isbn,description,price,discount_price,category,cover_image,nos,no_of_page) value('$title','$author','$isbn','$description','$price','$discount_price','$category','$cover_image','$qty','$no_of_page')");
                        if($query){
                            echo "<script>window.open('manage_books.php','_self')</script>";
                        }
                        else{
                            echo "<script>alert('failled')</script>";

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
