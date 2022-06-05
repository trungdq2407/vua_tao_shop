<?php
include 'connect.php';

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="../home.php" class="logo">Vua Táo Store<span>.</span></a>

      <nav class="navbar">
      <li>
                <a href="#">Mobile</a>

                <ul class="subnav">
                    <li><a href="../admin/iphone.php">Iphone</a></li>
                    <li><a href="../admin/samsung.php">Samsung</a></li>
                    <li><a href="../admin/oppo.php">Oppo</a></li>
                </ul>
            </li>
            <li>
               <a href="#">Tablet</a>

               <ul class="subnav">
                    <li><a href="../admin/iphone.php">Iphone</a></li>
                    <li><a href="../admin/samsung.php">Samsung</a></li>
                    <li><a href="../admin/oppo.php">Oppo</a></li>
                </ul>
            </li>
            <li>
               <a href="#">Phụ kiện</a>

               <ul class="subnav">
                    <li><a href="#">Dây sạc</a></li>
                    <li><a href="#">Ốp</a></li>
                    <li><a href="#">Tai nghe</a></li>
                </ul>
            </li>
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>