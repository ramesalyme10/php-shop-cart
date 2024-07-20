<?php
include('header.php');
include('db.php');








// delete products

if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $sql = "DELETE FROM cart WHERE id=$delete_id";
    $results = mysqli_query($conn, $sql);
    if ($results) {
        echo 'Products Deleted Successfully';
    }
}


if (isset($_POST['action'])) {
    if ($_POST['action'] == "add") {
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






?>



<header class="products">
    <div class="container">
        <div class="products-center-text">
            <h3>Our Latest Products</h3>
            <p>Check out all of our products.</p>
        </div>
        <div id="msg" class="alert-danger my-5 text-center">

        </div>
        <div class="products-search-products">
            <div class="row justify-content-center align-items-center">
              
                <div class="col-md-9">
                    <form method="post">
                        <input type="text" name="search" id="search" placeholder="Search...">

                        <button type="submit" name="search_btn" id="search_btn">Search</button>
                    </form>
                </div>

            </div>

        </div>



        <div class="products-content">

            <div class="products-grid-3" id="posts">


            </div>
            <nav aria-label="...">
                <ul class="pagination pagination-sm justify-content-center my-5">
                    <?php
                    $currentPage = 8;
                    $page = "";
                    if (isset($_POST['page_num'])) {
                        $page = $_POST['page_num'];
                    } else {
                        $page = 1;
                    }
                    $sql = "SELECT * FROM cart";
                    $results = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($results);
                    $totalPage = ceil($num / $currentPage);
                    for ($i = 1; $i <= $totalPage; $i++) {

                    ?>
                        <li class="page-item  ms-2" style="cursor: pointer;" aria-current="page">
                            <a id="<?php echo $i ?>" class="page-link"><?php echo $i ?></a>
                        </li>
                    <?php
                    }

                    ?>


                </ul>
            </nav>

        </div>
</header>

<?php include('footer.php'); ?>