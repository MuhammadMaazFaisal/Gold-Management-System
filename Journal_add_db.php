

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/head.php'; ?> -->
<?php
include 'layouts/session.php'; 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
  require_once "layouts/config.php";
  
  if(!isset($_SESSION['AJ']))
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

  $journal_title= $journal_url= $journal_code= $journal_type= $journaltype_code= $issn_online= $issn_print= $aims_scope=$journal_impact_factor=$journal_status="";
  






  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    
      $journal_title = trim($_POST["journal_title"]);
      $journal_url = trim($_POST["journal_url"]);
      $journal_code = trim($_POST["journal_code"]);
      $journal_type= trim($_POST["journal_type"]);
    
      $issn_online= trim($_POST["issn_online"]);
      $issn_print= trim($_POST["issn_print"]);
      $aims_scope= trim($_POST["aims_scope"]);
      $journal_impact_factor= trim($_POST["journal_impact_factor"]);
      $journal_status= trim($_POST["journal_status"]);
      $journal_added_by= $_SESSION['username'];

      $select_query="SELECT * FROM Journals where JournalCode=:j_code or JournalTitle=:j_title"; 
      $select_stmt = $pdo->prepare($select_query);
      $select_stmt->bindParam(":j_code",$journal_code);
      $select_stmt->bindParam(":j_title",$journal_title);
      $select_stmt->execute();

      if($select_stmt->rowCount()>0){
        // "journal exist" ?>
        <form action="Journal_add.php" method="post">
          <input hidden type="text" name="msg" value="Journal Already Exist">
          <input hidden type="submit"  name="submit" id="submitform" >
        </form>
        <script>
        
        $("#submitform").trigger( "click" );
        </script>
     <?php exit();} 

    
     $insert_query ="INSERT INTO Journals(JournalTitle, JournalURL, JournalCode, JournalType, ISSNOnline, ISSNPrint, JournalAimsandScope, JournalAddedBy,JournalImpactFactor,JournalStatus)
  
  
     VALUES ( :journal_title, :journal_url, :journal_code, :journal_type, :issn_online, :issn_print, :aims_scope, :journal_added_by, :journal_impact_factor,:journal_status)";
  
  
    
  
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":journal_title", $param_journal_title);
          $insert_stmt->bindParam(":journal_url", $param_journal_url);
          $insert_stmt->bindParam(":journal_code", $param_journal_code);
          $insert_stmt->bindParam(":journal_type", $param_journal_type);
          $insert_stmt->bindParam(":issn_online", $param_issn_online);
          $insert_stmt->bindParam(":issn_print", $param_issn_print);
          $insert_stmt->bindParam(":aims_scope", $param_aims_scope);
          $insert_stmt->bindParam(":journal_added_by", $journal_added_by);
          $insert_stmt->bindParam(":journal_impact_factor", $journal_impact_factor);
          $insert_stmt->bindParam(":journal_status", $journal_status);
  
           $param_journal_title= $journal_title;
          $param_journal_url = $journal_url ;
          $param_journal_code = $journal_code;
          $param_journal_type=$journal_type;
          $param_issn_online = $issn_online;
          $param_issn_print=$issn_print;
          $param_aims_scope = $aims_scope;
          $param_journal_impact_factor = $journal_impact_factor;
          $param_journal_status = $journal_status;


         
       
      if($insert_stmt->execute())
      {
        $jcode=strtoupper($journal_code);
        //adding file in the directory
        if (!file_exists('article-archive/accepted-articles/'.$jcode)) {
          mkdir('article-archive/accepted-articles/'.$jcode, 0777, true);
          chmod('article-archive/accepted-articles/'.$jcode, 0777);
      }
      if (!file_exists('article-archive/published-articles/'.$jcode)) {
        mkdir('article-archive/published-articles/'.$jcode, 0777, true);
        chmod('article-archive/published-articles/'.$jcode, 0777);
    }
        header("Location: Journal_view.php");
        exit();
      }
         

  
  
  }
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>
