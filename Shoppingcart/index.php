<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="styles\index.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="jsfiles\index.js"></script> 
    <title>Home</title>
    <script type="text/javascript">
function useradded(){
    
       
    const div = document.createElement('div');
    div.className= `useradded`;

    div.appendChild(document.createTextNode('New User Added'));
   
    const container = document.querySelector('.slideshow-container');
    const form = document.querySelector('.myslides'); 

    container.insertBefore(div,form);

    setTimeout(function(){
        document.querySelector('.useradded').remove()       
    },5000);
  }
  function error_msg(){
    
       
    const div = document.createElement('div');
    div.className= `usererror`;

    div.appendChild(document.createTextNode('Username/Password worng'));
   
    const container = document.querySelector('.slideshow-container');
    const form = document.querySelector('.myslides'); 

    container.insertBefore(div,form);

    setTimeout(function(){
        document.querySelector('.usererror').remove()       
    },5000);
  }

</script>
</head>
<body>

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
   <form method="GET" style="display:inline;margin-left:10px;">
       <input  type="text" id="searchid" name="searchbar" value="" class="searchcls">    
       <button  type="submit" id="submitbtnid" name="searchbtn" class="searchbtn"><i  class="fa fa-search"></i></button>
    </form>
     <nav>
       <ul> 
          <li style="display:none;" id="usericon">Hello <?php echo  $_SESSION["displayname"] ?> <img src=<?php echo $_SESSION["image"]  ?> width="20"> &nbsp&nbsp       </li>
          <li id="popuploginlist"> <a href="#"  id="popuplogin" > Sign in         </a> </li>
          <li id="signup">  <a href="userregister.php" > Sign up </a> </li>
          <li style="display:none" id="admin">  <a href="userregister.php?user=admin" > Admin </a> </li>
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

   
    <div class="captionbarunder">
      <small style="font-size:16px;">order we will deliver you <i class='fas fa-truck' style='font-size:16px'></i>        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp operating Hours |9.30am - 6.00pm(Mon-Sat) </small>
      
    </div>
   
    
    <div class="slideshow-container">
      <div class="myslides"> 
        <img src="img\slidecom.jpg" >
      </div> 
      <div class="myslides">   
        <img src="img\slidecom1.jpg" >
      </div>   
      <div class="myslides">   
        <img src="img\slidecom2.png" >
        </div> 

    </div>
    

    <!--Popup window loginwindow-->
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
                           'error_msg()',
                         '</script>'
                         ;
                }
            }
            
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
                          'document.getElementById("signup").style.display = "none";',
                          'document.getElementById("admin").style.display = "inline";',
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

    <div class="productintro">
         
      <div class="gallery1">       
         <img src="img\computer.jpg">
         <div class="bottom-left"><a href="comacc1.php" >Computer & Accessories </a></div>
      </div>
      <div class="gallery1">         
         <img src="img\mobile.jpg">
         <div class="bottom-left">Computer & Accessories</div>
      </div>
      <div class="gallery1">
         <img src="img\homeappli.jpg">
         <div class="bottom-left">Computer & Accessories</div>
      </div>



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

var myslide_index=0;

showslides();

function showslides(){

  myslide =  document.getElementsByClassName("myslides");

  for(var i=0 ; i<myslide.length ; i++ ){
     myslide[i].style.display="none";
  }

 myslide_index++;

  if(myslide_index>3){
    myslide_index=1;
  }
myslide[myslide_index-1].style.display="block";
setTimeout(showslides, 2000);
}

document.getElementById("popuplogin").addEventListener("click",function(){
  console.log("ddjhf")
      document.querySelector(".popup").style.display = "flex"
   });
  
  document.getElementById("popupclose").addEventListener("click",function(){
      
      document.querySelector(".popup").style.display = "none"
      window.location="index.php";
  });
  
      </script>


</body>
</html>