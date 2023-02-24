<?php

include 'layouts/session.php'; 
    error_reporting(E_ALL);

    ini_set('display_errors', 1);
    require_once "layouts/config.php";
if(isset($_POST['ajax']) && $_POST['ajax'] == 'forCategory'){

$catStatus = 'Active';
$timeStart = 5;
$id = trim($_POST['id']);
$CategoriesQuery = "SELECT * FROM categories WHERE `STATUS` = :CatStatus AND CAT_ID = :id";
$CategoriesStmt = $pdo->prepare($CategoriesQuery);
$CategoriesStmt->bindParam(':CatStatus', $catStatus);
$CategoriesStmt->bindParam(':id', $id);
if($CategoriesStmt->execute()){
    $categoryRecord = $CategoriesStmt->fetch();
    echo  '<input type="hidden" name="inRemainingCalculate" class="inRuningCalculate" value="0">
        <input type="hidden" name="newRemainingCalculate" class="newRemainingValue" value="0">';
    for ($i=1; $i <= $categoryRecord['HOURS']; $i++) { 
        
        echo '
            <tr id="'.$i.'">
                <td><input type="hidden" style="width: 110%;margin-right: 1%;" name="time" class="form-control time" value="12">12</td>
                <td><input type="text" style="width: 110%;margin-right: 1%;" name="name" class="form-control name" value=""></td>
                <td>K</td>';
            if($i == 1){                        
                echo '<td class="jCode">
                        <input type="number" style="width: 110%;margin-right: 1%;" class="form-control hJcode jCode" value="" disabled></td>';
            } else {
                echo '<td class="jCode">
                        <input type="number" style="width: 110%;margin-right: 1%;" class="form-control jCode" value=""></td>';
            }
            echo '
                <td><input type="number" name="inQueue" style="width: 110%;margin-right: 1%;" class="form-control inQueue"></td>
                <td><input type="number" name="inProcess" style="width: 110%;margin-right: 1%;" class="form-control inProcess" disabled></td>
                <td class="inRemainingClass">
                <input type="number" name="inRemaining" style="width: 110%;margin-right: 1%;" class="form-control inRemaining" disabled></td>
                <td>10%</td>
                <td><input name="feedbackOne" style="width: 110%;margin-right: 1%;" class="form-control feedbackOne" /></td>
                <td>
                    <input name="feedbackTwo" style="width: 110%;margin-right: 1%;" class="form-control feedbackTwo" />                            
                </td>
            </tr>';
    }
    die;
}
}


if(isset($_GET['for']) && $_GET['for'] == 'emailRecord'){

$condition = array();

$cat_id  = $_POST['cat_id'];
$name = trim($_POST['name']);
$time = trim($_POST['time']);
$jCode = $_POST['jCode'];
$In_Queue = $_POST['In_Queue'];
$In_Running = $_POST['In_Running'];
$In_Remaining  = (int)$_POST['In_Remaining'];
$Feedback_One  = trim($_POST['Feedback_One']);
$Feedback_Two  = trim($_POST['Feedback_Two']);
$user_id = 1;


$insertRecordQuery = "INSERT INTO EmailRecord (`cat_id`, `user_id`, `name`, `time`, `J_CODE`, `In_Queue`, `In_Running`, `In_Remaining`, `Feedback_One`, `Feedback_Two`)
                        VALUES (:cat_id, :userid, :userName, :rowTime, :J_CODE, :In_Queue, :In_Running, :In_Remaining, :Feedback_One, :Feedback_Two)";

$insertRecordStatement = $pdo->prepare($insertRecordQuery);
$insertRecordStatement->bindParam(':cat_id', $cat_id);
$insertRecordStatement->bindParam(':userid', $user_id);
$insertRecordStatement->bindParam(':userName', $name);
$insertRecordStatement->bindParam(':rowTime', $time);
$insertRecordStatement->bindParam(':J_CODE', $jCode);
$insertRecordStatement->bindParam(':In_Queue', $In_Queue);
$insertRecordStatement->bindParam(':In_Running', $In_Running);
$insertRecordStatement->bindParam(':In_Remaining', $In_Remaining);
$insertRecordStatement->bindParam(':Feedback_One', $Feedback_One);
$insertRecordStatement->bindParam(':Feedback_Two', $Feedback_Two);

if($insertRecordStatement->execute()){

    $secondRow = $_POST['id'];
    $secondRow++;

    echo $secondRow;

    // $secondRow = $_POST['id'];
    // $secondRow++;
    
    // $firstRow = $_POST['id'];

    // array_push($condition, ['firstRow' => $firstRow]);
    // array_push($condition, ['secondRow'=>$secondRow]); 
    
    // echo json_encode($condition);
}
die;

}
?>
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>