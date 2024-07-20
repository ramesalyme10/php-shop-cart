<?php 
include('db.php');

if (isset($_POST['action'])) {
    if ($_POST['action'] == "single") {
        $name = $_POST['name'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $query = "SELECT * FROM products WHERE name='$name'";
        $select_name = mysqli_query($conn, $query);
        if (mysqli_num_rows($select_name) > 0) {
            echo 'Products already added to the cart';
        } else {
            $sql = " INSERT INTO products (name,image,description,price,quantity) VALUES('$name','$image','$description', '$price', '$quantity')";
            $results = mysqli_query($conn, $sql);
            echo ' successfully';
        }
    }
}
