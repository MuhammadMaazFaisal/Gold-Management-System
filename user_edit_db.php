<?php
   include 'layouts/session.php';

   // Include config file
   require_once "layouts/config.php";
   
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  
//   include 'include/db/db_connect.php';
  
//   $user_id = $_SESSION['user_id'];
  
//   if(!isset($_SESSION['user_id']))
//   {
//     //User not logged in. Redirect them back to the login page.
//     header('Location: login.php');
//     exit; 
//   }

if(!isset($_SESSION['EU']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $user_id=$_POST["id"];
    $roles_input=$_POST['roles'];


$stmt = $pdo->prepare("SELECT Roles.RoleID, RoleName 
FROM Roles INNER JOIN UserRoles ON Roles.RoleID = UserRoles.RoleID WHERE UserRoles.UserID = $user_id");
$stmt->execute();
$row = $stmt->fetchAll();

   $role_values=[]; //to store already assigned roles
 foreach ($row as $output)
{ 
                                          
    $role_values[]= $output['RoleID'];

                           
                            
} 

//Insert Newly added roles

foreach($roles_input as $input_val){
    if(!in_array($input_val, $role_values)){

        // echo $input_val."insert here";
        $ins_stmt = $pdo->prepare("INSERT INTO  UserRoles (RoleID, UserID) 
        VALUES (:role_id, :user_id)");
        $ins_stmt->bindValue(':role_id', $input_val);
        $ins_stmt->bindValue(':user_id', $user_id);
        $ins_stmt->execute();


    }


}
//Delete assigned roles

foreach($role_values as $role_row){
    if(!in_array($role_row, $roles_input)){
        echo $role_row."Delete this one";

        $sql="DELETE FROM UserRoles WHERE RoleID= $role_row AND UserID= $user_id";
  
        $stmt = $pdo->prepare($sql);
    
       $stmt->execute();


    }

}

header("Location: UM_users.php");
exit();



    }
         


                


        




?>