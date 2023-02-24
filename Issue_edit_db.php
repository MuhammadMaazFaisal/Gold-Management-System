<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";

if(!isset($_SESSION['EI']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}
  
// Define variables and initialize with empty values

$issue= $volume= $year= $date= $journal_id= $addedby="";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
    $issue = trim($_POST["issue"]);
    $volume = trim($_POST["volume"]);
    $year = trim($_POST["year"]);
    $date= trim($_POST["date"]);
    $journal_id= trim($_POST["journal_id"]);
   $addedby= $_SESSION['id'];
   
 $select_query="SELECT * FROM Issues WHERE Issue=:i_issue and Volume=:i_volume and Journals_JournalID =:i_jid and IssueID != '$id'";
 $select_stmt = $pdo->prepare($select_query);
 $select_stmt->bindParam(":i_issue",$issue);
 $select_stmt->bindParam(":i_volume",$volume);
 $select_stmt->bindParam(":i_jid",$journal_id);
 $select_stmt->execute();

if($select_stmt->rowCount()>0){

   // issue exist
    ?>
   <form action="Issue_edit.php?id=<?php echo $id; ?>" method="post">
     <input hidden type="text" name="msg" value="Issue Already Exist">
     <input hidden type="submit"  name="submit" id="submitform" >
   </form>
   <script>
   
   $("#submitform").trigger( "click" );
   </script>
<?php exit();
} 


    $update_query = "UPDATE Issues SET Issue= :issue, Volume= :volume, Year= :year, Date= :date, Journals_JournalID = :journal_id
     WHERE IssueID=$id";






    $update_stmt = $pdo->prepare($update_query);
    $update_stmt->bindParam(":issue", $param_issue);
      $update_stmt->bindParam(":volume", $param_volume);
      $update_stmt->bindParam(":year", $param_year);
      $update_stmt->bindParam(":date", $param_date);
      $update_stmt->bindParam(":journal_id", $param_journal_id);



       $param_issue= $issue;
      $param_volume = $volume ;
      $param_year = $year;
      $param_date=$date;
      $param_journal_id = $journal_id;


   
  if($update_stmt->execute())
  {
    header("Location: Issue_view.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>