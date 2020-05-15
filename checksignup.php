<?php


require_once('./config/dbconfig.php');
 
     $userErr =$passwordErr=$msg="" ;
      $username= $password="";


     if (isset($_POST['register'])) {
 

  if (empty($_POST["username"])) {
    $usErr = "Name is required";
  } else {
    $username = test_inpu(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $usErr = "Only letters and white space allowed";
    }
  }
  

    

  if (empty($_POST["password"])) {
    $passErr = "password is required";
  } else {
    $password =test_inpu(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
   
  }



 $stmt = $db->connection->prepare('SELECT * FROM utilisateur WHERE username= ? ');
    $stmt->execute(array($username));
     $rows = $stmt->rowCount();


    if($rows > 0)
    {
        echo $msg= "is already exist";
        
    }


  $stmt = $db->connection->prepare('INSERT INTO utilisateur (username, password) VALUES (?, ?)');
    $stmt->execute(array($username,$password));
    $rows = $stmt->rowCount();

 if($row){

      echo $msg= "sigup is success";
          }


   }








function test_inpu($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}






?>