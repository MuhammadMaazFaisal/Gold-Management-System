<?php

if ($_POST['function'] == 'GetAllVendorData') {
    GetAllVendorData();
} elseif ($_POST['function'] == 'VendorCount') {
    VendorCount();
} elseif ($_POST['function'] == 'AddVendor') {
    AddVendor();
} elseif ($_POST['function'] == 'VendorDelete') {
    VendorDelete();
} elseif ($_POST['function'] == 'GetVendor') {
    GetVendor();
} elseif ($_POST['function'] == 'UpdateVendor') {
    UpdateVendor();
} elseif ($_POST['function'] == 'ProductCount') {
    ProductCount();
} elseif ($_POST['function'] == 'GetAllProduct') {
    GetAllProduct();
} elseif ($_POST['function'] == 'StepOne') {
    StepOne();
} elseif ($_POST['function'] == 'StepTwo') {
    StepTwo();
} elseif ($_POST['function'] == 'StepThree') {
    StepThree();
} elseif ($_POST['function'] == 'GetManufacturerData') {
    GetManufacturerData();
} elseif ($_POST['function'] == 'GetPolisherData') {
    GetPolisherData();
} elseif ($_POST['function'] == 'GetStoneSetterData') {
    GetStoneSetterData();
} elseif ($_POST['function'] == 'GetZircons') {
    GetZircons();
} elseif ($_POST['function'] == 'GetStones') {
    GetStones();
} elseif ($_POST['function'] == 'DeleteProduct') {
    DeleteProduct();
} elseif ($_POST['function'] == 'GetPolisherRate') {
    GetPolisherRate();
} elseif ($_POST['function'] == 'GetStoneSetterRate') {
    GetStoneSetterRate();
} elseif ($_POST['function'] == 'GetFilteredProducts') {
    GetFilteredProducts();
}

function GetFilteredProducts(){
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "SELECT ms.id, ms.vendor_id, ms.product_id, ms.date, ms.image, ms.details, ms.type, ms.quantity, ms.purity, ms.unpolish_weight, ms.polish_weight, ms.rate, ms.wastage, ms.unpure_weight, ms.pure_weight, ms.status, ms.tValues, ms.barcode, v.type AS vendor_type, v.name AS vendor_name, v.18k, v.21k, v.22k, v.status AS vendor_status, v.date AS vendor_date
    FROM manufacturing_step AS ms
    INNER JOIN vendor AS v ON ms.vendor_id = v.id";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    if ($getRecordStatement->execute()) {
        $array = $getRecordStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($array, true);
        die;
    }
}

function GetAllVendorData()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $type = $_POST['type'];
    $getRecordQuery = "SELECT * FROM `vendor` WHERE `status` = 'Active' AND `type` = '$type'";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    if ($getRecordStatement->execute()) {
        $array = $getRecordStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($array, true);
        die;
    }
}

function VendorCount()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "SELECT LPAD(COUNT(*), 3, '0') AS `count` FROM `vendor`";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    if ($getRecordStatement->execute()) {
        $row = $getRecordStatement->fetch();
        array_push($array, str_pad($row['count'] + 1, 3, '0', STR_PAD_LEFT));
        echo json_encode($array, true);
        die;
    }
}

function AddVendor()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "INSERT INTO `vendor`(`id`,`type`,`name`, `18k`, `21k`, `22k`, `status`,`date`) VALUES (:id,:type, :name, :18k, :21k, :22k, 'Active',:date)";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    $getRecordStatement->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':18k', $_POST['18k'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':21k', $_POST['21k'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':22k', $_POST['22k'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
    if ($getRecordStatement->execute()) {
        array_push($array, 'success');
        echo json_encode($array, true);
        die;
    }
}

function VendorDelete()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "UPDATE `vendor` SET `status` = 'Inactive' WHERE `id` = :id";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    $getRecordStatement->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    if ($getRecordStatement->execute()) {
        array_push($array, 'success');
        echo json_encode($array, true);
        die;
    }
}

function GetVendor()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $id = $_POST['id'];
    $getRecordQuery = "SELECT * FROM `vendor` WHERE `status` = 'Active' AND `id` = '$id'";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    if ($getRecordStatement->execute()) {
        array_push($array, $getRecordStatement->fetch(PDO::FETCH_ASSOC));
        echo json_encode($array, true);
        die;
    }
}

