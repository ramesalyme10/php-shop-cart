<?php

include('db.php');

if (isset($_POST['name']) && isset($_FILES['image']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['rating']) && isset($_POST['category'])) {

    $image = $_FILES['image'];
    $tmp = $_FILES['image']['tmp_name'];
    $folder = 'assets/' . $img;
    $name = $_POST['name'];
    $img = $_FILES['image']['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $category = $_POST['category'];

    $sql = "INSERT INTO cart (name,image,description,price,rating,category) VALUES ('$name','$img', '$description', '$price', '$rating','$category')";

    $results = mysqli_query($conn, $sql);
    if ($results) {
        move_uploaded_file($tmp, $folder);
    } else {
        die("something Went Wrong");
    }

  
}

?>
<?php include('header.php') ?>
<header class="header-form">
    <div class="container">
        <div class="header-post">
            <h2>Create Posts</h2>
            <p>Enjoy all the benefits of an Envato Elements subscription.</p>
        </div>
        <form id="form" class="my-5 w-50 mx-auto" method="post" enctype="multipart/form-data">
            <div class="form-group  my-4">
                <input class="form-control" type="text" name="name" id="name" placeholder="Enter New Name">
            </div>
            <div class="form-group  my-4">
                <input class="form-control" type="file" name="image" id="image" placeholder="Enter New Name">
            </div>
            <div class="form-group  my-4">
                <textarea class="form-control " name="description" id="description"></textarea>
            </div>
            <div class="form-group  my-4">
                <input class="form-control" type="text" name="price" id="price" placeholder="Enter New Price">
            </div>
            <div class="form-group  my-4">
                <input class="form-control" type="text" name="rating" id="rating" placeholder="Enter New Rating">
            </div>
            <div class="form-group  my-4">
                <input class="form-control" type="text" name="category" id="category" placeholder="Enter New Name">
            </div>
            <div class="form-group  my-4">
                <input class="btn btn-dark w-100" type="submit" name="submit" id="submit" value="Save">
            </div>
        </form>
    </div>
</header>
</body>
<?php include('footer.php'); ?>