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

    function GetDirectoryInera($ar_id){
        
        GLOBAL $pdo;
        $directoryValues =  array();
        $articleStatus = 'Active';
        $getDirectoryQuery = "SELECT Articles.ArticleProcessingType AS 'fileType', Journals.JournalCode AS 'journalFile', Articles.ArticleCode AS 'articleFile', Articles.ArticleJMSCode AS 'forAcceptedArticleFile' FROM Articles INNER JOIN Journals ON Articles.JournalID = Journals.JournalID WHERE Articles.ArticleID = :ar_id AND Articles.Status = :articleStatus;";
        $getDirectoryStmt = $pdo->prepare($getDirectoryQuery);
        $getDirectoryStmt->bindParam(':ar_id', $ar_id);
        $getDirectoryStmt->bindParam(':articleStatus', $articleStatus);
        if($getDirectoryStmt->execute()){ 
            $filePathRow = $getDirectoryStmt->fetch();
            $fileName = 'XML-conversion';
            $dir = 'article-archive/'.$filePathRow['fileType'].'-articles/'.$filePathRow['journalFile'].'/'.$filePathRow['articleFile'].'/'.$fileName;
            array_push($directoryValues,['dir'=>$dir, 'fileType'=>$filePathRow['fileType'], 'articleCode'=>$filePathRow['articleFile']]);
            return $directoryValues;
        }    
    
    }

    if(isset($_POST['ajax']) && $_POST['ajax'] == 'forUnAssignArticles') {
                                    
        $getUnAssignRecord = "SELECT Articles.ArticleID, Articles.Date, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `Articles` INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE ArticleID NOT IN (SELECT ArticleID FROM UserAssignedArticles) AND `Status` = 'active';";

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
            echo "Journal: " .  $value['JournalCode'].
                "/Volume: " . $value['ArticleVolume'].
                "/Issue: " . $value['ArticleIssue'].
                "/Year: " . $value['ArticleYear'];
            echo "</td><td>";
            $dt = new DateTime($value['Date']);
            echo $dt->format('Y-m-d');
            echo "</td><td>";
            $now = time();
            $your_date = strtotime($value["Date"]);
            $datediff = $now - $your_date;
            echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
            echo "</td><td>";
            echo 
            '<input type="hidden" value="'.$PSIDxmlconv.'" name="ps_id">
            <input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
            <input type="hidden" value="'.$assignmentTypeId.'" name="ast_id">
            <input type="hidden" value="'.$activeUserId.'" name="user_id">';
            echo '<button id="selfAssignButton" class="btn btn-sm btn-primary selfAssignArticle" >Assign</button>';
            echo "</td></tr>";
        }
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 'forAssignArticles'){

        
        $getAssignRecord = "SELECT Articles.ArticleID, UserAssignedArticles.Date, UserAssignedArticles.UserAssignedArticleID, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `UserAssignedArticles` INNER JOIN Articles ON UserAssignedArticles.ArticleID = Articles.ArticleID INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'Assigned' AND UserAssignedArticles.ProcessingStageID = :PSIDxmlconv;";
        
        $getAssignRecordRun = $pdo->prepare($getAssignRecord);
        
        $getAssignRecordRun->bindParam(':id',$activeUserId);
        $getAssignRecordRun->bindParam(':PSIDxmlconv',$PSIDxmlconv);

        if($getAssignRecordRun->execute()){
            $row = $getAssignRecordRun->fetchAll();

            foreach ($row as $key => $value) {
                echo "<tr><td>";
                echo $key + 1;
                echo "</td><td>";
                echo $value['ArticleTitle'];
                echo "</td><td>";
                echo $value['ArticleCode'];
                echo "</td><td>";
                echo "Journal: " .  $value['JournalCode'].
                    "/Volume: " . $value['ArticleVolume'].
                    "/Issue: " . $value['ArticleIssue'].
                    "/Year: " . $value['ArticleYear'];
                echo "</td><td>";
                $getFiles = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID";
                
                $getAssignRecordRun = $pdo->prepare($getFiles);
                
                $getAssignRecordRun->bindParam(":articleID", $value["ArticleID"]);
                
                if($getAssignRecordRun->execute()){

                    $filesRecord = $getAssignRecordRun->fetchAll();

                    foreach ($filesRecord as $key => $item) {
                        if($item['FileType'] == 'pdf' || $item['FileType'] == 'PDF'){
                            echo '<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >PDF File</a>';
                        }
                        if($item['FileType'] == 'docx' || ($item['FileType'] == 'doc' || $item['FileType'] == 'Word')){
                            echo '&nbsp;&nbsp;<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >Word File</a>';
                        }
                    }
                }
                echo "</td><td>";
                $dt = new DateTime($value['Date']);
                echo $dt->format('Y-m-d');
                echo "</td><td>";
                $now = time(); // or your date as well
                $your_date = strtotime($value["Date"]);
                $datediff = $now - $your_date;
                echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
                echo "</td><td>";
                echo '  <input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
                        <input type="hidden" value="'.$value["UserAssignedArticleID"].'" name="articleAssigned_id">
                        <a href="#" class="btn btn-sm btn-primary acceptArticleFromInera" >Accept</a>
                        &nbsp;&nbsp;
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target=".rejectModal">
                            Reject
                        </button>';
                echo "</td></tr>";
            }
        }
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 'forAcceptedArticles'){

        
        $getAssignRecord = "SELECT Articles.ArticleID, UserAssignedArticles.Date, UserAssignedArticles.UserAssignedArticleID, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `UserAssignedArticles` INNER JOIN Articles ON UserAssignedArticles.ArticleID = Articles.ArticleID INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'InProgress' AND UserAssignedArticles.ProcessingStageID = :PSIDxmlconv;";
        $getAssignRecordRun = $pdo->prepare($getAssignRecord);
        
        $getAssignRecordRun->bindParam(':id',$activeUserId);
        $getAssignRecordRun->bindParam(':PSIDxmlconv',$PSIDxmlconv);

        if($getAssignRecordRun->execute()){
            $row = $getAssignRecordRun->fetchAll();
        }

        foreach ($row as $key => $value) {

            $query = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID AND FileType = 'Inera'";
    
            $checkIneraFileStmt = $pdo->prepare($query);
            
            $article_id = $value['ArticleID'];
            $checkIneraFileStmt->bindParam(':articleID', $article_id);
            $checkIneraFileStmt->execute();
            
            echo "<tr><td>";
            echo $key + 1;
            echo "</td><td>";
            echo $value['ArticleTitle'];
            echo "</td><td>";
            echo $value['ArticleCode'];
            echo "</td><td>";
            echo "Journal: " .  $value['JournalCode'].
                "/Volume: " . $value['ArticleVolume'].
                "/Issue: " . $value['ArticleIssue'].
                "/Year: " . $value['ArticleYear'];
            echo "</td><td>";

            $getFiles = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID";
            
            $getAssignRecordRun = $pdo->prepare($getFiles);

            $getAssignRecordRun->bindParam(":articleID", $value["ArticleID"]);
            
            if($getAssignRecordRun->execute()){

                $filesRecord = $getAssignRecordRun->fetchAll();

                foreach ($filesRecord as $key => $item) {
                    if($item['FileType'] == 'pdf' || $item['FileType'] == 'PDF'){
                        echo '<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >PDF File</a>';
                    }
                    if($item['FileType'] == 'docx' || ($item['FileType'] == 'doc' || $item['FileType'] == 'Word')){
                        echo '&nbsp;&nbsp;<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >Word File</a>';
                    }
                    if($item['FileType'] == 'Inera'){
                        echo '&nbsp;&nbsp;<a href="Download_file.php?file_id='.$item['ArticlesFilesRecordID'].'" class="btn btn-sm btn-primary" >Inera</a>';
                    }
                }
            }
            echo "</td><td>";
            $dt = new DateTime($value['Date']);
            echo $dt->format('Y-m-d');
            echo "</td><td>";
            $now = time(); // or your date as well
            $your_date = strtotime($value["Date"]);
            $datediff = $now - $your_date;
            echo "<span class='text-danger'>" . round($datediff / (60 * 60 * 24)) . "  Days </span>";
            echo "</td><td>";
                    if($checkIneraFileStmt->rowCount() == 1){
                        echo '
                            <input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
                            <a href="#" class="btn btn-sm btn-primary completeFromInera" >Complete</a>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#xml_'.$value["ArticleID"].'">
                            Re Upload XML
                            </button>';
                    }else{
                        echo '<input type="hidden" value="'.$value["ArticleID"].'" name="ar_id">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#xml_'.$value["ArticleID"].'">
                        Upload XML
                        </button>';
                    }
            echo '<div class="modal fade" id="xml_'.$value["ArticleID"].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">'.$value['ArticleTitle'].'</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form enctype="multipart/form-data" method="post" class="ineraFileUpload" name="ineraFileUpload" id="'.$value['ArticleID'].'">
                                <div class="modal-body">
                                    <div class="form-group ">
                                        <label>Upload XML*</label>
                                        <input type="hidden" name="articleId"  class="form-control" value="'.$value['ArticleID'].'">
                                        <input type="file" name="user_inera_file"  id="xml-'.$value['ArticleID'].'"  class="form-control xmlFileUpload" accept="text/xml">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light closeModal" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary inera-file-upload" value="Save" >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>';
            echo "</td></tr>";
        }
    }
    if(isset($_GET['for']) && $_GET['for'] == 'articleComplete'){
        // print_r($_POST);die;
        $articleIdForComplete = trim($_POST['articleId']);
        
        $status = 'Completed';

        $articleCompleteQuery = "UPDATE UserAssignedArticles SET `Status` = :status WHERE ArticleID = :articleID AND ProcessingStageID = :PSIDxmlconv";
        $articleCompleteStmt = $pdo->prepare($articleCompleteQuery);
        $articleCompleteStmt->bindParam(':status', $status);
        $articleCompleteStmt->bindParam(':articleID', $articleIdForComplete);
        $articleCompleteStmt->bindParam(':PSIDxmlconv', $PSIDxmlconv);
        
        if($articleCompleteStmt->execute()){

            $getRecordForValidationStageQuery = "SELECT * FROM UserAssignedArticles WHERE ProcessingStageID = :PSIDxmlvalid AND ArticleID = :articleIdForComplete";
            $getRecordForValidationStageStmt = $pdo->prepare($getRecordForValidationStageQuery);
            $getRecordForValidationStageStmt->bindParam(':PSIDxmlvalid', $PSIDxmlvalid);
            $getRecordForValidationStageStmt->bindParam(':articleIdForComplete', $articleIdForComplete);
            $getRecordForValidationStageStmt->execute();

            if($getRecordForValidationStageStmt->rowCount()){
                $validationStatus = 'InProgress';
                $updateStatusValidateionQuery = "UPDATE UserAssignedArticles SET `Status` = `:validationStatus` WHERE ArticleID = :articleID AND ProcessingStageID = :PSIDxmlvalid";
                $updateStatusValidateionStmt = $pdo->prepare($updateStatusValidateionQuery);
                $updateStatusValidateionStmt->bindParam(':validationStatus', $validationStatus);
                $updateStatusValidateionStmt->bindParam(':articleID', $articleIdForComplete);
                $updateStatusValidateionStmt->bindParam(':PSIDxmlvalid', $PSIDxmlvalid);
                $updateStatusValidateionStmt->execute();
            }
        }
        echo 'completed';
        exit;
    }
    if(isset($_GET['ar_id']) && $_POST['from'] == 'acceptArticleFromInera'){
        
        $status = 'InProgress';

        $ar_id = trim($_POST['ar_id']);
        $getUserAssignedArticleIdQuery = "SELECT UserAssignedArticles.UserAssignedArticleID AS 'UserAssignedArticleId' FROM UserAssignedArticles WHERE ArticleID = :articleID AND UserID = :activeUserId";
            
        $getUserAssignedArticleIdStatement = $pdo->prepare($getUserAssignedArticleIdQuery);
        
        $getUserAssignedArticleIdStatement->bindParam(":articleID", $ar_id);
        $getUserAssignedArticleIdStatement->bindParam(":activeUserId", $activeUserId);
        if($getUserAssignedArticleIdStatement->execute()){
            
            $UserAssignedArticleID = $getUserAssignedArticleIdStatement->fetch();
            $UserAssignedArticleID = $UserAssignedArticleID['UserAssignedArticleId'];
        }

        $sql = 'UPDATE UserAssignedArticles
        SET Status = :status
        WHERE UserID = :id AND ArticleID = :ar_id AND ProcessingStageID = :PSIDxmlconv';

        // prepare statement
        $statement = $pdo->prepare($sql);

        // bind params
        $statement->bindParam(':id', $activeUserId);
        $statement->bindParam(':ar_id', $ar_id);
        $statement->bindParam(':PSIDxmlconv', $PSIDxmlconv);
        $statement->bindParam(':status', $status);

        // execute the UPDATE statment
        if ($statement->execute()) {

            $articleProcessingIndicator = +1;
            $articleProcessingStatus = 'InProgress';

            $insert_query ="INSERT INTO ArticleProcessing(ArticleProcessingIndicator, ArticleProcessingStatus, UserAssignedArticleID)
            VALUES (:articleProcessingIndicator, :articleProcessingStatus, :userAssignedArticleID)";

                    // prepare statement
            $insertStatement = $pdo->prepare($insert_query);

            // bind params
            $insertStatement->bindParam(':articleProcessingIndicator', $articleProcessingIndicator);
            $insertStatement->bindParam(':articleProcessingStatus', $articleProcessingStatus);
            $insertStatement->bindParam(':userAssignedArticleID', $UserAssignedArticleID);
            
            if($insertStatement->execute()){
                $dir = GetDirectoryInera($ar_id);
                $dir = $dir[0]['dir'];
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                    chmod($dir, 0777);
                    // copy('article-archive/published-articles/CMC/CMC-29-42-6335/XML-compilation/CMC-29-42-6335-compilation.xml', $dir.'/test.xml');                        
                }
                exit;
            }
        }

    }
    if(isset($_GET['file']) && ($_GET['file'] == 'uploadxml' && $_POST['for'] == 'userUploadXMLFile')){
        

        $articleId = trim($_POST['articleId']);
        $getFileLocation = GetDirectoryInera($articleId);
        $forInera = 'Inera';
        $getFileIneraQuery = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID AND FileType = :fileType";
        $getFileIneraStmt = $pdo->prepare($getFileIneraQuery);
        $getFileIneraStmt->bindParam(':articleID',$articleId);
        $getFileIneraStmt->bindParam(':fileType',$forInera);
        $getFileIneraStmt->execute();
  
        $userIneraXMLFileName = $_FILES['user_inera_file']['name'];

        $fileTypeIneraTmpName = $_FILES['user_inera_file']['tmp_name'];

        $quantity = 1;
        
        // $xmlFileDirectory = "ArticleFiles/IneraFiles/";
        $xmlFileDirectory = $getFileLocation[0]['dir'].'/';
        $targetXmlFilePath = $xmlFileDirectory . $userIneraXMLFileName;
        
        $fileType = pathinfo($targetXmlFilePath, PATHINFO_EXTENSION);

        if($fileType == 'xml'){
        
            $date = date("dmY");
            
            $filePath = $xmlFileDirectory.$getFileLocation[0]['articleCode'].'-converstion.'.$fileType;

            $fileName = $getFileLocation[0]['articleCode'].'-converstion.'.$fileType;

            if($getFileIneraStmt->rowCount() == 1){
                $row = $getFileIneraStmt->fetch();
                
                if(file_exists($row['FilePath']) == 1) {
                   
                    unlink($row['FilePath']);
                    move_uploaded_file($fileTypeIneraTmpName, $filePath);
                    
                    $updateRecordQuery = "UPDATE ArticlesFilesRecord SET `FileName` =  :fileName, FilePath = :filePath WHERE FileType = :forInera AND ArticleID = :articleId";
 
                    $updateRecordStmt = $pdo->prepare($updateRecordQuery);
                    $updateRecordStmt->bindParam(':fileName', $fileName);
                    $updateRecordStmt->bindParam(':filePath', $filePath);
                    $updateRecordStmt->bindParam(':forInera', $forInera);
                    $updateRecordStmt->bindParam(':articleId', $articleId);
                    $updateRecordStmt->execute();
                    
                    echo 'updated';
                    exit;
                    
                }
                
            }else{

                move_uploaded_file($fileTypeIneraTmpName, $filePath);



                $uploadFileIneraQuery = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, FileName, FilePath, ArticleID)
                VALUES (:fileType, :quantity, :fileName, :filePath , :articleId)";
    
                $statementFileUpload = $pdo->prepare($uploadFileIneraQuery);
    
                $statementFileUpload->bindParam(':fileType',$forInera);
                $statementFileUpload->bindParam(':quantity',$quantity);
                $statementFileUpload->bindParam(':fileName',$fileName);
                $statementFileUpload->bindParam(':filePath',$filePath);
                $statementFileUpload->bindParam(':articleId',$articleId);
                if($statementFileUpload->execute()){
                    echo 'true';
                    exit;
                }
            }
        }else{
            // array_push($fileNotMatch, ['error'=>'Invalid File Type.']);
            echo 'false';
            exit;
        }
    }
    // if(isset($_GET['for']) && $_GET['for'] == 'articleRejection'){
        
    //     $rejectArticleId = $_GET['ar_id'];
    //     $rejectAssignedArticleId = $_GET['UserAssignedArticleID'];

    //     $rejectionUpdateQuery = "";
        
    // }
    if(isset($_POST['for']) && $_GET['widgets'] == 'forWidgets'){
        
        $widgetsResponse = array();
        $query = "SELECT COUNT(ArticleID) AS 'UnAssignedArticles' FROM Articles Where ArticleID NOT IN (SELECT ArticleID FROM UserAssignedArticles) AND Status = 'Active'";
        $stmt = $pdo->prepare($query);
        if($stmt->execute()){ 
        
            $unAssignedArticles = $stmt->fetch(); 
            
        } 
        array_push($widgetsResponse,['unAssignCount' => $unAssignedArticles['UnAssignedArticles']]);
        
        foreach ($_POST['for'] as $key => $value) {

            $status = $value;
            
            $activeUserId = $_SESSION["id"];

            $query = "SELECT COUNT(UserID) AS 'countAssignedArticles' FROM UserAssignedArticles WHERE UserID = :id AND ProcessingStageID = :ProcessingStageID AND Status = :ineraStatus;";
            
            $stmt = $pdo->prepare($query);
            
            $stmt->bindParam(':id',$activeUserId);
            $stmt->bindParam(':ProcessingStageID',$PSIDxmlconv);
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