<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?php

include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";

  if(!isset($_SESSION['AI']))
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

  $issue= $volume= $year= $date= $journal_id= $addedby="";
  






  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
      
      
      
  
      $issue = trim($_POST["issue"]);
      $volume = trim($_POST["volume"]);
      $date = trim($_POST["date"]);
      $year= trim($_POST["year"]);
      $journal_id= trim($_POST["journal_id"]);
      $added_by= $_SESSION['id'];

 $select_query="SELECT * FROM Issues WHERE Issue=:i_issue and Volume=:i_volume and Journals_JournalID =:i_jid";
 $select_stmt = $pdo->prepare($select_query);
 $select_stmt->bindParam(":i_issue",$issue);
 $select_stmt->bindParam(":i_volume",$volume);
 $select_stmt->bindParam(":i_jid",$journal_id);
 $select_stmt->execute();

 if($select_stmt->rowCount()>0){
   // "journal exist" ?>
   <form action="Issue_add.php" method="post">
     <input hidden type="text" name="msg" value="Issue Already Exist">
     <input hidden type="submit"  name="submit" id="submitform" >
   </form>
   <script>
   
   $("#submitform").trigger( "click" );
   </script>
<?php exit();} 

    
     $insert_query ="INSERT INTO Issues(Issue, Volume, `Year`, `Date`, Journals_JournalID,AddedBy )
  
  
     VALUES ( :issue, :volume, :year, :date, :journal_id,:added_by)";
  
  
    
  
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":issue", $param_issue);
          $insert_stmt->bindParam(":volume", $param_volume);
          $insert_stmt->bindParam(":year", $param_year);
          $insert_stmt->bindParam(":date", $param_date);
          $insert_stmt->bindParam(":journal_id", $param_journal_id);
          $insert_stmt->bindParam(":added_by", $added_by);


          $param_issue= $issue;
          $param_volume = $volume ;
          $param_year = $year;
          $param_date=$date;
          $param_journal_id = $journal_id;

       
      if($insert_stmt->execute())
      {
        header("Location: Issue_view.php");
        exit();
      }
         

    }

?>
<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>