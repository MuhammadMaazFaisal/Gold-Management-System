<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// if(!isset($_SESSION['EJ']))
// {
//   //User not logged in. Redirect them back to the error page.
//   header('Location: pages-403.php');
//   exit; 
// }



require_once "layouts/config.php";


// Define variables and initialize with empty values

// $status="";



// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
 
    // $status= trim($_POST["status"]);


     ?>
      
   <?php  
   
 



    $update_query = "UPDATE Articles SET  Status = 'Archive' WHERE ArticleID =$id";






    $update_stmt = $pdo->prepare($update_query);

    //   $update_stmt->bindParam(":journal_status", $param_journal_status);
      


    //   //  $param_journal_title= $journal_title;
    //   $param_journal_url = $journal_url ;
    //   // $param_journal_code = $journal_code;
    //   $param_journal_type=$journal_type;
    //   $param_issn_online = $issn_online;
    //   $param_issn_print=$issn_print;
    //   $param_aims_scope = $aims_scope;
    //   $param_journal_status=$journal_status;
    //   $param_journal_impact_factor=$journal_impact_factor;
   
  if($update_stmt->execute())
  {
    header("Location: Assign-Dashboard-Article.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>