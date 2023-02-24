<?php

include 'layouts/session.php'; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $PSIDxmlconv=2;
    $assignmentTypeId = 1;
    $PSIDxmlvalid=3;
    $PSIDQA=4;
    $PSIDartpkg=5;
    $PSIDartdl=6;

    $activeUserId = $_SESSION['id'];
    require_once "layouts/config.php";

    if(isset($_POST['ajax']) && $_POST['ajax'] == 'forUnAssignArticles') {
       
                      
        $getUnAssignRecord = "SELECT Articles.ArticleID, Articles.Date, Articles.ArticleTitle, Articles.ArticleCode, 
        Journals.JournalCode, Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear 
        FROM `Articles` INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE
        ArticleID in (SELECT ArticleID as xmlval FROM UserAssignedArticles where ArticleID not in 
        (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > $PSIDxmlconv) 
        AND `Status`='Completed' AND ProcessingStageID= $PSIDxmlconv ) AND `Status`='Active'";

        $getUnAssignRecordRun = $pdo->prepare($getUnAssignRecord);
       

        if($getUnAssignRecordRun->execute()){
            $rowUnAssignedRecord = $getUnAssignRecordRun->fetchAll();
        }

        foreach ($rowUnAssignedRecord as $key => $value) {
            echo "<tr><td>";
            echo $key + 1;
            echo "</td><td>";
            echo $value['ArticleTitle'];
            echo "</td><td>";
            echo $value['ArticleCode'];
            echo "</td><td>";
            echo "Journal: " .  $value['JournalCode']."<br/>".
                "Volume: " . $value['ArticleVolume']."<br/>".
                "Issue: " . $value['ArticleIssue']."<br/>".
                "Year: " . $value['ArticleYear'];
            
            echo "</td><td>";
            
            $dt = new DateTime($value['Date']);
            echo $dt->format('d-m-Y');
            echo "</td><td>";
            $now = time();
            $your_date = strtotime($value["Date"]);
            $datediff = $now - $your_date;
            echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
            echo "</td><td>";
            
            echo 
            '<input type="hidden" value="'.$PSIDxmlvalid.'" name="ps_id">
            <input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
            <input type="hidden" value="'.$assignmentTypeId.'" name="ast_id">
            <input type="hidden" value="'.$activeUserId.'" name="user_id">';
            echo '<button id="selfAssignButton" class="btn btn-sm btn-primary selfAssignArticle">Assign</button>';
            echo "</td></tr>";
        }
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 'forAssignArticles'){

        
        $getAssignRecord = "SELECT Articles.ArticleID, UserAssignedArticles.Date, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `UserAssignedArticles` INNER JOIN Articles ON UserAssignedArticles.ArticleID = Articles.ArticleID INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'Assigned' AND UserAssignedArticles.ProcessingStageID = :PSIDxmlconv;";
        $getAssignRecordRun = $pdo->prepare($getAssignRecord);
        
        $getAssignRecordRun->bindParam(':id',$activeUserId);
        $getAssignRecordRun->bindParam(':PSIDxmlconv',$PSIDxmlvalid);

        if($getAssignRecordRun->execute()){
            $row = $getAssignRecordRun->fetchAll();
        }

        foreach ($row as $key => $value) {
            echo "<tr><td>";
            echo $key + 1;
            echo "</td><td>";
            echo $value['ArticleTitle'];
            echo "</td><td>";
            echo $value['ArticleCode'];
            echo "</td><td>";
            echo "Journals: " .  $value['JournalCode']."<br/>".
                "Volume: " . $value['ArticleVolume']."<br/>".
                "Issue: " . $value['ArticleIssue']."<br/>".
                "Year: " . $value['ArticleYear'];
            echo "</td><td>";
            $getFiles = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID";
            
            $getAssignRecordRun = $pdo->prepare($getFiles);
            
            $getAssignRecordRun->bindParam(":articleID", $value["ArticleID"]);
            
            if($getAssignRecordRun->execute()){

                $filesRecord = $getAssignRecordRun->fetchAll();

                foreach ($filesRecord as $key => $item) {
                    if($item['FileType'] == 'pdf' || $item['FileType'] == 'PDF'){
                        echo '<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >PDF File</a><br>';
                    }
                    if($item['FileType'] == 'docx' || ($item['FileType'] == 'doc' || $item['FileType'] == 'Word')){
                        echo '<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary mt-1" >Word File</a>';
                    }
                }
            }
            echo "</td><td>";            
            $dt = new DateTime($value['Date']);
            echo $dt->format('d-m-Y');
            echo "</td><td>";
            $now = time(); // or your date as well
            $your_date = strtotime($value["Date"]);
            $datediff = $now - $your_date;
            echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
            echo "</td><td>";
            echo 
            '<input type="hidden" value="'.$PSIDxmlvalid.'" name="ps_id">
            <input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
            <input type="hidden" value="'.$assignmentTypeId.'" name="ast_id">
            <input type="hidden" value="'.$activeUserId.'" name="user_id">';
            echo '<button id="selfAcceptArticle" class="btn btn-sm btn-primary selfAcceptArticle" >Accept</button>
                   <a href="#" class="btn btn-sm btn-primary" >Reject</a>  ';
            echo "</td></tr>";
        }
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 'forAcceptArticles'){

        
        $getAcceptRecord = "SELECT Articles.ArticleID, UserAssignedArticles.Date, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `UserAssignedArticles` INNER JOIN Articles ON UserAssignedArticles.ArticleID = Articles.ArticleID INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'InProgress' AND UserAssignedArticles.ProcessingStageID = :PSIDxmlconv;";
        $getAcceptRecordRun = $pdo->prepare($getAcceptRecord);
        
        $getAcceptRecordRun->bindParam(':id',$activeUserId);
        $getAcceptRecordRun->bindParam(':PSIDxmlconv',$PSIDxmlvalid);

        if($getAcceptRecordRun->execute()){
            $row = $getAcceptRecordRun->fetchAll();
        }

        foreach ($row as $key => $value) {
            echo "<tr><td>";
            echo $key + 1;
            echo "</td><td>";
            echo $value['ArticleTitle'];
            echo "</td><td>";
            echo $value['ArticleCode'];
            echo "</td><td>";
            echo "Journals: " .  $value['JournalCode']."<br/>".
                "Volume: " . $value['ArticleVolume']."<br/>".
                "Issue: " . $value['ArticleIssue']."<br/>".
                "Year: " . $value['ArticleYear'];
            echo "</td><td>";
            $getFiles = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID";
            
            $getAssignRecordRun = $pdo->prepare($getFiles);
            
            $getAssignRecordRun->bindParam(":articleID", $value["ArticleID"]);
            
            if($getAssignRecordRun->execute()){

                $filesRecord = $getAssignRecordRun->fetchAll();

                foreach ($filesRecord as $key => $item) {
                    if($item['FileType'] == 'pdf' || $item['FileType'] == 'PDF'){
                        echo '<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >PDF File</a><br>';
                    }
                    if($item['FileType'] == 'docx' || ($item['FileType'] == 'doc' || $item['FileType'] == 'Word')){
                        echo '<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary mt-1" >Word File</a>';
                    }
                    
                }
            }
            echo "</td><td>";      
            foreach($filesRecord as $key => $item){
                if($item['FileType'] == 'XML Converted'){
                    echo '<a href="Article_XML_View.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >XML Converted</a><br>';
                }
                if($item['FileType'] == 'XML Valid'){
                    echo '<a href="Article_XML_View_Edit.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary mt-1" >XML Compilation</a><br>';
                }
            }     
            echo "</td><td>";
            $dt = new DateTime($value['Date']);
            echo $dt->format('d-m-Y');
            echo "</td><td>";
            $now = time(); // or your date as well
            $your_date = strtotime($value["Date"]);
            $datediff = $now - $your_date;
            echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
            echo "</td></tr>";
            echo 
            '<input type="hidden" value="'.$PSIDxmlvalid.'" name="ps_id">
            <input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
            <input type="hidden" value="'.$assignmentTypeId.'" name="ast_id">
            <input type="hidden" value="'.$activeUserId.'" name="user_id">';
           
           
        }
    }
    if(isset($_POST['for']) && $_GET['widgets'] == 'forWidgets'){
        
        $widgetsResponse = array();
        $query = "SELECT Count(ArticleID) as XMLVal FROM UserAssignedArticles where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > 2 )  
        and `Status`='Completed' and ProcessingStageID= 2";
        $stmt = $pdo->prepare($query);
        if($stmt->execute()){ 
        
            $unAssignedArticles = $stmt->fetch(); 
            
        } 
        array_push($widgetsResponse,['unAssignCount' => $unAssignedArticles['XMLVal']]);
        
        foreach ($_POST['for'] as $key => $value) {

            $status = $value;
            
            $activeUserId = $_SESSION["id"];

            $query = "SELECT COUNT(UserID) AS 'countAssignedArticles' FROM UserAssignedArticles WHERE UserID = :id AND ProcessingStageID = :ProcessingStageID AND Status = :ineraStatus;";
            
            $stmt = $pdo->prepare($query);
            
            $stmt->bindParam(':id',$activeUserId);
            $stmt->bindParam(':ProcessingStageID',$PSIDxmlvalid);
            $stmt->bindParam(':ineraStatus',$status);
            
            if($stmt->execute()){ 
                
                $widgetData = $stmt->fetch(); 

                array_push($widgetsResponse,[$value => $widgetData['countAssignedArticles']]);
            }
        }
        
        echo  json_encode($widgetsResponse);
        exit;
    }
?>

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>