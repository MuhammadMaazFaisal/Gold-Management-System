<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

if(!isset($_SESSION['DJ']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

// $user_id = $_SESSION['user_id'];

// if(!isset($_SESSION['user_id']))
// {
//   //User not logged in. Redirect them back to the login page.
//   header('Location: login.php');
//   exit; 
// }






  $id= trim($_POST["id"]);

  
      $sql="DELETE FROM Journals WHERE JournalID= $id";
  
      $stmt = $pdo->prepare($sql);
  
      if($stmt->execute())
      {
        header("Location: Journal_view.php");
        exit();
      }
         
  
  






?>
              




  
