<?php     
 //database connection
//phpinfo();exit();
      $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $dbname = 'cims_erp';
      
      $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
      session_start();
?>