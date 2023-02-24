<?php include 'layouts/session.php'; ?>
<?php include 'layouts/config.php'; 

require 'vendor/autoload.php';

?>

<head>

    <title>Print Receipt Gold Account</title>

    

<style>
/* TODO: optimize */

body {
  font-family: 'Roboto', sans-serif;
  margin: 0px;
  padding: 0px;
}

.receipt {
    padding: 3mm;
    width: 80mm;
    border: 1px solid black;
	 margin-left: auto;
    margin-right: auto;
}
.receiptbtn {
    padding: 3mm;
    width: 80mm;
    
	 margin-left: auto;
    margin-right: auto;
}
.orderNo {
  width: 100%;
  text-align: right;
  padding-bottom: 1mm;
  font-size: 8pt;
  font-weight: bold;
}

.orderNo:empty {
  display: none;
}

.headerSubTitle {
  font-family: 'Equestria', 'Permanent Marker', cursive;
  text-align: center;
  font-size: 12pt;
}

.headerTitle {
  font-family: 'Equestria', 'Permanent Marker', cursive;
  text-align: center;
  font-size: 24pt;
  font-weight: bold;
}

#location {
  margin-top: 5pt;
  text-align: center;
  font-size: 16pt;
  font-weight: bold;
}

#date {
  margin: 5pt 0px;
  text-align: center;
  font-size: 8pt;
}

#barcode {
  display: block;
  margin: 0px auto;
}

#barcode:empty {
  display: none;
}

.watermark {
   position: absolute;
   left: 7mm;
   top: 60mm;
   width: 75mm;
   opacity: 0.1;
}

.keepIt {
  text-align: center;
  font-size: 12pt;
  font-weight: bold;
  padding-top: 9px;

}

.keepItBody {
  text-align: justify;
  font-size: 8pt;
}

.item {
  margin-bottom: 1mm;
}

.itemRow {
  display: flex;
  font-size: 8pt;
  align-items: baseline;
}

.itemRow > div {
  align-items: baseline;
}

.itemName {
  font-weight: bold;
}

.itemPrice {
  text-align: right;
  flex-grow: 1;
}

.itemColor {
  width: 10px;
  height: 100%;
  background: yellow;
  margin: 0px 2px;
  padding: 0px;
}

.itemColor:before {
  content: "\00a0";
}


.itemData2 {
  text-align: right;
  flex-grow: 1;
}

.itemData3 {
  width: 15mm;
  text-align: right;
}

.itemQuantity:before {
  content: "x";
}

.itemTaxable:after {
  content: " T";
}

.flex {
  display: flex;
  justify-content: center;
}

#qrcode {
  align-self: center;
  flex: 0 0 100px
}

.totals {
  flex-grow: 0;
  align-self: center;
  font-size: 8pt;
}

.totals .row {
  display: flex;
  text-align: right;
}

.totals .section {
  padding-top: 2mm;
}

.totalRow > div, .total > div {
  text-align: right;
  align-items: baseline;
  font-size: 8pt;
}

.totals .col1 {
  text-align: right;
  flex-grow: 1;
}

.totals .col2 {
   width: 22mm; 
}

.totals .col2:empty {
  display: none;
}

.totals .col3 {
  width: 15mm;  
}

.footer {
  overflow: hidden;
  margin-top: 5mm;
  border-radius: 7px;
  width: 100%;
  background: black;
  color: white;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
}

.footer:empty {
    display: none;
}

.eta {
  padding: 1mm 0px;
}

.eta:empty {
    display: none;
}

.eta:before {
    content: "Estimated time order will be ready: ";
  font-size: 8pt;
  display: block;
}

.etaLabel {
  font-size: 8pt;
}

.printType {
  padding: 1mm 0px;
  width: 100%;
  background: grey;
  color: white;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
}

.about {
  font-size: 12pt;
  overflow: hidden;
  background: #FCEC52;
  color: #3A5743;
  border-radius: 7px;
  padding: 0px;
  position: absolute;
  width: 500px;
  text-align: center;
  left: 50%;
  margin-top: 50px;
  margin-left: -250px;
}

.arrow_box h3, ul {
  margin: 5px;
}

.about li {
  text-align: left;
}

.arrow_box {
	position: absolute;
	background: #88b7d5;
  padding: 5px;
  margin-top: 20px;
  left: 95mm;
  top: 2;
  width: 500px;
	border: 4px solid #c2e1f5;
}
.arrow_box:after, .arrow_box:before {
	right: 100%;
	top: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.arrow_box:after {
	border-color: rgba(136, 183, 213, 0);
	border-right-color: #88b7d5;
	border-width: 30px;
	margin-top: -30px;
}
.arrow_box:before {
	border-color: rgba(194, 225, 245, 0);
	border-right-color: #c2e1f5;
	border-width: 36px;
	margin-top: -36px;
}
@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
</style>
</head>




   

   
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <?php   
    
     $date= $name=  $details= $gold_Issued_weight= $purity= $pure_weight_issued= "";
 
 $id =  trim($_GET["id"]);

    $sql="SELECT * FROM gold_accont_step WHERE id  = $id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    if($stmt->rowCount() == 1){
        $row = $stmt->fetch();
		
        $date = $row["date"];
        $name= $row["name"]; 
        $detail = $row["detail"];
		$gold_Issued_weight= $row["gold_Issued_weight"];
		$purity= $row["purity"];
		$pure_weight_issued= $row["pure_weight_issued"];
		$goldcode= $row["goldbarcode"];
		

    }
  

?>

    

       <!-- ======= -->


<!-- START RECEIPT -->
<div class="receipt">
 
  <div class="orderNo">
    Date: <span id="Order #"><?php echo date("d-m-Y", strtotime($date) ); ?></span>
	
  </div>
  <br/>
  <div class="headerSubTitle">
    Gold Account Receipt
  </div>
  <div class="headerTitle">
    <?php echo $name; ?>
  </div>
  <div class="headerSubTitle">
   
  </div>
  <div class="keepIt">
   Gold Issued Weight: <?php echo $gold_Issued_weight; ?>
  </div>
   <div id="date">
   <?php $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('$goldcode', $generator::TYPE_CODE_128)) . '">';
			?>
  </div>
  <div id="date">
			<?php echo "$goldcode"; ?>
  </div>
  
  <hr>

  <div class="keepIt">
    Purity: <?php echo $purity; ?>
  </div>
<div class="keepIt">
    Pure Weight Issued: <?php echo $pure_weight_issued; ?>
  </div>

 

  <br/>
  <div class="keepItBody">
     Details: <?php echo $detail; ?>. 
  </div>
  
</div>
	<div class="receiptbtn">
  <button id="btnPrint" class="hidden-print">Print</button>     
    </div>     

<script>		 
const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
</script>
</body>

</html>