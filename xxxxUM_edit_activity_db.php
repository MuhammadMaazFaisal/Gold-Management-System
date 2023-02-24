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
    $activities_input=$_POST['activities'];


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

header("Location: UM_roles.php");
exit();

    }
?>