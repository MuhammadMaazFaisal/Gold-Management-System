

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/head.php'; ?> -->
<?php
include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";


  if(!isset($_SESSION['ASA']))
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

  $system_activity_name= $system_activity_code= $system_activity_description = $added_by="";
  






  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
      
      
      
  
      $system_activity_name = trim($_POST["system_activity_name"]);
      $system_activity_code = trim($_POST["system_activity_code"]);
      $system_activity_description = trim($_POST["system_activity_description"]);

      $added_by= $_SESSION['id'];

      $select_query="SELECT * FROM SystemActivities where SystemActivityName=:psn or SystemActivityCode=:psc"; 
      $select_stmt = $pdo->prepare($select_query);
      $select_stmt->bindParam(":psn",$system_activity_name);
      $select_stmt->bindParam(":psc",$system_activity_code);
      $select_stmt->execute();

      if($select_stmt->rowCount()>0){
        // "stage exist exist" ?>
        <form action="UM_system_activities_add.php" method="post">
          <input hidden type="text" name="msg" value="System Activity Already Exist">
          <input hidden type="submit"  name="submit" id="submitform" >
        </form>
        <script>
        
        $("#submitform").trigger( "click" );
        </script>
     <?php exit();} 

    
     $insert_query ="INSERT INTO SystemActivities (SystemActivityName, SystemActivityCode, SystemActivityDescription,AddedBy)
  
  
     VALUES ( :system_activity_name, :system_activity_code, :system_activity_description,:added_by)";
  
  
    
  
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":system_activity_name", $param_system_activity_name);
          $insert_stmt->bindParam(":system_activity_code", $param_system_activity_code);
          $insert_stmt->bindParam(":system_activity_description", $param_system_activity_description);
          $insert_stmt->bindParam(":added_by", $param_added_by);

  
         $param_system_activity_name= $system_activity_name;
          $param_system_activity_code = $system_activity_code ;
          $param_system_activity_description = $system_activity_description;
          $param_added_by = $added_by;
  
       
      if($insert_stmt->execute())
      {
        header("Location: UM_system_activities.php");
        exit();
      }
         

  
  
  }
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>
