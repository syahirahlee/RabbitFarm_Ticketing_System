<?php require_once('Connections/rabbitfarm.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "Customer";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "sorry.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO tblticket (Username, Name, IC_No, Contact_No, Email, UserType, `Date`, PackageType, Quantity, Total_price) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['IC_No'], "text"),
                       GetSQLValueString($_POST['Contact_No'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Usertype'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['PackageType'], "text"),
                       GetSQLValueString($_POST['Quantity'], "double"),
                       GetSQLValueString($_POST['Total_price'], "double"));

  mysql_select_db($database_rabbitfarm, $rabbitfarm);
  $Result1 = mysql_query($insertSQL, $rabbitfarm) or die(mysql_error());

  $insertGoTo = "Pay.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Customer = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Customer = $_SESSION['MM_Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_Customer = sprintf("SELECT * FROM tblcustomer WHERE Username = %s", GetSQLValueString($colname_Customer, "text"));
$Customer = mysql_query($query_Customer, $rabbitfarm) or die(mysql_error());
$row_Customer = mysql_fetch_assoc($Customer);
$totalRows_Customer = mysql_num_rows($Customer);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Purchase Ticket</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}


body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #000000;
}
a:link {
	color: #000000;
}
a:visited {
	color: #000000;
}
a:hover {
	color: #990066;
}
</style>

