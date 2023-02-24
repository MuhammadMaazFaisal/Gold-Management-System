<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!isset($_SESSION['EJ']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}



require_once "layouts/config.php";


// Define variables and initialize with empty values
// $journal_title= $journal_code=
$journal_url=  $journal_type= $journaltype_code= $issn_online= $issn_print= $aims_scope=$journal_impact_factor=$journal_status="";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
    // $journal_title = trim($_POST["journal_title"]);
    $journal_url = trim($_POST["journal_url"]);
    // $journal_code = trim($_POST["journal_code"]);
    $journal_type= trim($_POST["journal_type"]);
    $issn_online= trim($_POST["issn_online"]);
    $issn_print= trim($_POST["issn_print"]);
    $aims_scope= trim($_POST["aims_scope"]);
    $journal_impact_factor= trim($_POST["journal_impact_factor"]);
    $journal_status= trim($_POST["journal_status"]);
    $journal_added_by= $_SESSION['username'];

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
   
 



    $update_query = "UPDATE Journals SET JournalType=:journal_type, ISSNOnline=:issn_online, ISSNPrint=:issn_print, JournalURL=:journal_url, JournalAimsandScope=:aims_scope , JournalImpactFactor=:journal_impact_factor, JournalStatus = :journal_status
     WHERE JournalID=$id";






    $update_stmt = $pdo->prepare($update_query);
    // $update_stmt->bindParam(":journal_title", $param_journal_title);
      $update_stmt->bindParam(":journal_url", $param_journal_url);
      // $update_stmt->bindParam(":journal_code", $param_journal_code);
      $update_stmt->bindParam(":journal_type", $param_journal_type);
      $update_stmt->bindParam(":issn_online", $param_issn_online);
      $update_stmt->bindParam(":issn_print", $param_issn_print);
      $update_stmt->bindParam(":aims_scope", $param_aims_scope);
      $update_stmt->bindParam(":journal_impact_factor", $param_journal_impact_factor);
      $update_stmt->bindParam(":journal_status", $param_journal_status);
      


      //  $param_journal_title= $journal_title;
      $param_journal_url = $journal_url ;
      // $param_journal_code = $journal_code;
      $param_journal_type=$journal_type;
      $param_issn_online = $issn_online;
      $param_issn_print=$issn_print;
      $param_aims_scope = $aims_scope;
      $param_journal_status=$journal_status;
      $param_journal_impact_factor=$journal_impact_factor;
   
  if($update_stmt->execute())
  {
    header("Location: Journal_view.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>