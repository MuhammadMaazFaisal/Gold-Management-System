<?php

include 'layouts/session.php'; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";


    if(isset($_GET['from']) && $_GET['from'] == 'stepTwo'){
		
		$dirpro = 'external-work-directory/images';
        $imageNamepo = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
		
        $stepTwoCode = trim($_POST['stepTwoCode']);
        $stepTwoName = trim($_POST['name']);
        $stepTwoDifference = $_POST['difference'];
        $poWas = $_POST['poWas'];
        $psEmail = $_POST['psEmail'];
        $stepTwoDate = $_POST['date'];
		$details = $_POST['detail'];
		$polisherbarcode = $_POST['polisherbarcode'];
		$fileWithNamepo = $dirpro. $imageNamepo;
		
		$fileType = pathinfo($fileWithNamepo, PATHINFO_EXTENSION);

        if (!file_exists($dirpro)) {
            mkdir($dirpro, 0777, true);
            chmod($dirpro, 0777);
            // copy('article-archive/published-articles/CMC/CMC-29-42-6335/XML-compilation/CMC-29-42-6335-compilation.xml', $dir.'/test.xml');                        
        } 

        $time = time();

        $poliName = $dirpro.'/'.$time.'-'.$imageNamepo;

       $stepTwoQry = "INSERT INTO polisher_step(`code`, `image`, `name`, `difference`, `Wastage`, `Payable`, `date`,`details`,`polisherbarcode`)
        VALUES (:stepTwoCode,:imageNamepo, :stepTwoName, :stepTwoDifference, :poWas, :psEmail, :stepTwoDate, :details, :polisherbarcode);";
		
		

        $stepTwoStatement = $pdo->prepare($stepTwoQry);

        $stepTwoStatement->bindParam(':stepTwoCode', $stepTwoCode);
        $stepTwoStatement->bindParam(':stepTwoName', $stepTwoName);
        $stepTwoStatement->bindParam(':stepTwoDifference', $stepTwoDifference);
        $stepTwoStatement->bindParam(':poWas', $poWas);
        $stepTwoStatement->bindParam(':psEmail', $psEmail);
        $stepTwoStatement->bindParam(':stepTwoDate', $stepTwoDate);
		$stepTwoStatement->bindParam(':details', $details);
		$stepTwoStatement->bindParam(':imageNamepo', $poliName);
		$stepTwoStatement->bindParam(':polisherbarcode', $polisherbarcode);
		

		
		
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
		$additionalbarcode = $_POST['additionalbarcode'];
		
        
       $stepadditional = "INSERT INTO additional_step(`date`, `name`, `type`, `amount`,`additionalbarcode`)
        VALUES (:date,:name, :type, :amount, :additionalbarcode);";
        $stepadditionalStatement = $pdo->prepare($stepadditional);

        $stepadditionalStatement->bindParam(':date', $date);
        $stepadditionalStatement->bindParam(':name', $name);
        $stepadditionalStatement->bindParam(':type', $type);
        $stepadditionalStatement->bindParam(':amount', $amount);
		$stepadditionalStatement->bindParam(':additionalbarcode', $additionalbarcode);
        
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
		$goldbarcode = $_POST['goldbarcode'];
        
       $stepgoldaccount = "INSERT INTO gold_accont_step(`date`, `name`, `detail`, `gold_Issued_weight`,`purity`,`pure_weight_issued`,`goldbarcode`)
        VALUES (:date,:name, :detail, :gold_Issued_weight,:purity,:pure_weight_issued,:goldbarcode);";
        $stepgoldaccountStatement = $pdo->prepare($stepgoldaccount);

        $stepgoldaccountStatement->bindParam(':date', $date);
        $stepgoldaccountStatement->bindParam(':name', $name);
        $stepgoldaccountStatement->bindParam(':detail', $detail);
        $stepgoldaccountStatement->bindParam(':gold_Issued_weight', $gold_Issued_weight);
		$stepgoldaccountStatement->bindParam(':purity', $purity);
		$stepgoldaccountStatement->bindParam(':pure_weight_issued', $pure_weight_issued);
		$stepgoldaccountStatement->bindParam(':goldbarcode', $goldbarcode);
        
        if($stepgoldaccountStatement->execute()){
            
            header('Location: production_page.php');
        }
    }
	
	
	
	
	
	
?>
<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>