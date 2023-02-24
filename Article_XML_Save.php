<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "layouts/config.php";


  
// Define variables and initialize with empty values



$text = $_GET["value"];
echo "text is  ".$text;
die();

// Processing form data when form is submitted
if (isset($_GET['file_Id']))
{    
    $file_sql = "SELECT *
    FROM
        ArticlesFilesRecord
    WHERE
       ArticlesFilesRecordID = :fileId";

    $file_stmt = $pdo->prepare($file_sql);
    $file_stmt->bindParam(":fileId", $_GET['file_Id']);
    $file_result = $file_stmt->execute();
    $file_result = $file_stmt->fetch();


    $fileId = $_GET['file_Id'];
    $fileName = $file_result['FileName'];
    $filePath = $file_result['FilePath'];
    $article_Id = $file_result['ArticleID'];
    $quantity = 1;

    $DestinationFilePath = "ArticleFiles/XMLCompilation/";
    $DestinationFilePathName = "ArticleFiles/XMLCompilation/".$fileName;
    $fileType = pathinfo($DestinationFilePathName, PATHINFO_EXTENSION);

    if(!file_exists($DestinationFilePathName))
    {
       if(copy($filePath, $DestinationFilePathName))
       {
         $insert_sql = "INSERT INTO ArticlesFilesRecord(FileType, Quantity, FileName, FilePath, ArticleID) 
         VALUES (:file_type, :quantity, :nameFile, :filePath, :article_id)";
          $insert_stmt = $pdo->prepare($insert_sql);
          $insert_stmt->bindParam(":file_type", 'XML Valid');
          $insert_stmt->bindParam(":quantity", $quantity);
          $insert_stmt->bindParam(":nameFile", $fileName);
          $insert_stmt->bindParam(":filePath", $DestinationFilePathName);
          $insert_stmt->bindParam(":article_id", $article_Id);
          $insert_stmt->execute();
       }
        
    } 
   
    else
    {  
        
       

           
    
        //     // Note the write permission requested (w)
        //     $file = fopen($filePath, "w") or die("Cannot open file.");
    
        
        //     // Write the data to fhe file with fwrite()
        //     fwrite($file, $text);
        //     fclose($file);
           
        
        // echo "text is  a";
              // define the data to be written to the file
        
      
       
      

    }


    
    // header("Location:Article_XML_View.php?file_id=$fileId");
    // exit();



  
        
    
        
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>