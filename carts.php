<?php
include('header.php');
include('db.php');

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'delete') {
    $delete_id = $_POST['delete_id'];
    $sql = " DELETE FROM products WHERE id='$delete_id'";
    $results = mysqli_query($conn, $sql);
  }
}
if (isset($_POST['action'])) {
  if ($_POST['action'] == 'clear-all') {

    $sql = " DELETE FROM products";
    $results = mysqli_query($conn, $sql);
  }
}


if(isset($_POST['action'])){
    if($_POST['action'] == 'add_qty'){
       $qty = $_POST['qty'];
       $qty_id = $_POST['qty_id'];

       $sql = "UPDATE products SET quantity=$qty WHERE id=$qty_id";
       $results = mysqli_query($conn,$sql);
       
       if(mysqli_num_rows($results) > 0 ){
          echo 'qty has been updated Successfully';
          
       }else{
        echo 'something went wrong';
       }
    }
}

?>



<header class="header-table">
  <table class="table table-warning table-table-responsive-md">
   <div id="message" class="text-center my-5">

   </div>
    <tbody>
      <?php
      $num = 1;
      $totalPrice = 0;
      $sql = 'SELECT * FROM products';
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
      ?>

        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <?php
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <?php foreach ($products as $key => $product) : ?>

          <tr id="add-cart">
            <td><?php echo $num ?></td>
            <td>
              <img src="./images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </td>
            <td><?php echo $product['name']; ?></td>
            <td>
              <div class="input-group">
                <button id="decrement_btn" class="input-group-text updateQty">-</button>
                
                <input type="hidden" name="qty_id" id="qty_id" value="<?php echo $product['id'] ?>">
                <input type="number" class="form-control" name="input_qty" id="input_qty" value="<?php echo $product['quantity']; ?>">
                
                <button id="increment_btn" class="input-group-text updateQty">+</button>
              </div>
            </td>
            <td><?php echo number_format($product['price'], 2) ?></td>
            <td>
              <i id="del_cart" rel=<?php echo $product['id']; ?> class="fas fa-trash-Alt"></i>
            </td>
          </tr>
          <?php
          $num++;
          $totalPrice += $product['price'] * $product['quantity'];

          ?>

        <?php endforeach; ?>
      <?php

      } else {
        echo '<div class="text-center my-5">
        <h2>No Products Available</h2>
      </div>';
      }


      ?>

    </tbody>
  </table>
  <?php if ($totalPrice > 0) : ?>
    <div class="header-table-content">
      <div class="d-flex justify-content-between my-3">
        <a class="btn  btn-outline-dark" href="shop.php">Continue Shopping</a>
      
        <div><strong>TotalPrice:</strong>$ <?php echo number_format($totalPrice, 2) ?></div>
      </div>
    </div>
    <div class="table-clear-all">
      <button id="Remove_all" class="btn btn-danger">
        <i class="fas fa-trash"></i> Delete All
      </button>
    </div>

  <?php endif; ?>

</header>

<?php include('footer.php'); ?>