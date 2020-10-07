<?php
session_start();
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="styles\producthandle.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="jsfiles\producthandle.js"></script> 
    <title>Home</title>
</head>
<body>
    <style>
     .operationbtncon{
       position:absolute;
       top:200px;
       right:100px;
       background-color:#1c708f;
       margin:5px;
     }
   table .operationbtncon td{
     width:200px;
     margin:20px;
    

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
       <li style="display:none;" id="usericon">Hello <?php echo  $_SESSION["displayname"] ?> <img src=<?php echo $_SESSION["image"]  ?> width="20"> &nbsp&nbsp       </li> 
       
          <li id="signout" > <a href="signout.php"  > Sign out </a> </li>         
          <li id="productivew" > <a href="supproview.php"  > View Product </a> </li>         
         
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
    <?php
              
            
            if(isset($_REQUEST["id"])){
              
               echo  '<script type="text/javascript">',
                        'useradded();',
                      '</script>'
                      ;
              $imageurl =   $_SESSION["image"]  ;
                $username      =  $_SESSION["displayname"];
             
         }

            if(isset($_SESSION["role"])){

              $imageurl =   $_SESSION["image"]  ;
              $username      =  $_SESSION["displayname"];
              echo  '<script>',  
              'document.getElementById("usericon").style.display = "inline";',                    
                    
                        '</script>'
                        ;
            }

               

          
   ?>
<table class="operationbtncon">
  <tr>
    <td>
   
      <button type="submit" onclick="deleteform()">Delete Product</button>

       <div id="deleteprofromid" style="display:none">

        <form method="post">
           <label>Enter Product Name</label><br>
           <input type="text" name="delproname">
            <br><br>
           <button type="submit" class="delete" name="delete" >Delete </button>
        </form> 

       </div>
       </td>
  </tr>
  <tr>
   
   <td>
   
      <button class="carddetails" type="submit" onclick="cardform()">Update Card</button>

       <div id="carddetailsformid" style="display:none">
    
         <form method="post">
            <label>Enter Card Number</label><br>
            <input type="text" name="cardnum" value="<?php echo $_SESSION['cardnumber']; ?>">
            <br><br>
            <button type="submit" class="updatecard" name="updatecard" >Update card </button>
         </form> 

       </div>
   
  </td>
  </tr>
</table>> 
 
  
<?php
         if(isset($_POST["updatecard"])){
               $sqlcardupdate = "update user set card_number=:cn where username=:un ;";
               $stmt = $conn->prepare($sqlcardupdate);
               $stmt->bindParam(':cn',$_POST["cardnum"]);
               $stmt->bindParam(':un',$_SESSION["username"]);
               $stmt->execute();
         }
?>

  
 
  

  <?php 
     
   if(isset($_POST["delete"])){
      $sqldelete = "Delete from product where supplierid=:supid and name=:proname";
      $stmt = $conn->prepare($sqldelete);
      $stmt->bindParam(':supid',$_SESSION["id"]);
      $stmt->bindParam(':proname',$_POST["delproname"]);
      $stmt->execute();
      header("location:http://localhost/shoppingcard/prdoucthandle.php?msg='deleted'");
   }
  ?>

 <div class="addproductform"> 
  <label>Supplier ID :- <?php echo $_SESSION["id"]  ?> <label>

  <form method="post" enctype="multipart/form-data" action="_producthandle.php" >
      <?php 
        if(isset($_GET["er"])){
          echo "<small class='errormsg'>required fields <small><br><Br>";
        }
      ?>
      <label for="Name">Product Name </label> <br>
      <input type="text" placeholder="sunlight" name="proname" id="proname" required="" value=""><br><br>

      <label for="Qty">Quantity </label><br>
      <input type="number" placeholder="0" name="proqty" id="userqty" required="" value=""><br><br>    

      <label for="role">Price </label><br>
      <input type="text" placeholder="Rs 0.00" name="proprice" id="proprice" required="" value=""><br><br>
          <BR><bR>

      <label> Product Type </label> <br>   
      <select name="type">
          <option value="com&acc">Computer & Accessories</option>
          <option value="mob&gad">Mobile & Gadgets </option>
          <option value="homeapp">Home Appliences </option>
      </select>

        <br><br>
      <label for="drivelink">Image url </label><br>
      <input type="file" name="fileToUpload" id="fileToUpload" multiple > <br><br>
            
     
      <button type="submit" name="addpro" id="addpro"> Add/Update Product </button>
      
      </form>

 </div>





















 
<div class="backtotop">
         <a href="">Back to up</a>
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

  function errorhandle(){ 
      document.getElementById("errorshow").style.display="flex"
    
      document.querySelector(".popup").style.display = "flex";
   
  
  }
document.getElementById("popuplogin").addEventListener("click",function(){
      document.querySelector(".popup").style.display = "flex"
   });
  
  document.getElementById("popupclose").addEventListener("click",function(){
      document.querySelector(".popup").style.display = "none"
  });
  function cardform(){
    document.getElementById("carddetailsformid").style.display="flex"
  }

</script>




</body>
</html>