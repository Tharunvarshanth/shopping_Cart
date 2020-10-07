<?php 
session_start();
include('db_connect.php');


     if(isset($_POST["addtocart"])){

       if(isset($_SESSION["cart"])){
              $item_array_id = array_column($_SESSION["cart"],"product_id");
              if(!in_array($_GET["proid"],$item_array_id))
              {
                $count= count($_SESSION["cart"]);
                $item_array =array(
                  'product_id'=>$_GET["proid"],
                  'sup_id' =>$_POST["supplierid"],
                  'productname'=>$_POST["productname"],
                  'qty'   => $_POST["size"],
                  'price'  =>$_POST["price"]
              ); 
              $_SESSION["cart"][$count] =$item_array;
              echo '<script> window.location="productview.php?text=" </script>';

              }
              else{
                echo '<script> window.alert("This item already added to cart"); </script>';
                echo '<script> window.location="productview.php?text=" </script>';
              }
       }
       else{
         $item_array =array(
             'product_id'=>$_GET["proid"],
             'sup_id' =>$_POST["supplierid"],
             'productname'=>$_POST["productname"],
             'qty'   => $_POST["size"],
             'price'  =>$_POST["price"]
         ); 
         $_SESSION["cart"][0] =$item_array;

       }

     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="styles\productview.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="jsfiles\index.js"></script> 
    <title>Home</title>
</head>
<body>
    <style>
    table .view label{
font-weight: bold;
}
table tr {
  width:100%;
 display:flex;
 flex-direction:row;
 justify-content:space-between; 
 
}
table tr td{ 
  margin:10px;
  padding:5px;
  color:white;
}
table tr td .add_to_cart{
  background-color:#006699;
  color:white;
  font-weight: bold;
  padding:5px;

}

    </style>
     <?php
  
  if(isset($_GET["searchbtn"])){
     
   $search_text = $_GET["searchbar"];

   if(empty($search_text)){
     header('Location:http://localhost/shoppingcard/productview.php?text=');
   }
   else{
     header('Location:http://localhost/shoppingcard/productview.php?text='.$search_text);
   }
  }

?>
    
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
        <a href="#">Contact</a>
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

<!--GETTING PRODUCT DETAILS FROM DATABASE   -->

<div class="shoppingcartlist">
   <H2 style="text-align:center">Shopping Cart</H2><Br><Br>
   
   <table>
              
              
<?php 

 $sqlgetproductlist="select * from product where name LIKE '".trim($_GET["text"])."%' ;"  ;

     if(strlen($_GET["text"])==""){
      $sqlgetproductlist="select * from product  ;" ;
    }
  
           $stmt= $conn->prepare($sqlgetproductlist);
           $stmt->execute();
       
           if($stmt->rowCount()>0) {
             
             while($row = $stmt->fetch(PDO::FETCH_ASSOC)){  
                 
                ?>             
                            
                  <form method="post" action="productview.php?text=&proid=<?php echo $row['id'] ?> ">
                  <tr >
                    <td>   
                       <img  src="<?php echo $row['imageurl'] ?>" width=150>     
                    </td>  
                    <td>    
                       <label  style="font-weight: bold;" for="productname"><?php echo $row['name'] ?></label>                   
                       <input  type="hidden" name="productname" value="<?php echo $row['name'] ?>" > 
                      </td> 
                       <td>   
                      <label  >Stock : <?php echo '<label> '.$row["quantity"].' </label>' ?>  </label> <br>
                      </td> 
                      <td>   
                      <label >Quantity </label>
                      <input  style="width:30px;height:15px;" type="number" name="size" min=0 max=<?php echo $row['quantity'] ?>  value=0>
                      </td> 
                      <td>   
                      <label >Price :<?php echo '<label style="font-weight: bold;"> '.$row["price"].' </label>' ?> </label>
                      <input type="hidden" name="price" value="<?php echo $row['price'] ?>" >
                      </td> 
                      <td>                        
                      <input  type="hidden" name="supplierid" value="<?php echo $row['supplierid'] ?>" >
                      </td> 
                      <td>                          
                      <button type="submit" class="add_to_cart" style="height:30px;" name="addtocart">Add-To-Cart</button>                     
                    </td>
              
                  </tr>
         
                 </form>
            
     <?php     
       }

           }
        

?>

</table>
</div>



    <script>



document.getElementById("popuplogin").addEventListener("click",function(){
      document.querySelector(".popup").style.display = "flex"
   });
  
  document.getElementById("popupclose").addEventListener("click",function(){
      document.querySelector(".popup").style.display = "none"
  });


      </script>


</body>
</html>