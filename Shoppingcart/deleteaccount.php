<?php
include('db_connect.php');
session_start();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="styles\userregister.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <title>Home</title>
    <script type="text/javascript">
function errorhandle_1(){
    console.log("err")
       
    const div = document.createElement('div');
    div.className= `errorbar`;

    div.appendChild(document.createTextNode('User All ready registered'));
   
    const container = document.querySelector('.userregister');
    const form = document.querySelector('#registerform'); 

    container.insertBefore(div,form);

    setTimeout(function(){
        document.querySelector('.errorbar').remove()
       
    },5000);
  }

</script>
</head>
<body>
<style>
 
  .userregister{
    align-items: center;
    position: static;
    background-color:#497283;
    width:50%;
    margin: auto;   
    padding: auto;
    text-align:center;
    border: 2px solid green;    
}



 
  </style>
  <br><br>
<div class="captionbar">

     <button class="navverbtn" style=""onclick="openNav()" > <i class="fa fa-bars">Menu</i>  </button>
     <H1 style="display:inline;margin-left:75px;">TMV Shopping</H1>   
   
     
     <nav>
       <ul>  
          <li  > <a href="">Hello Admin </a>  </li>
          <li> <a href="http://localhost/shoppingcard/index.php" id="signout"> Return Home </a> </li>
         
         
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

    
    <div class="userregister">   

     <img src="uploads\admin.jpg" width="100">
      
      <br><br>
      
      <form  method="post" >
     
       <label for="email"> Email </label> <br>
       <input type="email" placeholder="youremail@mail.com" name="useremail" id="useremail" required="" ><br><br>
     
       <label for="role">Role </label><br>
      
      <select name="role" id="role" onclick="opencard()">     
         <option value=2> customer </option>
         <option value=3> supplier </option> 
      </select>
       <br><br>           
       
        <label> Click button account delete  </label><br>
        <button type="submit" name="delete" id="send"> Delete </button>
      
      </form>

    
   </div>

   <?php
      if(isset($_POST["delete"])){
       if($_POST["role"]==2){  
         $sqldelete_user= "DELETE FROM user WHERE username=:un";
         $stmt = $conn->prepare($sqldelete_user);
         $stmt->bindParam(':un',$_POST["useremail"]);
         $stmt->execute();
       }
       else{
        $sql_get_userid = "select id from user where username=:un";
         $stmt = $conn->prepare($sql_get_userid);
        $stmt->bindParam(':un',$_POST["useremail"]);
        $stmt->execute();

         $id=  $stmt->fetchColumn();


        $sqldelete_user= "DELETE FROM user WHERE username=:un";
        $stmt = $conn->prepare($sqldelete_user);
        $stmt->bindParam(':un',$_POST["useremail"]);
        $stmt->execute();
       
        $sqldelete_user= "DELETE FROM product WHERE supplierid=:supid";
        $stmt = $conn->prepare($sqldelete_user);
        $stmt->bindParam(':supid',$id);
        $stmt->execute();
       
       }
       header('location:http://localhost/shoppingcard/index.php?er=deleted');
    
      }

   ?>

<!-- user already registerd -->


<?php
      if(isset($_GET["er"])){
        if($_GET["er"]==1){
           echo '<script type="text/javascript"> errorhandle_1(); </script>';
                  
                 
        } 
      }
?>






<script  type = "text/javascript">
function opencard(){

   rolevalue= document.getElementById("role").value ;
   console.log(rolevalue)
   if(rolevalue==3){
    document.getElementById("card").style.display="flex";    
   }
   else{
    document.getElementById("card").style.display="none";
   }
  }

  function errorhandle_1(){
    console.log("err")
       
    const div = document.createElement('div');
    div.className= `errorbar`;

    div.appendChild(document.createTextNode('User All ready registered'));
   
    const container = document.querySelector('.userregister');
    const form = document.querySelector('#registerform'); 

    container.insertBefore(div,form);

    setTimeout(function(){
        document.querySelector('.errorbar').remove()
       
    },5000);
  }

function openNav() {
    document.getElementById("myNav").style.width = "25%";
  }
  
  function closeNav() {
    document.getElementById("myNav").style.width = "0%";
  }

  document.getElementById("signout").addEventListener("click",function(){
          <?php 
          session_destroy();
          ?>
          header('location:http://localhost/shoppingcard/index.php');
  })
  document.getElementById("card").style.display="none";
  
  var rolevalue=2;

  
  
</script>




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
</body>
</html>