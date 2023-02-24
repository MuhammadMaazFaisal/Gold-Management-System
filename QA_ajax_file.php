<?php

include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
$PSIDxmlconv = 2;
$assignmentTypeId = 1;
$PSIDxmlvalid = 3;
$PSIDQA = 4;
$PSIDartpkg = 5;
$PSIDartdl = 6;
$activeUserId = $_SESSION['id'];
include 'layouts/head-main.php';
require_once "layouts/config.php";

if (isset($_POST['ajax']) && $_POST['ajax'] == 'forUnAssignArticles') {

    $getUnAssignRecord = "SELECT Articles.ArticleID, Articles.Date, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, 
        Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `Articles` 
        INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE ArticleID 
        in(SELECT ArticleID as artpkg FROM UserAssignedArticles 
        where ArticleID not in (Select ArticleID from `UserAssignedArticles` where ProcessingStageID > '$PSIDxmlvalid' ) 
        and `Status`='Completed' and ProcessingStageID= '$PSIDxmlvalid' ) AND `Status` = 'active';";

    $getUnAssignRecordRun = $pdo->prepare($getUnAssignRecord);

    if ($getUnAssignRecordRun->execute()) {
        $rowUnAssignedRecord = $getUnAssignRecordRun->fetchAll();
    }

    foreach ($rowUnAssignedRecord as $key => $value) {
?>
        <tr>
            <td>
                <?php echo $key + 1;
                echo "</td><td>";
                echo $value['ArticleTitle'];
                echo "</td><td>";
                echo $value['ArticleCode'];
                echo "</td><td>";
                echo "Journal: " .  $value['JournalCode'] .
                    "<br>Volume: " . $value['ArticleVolume'] .
                    "<br>Issue: " . $value['ArticleIssue'] .
                    "<br>Year: " . $value['ArticleYear'];
                echo "</td><td>";

                // fetch pdf files
                $pdf_sql = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'pdf' or FileType = 'PDF'))";
                $pdf_stmt = $pdo->prepare($pdf_sql);
                $pdf_stmt->bindParam(":articleID", $value["ArticleID"]);
                $pdf_result = $pdf_stmt->execute();
                $pdf_result = $pdf_stmt->fetch();

                // fetch docx files
                $wordFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND (FileType = 'docx' or FileType = 'doc' or FileType = 'Word'))";
                $word_stmt = $pdo->prepare($wordFile);
                $word_stmt->bindParam(":articleID", $value["ArticleID"]);
                $word_result = $word_stmt->execute();
                $word_result = $word_stmt->fetch();

                // fetch XML Converted files
                $ineraFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
  (FileType = 'Inera' or FileType = 'XML Converted'))";
                $inera_stmt = $pdo->prepare($ineraFile);
                $inera_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                $inera_result = $inera_stmt->execute();
                $inera_result = $inera_stmt->fetch();

                // fetch XML Valid
                $validFile = "SELECT * FROM ArticlesFilesRecord WHERE (ArticleID = :articleID AND 
  (FileType = 'XML Valid' ))";
                $valid_stmt = $pdo->prepare($validFile);
                $valid_stmt->bindParam(":articleID", $row_xmlc["ArticleID"]);
                $valid_result = $valid_stmt->execute();
                $valid_result = $valid_stmt->fetch();
                ?>
                <a href="Download_file.php?file_id=<?php echo $pdf_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary">PDF File</a>
                <br><a href="Download_file.php?file_id=<?php echo $word_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Word File</a>
                <br><a href="Download_file.php?file_id=<?php echo $inera_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">Inera File</a>
                <br><a href="Download_file.php?file_id=<?php echo $valid_result['ArticlesFilesRecordID'] ?>" class="btn btn-sm btn-primary mt-1">XML Valid File</a>
                <?php
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
                '<input type="hidden" value="' . $PSIDQA . '" name="ps_id">
            <input type="hidden" value="' . $value["ArticleID"] . '" name="ar_id">
            <input type="hidden" value="' . $assignmentTypeId . '" name="ast_id">
            <input type="hidden" value="' . $activeUserId . '" name="user_id">';
                echo '<button id="selfAssignButton" class="btn btn-sm btn-primary selfAssignArticle" >Assign</button>';
                ?>
            </td>
        </tr>
