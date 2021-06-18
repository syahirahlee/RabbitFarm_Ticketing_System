<?php require_once('Connections/rabbitfarm.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_view = 5;
$pageNum_view = 0;
if (isset($_GET['pageNum_view'])) {
  $pageNum_view = $_GET['pageNum_view'];
}
$startRow_view = $pageNum_view * $maxRows_view;

mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_view = "SELECT * FROM tblticket";
$query_limit_view = sprintf("%s LIMIT %d, %d", $query_view, $startRow_view, $maxRows_view);
$view = mysql_query($query_limit_view, $rabbitfarm) or die(mysql_error());
$row_view = mysql_fetch_assoc($view);

if (isset($_GET['totalRows_view'])) {
  $totalRows_view = $_GET['totalRows_view'];
} else {
  $all_view = mysql_query($query_view);
  $totalRows_view = mysql_num_rows($all_view);
}
$totalPages_view = ceil($totalRows_view/$maxRows_view)-1;

$queryString_view = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_view") == false && 
        stristr($param, "totalRows_view") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_view = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_view = sprintf("&totalRows_view=%d%s", $totalRows_view, $queryString_view);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style5 {
	font-size: 28px;
	font-family: "Berlin Sans FB";
}
.style6 {
	font-family: "Agency FB";
	font-size: 34px;
	font-weight: bold;
}
a:link {
	color: #003366;
}
a:hover {
	color: #99CCCC;
}
.style7 {font-size: 10px}
.style8 {font-size: 32px}
.style9 {font-size: 16px}
.style11 {font-size: 14}
.style13 {font-size: 14px}
.style14 {font-size: 16}

.button {     background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button:hover {
    opacity: 1;
    color: white;
}
.button1 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button2 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button11 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button21 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button3 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button4 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
.button41 {background-color:#66CCCC;
    border: none;
    color: white;
    padding: 10px 24px;
	font-weight:bold;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.4s;
    opacity: 0.8;
}
-->
</style>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

function printPage() {
    window.print();
}
//-->
</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" bgcolor="#FFCC99">
    <tr>
      <td><blockquote>
        <p align="center"><span class="style5 style6"><span class="style6"><img src="pic/rabbit-153203_640.png" alt="" width="104" height="97" /></span><span class="style8">RABBIT FUN LAND CUSTOMER REPORT</span></span></p>
      </blockquote></td>
    </tr>
  </table>
  <p class="style5 style6 style7">&nbsp;</p>
</form>
<form id="form2" name="form2" method="post" action="">
  <table border="1" align="center">
    <tr>
      <td width="193" height="33"><div align="center"><span class="style9">Name</span></div></td>
      <td width="119"><div align="center"><span class="style9">IC No</span></div></td>
      <td width="124"><div align="center"><span class="style9">Contact No</span></div></td>
      <td width="142"><div align="center"><span class="style9">Email</span></div></td>
      <td width="89"><div align="center"><span class="style9">Date</span></div></td>
      <td width="128"><div align="center"><span class="style9">Ticket Type</span></div></td>
      <td width="94"><div align="center"><span class="style9">Quantity</span></div></td>
      <td width="115"><div align="center"><span class="style9">Total Price</span></div></td>
    </tr>
    <?php do { ?>
    <tr>
      <td height="33"><span class="style13"><?php echo $row_view['Name']; ?></span></td>
      <td><span class="style11 style13 style13"><?php echo $row_view['IC_No']; ?></span></td>
      <td><span class="style13"><?php echo $row_view['Contact_No']; ?></span></td>
      <td><span class="style13"><?php echo $row_view['Email']; ?></span></td>
      <td><span class="style13"><?php echo $row_view['Date']; ?></span></td>
      <td><span class="style13"><?php echo $row_view['PackageType']; ?></span></td>
      <td><span class="style13"><?php echo $row_view['Quantity']; ?></span></td>
      <td><span class="style13"><?php echo $row_view['Total_price']; ?></span></td>
    </tr>
    <?php } while ($row_view = mysql_fetch_assoc($view)); ?>
  </table>
  <p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p align="center" class="style14 style14 style14">&nbsp;<a href="<?php printf("%s?pageNum_view=%d%s", $currentPage, 0, $queryString_view); ?>">First</a> <a href="<?php printf("%s?pageNum_view=%d%s", $currentPage, min($totalPages_view, $pageNum_view + 1), $queryString_view); ?>">Next</a> (Page <?php echo ($startRow_view + 1) ?> ) <a href="<?php printf("%s?pageNum_view=%d%s", $currentPage, max(0, $pageNum_view - 1), $queryString_view); ?>">Previous</a> <a href="<?php printf("%s?pageNum_view=%d%s", $currentPage, $totalPages_view, $queryString_view); ?>">Last</a></p>
  <p align="center" class="style14 style14 style14">&nbsp;</p>
  <p>
    <label></label>
  </p>
  <table width="80%" border="0" align="center">
    <tr>
      <td>
        
        <div align="right">
          <input name="print" type="button" class="button" id="print" onclick="printPage()" value="PRINT REPORT" />
          </div></td>
      <td>
        <div align="left">
          <blockquote>
            <p align="center">
              <input name="back" type="button" class="button" id="back" onclick="MM_goToURL('parent','staff_menu.php');return document.MM_returnValue" value="BACK TO MENU" />
            </p>
          </blockquote>
      </div></td>
    </tr>
  </table>
  <blockquote>
    <p>&nbsp; </p>
  </blockquote>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($view);
?>
