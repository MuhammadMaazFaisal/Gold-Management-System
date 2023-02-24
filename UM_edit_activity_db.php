<?php
     include 'layouts/session.php';

     // Include config file
     require_once "layouts/config.php";
     
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

//   $user_id = $_SESSION['user_id'];
  
//   if(!isset($_SESSION['user_id']))
//   {
//     //User not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }
if(!isset($_SESSION['ERSA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $role_id=$_POST["id"];
    $count = trim($_POST["count"]);
    // $activities_input=$_POST['activities'];
    $activities_input = [];
    for ($x = 1; $x <= $count; $x++) {
      if (isset($_POST["activities$x"])) {
        echo $activities = trim($_POST["activities$x"]);
        array_push($activities_input, $activities);
      }}


$stmt = $pdo->prepare("SELECT SystemActivities.SystemActivityID, SystemActivityName 
FROM SystemActivities INNER JOIN RoleSystemActivities ON SystemActivities.SystemActivityID = RoleSystemActivities.SystemActivityID 
WHERE RoleSystemActivities.RoleID=$role_id ");
$stmt->execute();
$row = $stmt->fetchAll();

   $activity_values=[]; //to store already assigned roles
 foreach ($row as $output)
{ 
                                          
    $activity_values[]= $output['SystemActivityID'];
                            
} 

//Insert Newly added roles

foreach($activities_input as $input_val){
    if(!in_array($input_val, $activity_values)){

        // echo $input_val."insert here";
        $se="SELECT SystemActivityCode From SystemActivities Where SystemActivityID= $input_val";
        $stmtse = $pdo->prepare($se);
        $stmtse->execute();
        $sysactcode=$stmtse->fetch(); 
        $SAcode =$sysactcode['SystemActivityCode'];
        $_SESSION[$SAcode]=$SAcode;

        $ins_stmt = $pdo->prepare("INSERT INTO  RoleSystemActivities (RoleID, SystemActivityID) 
        VALUES (:role_id, :SystemActivityID)");
        $ins_stmt->bindValue(':SystemActivityID', $input_val);
        $ins_stmt->bindValue(':role_id', $role_id);
        $ins_stmt->execute();

    }

}
//Delete assigned roles

foreach($activity_values as $activity_row){

    if(!in_array($activity_row, $activities_input)){
        // echo $role_row."Delete this one";
        // unset($_SESSION['society user']);
        $se="SELECT SystemActivityCode From SystemActivities Where SystemActivityID= $activity_row";
        $stmtse = $pdo->prepare($se);
        $stmtse->execute();
        $sysactcode=$stmtse->fetch(); 
        $SAcode =$sysactcode['SystemActivityCode'];
        if(isset($_SESSION[$SAcode])){
            unset($_SESSION[$SAcode]);

        }
       
        $sql="DELETE FROM RoleSystemActivities WHERE SystemActivityID= $activity_row AND RoleID= $role_id";
  
        $stmt = $pdo->prepare($sql);
    
       $stmt->execute();

    }
    

}
?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/js/app.js"></script>

<?php
 header("Location: UM_roles.php?msg=edit_role_activity");
 exit();

    }
?>