function UpdateVendor()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "UPDATE `vendor` SET `name` = :name,`type`= :type, `18k` = :18k, `21k` = :21k, `22k` = :22k, `date`=:date WHERE `id` = :id";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    $getRecordStatement->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':18k', $_POST['18k'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':21k', $_POST['21k'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':22k', $_POST['22k'], PDO::PARAM_STR);
    $getRecordStatement->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
    if ($getRecordStatement->execute()) {
        array_push($array, 'success');
        echo json_encode($array, true);
        die;
    }
}

function ProductCount()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "SELECT LPAD(COUNT(*), 4, '0') AS `count` FROM `product`";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    if ($getRecordStatement->execute()) {
        $row = $getRecordStatement->fetch();
        array_push($array, str_pad($row['count'] + 1, 4, '0', STR_PAD_LEFT));
        echo json_encode($array, true);
        die;
    }
}

function GetAllProduct()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";
    $array = array();
    $getRecordQuery = "SELECT * FROM `product` WHERE `status` = 'Active'";
    $getRecordStatement = $pdo->prepare($getRecordQuery);
    if ($getRecordStatement->execute()) {
        $array = $getRecordStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($array, true);
        die;
    }
}

function StepOne()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $dir = 'external-work-directory/images/';
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $vendor_id = trim($_POST['vendor_id']);
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
    $barcode = $_POST['barcode'];
    $fileWithName = $dir . $imageName;

    $fileType = pathinfo($fileWithName, PATHINFO_EXTENSION);

    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
        chmod($dir, 0777);
    }

    $time = time();

    $pName = $dir . '/' . $time . '-' . $imageName;

    $array = array();

    $qry3 = "SELECT * FROM `product` WHERE `id` = '$code'";
    $qry3Statement = $pdo->prepare($qry3);
    $qry3Statement->execute();
    $row = $qry3Statement->fetch(PDO::FETCH_ASSOC);
    if ($row['id'] == $code) {
        $qry = "UPDATE `manufacturing_step` SET `vendor_id`=:vendor_id,`image`=:imageName,`product_id`=:code,`type`=:fType,`quantity`=:quantity,`purity`=:pValue,`unpolish_weight`=:unpolish_weight,`polish_weight`=:polish_weight,`rate`=:rate,`wastage`=:wastage,`tValues`=:tValues,`date`=:fDate,`details`=:details,`barcode`=:barcode WHERE `product_id` = '$code'";
    } else {
        $qry1 = "INSERT INTO `product`(`id`, `status`) VALUES (:code, 'Active')";
        $qry1Statement = $pdo->prepare($qry1);

        $qry1Statement->bindParam(':code', $code);
        
        if ($qry1Statement->execute()) {
            array_push($array, 'success');
        }
        $qry = "INSERT INTO manufacturing_step(`vendor_id`, `image`, `product_id`, `type`, `quantity`, `purity`, `unpolish_weight`, `polish_weight`, `rate`, `wastage`, `tValues`, `date`, `details`,`barcode`)
    VALUES (:vendor_id, :imageName, :code, :fType, :quantity, :pValue, :unpolish_weight, :polish_weight, :rate, :wastage, :tValues, :fDate, :details, :barcode);";
    }

    $qryStatement = $pdo->prepare($qry);


    $qryStatement->bindParam(':vendor_id', $vendor_id);
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
    $qryStatement->bindParam(':barcode', $barcode);


    move_uploaded_file($imageTmpName, $pName);

    if ($qryStatement->execute()) {
        array_push($array, 'success');
    }
    echo json_encode($array);
}

