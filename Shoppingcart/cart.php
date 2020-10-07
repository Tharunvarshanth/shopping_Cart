<?php 
session_start();
include('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="styles\cart.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <title>Cart</title>
    <script>
       function order_send($key){
    console.log('http://localhost/shoppingcard/checkout.php?key='+$key);
    window.location.href="http://localhost/shoppingcard/checkout.php?key="+$key;
  }

      </script>
</head>
<body>
    
    
    <div class="captionbar">

     <button class="navverbtn" style="" onclick="openNav()" > <i class="fa fa-bars">Menu</i>  </button>
     <H1 style="display:inline;margin-left:75px;">TMV Shopping</H1>
     <form method="GET" style="display:inline;margin-left:35px;">
       <input  type="text" id="searchid" name="searchbar" value="" class="searchcls">    
       <button  type="submit" id="submitbtnid" name="searchbtn" class="searchbtn"><i  class="fa fa-search"></i></button>
    </form>
     <nav>
       <ul>  
       <li style="display:none;" id="usericon">Hello <?php echo  $_SESSION["displayname"] ?> <img src=<?php echo $_SESSION["image"]  ?> width="20"> &nbsp&nbsp       </li>
          <li id="popuploginlist"> <a href="#" id="popuplogin" > Sign in         </a> </li>
          <li id="signup">     <a href="userregister.php" > Signup </a> </li>
          <li id="signout" style="display:none;"> <a href="signout.php"  > Sign out </a> </li>
          <li> <a href="cart.php"> Cart </a> </li>
          <li id="productregister" style="display:none"> <a href="prdoucthandle.php" style="border-right:none">Supplier Manage         </a> </li>
       </ul>
     </nav>   
            
    </div>
    
    <div id="myNav" class="overlay">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <div class="overlay-content">
      <a href="http://localhost/shoppingcard/index.php">Home</a>
      <a href="http://localhost/shoppingcard/productview.php?text=">Product List</a>
         <a href="userdelete.php">Delete Account</a>
        <a href="#">About us</a>
      </div>
    </div>


    <!--Popup window -->
    <div class="popup">
          
      <div class="popup-content">
      <i class="fa fa-close" id="popupclose" style="font-size:20px"></i> 

      <h3 id="errorshow" style="display:none;color:red">Username / password incorrect</h3>
      <form action="_login.php" method="post">
    
       <label style="margin:1px auto" for="username"> Username/Email</label><br>
       <input type="email" placeholder="youremail@mail.com" name="username" required="">
       <br>
       <label for="password"> Password</label><br>
       <input type="password" name="password" required="">
       <br>
       <button type="submit" name="signinbtn" name="Log In"> Log In</button>
       <br>
      </form>
        <small style="margin:auto;color:white">for new user <a href="#" style="text-decoration:none;background-color:#ffffa0">click here</a> for registrations</small>
     </div>
   </div>
   
    <?php
               if(isset($_REQUEST["er"])){
                 if($_REQUEST["er"]=="1"){
                  echo  '<script type="text/javascript">',
                           'errorhandle();',
                         '</script>'
                         ;
                }
            }
            

            if(isset($_SESSION["role"])){
              $imageurl =   $_SESSION["image"]  ;
              $username      =  $_SESSION["displayname"];
              echo  '<script>',  
              'document.getElementById("usericon").style.display = "inline";',                    
                    
                        '</script>'
                        ;
                if($_SESSION["role"]!=1){
                  
                  echo  '<script>',  
                  'document.getElementById("popuploginlist").style.display = "none";',
                          'document.getElementById("signup").style.display = "none";',
                          'document.getElementById("signout").style.display = "inline";',
                            '</script>'
                ;
                }
                else if($_SESSION["role"]==1){
                      echo  '<script>',  
                  'document.getElementById("popuploginlist").style.display = "none";',
                          'document.getElementById("signup").style.display = "inline";',
                          'document.getElementById("signout").style.display = "inline";',
                            '</script>'
                ;
                }
                if($_SESSION["role"]==3){
                  echo  '<script>',  
                           'document.getElementById("signout").style.display = "inline";',
                          'document.getElementById("productregister").style.display = "inline";',
                            '</script>'
                            ;
                }
               
            }
            else{
              echo  '<script>',
              'document.getElementById("popuploginlist").style.display = "inline";',
                          'document.getElementById("signout").style.display = "none";',
                          'document.getElementById("signup").style.display = "inline";',                          
                            '</script>'
                ;
            }

          
   ?>

<!--Delete the cart product  -->
<?php 
      if(isset($_GET["action"])){
        if($_GET["action"]=="delete"){
           foreach($_SESSION["cart"] as $key=>$value){
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$key]);
                    echo "<script>window.alert('product has been deleted');  </script>";
                    echo "<script> window.location='cart.php' ;</script>";
                }
           }
        }
      }

?>

<div class="cartview">  
<table border="1">
    <tr>
        <th>  Product ID </th> <th>  Product Name </th> <th>  Price </th> <th>  Qty </th>  <th>  Remove</th> 
    </tr>
    <?php  
         if(!empty($_SESSION["cart"])){
             $total = 0;
              
             foreach($_SESSION["cart"] as $key => $value){
                 ?>
              
              <tr class="details">
                  <td>  <?php echo $value["product_id"]   ?> </td>
                  <td>  <?php echo $value["productname"]   ?> </td>
                  <td>  <?php echo $value["price"] ?> </td>
                  <td>   <?php echo $value["qty"]   ?>    </td>                  
                  <td> <a href="http://localhost/shoppingcard/cart.php?action=delete&id=<?php echo  $value['product_id'] ?>">x </a> </td>
             </tr>
             <?php  
                $total = $total + intval($value["price"])*intval($value["qty"]);
                $_SESSION["cart"][$key]["total"]=$total;
           ?>
           <tr>
               <td colspan="1">Total </td>
               <th colspan="2" style="text-align:right"> <?php echo number_format($total,2);         ?>   </th>
                <th>
                  <form method="post" action="http://localhost/shoppingcard/_cart.php?key=<?php echo $key; ?>">
                   <button  name="order" > Order </button> 
                </form>
                </th>
              </tr>

         <?php    }
         }
      
    ?>
   
</table>

</div>













































    <footer>     
     <small>@copyright reserved</small>
     <div class="middletext"> 
          <small>conditions applied </small>
          <small>privacy notice </small>
          <small>Interest-Based Ads </small>
     </div>
     <div class="socialmediaicons">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
     </div>
   </footer>
















    <script>


function openNav() {
    document.getElementById("myNav").style.width = "25%";
  }
  
  function closeNav() {
    document.getElementById("myNav").style.width = "0%";
  }

  function closepopuplogin() {
    document.getElementById("myNav").style.width = "0%";
  }

document.getElementById("popuplogin").addEventListener("click",function(){
      document.querySelector(".popup").style.display = "flex";
   });
  
  document.getElementById("popupclose").addEventListener("click",function(){
      document.querySelector(".popup").style.display = "none";
  });
  
  function order_send($key){
    console.log('http://localhost/shoppingcard/checkout.php?key="+$key');
    window.location="http://localhost/shoppingcard/checkout.php?key="+$key;
  }

  </script>


</body>
</html>
