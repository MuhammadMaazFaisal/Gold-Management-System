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

 $name=  $details= $difference= $Wastage= $Payable= $code ="";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{     $id= trim($_POST["id"]);
  
		$code = trim($_POST["code"]);
        $name= trim($_POST["name"]); 
        $details= trim($_POST["details"]);
		$difference= trim($_POST["difference"]);
		$Payable= trim($_POST["Payable"]);
		$Wastage= trim($_POST["Wastage"]);
		$added_by= $_SESSION['id'];

    

    // if($select_stmt->rowCount()>0){
      // "journal exist" ?>
      
   <?php //exit(); //} 
   
 



    $update_query = "UPDATE polisher_step SET code=:code, name=:name, details=:details, difference=:difference, Payable=:Payable, Wastage =:Wastage WHERE id =$id";



    $update_stmt = $pdo->prepare($update_query);
    
      $update_stmt->bindParam(":code", $code);
		$update_stmt->bindParam(":name", $name);
		$update_stmt->bindParam(":details", $details);
		$update_stmt->bindParam(":difference", $difference);
		$update_stmt->bindParam(":Payable", $Payable);
		$update_stmt->bindParam(":Wastage", $Wastage);
		

    
      //$gold_received = $gold_received;
    //   $param_added_by = $added_by;

   
  if($update_stmt->execute())
  {
    header("Location: view_manufecturing.php");
    exit();
  }
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>