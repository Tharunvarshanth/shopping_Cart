<?php 
session_start();
include('db_connect.php');

if(isset($_GET["key"])){
  $index = $_GET["key"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="styles\checkout.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="jsfiles\index.js"> </script> 
    <title>Payment</title>
    <script>
  
    </script>
</head>
<body>
    <style>
    .paymentform{
       
    margin: 50px;
    padding:10px;

    display: flex;
  
}

.paymentform label{
  margin:2px;
  padding:4px;  

}
.paymentform tr td{
  padding:2px;
  margin:2px;
}
.paymentform tr td input {
  width:200px;
  height:30px;

}
.paymentform tr td label {
  width:200px;
  height:30px;
  
}
.paymentform tr td #btn{
  text-align:center;
  align-items:center;
}

    </style>
    
    <div class="captionbar">

     <button class="navverbtn" style="" onclick="openNav()" > <i class="fa fa-bars">Menu</i>  </button>
     <H1 style="display:inline;margin-left:75px;">TMV Shopping</H1>
     <form method="GET" style="display:inline;margin-left:35px;">
       <input  type="text" id="searchid" name="searchbar" value="" class="searchcls">    
       <button  type="submit" id="submitbtnid" name="searchbtn" class="searchbtn"><i  class="fa fa-search"></i></button>
    </form>
     
     <nav>
       <ul> 
       <li > <a href="prdoucthandle.php" id="popuplogin" >Hi <?php echo  $_SESSION["displayname"];  ?>&nbsp&nbsp<img src=<?php echo $_SESSION["image"]  ?> width="20"> </a>       </li>                 
          <li id="signout" > <a href="signout.php"  > Sign out </a> </li>
          <li> <a href="cart.php"> Cart </a> </li>
          <li id="productregister" style="display:none"> <a href="prdoucthandle.php" style="border-right:none">Supplier Manage         </a> </li>
       </ul>
     </nav>   
            
    </div>
    
    <div id="myNav" class="overlay">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <div class="overlay-content">
         <a href="http://localhost/shoppingcard/index.php"> Home</a>
         <a href="http://localhost/shoppingcard/productview.php?text=">Product List</a>
         <a href="userdelete.php">Delete Account</a>
        <a href="#">Contact</a>
      </div>
    </div>


    
    <?php
            
            

            if(isset($_SESSION["role"])){
              $imageurl =   $_SESSION["image"]  ;
              $username      =  $_SESSION["displayname"];
              echo  '<script>',  
              'document.getElementById("usericon").style.display = "inline";',                    
                    'disableinput_box();',
                        '</script>'
                        ;
                        $total_usd=   intval($_SESSION["cart"][$_GET["key"]]["total"])/180 ;
            }
        
          
   ?>




<div class="paymentform"> 
<table>
<form method="post" action="https://sandbox.payhere.lk/pay/checkout" >   
  
    <input type="hidden" name="merchant_id" value="1215483">    <!-- Replace your Merchant ID -->
    <input type="hidden" name="return_url" value="http://sample.com/return">
    <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
    <input type="hidden" name="notify_url" value="http://sample.com/notify">  
    <br><br>
    <tr>
    <th>
    Order Details<br>
    </th>
    <tr>   
      <td> <label>Order ID<label>  </td>
    <td > <input id="inputdisable" type="text" name="order_id" value=<?php echo $_SESSION["cart"][$_GET["key"]]["cart_id"]; ?>>  </td>
      <BR>
      </tr>
      <tr>
     <td>  <label>Product ID<label> </td>
     <td>   <input id="inputdisable" type="text" name="supplier_id" value=<?php echo $_SESSION["cart"][$_GET["key"]]["product_id"];?> ><br>  </td>
      </tr>
      <tr>
      <td> <label>Currency <label> </td>
      <td> <input id="inputdisable" type="text" name="currency" value="LKR"> </td>
      </tr>
    <br>
    <tr>    
     <td> <label>Total Bill<label> </td>
     <td> <input id="inputdisable" type="text" name="amount" value=<?php echo  $_SESSION["cart"][$_GET["key"]]["total"]  ?>  > </td>
     </tr>
   <br>
   <tr>
      <td> <label>Currency <label> </td>
      <td> <input id="inputdisable" type="text" name="currency" value="USD"> </td>
      </tr>
      <br>
    <tr>    
     <td> <label>Total Bill<label> </td>
     <td> <input  id="inputdisable" type="text" name="amount" value=<?php echo $total_usd   ?>  > </td>
     </tr>
   <br>
    <br><br>
    <tr>
     <th> Customer Details  </th><br>
    </tr>
    <tr>
    <td><label>First Name<label> </td>
     <td> <input type="text" name="first_name" value=""><br> </td> <Br>    
    </tr>
    <tr>
     <td> <label>Last Name<label> </td>
    <td>  <input type="text" name="last_name" value=""> </td> <br> 
    </tr>
    <tr>    
     <td> <label>Email<label> </td>
     <td>  <input  id="inputdisable" type="text" name="email" value=<?php echo $_SESSION["username"] ?>><br> </td>
    </tr>
    <tr>
     <td> <label>Phone Number<label> </td>
     <td> <input  type="text" name="phone" value="0771234567"><br> </td>
    </tr> 
    <tr>    
     <td> <label>Delivery Address<label> <td>
     <td>  <input  type="text" name="address" value=""> </td>
    </tr>
    <tr>
     <td> <label>Delivery City<label> </td>
     <td>  <input  type="text" name="city" value="Colombo"> </td>
    </tr>
    <input type="hidden" name="country" value="Sri Lanka"><br><br> 
<tr>
   
    <th>  <label>Payement Details </label> <br><br> </th>
    </tr>
    <tr>   
      <td>   <label> Card Holder Name<label> </td>
      <td> <input  type="text" name="chn" value=""><br> </td>
    </tr>
    <tr>
   <td> <label> card_no - Masked card number<label> </td>
    <td><input type="text" name="chnumber" value=""> </td>
   </tr>
   <Br>
   <tr>
    <td> <label> card_expiry - Card expiry in format MMYY (Ex: 0122)<label> </td>
    <td> <input type="text" name="chdate" value=""> </td>
   </tr>  
   <Br><br>
  <tr> 
    <td id="btn" colspan="2">
    <input type="submit" value="Buy Now" name="buynow">
    </td>
  </tr>   
</form> 

</table>
</div>
<?php


?>
<br><br>
<div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'paypal',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":<?php echo  ($_SESSION["cart"][$_GET["key"]]["total"])  ?>}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name + '!');
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>


<?php 

  if(isset($_POST["buynow"])){
   
    $firstname= $_POST["first_name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $city  = $_POST["city"];
    $country =$_POST["country"];


      $sqlcheckoutupdate="update checkout set firstname=:fn,phonenumber=:pn,address=:add,city=:city,country=:country where cart_id=:cid";
       $stmt = $conn->prepare( $sqlcheckoutupdate);
       $stmt->bindParam(':fn',$firstname);
       $stmt->bindParam(':pn',$phone);
       $stmt->bindParam(':add',$address);
       $stmt->bindParam(':city',$city);
       $stmt->bindParam(':country',$country);
       $stmt->bindParam(':cid', $_SESSION["cart"][$_GET["key"]]["cart_id"]);
         
       $stmt->execute();
 
    }


?>
<script>


 var myNodelist = document.querySelectorAll("#inputdisable");
var i;
for (i = 0; i < myNodelist.length; i++) {
  myNodelist[i].disabled = true;
}

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
  
 

  </script>

</body>
</html>
