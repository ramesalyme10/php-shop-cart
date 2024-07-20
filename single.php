<?php
include('header.php');
include('db.php');

if (isset($_GET['single_id'])) {
    $single_id = mysqli_real_escape_string($conn, $_GET['single_id']);
    $sql = "SELECT * FROM cart WHERE id=  $single_id";

    $results = mysqli_query($conn, $sql);

    $post = mysqli_fetch_assoc($results);
}



?>



<header class="single-page">
    <div class="container">
        <div class="single-page-content" id="single">
            <div class="grid-2">
                <div class="single-tab-1">
                    <div class="card">
                        <img src="images/<?php echo $post['image']; ?>" alt="<?php echo $post['name']; ?>">

                    </div>
                </div>
                <div class="single-tab-2">
                    <div class="card p-2">
                        <div class="d-flex align-items-center">
                            <span>Category:</span><a class="ms-1 mt-2" style="text-decoration: none;" href=""><?php echo $post['category']  ?></a>
                        </div>
                        <h2><?php echo $post['name']; ?></h2>
                        <div class="single-flex">
                            <p class="single-price">$ <?php echo number_format($post['price'], 2); ?></p>
                            <div>******</div>
                        </div>
                        <p><?php echo $post['description']; ?></p>
                        <div style="display: flex; align-items: center;" class="single-btn">
                            <form id="form" method="post">
                                <input type="hidden" name="image" id="image" value="<?php echo $post['image']; ?>">
                                <input type="hidden" name="name" id="name" value="<?php echo $post['name']; ?>">
                                <input type="hidden" name="description" id="description" value="<?php echo $post['description']; ?>">
                                <input type="hidden" name="price" id="price" value="<?php echo $post['price']; ?>">
                                <input type="hidden" name="quantity" id="quantity" value=1>
                                <a style="margin-right: 15px; text-decoration: none;" class="btn_cart" href="">Add To Cart</a>

                            </form>

                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<?php include('footer.php'); ?>