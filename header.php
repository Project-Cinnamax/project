
<header class="header">

   <div class="flex">

      <a href="Home.php" class="logo">Cinnamax</a>

      <nav class="navbar">
         <?php
               session_start();
               if (isset($_SESSION['name_type'])) {
                  if ($_SESSION['name_type']=="Seller") {
                     echo ' <a href="admin.php">add products</a>';
                 }
               }
         ?>
         <a href="products.php">view products</a>
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn2, "SELECT * FROM `cart`") or die('query failed'. mysqli_error($conn2));
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>