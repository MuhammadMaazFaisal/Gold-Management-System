<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";


if(!isset($_SESSION['EPS']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  

// Define variables and initialize with empty values
// $processing_stage_name= $processing_stage_code=
 $processing_stage_description = $score_calculation_status = $score_calculation_rationale ="";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
    // $processing_stage_name = trim($_POST["processing_stage_name"]);
    //   $processing_stage_code = trim($_POST["processing_stage_code"]);
      $processing_stage_description = trim($_POST["processing_stage_description"]);
      $score_calculation_status= trim($_POST["score_calculation_status"]);
      $score_calculation_rationale= trim($_POST["score_calculation_rationale"]);
    $added_by= $_SESSION['id'];

    // $select_query="SELECT * FROM Journals where JournalCode=:j_code or JournalTitle=:j_title"; 
    // $select_stmt = $pdo->prepare($select_query);
    // $select_stmt->bindParam(":j_code",$journal_code);
    // $select_stmt->bindParam(":j_title",$journal_title);
    // $select_stmt->execute();

    // if($select_stmt->rowCount()>0){
      // "journal exist" ?>
      <!-- <form action="Journal_add.php" method="post">
        <input hidden type="text" name="msg" value="Journal Already Exist">
        <input hidden type="submit"  name="submit" id="submitform" >
      </form>
      <script>
      
      $("#submitform").trigger( "click" );
      </script> -->
   <?php //exit(); //} 
   
 



    $update_query = "UPDATE ProcessingStages SET  ProcessingStageDescription=:processing_stage_description, ScoreCalculationStatus=:score_calculation_status, ScoreCalculationRationale=:score_calculation_rationale
     WHERE ProcessingStageID=$id";






    $update_stmt = $pdo->prepare($update_query);
    // $update_stmt->bindParam(":processing_stage_name", $param_processing_stage_name);
    //   $update_stmt->bindParam(":processing_stage_code", $param_processing_stage_code);
      $update_stmt->bindParam(":processing_stage_description", $param_processing_stage_description);
      $update_stmt->bindParam(":score_calculation_status", $param_score_calculation_status);
      $update_stmt->bindParam(":score_calculation_rationale", $param_score_calculation_rationale);
    //   $update_stmt->bindParam(":added_by", $param_added_by);
      


      //  $param_processing_stage_name= $processing_stage_name;
      // $param_processing_stage_code = $processing_stage_code ;
      $param_processing_stage_description = $processing_stage_description;
      $param_score_calculation_status=$score_calculation_status;
      $param_score_calculation_rationale = $score_calculation_rationale;
    //   $param_added_by = $added_by;

   
  if($update_stmt->execute())
  {
    header("Location: UM_processing-stage.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>