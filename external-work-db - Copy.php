<?php

include 'layouts/session.php'; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    if(isset($_GET['from']) && $_GET['from'] == 'stepOne'){

        $dir = 'external-work-directory/images';
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $name = trim($_POST['name']);
        $code = $_POST['code'];
        $type = $_POST['type'];
        $quantity = $_POST['quantity'];
        $purity = trim($_POST['purity']);
        $unpolish_weight = trim($_POST['unpolish_weight']);
        $polish_weight = trim($_POST['polish_weight']);
        $rate = trim($_POST['rate']);
        $wastage = trim($_POST['wastage']);
        $tValues = trim($_POST['tValues']);
        $date = $_POST['date'];
		$details = $_POST['details'];
        $fileWithName = $dir. $imageName;

        $fileType = pathinfo($fileWithName, PATHINFO_EXTENSION);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
            // copy('article-archive/published-articles/CMC/CMC-29-42-6335/XML-compilation/CMC-29-42-6335-compilation.xml', $dir.'/test.xml');                        
        } 

        $time = time();

        $pName = $dir.'/'.$time.'-'.$imageName;

        $qry = "INSERT INTO manufacturing_step(`name`, `image`, `code`, `type`, `quantity`, `purity`, `unpolish_weight`, `polish_weight`, `rate`, `wastage`, `tValues`, `date`, `details`)
        VALUES (:userName, :imageName, :code, :fType, :quantity, :pValue, :unpolish_weight, :polish_weight, :rate, :wastage, :tValues, :fDate, :details);";

       
		
		$qryStatement = $pdo->prepare($qry);


        $qryStatement->bindParam(':userName', $name);
        $qryStatement->bindParam(':imageName', $pName);
        $qryStatement->bindParam(':code', $code);
        $qryStatement->bindParam(':fType', $type);
        $qryStatement->bindParam(':quantity', $quantity);
        $qryStatement->bindParam(':pValue', $purity);
        $qryStatement->bindParam(':unpolish_weight', $unpolish_weight);
        $qryStatement->bindParam(':polish_weight', $polish_weight);
        $qryStatement->bindParam(':rate', $rate);
        $qryStatement->bindParam(':wastage', $wastage);
        $qryStatement->bindParam(':tValues', $tValues);
        $qryStatement->bindParam(':fDate', $date);
		$qryStatement->bindParam(':details', $details);


        move_uploaded_file($imageTmpName, $pName);


        if($qryStatement->execute()){
            
            header('Location: production_page.php');
        }
    }











    if(isset($_GET['from']) && $_GET['from'] == 'stepTwo'){
		
		$dir = 'external-work-directory/images';
        $imageNamepo = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
		
        $stepTwoCode = trim($_POST['stepTwoCode']);
        $stepTwoName = trim($_POST['name']);
        $stepTwoDifference = $_POST['difference'];
        $poWas = $_POST['poWas'];
        $psEmail = $_POST['psEmail'];
        $stepTwoDate = $_POST['date'];
		$details = $_POST['detail'];
		$fileWithNamepo = $dir. $imageNamepo;
		
		$fileType = pathinfo($fileWithNamepo, PATHINFO_EXTENSION);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
            chmod($dir, 0777);
            // copy('article-archive/published-articles/CMC/CMC-29-42-6335/XML-compilation/CMC-29-42-6335-compilation.xml', $dir.'/test.xml');                        
        } 

        $time = time();

        $poliName = $dir.'/'.$time.'-'.$imageNamepo;

       $stepTwoQry = "INSERT INTO polisher_step(`code`, `image`, `name`, `difference`, `Wastage`, `Payable`, `date`,`details`)
        VALUES (:stepTwoCode,:imageNamepo, :stepTwoName, :stepTwoDifference, :poWas, :psEmail, :stepTwoDate, :details);";
		
		

        $stepTwoStatement = $pdo->prepare($stepTwoQry);

        $stepTwoStatement->bindParam(':stepTwoCode', $stepTwoCode);
        $stepTwoStatement->bindParam(':stepTwoName', $stepTwoName);
        $stepTwoStatement->bindParam(':stepTwoDifference', $stepTwoDifference);
        $stepTwoStatement->bindParam(':poWas', $poWas);
        $stepTwoStatement->bindParam(':psEmail', $psEmail);
        $stepTwoStatement->bindParam(':stepTwoDate', $stepTwoDate);
		$stepTwoStatement->bindParam(':details', $details);
		$stepTwoStatement->bindParam(':imageNamepo', $poliName);

		
		
		move_uploaded_file($imageTmpName, $poliName);
		
        if($stepTwoStatement->execute()){
            
            header('Location: production_page.php');
        }
    }





























    
    if(isset($_GET['ajax']) && $_GET['ajax'] = 'getData'){
        
        $code = $_POST['code'];
        $record = array();

        $getRecordQuery = "SELECT * FROM `manufacturing_step` WHERE `status` = 'Active' AND `code` = :code";
        $getRecordStatement = $pdo->prepare($getRecordQuery);
        $getRecordStatement->bindParam(':code', $code);
        if($getRecordStatement->execute()){
            $row = $getRecordStatement->fetch();
            array_push($record, ['name'=>$row['name'],'unpolish_weight'=>$row['unpolish_weight'],'polish_weight'=>$row['polish_weight']]);
            echo json_encode($record, true);
            die;
        }
        
    }
	
	if(isset($_GET['from']) && $_GET['from'] == 'additional'){
		$date = trim($_POST['date']);
        $name = trim($_POST['name']);
        $type = $_POST['type'];
        $amount = $_POST['amount'];
		
        
       $stepadditional = "INSERT INTO additional_step(`date`, `name`, `type`, `amount`)
        VALUES (:date,:name, :type, :amount);";
        $stepadditionalStatement = $pdo->prepare($stepadditional);

        $stepadditionalStatement->bindParam(':date', $date);
        $stepadditionalStatement->bindParam(':name', $name);
        $stepadditionalStatement->bindParam(':type', $type);
        $stepadditionalStatement->bindParam(':amount', $amount);
        
        if($stepadditionalStatement->execute()){
            
            header('Location: production_page.php');
        }
    }
	
	if(isset($_GET['from']) && $_GET['from'] == 'goldaccount'){
		$date = trim($_POST['date']);
        $name = trim($_POST['name']);
        $detail = $_POST['detail'];
        $gold_Issued_weight = $_POST['gold_Issued_weight'];
		$purity = $_POST['purity'];
		$pure_weight_issued = $_POST['pure_weight_issued'];
        
       $stepgoldaccount = "INSERT INTO gold_accont_step(`date`, `name`, `detail`, `gold_Issued_weight`,`purity`,`pure_weight_issued`)
        VALUES (:date,:name, :detail, :gold_Issued_weight,:purity,:pure_weight_issued);";
        $stepgoldaccountStatement = $pdo->prepare($stepgoldaccount);

        $stepgoldaccountStatement->bindParam(':date', $date);
        $stepgoldaccountStatement->bindParam(':name', $name);
        $stepgoldaccountStatement->bindParam(':detail', $detail);
        $stepgoldaccountStatement->bindParam(':gold_Issued_weight', $gold_Issued_weight);
		$stepgoldaccountStatement->bindParam(':purity', $purity);
		$stepgoldaccountStatement->bindParam(':pure_weight_issued', $pure_weight_issued);
		
        
        if($stepgoldaccountStatement->execute()){
            
            header('Location: production_page.php');
        }
    }
	
	
	
	
	
	
?>
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>