function StepTwo()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $dirpro = 'external-work-directory/images';
    $imageNamepo = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];

    $stepTwoCode = trim($_POST['product_id']);
    $stepTwoName = trim($_POST['vendor_id']);
    $stepTwoDifference = $_POST['difference'];
    $poWas = $_POST['poWas'];
    $payable = $_POST['payable'];
    $stepTwoDate = $_POST['date'];
    $details = $_POST['detail'];
    $polisherbarcode = $_POST['polisherbarcode'];
    $fileWithNamepo = $dirpro . $imageNamepo;

    $fileType = pathinfo($fileWithNamepo, PATHINFO_EXTENSION);

    if (!file_exists($dirpro)) {
        mkdir($dirpro, 0777, true);
        chmod($dirpro, 0777);
        // copy('article-archive/published-articles/CMC/CMC-29-42-6335/XML-compilation/CMC-29-42-6335-compilation.xml', $dir.'/test.xml');                        
    }

    $time = time();

    $poliName = $dirpro . '/' . $time . '-' . $imageNamepo;

    $qry = "SELECT * FROM `polisher_step` WHERE `product_id` = :stepTwoCode";
    $qryStatement = $pdo->prepare($qry);
    $qryStatement->bindParam(':stepTwoCode', $stepTwoCode);
    $qryStatement->execute();
    $array = array();
    if ($qryStatement->rowCount() > 0) {
        $stepTwoQry = "UPDATE `polisher_step` SET `image`=:imageNamepo,`vendor_id`=:stepTwoName,`difference`=:stepTwoDifference,`Wastage`=:poWas,`Payable`=:payable,`date`=:stepTwoDate,`details`=:details,`polisherbarcode`=:polisherbarcode WHERE `product_id` = :stepTwoCode";
    } else {
        $stepTwoQry = "INSERT INTO polisher_step(`product_id`, `image`, `vendor_id`, `difference`, `Wastage`, `Payable`, `date`,`details`,`polisherbarcode`)
        VALUES (:stepTwoCode,:imageNamepo, :stepTwoName, :stepTwoDifference, :poWas, :payable, :stepTwoDate, :details, :polisherbarcode);";
    }





    $stepTwoStatement = $pdo->prepare($stepTwoQry);

    $stepTwoStatement->bindParam(':stepTwoCode', $stepTwoCode);
    $stepTwoStatement->bindParam(':stepTwoName', $stepTwoName);
    $stepTwoStatement->bindParam(':stepTwoDifference', $stepTwoDifference);
    $stepTwoStatement->bindParam(':poWas', $poWas);
    $stepTwoStatement->bindParam(':payable', $payable);
    $stepTwoStatement->bindParam(':stepTwoDate', $stepTwoDate);
    $stepTwoStatement->bindParam(':details', $details);
    $stepTwoStatement->bindParam(':imageNamepo', $poliName);
    $stepTwoStatement->bindParam(':polisherbarcode', $polisherbarcode);




    move_uploaded_file($imageTmpName, $poliName);

    $array = array();

    if ($stepTwoStatement->execute()) {
        array_push($array, 'success');
    }
    echo json_encode($array, true);
}

