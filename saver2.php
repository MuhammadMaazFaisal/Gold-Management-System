<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
include 'layouts/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);





require_once "layouts/config.php";





// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{    $fileId = $_POST['file_Id'];
        $select_sql = "SELECT * FROM ArticlesFilesRecord WHERE ArticlesFilesRecordID = :fileid";
        



    $filePath = $_POST['path'];
    $destinationFilePath = "ArticleFiles/XMLCompilation/";
    echo "Success";
    die();
   
    
    if (file_exists($filePath)) {        
        /* Store the path of source file */
        $filePath = 'images/test.jpeg';
        
        /* Store the path of destination file */
        $destinationFilePath = 'copyImages/test.jpeg';
        
        /* Copy File from images to copyImages folder */
        if( !copy($filePath, $destinationFilePath) ) {  
            echo "File can't be copied!";  
        }  
        else {  
            echo "File has been copied!";  
        } 





   
 
    header("Location: Journal_view.php");
    exit();
 
     
  
}

?>

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>