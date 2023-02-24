<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";


if(!isset($_SESSION['ESA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

// Define variables and initialize with empty values
$date= $name= $gold_issued = "";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
    // $system_activities_name = trim($_POST["system_activities_name"]);
    //   $system_activities_code = trim($_POST["system_activities_code"]);
      $gold_issued = trim($_POST["gold_issued"]);

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
   
 



    $update_query = "UPDATE goldaccount SET gold_issued=:gold_issued  WHERE AccID =$id";






    $update_stmt = $pdo->prepare($update_query);
    // $update_stmt->bindParam(":system_activities_name", $param_system_activities_name);
    //   $update_stmt->bindParam(":system_activities_code", $param_system_activities_code);
      $update_stmt->bindParam(":gold_issued", $gold_issued);

    //   $update_stmt->bindParam(":added_by", $param_added_by);
      


      //  $param_system_activities_name= $system_activities_name;
      // $param_system_activities_code = $system_activities_code ;
      $gold_issued = $gold_issued;
    //   $param_added_by = $added_by;

   
  if($update_stmt->execute())
  {
    header("Location: view_gold_details.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>