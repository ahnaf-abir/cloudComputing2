<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myuserid = mysqli_real_escape_string($db,$_POST['userId']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT userId FROM userInfo WHERE userId = '$myuserid' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);
      
      // If result matched $myuserid and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_userId'] = $myuserid;
         echo "user ".$myuserid." logged-in.";
		 header("Location: index.php");
	  }
	  else
	  {
		  echo "user ".$myuserid." failed to log in.";
	  }  
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
      <?php include("nav.php") ?>
     <div class="container">
       <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <table>
           
            <tr>
               <td>User Id: </td>
               <td><input type = "text" name = "userId" required>
               </td>
            </tr>
           
           <tr>
               <td>Password: </td>
               <td><input type = "password" name = "password" required>
               </td>
            </tr>
           
            
            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit"> 
               </td>
            </tr>
            
         </table>
      </form>
        <p>
              New User? <a href="register.php"> Register here</a>
           </p>
      
       </div>
  </body> 
</html>