function StepThree()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $array = array();

    $dirpro = 'external-work-directory/images';
    $imageNamepo = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $vendor_id = trim($_POST['vendor']);
    $product_id = trim($_POST['code']);
    $date = $_POST['date'];
    $details = $_POST['detail'];
    $issued_weight = $_POST['Issued_weight'];
    $z_code = $_POST['zircon_code'];
    $z_weight = $_POST['zircon_weight'];
    $z_quantity = $_POST['zircon_quantity'];
    $total_z_price = $_POST['zircon_total'];
    $total_z_weight = $_POST['zircon_total_weight'];
    $total_z_quantity = $_POST['zircon_total_quantity'];
    $s_code = $_POST['stone_code'];
    $s_weight = $_POST['stone_weight'];
    $s_quantity = $_POST['stone_quantity'];
    $total_s_price = $_POST['stone_total'];
    $total_s_weight = $_POST['stone_total_weight'];
    $total_s_quantity = $_POST['stone_total_quantity'];
    $grand_price = $_POST['grand_total'];
    $received_weight = $_POST['received_weight'];
    $stone_received = $_POST['stone_received'];
    $qty = $_POST['Qty'];
    $wastage = $_POST['wastage'];
    $total_valu = $_POST['Total'];
    $payable = $_POST['Payable'];
    $stonesetter_barcode = $_POST['stonebarcode'];

    $fileWithNamepo = $dirpro . $imageNamepo;

    $fileType = pathinfo($fileWithNamepo, PATHINFO_EXTENSION);

    if (!file_exists($dirpro)) {
        mkdir($dirpro, 0777, true);
        chmod($dirpro, 0777);
    }

    $time = time();

    $pName = $dirpro . '/' . $time . '-' . $imageNamepo;


    $qry3 = "SELECT * FROM `stone_setter_step` WHERE `product_id` = :product_id";
    $qryStatement3 = $pdo->prepare($qry3);
    $qryStatement3->bindParam(':product_id', $product_id);
    $qryStatement3->execute();
    $array = array();
    if ($qryStatement3->rowCount() > 0) {
        $qry2 = "DELETE FROM `zircon` WHERE `product_id` = :product_id";
        $qryStatement2 = $pdo->prepare($qry2);
        $qryStatement2->bindParam(':product_id', $product_id);
        $qryStatement2->execute();
        $qry2 = "DELETE FROM `stone` WHERE `product_id` = :product_id";
        $qryStatement2 = $pdo->prepare($qry2);
        $qryStatement2->bindParam(':product_id', $product_id);
        $qryStatement2->execute();
        $qry4 = "UPDATE `stone_setter_step` SET `image`=:imageNamepo,`vendor_id`=:vendor_id,`date`=:date,`detail`=:details,`Issued_weight`=:issued_weight,`z_total_price`=:total_z_price,`z_total_weight`=:total_z_weight,`z_total_quantity`=:total_z_quantity,`s_total_price`=:total_s_price,`s_total_weight`=:total_s_weight,`s_total_quantity`=:total_s_quantity,`grand_total`=:grand_price,`status`=0,`Received_weight`=:received_weight,`Stone_received`=:stone_received,`Qty`=:qty,`Wastage`=:wastage,`Total_valu`=:total_valu,`Payable`=:payable,`Stonesetter_barcode`=:stonesetter_barcode WHERE `product_id` = :product_id";
    } else {

        $qry4 = "INSERT INTO `stone_setter_step`( `product_id`, `date`, `vendor_id`, `image`, `detail`, `Issued_weight`, `z_total_price`, `z_total_weight`, `z_total_quantity`, `s_total_price`, `s_total_weight`, `s_total_quantity`, `grand_total`, `status`, `Received_weight`, `Stone_received`, `Qty`, `Wastage`, `Total_valu`, `Payable`, `Stonesetter_barcode`) VALUES (:product_id,:date,:vendor_id,:imageNamepo,:details,:issued_weight,:total_z_price,:total_z_weight,:total_z_quantity,:total_s_price,:total_s_weight,:total_s_quantity,:grand_price,0,:received_weight,:stone_received,:qty,:wastage,:total_valu,:payable,:stonesetter_barcode)";
    }

    for ($i = 0; $i < count($z_code); $i++) {
        $z_weight = $z_weight[$i];
        $z_quantity = $z_quantity[$i];

        $qry = "INSERT INTO `zircon`( `product_id`, `weight`, `price`, `quantity`) VALUES (:product_id,:z_weight,0,:z_quantity)";

        $statement = $pdo->prepare($qry);

        $statement->bindParam(':product_id', $product_id);
        $statement->bindParam(':z_weight', $z_weight);
        $statement->bindParam(':z_quantity', $z_quantity);

        if ($statement->execute()) {
            array_push($array, 'success');
        }
    }

    for ($i = 0; $i < count($s_code); $i++) {
        $s_weight = $s_weight[$i];
        $s_quantity = $s_quantity[$i];
        $qry1 = "INSERT INTO `stone`( `product_id`, `weight`, `price`, `quantity`) VALUES (:product_id,:s_weight,0,:s_quantity)";

        $statement1 = $pdo->prepare($qry1);

        $statement1->bindParam(':product_id', $product_id);
        $statement1->bindParam(':s_weight', $s_weight);
        $statement1->bindParam(':s_quantity', $s_quantity);

        if ($statement1->execute()) {
            array_push($array, 'success');
        }
    }



    $statement1 = $pdo->prepare($qry4);

    $statement1->bindParam(':product_id', $product_id);
    $statement1->bindParam(':date', $date);
    $statement1->bindParam(':vendor_id', $vendor_id);
    $statement1->bindParam(':imageNamepo', $pName);
    $statement1->bindParam(':details', $details);
    $statement1->bindParam(':issued_weight', $issued_weight);
    $statement1->bindParam(':total_z_price', $total_z_price);
    $statement1->bindParam(':total_z_weight', $total_z_weight);
    $statement1->bindParam(':total_z_quantity', $total_z_quantity);
    $statement1->bindParam(':total_s_price', $total_s_price);
    $statement1->bindParam(':total_s_weight', $total_s_weight);
    $statement1->bindParam(':total_s_quantity', $total_s_quantity);
    $statement1->bindParam(':grand_price', $grand_price);
    $statement1->bindParam(':received_weight', $received_weight);
    $statement1->bindParam(':stone_received', $stone_received);
    $statement1->bindParam(':qty', $qty);
    $statement1->bindParam(':wastage', $wastage);
    $statement1->bindParam(':total_valu', $total_valu);
    $statement1->bindParam(':payable', $payable);
    $statement1->bindParam(':stonesetter_barcode', $stonesetter_barcode);

    move_uploaded_file($imageTmpName, $pName);



    if ($statement1->execute()) {
        array_push($array, 'success');
    }
    echo json_encode($array, true);
}

