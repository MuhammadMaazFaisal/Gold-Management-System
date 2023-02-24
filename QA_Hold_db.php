<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php

include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";
  
  // $user_id = $_SESSION['user_id'];
  
  // if(!isset($_SESSION['user_id']))
  // {
  //   //User not logged in. Redirect them back to the login page.
  //   header('Location: login.php');
  //   exit; 
  // }

  $ps_id=$ar_id=$ast_id=$user_id="";
  $user_reassigned_article_status= "Holded";


  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {

      $ps_id = trim($_POST["ps_id"]);
      $ar_id = trim($_POST["ar_id"]);
      $ast_id = trim($_POST["ast_id"]);




  
$update_query = "UPDATE UserAssignedArticles SET  Status = 'Holded' WHERE ArticleID=$ar_id AND ProcessingStageID = $ps_id";
$update_stmt = $pdo->prepare($update_query);
$update_stmt->execute();

       
      if(!isset($_POST['userID']))
      {
        header("Location: QA-Dashboard-User.php");
        exit();
      }
     
         

    }

?>
<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>