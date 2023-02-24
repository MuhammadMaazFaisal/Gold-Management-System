<?php
include 'layouts/config.php';
//===================================================
//              FOR Dashboard
//===================================================

//Query for New User 
$query = "SELECT count(*)as user FROM `users` WHERE `UserStatus` LIKE 'Active';";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$nsc = $rows['user'];

//Query for Role 
$query = "SELECT count(*)as roles FROM `roles` WHERE `Status` LIKE 'Active';";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$roles = $rows['roles'];


//Query for Unactive User 
$query = "SELECT count(*)as user FROM `users` WHERE `UserStatus` LIKE 'Unactive';";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$unactiveuser = $rows['user'];


//Query for system Activities 
$query = "SELECT count(*)as system_activities FROM `systemactivities`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$system_activities = $rows['system_activities'];


//Query for Manufacturing 
$query = "SELECT count(*)as manufacturing_step FROM `manufacturing_step`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$manufacturing_step = $rows['manufacturing_step'];


//Query for Polisher 
$query = "SELECT count(*)as polisher_step FROM `polisher_step`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$polisher_step = $rows['polisher_step'];

//Query for ADDITIONAL MANUFACTURING 
$query = "SELECT count(*)as additional_step FROM `additional_step`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$additional = $rows['additional_step'];

//Query for Gold Account 
$query = "SELECT count(*)as gold_accont_step FROM `gold_accont_step`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$gold_accont_step = $rows['gold_accont_step'];


//Query for Suppliers List
$query = "SELECT count(*)as supplier_list FROM `supplier_list`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$supplier_list = $rows['supplier_list'];


//Query for Po Order
$query = "SELECT count(*)as purchase_order_list FROM `purchase_order_list`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$purchase_order_list = $rows['purchase_order_list'];

//Query for List of Item 
$query = "SELECT count(*)as item_list FROM `item_list`;";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rows = $stmt->fetch();
$item_list = $rows['item_list'];
?>
<?php


?>

