

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/head.php'; ?> -->
<?php
include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";

  if(!isset($_SESSION['APS']))
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

  $processing_stage_name= $processing_stage_code= $processing_stage_description = $score_calculation_status = $score_calculation_rationale =$added_by="";
  






  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
      
      
      
  
      $processing_stage_name = trim($_POST["processing_stage_name"]);
      $processing_stage_code = trim($_POST["processing_stage_code"]);
      $processing_stage_description = trim($_POST["processing_stage_description"]);
      $score_calculation_status= trim($_POST["score_calculation_status"]);
      $score_calculation_rationale= trim($_POST["score_calculation_rationale"]);

      $added_by= $_SESSION['id'];

      $select_query="SELECT * FROM ProcessingStages where ProcessingStageName=:psn or ProcessingStageCode=:psc"; 
      $select_stmt = $pdo->prepare($select_query);
      $select_stmt->bindParam(":psn",$processing_stage_name);
      $select_stmt->bindParam(":psc",$processing_stage_code);
      $select_stmt->execute();

      if($select_stmt->rowCount()>0){
        // "stage exist exist" ?>
        <form action="UM_processing-stage_add.php" method="post">
          <input hidden type="text" name="msg" value="Processing Stage Already Exist">
          <input hidden type="submit"  name="submit" id="submitform" >
        </form>
        <script>
        
        $("#submitform").trigger( "click" );
        </script>
     <?php exit();} 

    
     $insert_query ="INSERT INTO ProcessingStages(ProcessingStageName, ProcessingStageCode, ProcessingStageDescription, ScoreCalculationStatus, ScoreCalculationRationale,AddedBy)
  
  
     VALUES ( :processing_stage_name, :processing_stage_code, :processing_stage_description, :score_calculation_status, :score_calculation_rationale,:added_by)";
  
  
    
  
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":processing_stage_name", $param_processing_stage_name);
          $insert_stmt->bindParam(":processing_stage_code", $param_processing_stage_code);
          $insert_stmt->bindParam(":processing_stage_description", $param_processing_stage_description);
          $insert_stmt->bindParam(":score_calculation_status", $param_score_calculation_status);
          $insert_stmt->bindParam(":score_calculation_rationale", $param_score_calculation_rationale);
          $insert_stmt->bindParam(":added_by", $param_added_by);

  
         $param_processing_stage_name= $processing_stage_name;
          $param_processing_stage_code = $processing_stage_code ;
          $param_processing_stage_description = $processing_stage_description;
          $param_score_calculation_status=$score_calculation_status;
          $param_score_calculation_rationale = $score_calculation_rationale;
          $param_added_by = $added_by;
  
       
      if($insert_stmt->execute())
      {
        header("Location: UM_processing-stage.php");
        exit();
      }
         

  
  
  }
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>