<?php

    }
}
if (isset($_POST['ajax2']) && $_POST['ajax2'] == 'forAssignArticles') {


    $getAssignRecord = "SELECT Articles.ArticleID, UserAssignedArticles.Date, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, 
        Articles.ArticleIssue, Articles.ArticleVolume, Articles.ArticleYear FROM `UserAssignedArticles` 
        INNER JOIN Articles ON UserAssignedArticles.ArticleID = Articles.ArticleID 
        INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE UserAssignedArticles.UserID = :id 
        AND UserAssignedArticles.Status = 'Assigned' AND UserAssignedArticles.ProcessingStageID = :PSIDQA;";
    $getAssignRecordRun = $pdo->prepare($getAssignRecord);

    $getAssignRecordRun->bindParam(':id', $activeUserId);
    $getAssignRecordRun->bindParam(':PSIDQA', $PSIDQA);

    if ($getAssignRecordRun->execute()) {
        $row = $getAssignRecordRun->fetchAll();
    }

    foreach ($row as $key => $value) {
      ?>  <tr>
            <td>
                <?php echo $key + 1;
                echo "</td><td>";
                echo $value['ArticleTitle'];
                echo "</td><td>";
                echo $value['ArticleCode'];
                echo "</td><td>";
                echo "Journal: " .  $value['JournalCode'] .
                    "<br>Volume: " . $value['ArticleVolume'] .
                    "<br>Issue: " . $value['ArticleIssue'] .
                    "<br>Year: " . $value['ArticleYear'];
                echo "</td><td>";
        $getFiles = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID";

        $getAssignRecordRun = $pdo->prepare($getFiles);

        $getAssignRecordRun->bindParam(":articleID", $value["ArticleID"]);

        if ($getAssignRecordRun->execute()) {

            $filesRecord = $getAssignRecordRun->fetchAll();

            foreach ($filesRecord as $key => $item) {
                if ($item['FileType'] == 'pdf' || $item['FileType'] == 'PDF') {
                    echo '<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >PDF File</a>';
                }
                if ($item['FileType'] == 'docx' || ($item['FileType'] == 'doc' || $item['FileType'] == 'Word')) {
                    echo '&nbsp;&nbsp;<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >Word File</a>';
                }
                if ($item['FileType'] == 'Inera' || ( $item['FileType'] == 'XML Converted')) {
                    echo '&nbsp;&nbsp;<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >Inera File</a>';
                }
                if ($item['FileType'] == 'xml' || $item['FileType'] == 'XML Valid') {
                    echo '&nbsp;&nbsp;<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >XML Valid File</a>';
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
        echo '  <input type="hidden" value="' . $value["ArticleID"] . '" name="ar_id">
                    <a href="#" class="btn btn-sm btn-primary acceptArticleFromQA" >Accept</a>
                    &nbsp;&nbsp;<a href="#" class="btn btn-sm btn-primary" >Reject</a>  ';
                    ?>
                    </td>
                </tr>
        <?php
        
    }
}
if (isset($_POST['ajax3']) && $_POST['ajax3'] == 'forAcceptedArticles') {


    $getAssignRecord = "SELECT Articles.ArticleID, UserAssignedArticles.Date, Articles.ArticleTitle, Articles.ArticleCode, Journals.JournalCode, Articles.ArticleIssue, 
    Articles.ArticleVolume, Articles.ArticleYear FROM `UserAssignedArticles` INNER JOIN Articles ON UserAssignedArticles.ArticleID = Articles.ArticleID 
    INNER JOIN Journals ON Journals.JournalID = Articles.JournalID WHERE UserAssignedArticles.UserID = :id AND UserAssignedArticles.Status = 'InProgress' 
    AND UserAssignedArticles.ProcessingStageID = :PSIDQA;";
    $getAssignRecordRun = $pdo->prepare($getAssignRecord);

    $getAssignRecordRun->bindParam(':id', $activeUserId);
    $getAssignRecordRun->bindParam(':PSIDQA', $PSIDQA);

    if ($getAssignRecordRun->execute()) {
        $row = $getAssignRecordRun->fetchAll();
    }

    foreach ($row as $key => $value) {
        ?>  <tr>
        <td>
            <?php echo $key + 1;
            echo "</td><td>";
            echo $value['ArticleTitle'];
            echo "</td><td>";
            echo $value['ArticleCode'];
            echo "</td><td>";
            echo "Journal: " .  $value['JournalCode'] .
                "<br>Volume: " . $value['ArticleVolume'] .
                "<br>Issue: " . $value['ArticleIssue'] .
                "<br>Year: " . $value['ArticleYear'];
            echo "</td><td>";
        $getFiles = "SELECT * FROM ArticlesFilesRecord WHERE ArticleID = :articleID";

        $getAssignRecordRun = $pdo->prepare($getFiles);

        $getAssignRecordRun->bindParam(":articleID", $value["ArticleID"]);

        if ($getAssignRecordRun->execute()) {

            $filesRecord = $getAssignRecordRun->fetchAll();

            foreach ($filesRecord as $key => $item) {
                if ($item['FileType'] == 'pdf' || $item['FileType'] == 'PDF') {
                    echo '<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >PDF File</a>';
                }
                if ($item['FileType'] == 'docx' || ($item['FileType'] == 'doc' || $item['FileType'] == 'Word')) {
                    echo '&nbsp;&nbsp;<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >Word File</a>';
                }
                if ($item['FileType'] == 'Inera' || ( $item['FileType'] == 'XML Converted')) {
                    echo '&nbsp;&nbsp;<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >Inera File</a>';
                }
                if ($item['FileType'] == 'xml' || $item['FileType'] == 'XML Valid') {
                    echo '&nbsp;&nbsp;<a href="Download_file.php?file_id=' . $item['ArticlesFilesRecordID'] . '" class="btn btn-sm btn-primary" >XML Valid File</a>';
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
        echo '  <input type="hidden" value="' . $value["ArticleID"] . '" name="ar_id">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#xml_' . $value["ArticleID"] . '">
                    Upload XML
                    </button>
                    &nbsp;&nbsp;<a href="#" class="btn btn-sm btn-primary" >Complete</a>  ';
                    ?>
                    </td>
                </tr>
        <?php
        echo '<div class="modal fade" id="xml_' . $value["ArticleID"] . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>I will not close if you click outside me. Dont even try to press escape key.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                    </div>
                </div>
            </div>';
    }
}
if (isset($_GET['ar_id']) && $_POST['from'] == 'acceptArticleFromQA') {

    $status = 'InProgress';

    $ar_id = trim($_POST['ar_id']);

    $getUserAssignedArticleIdQuery = "SELECT UserAssignedArticles.UserAssignedArticleID AS 'UserAssignedArticleId' FROM UserAssignedArticles WHERE ArticleID = :articleID 
    AND UserID = :activeUserId";

    $getUserAssignedArticleIdStatement = $pdo->prepare($getUserAssignedArticleIdQuery);

    $getUserAssignedArticleIdStatement->bindParam(":articleID", $ar_id);
    $getUserAssignedArticleIdStatement->bindParam(":activeUserId", $activeUserId);
    if ($getUserAssignedArticleIdStatement->execute()) {

        $UserAssignedArticleID = $getUserAssignedArticleIdStatement->fetch();
        $UserAssignedArticleID = $UserAssignedArticleID['UserAssignedArticleId'];
    }

    $sql = 'UPDATE UserAssignedArticles
        SET Status = :status
        WHERE UserID = :id AND ArticleID = :ar_id AND ProcessingStageID = :PSIDQA';

    // prepare statement
    $statement = $pdo->prepare($sql);

    // bind params
    $statement->bindParam(':id', $activeUserId);
    $statement->bindParam(':ar_id', $ar_id);
    $statement->bindParam(':PSIDQA', $PSIDQA);
    $statement->bindParam(':status', $status);

    // execute the UPDATE statment
    if ($statement->execute()) {

        $articleProcessingIndicator = +1;
        $articleProcessingStatus = 'InProgress';

        $insert_query = "INSERT INTO ArticleProcessing(ArticleProcessingIndicator, ArticleProcessingStatus, UserAssignedArticleID)
            VALUES (:articleProcessingIndicator, :articleProcessingStatus, :userAssignedArticleID)";

        // prepare statement
        $insertStatement = $pdo->prepare($insert_query);

        // bind params
        $insertStatement->bindParam(':articleProcessingIndicator', $articleProcessingIndicator);
        $insertStatement->bindParam(':articleProcessingStatus', $articleProcessingStatus);
        $insertStatement->bindParam(':userAssignedArticleID', $UserAssignedArticleID);

        if ($insertStatement->execute()) {
            exit;
        }
    }
}
if (isset($_POST['for']) && $_GET['widgets'] == 'forWidgets') {

    $widgetsResponse = array();
    $query = "SELECT COUNT(ArticleID) AS 'UnAssignedArticles' FROM Articles Where ArticleID NOT IN (SELECT ArticleID FROM UserAssignedArticles) AND Status = 'Active'";
    $stmt = $pdo->prepare($query);
    if ($stmt->execute()) {

        $unAssignedArticles = $stmt->fetch();
    }
    array_push($widgetsResponse, ['unAssignCount' => $unAssignedArticles['UnAssignedArticles']]);

    foreach ($_POST['for'] as $key => $value) {

        $status = $value;

        $activeUserId = $_SESSION["id"];

        $query = "SELECT COUNT(UserID) AS 'countAssignedArticles' FROM UserAssignedArticles WHERE UserID = :id AND ProcessingStageID = :ProcessingStageID AND Status = :ineraStatus;";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':id', $activeUserId);
        $stmt->bindParam(':ProcessingStageID', $PSIDQA);
        $stmt->bindParam(':ineraStatus', $status);

        if ($stmt->execute()) {

            $widgetData = $stmt->fetch();

            array_push($widgetsResponse, [$value => $widgetData['countAssignedArticles']]);
        }
    }

    echo  json_encode($widgetsResponse);
    exit;
}
?>