<style type="text/css">
<!--
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
.style10 {	font-family: Geneva, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 15px;
}
.style18 {	font-size: 15px
}
.style25 {	color: #000000;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 15px;
}
.style7 {	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style8 {color: #000000}
.style9 {	color: #000000;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<style type="text/css">
<!--

.button1 {      background-color:#6666CC;
    border: none;
    color: white;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
	font-family:: "Geneva";
	font-weight:bold;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.3s;
	opacity: 0.8;
}

.button1:hover {
    opacity: 1 ;
    color: white;
}
-->
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style34 {	font-size: 29px;
	font-family: "Agency FB";
	font-weight: bold;
}
.style32 {
	font-size: 30px;
	font-family: "Agency FB";
}
.button121 {background-color:#6666CC;
    border: none;
    color: white;
    padding: 8px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 19px;
	font-family:"Agency FB";
	font-weight:bold;
    margin: 10px 4px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.3s;
	opacity: 0.8;
}
.button121:hover {
    opacity: 1 ;
    color: white;
}
.style60 {	font-size: 16px
}
.style26 {	font-size: 18px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style35 {font-size: 18px}
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
.style61 {	font-size: 28px;
	font-family: "Agency FB";
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
-->
</style>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="100%" border="0" bgcolor="#009999">
    <tr>
      <td width="87%"><div align="right"></div></td>
      <td width="1%"><div align="right">
        <input name="login" type="button" class = "button" id="login" onclick="MM_goToURL('parent','login.php');return document.MM_returnValue"" value="Login" ;return document.mm_returnvalue="document.mm_returnvalue" />
      </div></td>
      <td width="7%"><div align="center">
        <input name="signup" type="button" class = "button" id="signup" onclick="MM_goToURL('parent','sign_up.php');return document.MM_returnValue"" value="Sign Up" ;return document.mm_returnvalue="document.mm_returnvalue" />
      </div></td>
    </tr>
  </table>
  <table width="100%" border="0" bgcolor="#009999">
    <tr>
      <td> <p align="center"><img src="pic/2.png" alt="" width="177" height="134" /><img src="pic/logo2.png" alt="" width="304" height="172" /> <img src="pic/3.png" alt="" width="179" height="138" /></p>
        <ul id="MenuBar1" class="MenuBarHorizontal">
          <li>
            <div align="center"><a href="mainpage.php" class="style7 style18">Home</a></div>
          </li>
          <li>
            <div align="center"><a href="#" class="MenuBarItemSubmenu style7 style8 style18">Attractions</a>
                <ul>
                  <li><a href="Animals.php" class="style25">Animals</a></li>
                  <li><a href="Facilities.php" class="style25">Facilities and Others</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div align="center"><a href="#" class="MenuBarItemSubmenu style8 style7 style18">Ticketing</a>
                <ul>
                  <li><a href="OpenHour.php" class="style8 style10"><strong>Opening Hours</strong></a> </li>
                  <li><a href="TicketRate.php" class="style25">Rates</a></li>
                </ul>
            </div>
          </li>
          <li>
            <div align="center" class="style9"><a href="About.php" class="style18">About</a></div>
          </li>
          <li>
            <div align="center" class="style18"><a href="Contact.php" class="style9">Contact Us</a></div>
          </li>
        </ul>
        <p align="center">&nbsp;</p>      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form2" id="form2" onenter ="return false;">
  <div align="center"><span class="style34">Rabbit Fun Land Ticket Purchase</span></div>
  <p align="center"><?php $_SESSION["MM_Username"]; ?>&nbsp;</p>
  <p align="center"><span class="style32"><span class="style61"><img src="pic/tickett1.png" alt="" width="127" height="73" /></span>1. Select Ticket Type</span></p>
  <p align="center">&nbsp;</p>
  <table width="35%" height="303" border="0" align="center">
    <tr>
      <td width="40%" height="44"><span class="style35">Ticket Type</span></td>
      <td width="60%"><select id="PackageType" name="PackageType" class="style60" >
          <option>Select one</option>
          <option value="normal" >Normal Rate (RM8) </option>
          <option value="school">School Package (RM40)</option>
      </select></td>
    </tr>
    <tr>
      <td height="44"><span class="style35">Quantity</span></td>
      <td><label>
        <input name="Quantity" type="text" class="style18" id="Quantity" size="6" />
      </label></td>
    </tr>
    <tr>
      <td height="45"><span class="style26 style35">Date</span></td>
      <td><label>
        <input name="Date" type="date" class="style18" id="Date" />
      </label></td>
    </tr>
    <tr>
      <td height="81" colspan="2"><p align="center" class="style35">
          <input name="enter" type="button" class="button121" id="enter"  value="ENTER" button="button"  onclick="calculateTotal()"/>
      </p></td>
    </tr>
    <tr>
      <td height="77"><span class="style26 style35">Total Price : </span></td>
      <td height="77"><label>
        <input name="Total_price" type="text" class="style18" id="Total_price" size="6" />
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center"><span class="style32"><img src="pic/Profile01-RoundedWhite-512.png" alt="" width="97" height="87" /> 2. Enter your details</span></p>
  <p align="center">&nbsp;</p>
  <table width="456" border="0" align="center">
    <tr>
      <td width="156" height="44"><span class="style35"> Username</span></td>
      <td width="290"><label>
        <input name="Username" type="text" class="style60" id="Username" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="47"><span class="style35">Name</span></td>
      <td><label>
        <input name="Name" type="text" class="style60" id="Name" size="40" maxlength="40" />
      </label></td>
    </tr>
    <tr>
      <td height="50"><span class="style35">IC no</span></td>
      <td><label>
        <input name="IC_No" type="text" class="style60" id="IC_No" maxlength="15" />
      </label></td>
    </tr>
    <tr>
      <td height="51"><span class="style35">Contact no</span></td>
      <td><label>
        <input name="Contact_No" type="text" class="style60" id="Contact_No" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="44"><span class="style35">Email</span></td>
      <td><label>
        <input name="Email" type="text" class="style60" id="Email" size="30" />
      </label></td>
    </tr>
    <tr>
      <td><span class="style35"></span></td>
      <td><input name="Usertype" type="hidden" id="Usertype" value="Customer" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="1068" border="0" align="center">
    <tr>
      <td width="214">&nbsp;</td>
      <td width="499"><div align="right">
          <input name="next" type="submit" class = "button" id="next"" value="PROCEED TO PAYMENT" ;return document.mm_returnvalue="document.mm_returnvalue" />
      </div></td>
      <td width="341"><blockquote>
          <p>
            <input name="back" type="button" class = "button" id="back" onclick="MM_goToURL('parent','customer_menu.php');return document.MM_returnValue"" value="BACK TO MENU" ;return document.mm_returnvalue="document.mm_returnvalue" />
          </p>
      </blockquote></td>
    </tr>
  </table>
  <p align="center">
    <input type="hidden" name="MM_insert" value="form2" />
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>

<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});

//reference for calculation
var theForm = document.forms["form2"];

var ticket_type= new Array();
 ticket_type["normal"]=8;
 ticket_type["school"]=40;

//This function finds the filling price based on the 
//drop down selection
function getTicketPrice()
{
    var TicketPrice=0;
    //Get a reference to the form id="form2"
    var theForm = document.forms["form2"];
    //Get a reference to the select id="PackageType"
     var selectedTicket = theForm.elements["PackageType"];
     
    //set cakeFilling Price equal to value user chose
    //For example filling_prices["Lemon".value] would be equal to 5
    TicketPrice = ticket_type[selectedTicket.value];

    //finally we return cakeFillingPrice
    return TicketPrice;
}

function getQuantity()
{
    //Assume form with id="theform"
    var theForm = document.forms["form2"];
    //Get a reference to the TextBox
    var quantity = theForm.elements["Quantity"];
    var howmany =0;
    //If the textbox is not blank
    if(quantity.value!="")
    {
        howmany = parseInt(quantity.value);
    }
return howmany;
}

function calculateTotal()
{
    //Here we get the total price by calling our function
    //Each function returns a number so by calling them we add the values they return together
    var TotalPrice = getTicketPrice() * getQuantity();
    
    //display the result
    form2.Total_price.value = TotalPrice;

}

//-->
</script>
</body>
</html>
<?php
mysql_free_result($Customer);
?> 