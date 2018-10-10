<?php
   define('DB_SERVER', 'sql12.freemysqlhosting.net');
   define('DB_USERNAME', 'sql12260472');
   define('DB_PASSWORD', 'pQW35HuUVj');
   define('DB_DATABASE', 'sql12260472');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();}
?>