<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // first name, user id, password and email sent from registration form 
      
      $myfname = mysqli_real_escape_string($db,$_POST['fName']);
	  $myuserid = mysqli_real_escape_string($db,$_POST['userId']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
	  $myemail = mysqli_real_escape_string($db,$_POST['email']);
      
      $sql = "INSERT INTO userInfo VALUES ('$myfname', '$myuserid', '$mypassword', '$myemail')";
      if (!mysqli_query($db,$sql)) {
		die('Error: ' . mysqli_error($db));
		}
		echo "User: ".$myfname." added";
   }
?>
<!DOCTYPE HTML>  
<html> 
  <head>
      <title>Weather</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body> 
      <?php include("nav.php")?>
    <div class="container">
      <h2>Register</h2>
      
      <p><span class = "error">All fields are required .</span></p>
       
      <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <table>
            <tr>
               <td>Name:</td>
               <td><input type = "text" name = "fName" required>
               </td>
            </tr>
           
            <tr>
               <td>User Id: </td>
               <td><input type = "text" name = "userId" required>
               </td>
            </tr>
           
           <tr>
               <td>Password: </td>
               <td><input type = "password" name = "password"  required>
               </td>
            </tr>
           
            <tr>
               <td>E-mail: </td>
               <td><input type = "text" name = "email" required>
               </td>
            </tr>
             
            <tr>
               <td>Agree</td>
               <td><input type = "checkbox" name = "checked" value = "1" required></td>
               <?php if(!isset($_POST['checked'])){ ?>
               <span class = "error">* <?php echo "You must agree to terms";?></span>
               <?php } ?> 
            </tr>
            
            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit"> 
               </td>
            </tr>
            
         </table>
      </form>
      
         </div>
  </body> 
</html>