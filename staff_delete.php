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

$colname_searching = "-1";
if (isset($_GET['Username'])) {
  $colname_searching = $_GET['Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_searching = sprintf("SELECT * FROM tblticket WHERE Username = %s", GetSQLValueString($colname_searching, "text"));
$searching = mysql_query($query_searching, $rabbitfarm) or die(mysql_error());
$row_searching = mysql_fetch_assoc($searching);
$totalRows_searching = mysql_num_rows($searching);

$colname_Delete = "-1";
if (isset($_GET['Username'])) {
  $colname_Delete = $_GET['Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_Delete = sprintf("SELECT * FROM tblticket WHERE Username = %s", GetSQLValueString($colname_Delete, "text"));
$Delete = mysql_query($query_Delete, $rabbitfarm) or die(mysql_error());
$row_Delete = mysql_fetch_assoc($Delete);
$totalRows_Delete = mysql_num_rows($Delete);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Customer</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
}
.style2 {
	font-family: "OCR A Extended";
	font-size: 26px;
}
.style4 {
	font-size: 20px;
	font-family: "Berlin Sans FB";
}
.style5 {
	font-size: 28px;
	font-family: "Agency FB";
}
.style6 {font-size: 9px}
body,td,th {
	font-family: Berlin Sans FB;
	font-size: 18px;
}
.style9 {
	font-family: "Agency FB";
	font-size: 34px;
	font-weight: bold;
}
.style20 {font-size: 18px}
.style21 {font-family: Geneva, Arial, Helvetica, sans-serif}
.style24 {font-size: 16px}
.style26 {
	font-size: 16px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
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
    opacity: 1.5;
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
-->
</style>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
</head>

<body>
<form id="form1" name="form1" method="get">
  <table width="100%" border="0" bgcolor="#FFCC99">
    <tr>
      <td><blockquote>
          <p align="center"><span class="style2 style5"><span class="style9"><img src="pic/rabbit-153203_640.png" alt="" width="104" height="97" />DELETE CUSTOMER TICKETING RECORD</span></span></p>
      </blockquote></td>
    </tr>
  </table>
  <p align="center" class="style2 style4">Please enter username:</p>
  <p align="center" class="style1 style2">
    <label>
    <input name="Username" type="text" id="Username" size="15" maxlength="12" />
    </label>
    <label>
    <input name="submit" type="submit" class="button" id="submit" value="SEARCH" />
    </label>
  </p>
</form>
<form id="form2" name="form2" method="POST">
  <table width="397" border="0" align="center">
    <tr>
      <td height="34" colspan="2"><span class="style20">Customer information</span></td>
    </tr>
    <tr>
      <td width="142" height="34"><span class="style18 style24 style21"> Username</span></td>
      <td width="245"><label>
        <input name="Username" type="text" id="Username" value="<?php echo $row_Delete['Username']; ?>" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="34"><span class="style18 style24 style21">Name</span></td>
      <td><label>
        <input name="Name" type="text" id="Name3" value="<?php echo $row_Delete['Name']; ?>" size="40" maxlength="40" />
      </label></td>
    </tr>
    <tr>
      <td height="33"><span class="style18 style24 style21">IC no</span></td>
      <td><label>
        <input name="IC_No" type="text" id="IC_No" value="<?php echo $row_Delete['IC_No']; ?>" maxlength="15" />
      </label></td>
    </tr>
    
    <tr>
      <td height="33"><span class="style18 style24 style21">Contact no</span></td>
      <td><label>
        <input name="Contact_No" type="text" id="Contact_No" value="<?php echo $row_Delete['Contact_No']; ?>" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="34"><span class="style18 style24 style21">Email</span></td>
      <td><label>
        <input name="Email" type="text" id="Email" value="<?php echo $row_Delete['Email']; ?>" />
      </label></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><input name="Usertype" type="hidden" id="Usertype" value="<?php echo $row_Delete['UserType']; ?>" /></td>
    </tr>
    <tr>
      <td height="42" colspan="2"><p>Ticketing information</p>      </td>
    </tr>
    <tr>
      <td height="34"><span class="style18 style21 style24">Date</span></td>
      <td><label>
        <input name="Date" type="date" id="Date" value="<?php echo $row_Delete['Date']; ?>" />
      </label></td>
    </tr>
    <tr>
      <td height="35"><span class="style18 style21 style24">Package type</span></td>
      <td><label>
        <select name="PackageType" id="PackageType" title="<?php echo $row_Delete['PackageType']; ?>">
          <option value="" <?php if (!(strcmp("", $row_Delete['PackageType']))) {echo "selected=\"selected\"";} ?>>Select Package Type:</option>
          <option value="normal" <?php if (!(strcmp("normal", $row_Delete['PackageType']))) {echo "selected=\"selected\"";} ?>>Normal Rate</option>
          <option value="school" <?php if (!(strcmp("school", $row_Delete['PackageType']))) {echo "selected=\"selected\"";} ?>>School Tour</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td height="42"><span class="style18 style21 style24">Quantity</span></td>
      <td><input name="Quantity" type="text" id="Quantity" value="<?php echo $row_Delete['Quantity']; ?>" /></td>
    </tr>
    <tr>
      <td height="42" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td height="104" class="style26">Total price</td>
      <td><label>
        <input name="Total_price" type="text" id="Total_price" value="<?php echo $row_Delete['Total_price']; ?>" />
      </label></td>
    </tr>
    
    <tr>
      <td height="45"><label> </label>
          <div align="center">
            <input name="del" type="submit" class="button" id="del" onclick="MM_popupMsg('Are you sure you want to delete this user data?')" value="DELETE" />
          </div></td>
      <td height="45"><div align="center">
        <input name="back2" type="button" class="button" id="back2" onclick="MM_goToURL('parent','staff_menu.php');return document.MM_returnValue" value="BACK TO MENU" />
      </div></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>&nbsp;</blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
  <p class="style6">
    <label></label>
  </p>
  </form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($searching);

mysql_free_result($Delete);
?>