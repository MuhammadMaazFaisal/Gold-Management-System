<?php
include 'layouts/session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "layouts/config.php";

if(!isset($_SESSION['AA']))
{
  //User not logged in. Redirect them back to the error page.
  header('Location: pages-403.php');
  exit; 
}

// $user_id = $_SESSION['user_id'];
// if(!isset($_SESSION['user_id']))
// {
// //User not logged in. Redirect them back to the login page.
// header('Location: login.php');
// exit; 
// }
$article_year=$article_issue=$article_volume= $article_title=$article_jmscode=$article_author= $article_doi=$elocator=
$article_abstract=$first_page=$last_page=$article_type=$article_keyword=$journal_ID=$article_procesing_type=$article_added_by=$article_code='';



if ($_SERVER["REQUEST_METHOD"] == "POST") 

{
    $article_year = trim($_POST["articleyear"]);
    $article_issue = trim($_POST["article-issue"]);
    $article_volume = trim($_POST["article-volume"]);
    $article_title = trim($_POST["article-title"]);
    $article_jmscode = trim($_POST["article-jmscode"]);
    $article_author = trim($_POST["article-author"]);
    $article_doi = trim($_POST["article-doi"]);
    $elocator = trim($_POST["elocator"]);
    $article_abstract = trim($_POST["article-abstract"]);
    $first_page = trim($_POST["first-page"]);
    $last_page = trim($_POST["last-page"]);
    $article_type = trim($_POST["article-type"]);
    $article_keyword = trim($_POST["article-keyword"]);
    $journal_ID = $_POST["journal-name"];
    $article_procesing_type = $_POST["article-procesing-type"];
    $article_added_by = $_SESSION['id'];
    $article_code = $_POST["article-code"];

    $jcode=explode("-",$article_code);
    $targetDir = "article-archive/$article_procesing_type-articles/$jcode[0]/$article_code";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
        chmod($targetDir, 0777);
    }
    $pdfDir = "article-archive/$article_procesing_type-articles/$jcode[0]/$article_code/pdf-file";
    if (!file_exists($pdfDir)) {
        mkdir($pdfDir, 0777, true);
        chmod($pdfDir, 0777);
    }
    $docDir = "article-archive/$article_procesing_type-articles/$jcode[0]/$article_code/word-file";
    if (!file_exists($docDir)) {
        mkdir($docDir, 0777, true);
        chmod($docDir, 0777);
    }

    $pdfFile = $_FILES['pdfFile']['name'];
    $docFile = $_FILES['wordFile']['name'];
    $targetPdfFilePath = $pdfDir . $pdfFile;
    $targetWordFilePath = $docDir . $docFile;
    $pdffileType = pathinfo($targetPdfFilePath, PATHINFO_EXTENSION);
    $wordfileType = pathinfo($targetWordFilePath, PATHINFO_EXTENSION);
    $temp_pdf_name = $_FILES['pdfFile']['tmp_name'];
    $temp_word_name = $_FILES['wordFile']['tmp_name'];

    if ($pdffileType == 'pdf' && ($wordfileType == 'docx' || $wordfileType == 'doc')) 
    {
        $sqls = "SELECT * 
            FROM Articles 
            WHERE ArticleDOI = :article_doi OR ArticleCode = :article_code";
        $stmts = $pdo->prepare($sqls);
        $stmts->bindValue(':article_doi', $article_doi);
        $stmts->bindValue(':article_code', $article_code);
        $stmts->execute();
       //echo $stmts->rowCount();
        if($stmts->rowCount()>0)
        {   
            $Message = "Already Exist";
           header("Location:Article_add.php?Message=".$Message);
           exit();
        } 
        
        // INSERT ARTICLES Query
        $insert_query = "INSERT INTO Articles(ArticleTitle, ArticleAuthors, ArticleCode, ArticleKeywords, ArticleDOI, ArticleType, ArticleLastPage, ArticleFirstPage, Elocator, ArticleIssue, ArticleVolume, ArticleYear, ArticleAbstract, JournalID, AddedBy, ArticleJMSCode, ArticleProcessingType) 
            VALUES (:article_title, :article_author, :article_code, :article_keyword, :article_doi, :article_type, :first_page, :last_page, :elocator, :article_issue, :article_volume, :article_year, :article_abstract, :journal_id, :added_by, :article_jmscode,:article_procesing_type )";

        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->bindParam(":article_title", $article_title);
        $insert_stmt->bindParam(":article_author", $article_author);
        $insert_stmt->bindParam(":article_keyword", $article_keyword);
        $insert_stmt->bindParam(":article_doi", $article_doi);
        $insert_stmt->bindParam(":article_type", $article_type);
        $insert_stmt->bindParam(":last_page", $last_page);
        $insert_stmt->bindParam(":first_page", $first_page);
        $insert_stmt->bindParam(":elocator", $elocator);
        $insert_stmt->bindParam(":article_issue", $article_issue);
        $insert_stmt->bindParam(":article_volume", $article_volume);
        $insert_stmt->bindParam(":article_year", $article_year);
        $insert_stmt->bindParam(":article_abstract", $article_abstract);
        $insert_stmt->bindParam(":journal_id", $journal_ID);
        $insert_stmt->bindParam(":added_by", $article_added_by);
        $insert_stmt->bindParam(":article_code", $article_code);
        $insert_stmt->bindParam(":article_jmscode", $article_jmscode);
        $insert_stmt->bindParam(":article_procesing_type", $article_procesing_type);
        if ($insert_stmt->execute()) 
        {
            $ID = $pdo->lastInsertId();

            // echo $ID;

            // check pdf validation and uploading in pdf folder
            if ($pdffileType == 'pdf') 
            {

                $date = date("dmY");
                $path_pdffilename_ext = $pdfDir . $article_code. $pdffileType;
                //to stor in db
                $pdffile_name = $article_code . $pdffileType;
                $quantity = 1;

                move_uploaded_file($temp_pdf_name, $path_pdffilename_ext);
                $pdf_sql = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, FileName, FilePath, ArticleID) 
                    VALUES (:file_type, :quantity, :nameFile, :filePath, :article_id)";
                $pdf_stmt = $pdo->prepare($pdf_sql);
                $pdf_stmt->bindParam(":file_type", $pdffileType);
                $pdf_stmt->bindParam(":quantity", $quantity);
                $pdf_stmt->bindParam(":nameFile", $pdffile_name);
                $pdf_stmt->bindParam(":filePath", $path_pdffilename_ext);
                $pdf_stmt->bindParam(":article_id", $ID);
                $pdf_stmt->execute();
            }

            if ($wordfileType == 'docx' || $wordfileType == 'doc') 
            {

                $date = date("dmY");
                $path_wordfilename_ext = $docDir . $article_code . $wordfileType;
                //to stor in db
                $wordfile_name = $article_code . $wordfileType;
                $quantity = 1;
                move_uploaded_file($temp_word_name, $path_wordfilename_ext);
                $word_sql = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, FileName, FilePath, ArticleID) 
                    VALUES (:file_type, :quantity, :nameFile, :filePath, :article_id)";
                $word_stmt = $pdo->prepare($word_sql);
                $word_stmt->bindParam(":file_type", $wordfileType);
                $word_stmt->bindParam(":quantity", $quantity);
                $word_stmt->bindParam(":nameFile", $wordfile_name);
                $word_stmt->bindParam(":filePath", $path_wordfilename_ext);
                $word_stmt->bindParam(":article_id", $ID);
                $word_stmt->execute();
            }
            header("Location: Article_view.php");
            exit();
        }
        
                
            
       
    }
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>