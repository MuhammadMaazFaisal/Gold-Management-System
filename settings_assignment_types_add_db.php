

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/head.php'; ?> -->
<?php
include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";

  if (!isset($_SESSION['AAT'])) {
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

  $assignment_type_name= $assignment_type_code= $added_by="";
  






  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
      
      
      
  
      $assignment_type_name = trim($_POST["assignment_type_name"]);
      $assignment_type_code = trim($_POST["assignment_type_code"]);


      $added_by= $_SESSION['id'];

      $select_query="SELECT * FROM AssignmentTypes where AssignmentTypeName=:atn and AssignmentTypeCode=:atc"; 
      $select_stmt = $pdo->prepare($select_query);
      $select_stmt->bindParam(":atn",$assignment_type_name);
      $select_stmt->bindParam(":atc",$assignment_type_code);
      $select_stmt->execute();

      if($select_stmt->rowCount()>0){
        // "stage exist exist" ?>
        <form action="settings_assignment_types_add.php" method="post">
          <input hidden type="text" name="msg" value="Assignment Type Already Exist">
          <input hidden type="submit"  name="submit" id="submitform" >
        </form>
        <script>
        
        $("#submitform").trigger( "click" );
        </script>
     <?php exit();} 

    
     $insert_query ="INSERT INTO AssignmentTypes(AssignmentTypeName, AssignmentTypeCode,AddedBy)
  
  
     VALUES ( :assignment_type_name, :assignment_type_code, :added_by)";
  
  
    
  
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":assignment_type_name", $param_assignment_type_name);
          $insert_stmt->bindParam(":assignment_type_code", $param_assignment_type_code);
          $insert_stmt->bindParam(":added_by", $param_added_by);

  
         $param_assignment_type_name= $assignment_type_name;
          $param_assignment_type_code = $assignment_type_code ;
          $param_added_by = $added_by;
  
       
      if($insert_stmt->execute())
      {
        header("Location: settings_assignment_types_view.php");
        exit();
      }
         

  
  
  }
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>