function StepFour(){
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $array = array();
    $date= $_POST['date'];
    $vendor_id= $_POST['vendor_id'];
    $product_id= $_POST['product_id'];
    $amount= $_POST['amount'];

    $qry="INSERT INTO `additional_step`( `product_id`, `vendor_id`, `type`, `amount`, `status`) VALUES (:product_id,:vendor_id,'1',:amount,'Active')";
    $statement = $pdo->prepare($qry);
    $statement->bindParam(':product_id', $product_id);
    $statement->bindParam(':vendor_id', $vendor_id);
    $statement->bindParam(':amount', $amount);
    if($statement->execute()){
        array_push($array,'success');
    }

}

function GetManufacturerData()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $qry = "SELECT * FROM manufacturing_step WHERE product_id = :id";
    $qryStatement = $pdo->prepare($qry);
    $qryStatement->bindParam(':id', $id);
    $qryStatement->execute();
    $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);
}

function GetPolisherData()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $qry = "SELECT * FROM polisher_step WHERE product_id = :id";
    $qryStatement = $pdo->prepare($qry);
    $qryStatement->bindParam(':id', $id);
    $qryStatement->execute();
    $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);
}

function GetStoneSetterData()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $qry = "SELECT * FROM stone_setter_step WHERE product_id = :id";
    $qryStatement = $pdo->prepare($qry);
    $qryStatement->bindParam(':id', $id);
    $array = array();
    if ($qryStatement->execute()) {
        $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result, true);
    } else {
        echo json_encode($qryStatement->errorInfo(), true);
    }
}

function GetZircons()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $qry = "SELECT * FROM zircon WHERE product_id=:id";
    $qryStatement = $pdo->prepare($qry);

    $qryStatement->bindParam(':id', $id);
    $qryStatement->execute();

    $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);
}

function GetStones()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $qry = "SELECT * FROM stone WHERE product_id=:id";
    $qryStatement = $pdo->prepare($qry);

    $qryStatement->bindParam(':id', $id);
    $qryStatement->execute();

    $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);
}

function DeleteProduct()
{
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $qry = "Update product SET status='Inactive' WHERE id=:id";
    $qryStatement = $pdo->prepare($qry);

    $qryStatement->bindParam(':id', $id);

    if ($qryStatement->execute()) {
        $result = array('status' => 'success');
    } else {
        $result = array('status' => 'error');
    }

    echo json_encode($result, true);
}

function GetPolisherRate(){
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $column=$_POST['column'];
    $qry = "SELECT $column FROM  vendor WHERE id=:id";
    $qryStatement = $pdo->prepare($qry);

    $qryStatement->bindParam(':id', $id);
    $qryStatement->execute();

    $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result, true);

}

function GetStoneSetterRate(){
    include 'layouts/session.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once "layouts/config.php";

    $id = $_POST['id'];
    $column=$_POST['column'];
    $qry = "SELECT $column FROM  vendor WHERE id=:id";
    $qryStatement = $pdo->prepare($qry);

    $qryStatement->bindParam(':id', $id);
    $qryStatement->execute();

    if($qryStatement->rowCount() > 0){
        $result = $qryStatement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result, true);
    }else{
        echo json_encode('error', true);
    }

}
