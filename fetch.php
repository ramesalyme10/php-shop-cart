<?php
include('db.php');


if(isset($_POST['action'])){
    if(isset($_POST['action']) == 'search'){
        $search_name = $_POST['search_name'];
        $sql = "SELECT * FROM cart WHERE  name LIKE '%$search_name%' OR category LIKE '%$search_name%'";
        $results = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($results);
        if ($count > 0) {
            while ($product = mysqli_fetch_assoc($results)) {
    ?>
                <div class="card">
                    <img src="images/<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>">
                    <div class="card-body">
                        <div class="products-title-rating">
                            <h2 id="name"><?php echo $product['name'] ?></h2>
                            <products-rating>*****</products-rating>
                        </div>
                        <div class="products-price">
                            <span><?php echo number_format($product['price'], 2)  ?> $</span>
                        </div>
                    </div>
                    <form class="card-body-icons" method="post">
    
                        <input type="hidden" name="image" id="image" value="<?php echo $product['image']; ?>">
                        <input type="hidden" name="name" id="name" value="<?php echo $product['name']; ?>">
                        <input type="hidden" name="description" id="description" value="<?php echo $product['description']; ?>">
                        <input type="hidden" name="price" id="price" value="<?php echo $product['price']; ?>">
                        <input type="hidden" name="quantity" id="quantity" value=1>
                        <button type="submit" name="save" id="save"><i class="fa-solid fa-cart-shopping"></i></button>
                        <a rel="<?php echo $product['id'] ?>" id="single_btn"><i class="fa-solid fa-eye text-info"></i></a>
                        <a id="update_btn" rel="<?php echo $product['id'] ?>"><i class="fa-solid fa-edit text-success"></i></a>
    
                        <i id="delete_btn" rel="<?php echo $product['id'] ?>" class="fa-solid fa-trash text-danger"></i>
                    </form>
                    <div>
    
                    </div>
                </div>
    
    <?php
            }
        } else {
            echo '<div class="text-center my-5 w-100 mx-auto">
      <span>Sorry: No Products Found!</span>
    </div>
    ';
        }
        
    }
}






