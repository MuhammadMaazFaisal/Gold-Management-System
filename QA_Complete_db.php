<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

// if(!isset($_SESSION['EI']))
// {
//   //User not logged in. Redirect them back to the error page.
//   header('Location: pages-403.php');
//   exit; 
// }
  
// Define variables and initialize with empty values

$ps_id=$ar_id=$ast_id=$user_id=$user_assigned_article_id= "";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
  $ps_id = trim($_POST["ps_id"]);
  $ar_id = trim($_POST["ar_id"]);
  $ast_id = trim($_POST["ast_id"]);
 $user_assigned_article_id =  trim($_POST["user_assigned_article_id"]);


   


$update_query = "UPDATE UserAssignedArticles SET  Status = 'Completed' WHERE ArticleID =$ar_id AND ProcessingStageID=$ps_id ";
$update_stmt = $pdo->prepare($update_query);
$update_stmt->execute();


   
  if($update_stmt->execute())
  {
    header("Location: QA-Dashboard-User.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>