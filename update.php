<?php
include('header.php');
include('db.php');


if (isset($_GET['edit_id'])) {
    $edit_id = mysqli_real_escape_string($conn, $_GET['edit_id']);
}
$sql = "SELECT * FROM cart WHERE id=  $edit_id";

$results = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($results);


if (isset($_POST['name']) && isset($_FILES['image']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['rating']) && isset($_POST['category'])) {
    $image = $_FILES['image'];
    $tmp = $_FILES['image']['tmp_name'];
    $img = $_FILES['image']['name'];
    $folder = 'images/' . $img;

    $update_id = $_POST['update_id'];
    $name = $_POST['name'];
    $img = $_FILES['image']['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $category = $_POST['category'];

    $sql = "UPDATE cart SET name= '$name', image='$img',description='$description', price='$price', rating='$rating', category='$category' WHERE id=$update_id ";

    $results = mysqli_query($conn, $sql);
    if ($results) {
        move_uploaded_file($tmp, $folder);
    } else {
        die("something Went Wrong");
    }



    header('Location: shop.php');
}

?>

<header class="header-form">
    <div class="container">
        <form id="updateForm" class="my-5 w-75 mx-auto" method="post" enctype="multipart/form-data">
            <div class="form-group col-lg-8 my-4">
                <input class="form-control" type="text" name="name" value="<?php echo $post['name'] ?>" id="name" placeholder="Enter New Name">
            </div>
            <div class="form-group col-lg-8 my-4">
                <input class="form-control" type="file" name="image" id="image" placeholder="Enter New Name">
            </div>
            <div class="form-group col-lg-8 my-4">
                <textarea class="form-control " name="description" id="description"><?php echo $post['description'] ?>"</textarea>
            </div>
            <div class="form-group col-lg-8 my-4">
                <input class="form-control" type="text" name="price" value="<?php echo $post['price'] ?>" id="price" placeholder="Enter New Price">
            </div>
            <div class="form-group col-lg-8 my-4">
                <input class="form-control" type="text" name="rating" value="<?php echo $post['rating'] ?>" id="rating" placeholder="Enter New Rating">
            </div>
            <div class="form-group col-lg-8 my-4">
                <input class="form-control" type="text" value="<?php echo $post['category'] ?>" name="category" id="category" placeholder="Enter New Name">
            </div>
            <div class="form-group col-lg-8 my-4">
                <input type="hidden" name="update_id" value="<?php echo $post['id'] ?>">
                <input class="btn btn-success w-100" type="submit" name="submit" id="submit" value="Update Posts">
            </div>
        </form>
    </div>
</header>
<?php include('footer.php'); ?>