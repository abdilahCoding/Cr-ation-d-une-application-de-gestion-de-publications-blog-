<?php

    require_once('./config/dbconfig.php');
    session_start();
 

     $userErr =$passwordErr=$ms="" ;
      $username= $password="" ;

     if (isset($_POST['login'])) {
     


  if (empty($_POST["username"])) {
    $userErr = "Name is required";
  } else {
    $username = test_input(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $userErr = "Only letters and white space allowed";
    }
  }
  

  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

   
  }
  $stmt = $db->connection->prepare("SELECT * FROM utilisateur WHERE username = ? AND password = ? ");
    $stmt->execute(array($username, $password));
    $row = $stmt->fetch();
    $rows = $stmt->rowCount();



      if ($rows > 0 ) {
      	$id = $row['user_id'];
        $_SESSION['id'] = $id;
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit();

      }else{

      	$ms = "is not found";
        
      }
  




   }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}





















?>