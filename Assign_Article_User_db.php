<?php

include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";
  
  // $user_id = $_SESSION['user_id'];
  
  if(!isset($_SESSION['id']))
  {
    //User not logged in. Redirect them back to the login page.
    header('Location: auth-login.php');
    exit; 
  }
 // Super Admin
  $ps_id=$ar_id=$ast_id=$user_id=$added_by= "";


  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
      $ps_id = trim($_POST["ps_id"]);
      $ar_id = trim($_POST["ar_id"]);
      $ast_id = trim($_POST["ast_id"]);
      $user_id= trim($_POST["user_id"]);

    //   $added_by= $_SESSION['id'];

//  $select_query="SELECT * FROM Issues WHERE Issue=:i_issue and Volume=:i_volume and Journals_JournalID =:i_jid";
//  $select_stmt = $pdo->prepare($select_query);
//  $select_stmt->bindParam(":i_issue",$issue);
//  $select_stmt->bindParam(":i_volume",$volume);
//  $select_stmt->bindParam(":i_jid",$journal_id);
//  $select_stmt->execute();

//  if($select_stmt->rowCount()>0){
   // "journal exist" ?>
   <!-- <form action="Issue_add.php" method="post">
     <input hidden type="text" name="msg" value="Issue Already Exist">
     <input hidden type="submit"  name="submit" id="submitform" >
   </form>
   <script>
   
   $("#submitform").trigger( "click" );
   </script> -->
<?php 
//exit();

    
      $insert_query ="INSERT INTO UserAssignedArticles(UserID, ProcessingStageID, ArticleID ,AssignmentTypeID  )
        VALUES (:user_id, :ps_id, :ar_id, :ast_id)";  
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":ps_id", $param_ps_id);
        $insert_stmt->bindParam(":ar_id", $param_ar_id);
        $insert_stmt->bindParam(":ast_id", $param_ast_id);
        $insert_stmt->bindParam(":user_id", $param_user_id);

        $param_ps_id= $ps_id;
        $param_ar_id = $ar_id ;
        $param_ast_id = $ast_id;
        $param_user_id=$user_id;
        $insert_stmt->execute();
        
       
      if(!isset($_POST['userID']))
      {
        header("Location: QA-Dashboard-User.php");
        exit();
      }
      else{
        if(!isset($_GET['ajax']) && $ps_id == 2) 
        {
          header("Location: Inera-user-dashboard.php");
          exit();
        }else if($ps_id == 3){
          header("Location: Xml-valid-user-dashboard.php");
          exit();
        }
        else if($ps_id == 1){
          header("Location: Assign-Dashboard-Article.php");
          exit();
        }else if(isset($_GET['ajax']) && $_GET['ajax'] == 'assignSection'){
          exit;
        }
      }
     
         

    }

?>
<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>