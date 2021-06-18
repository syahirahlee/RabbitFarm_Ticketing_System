<?php require_once('Connections/rabbitfarm.php'); ?><?php
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
?><?php
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

$colname_Pay = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Pay = $_SESSION['MM_Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_Pay = sprintf("SELECT * FROM tblticket WHERE Username = %s", GetSQLValueString($colname_Pay, "text"));
$Pay = mysql_query($query_Pay, $rabbitfarm) or die(mysql_error());
$row_Pay = mysql_fetch_assoc($Pay);
$totalRows_Pay = mysql_num_rows($Pay);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Make Payment</title>
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
.style60 {	font-size: 16px
}
.style26 {	font-size: 18px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style35 {font-size: 18px}
.style61 {
	font-family: "Agency FB";
	font-size: 24px;
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

<form id="form2" name="form2" method="POST">
  <div align="center"><span class="style34">Rabbit Fun Land Ticket Purchase</span></div>
  <p>&nbsp;</p>
  <table width="34%" border="0" align="center">
    <tr>
      <td width="48%"><div align="left">
        <blockquote>
          <p><span class="style32"><img src="pic/payment-methods-bank-cards-icon-512x512-pixel-4.png" width="102" height="86" /></span></p>
        </blockquote>
      </div></td>
      <td width="52%"><div align="left"><span class="style32">3. Payment</span></div></td>
    </tr>
    <tr>
      <td height="20" colspan="2"><span class="style61">You are about to purchase the following items:</span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="35%" height="141" border="0" align="center">
    
    <tr>
      <td width="42%" height="44"><span class="style35">Ticket Type</span></td>
      <td width="58%" class="style35"><?php echo $row_Pay['PackageType']; ?></td>
    </tr>
    <tr>
      <td height="44"><span class="style35">Quantity</span></td>
      <td class="style35"><label><?php echo $row_Pay['Quantity']; ?></label></td>
    </tr>
    <tr>
      <td height="45"><span class="style26 style35">Date</span></td>
      <td class="style35"><label><?php echo $row_Pay['Date']; ?></label></td>
    </tr>
  </table>
  <table width="36%" border="0" align="center">
    <tr>
      <td width="42%" height="43" bgcolor="#66CC99"><span class="style35">Total Ticket Price</span></td>
      <td width="58%" bgcolor="#66CC99"> <div align="left" class="style35"><?php echo $row_Pay['Total_price']; ?></div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="38%" border="0" align="center">
    <tr>
      <td height="53" bgcolor="#CCCCCC"><span class="style34">Payment Information</span></td>
    </tr>
    <tr>
      <td><p><br />  
          <span class="style32">Accepted Cards <img src="pic/visa_PNG2.png" width="252" height="65" /></span></p>
        <p>&nbsp;</p>
        <blockquote>
          <p class="style35">Name on Card</p>
        </blockquote>
        <p class="style35">
          <label>
          <blockquote>
            <p>
              <input name="cardname" type="text" id="cardname" size="50" placeholder="Azman bin Johari" />
            </p>
          </blockquote>
          </label>
        </p>
        <blockquote>
          <p class="style35">Card Number</p>
        </blockquote>
        <p>
          <label>
          <blockquote>
            <p>
              <input name="no" type="text" id="no" size="30" placeholder="1111-2222-3333-4444" />
            </p>
          </blockquote>
          </label>
        </p>
        <blockquote>
          <p class="style35">Exp Month</p>
        </blockquote>
        <p>
          <label>
          <blockquote>
            <p class="style35" id="month" name="month">
              <select name="month" class="style35" id="month">
                <option>Select Month:</option>
                <option value="Jan">January</option>
                <option value="Feb">February</option>
                <option value="March">March</option>
                <option value="Apr">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="Aug">August</option>
                <option value="Sep">September</option>
                <option value="Oct">October</option>
                <option value="Nov">November</option>
                <option value="Dec">December</option>
                                  </select>
            </p>
          </blockquote>
          </label>
        </p>
        <blockquote>
          <p class="style35">Exp Year</p>
        </blockquote>
        <p>
          <label>
          <blockquote>
            <p>
              <input name="year" type="text" id="year" size="6" placeholder="2018" />
            </p>
          </blockquote>
          </label>
        </p>
        <blockquote>
          <p class="style35">CVV</p>
        </blockquote>        <p class="style35">
        <label>
        <blockquote>
          <p>
            <input name="cvv" type="text" id="cvv" size="5" />
          </p>
        </blockquote>
        </label>
      </p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="1068" border="0" align="center">
    <tr>
      <td width="214">&nbsp;</td>
      <td width="394"><div align="right">
          <input name="next" type="button" class = "button" id="next" onclick="MM_goToURL('parent','pay success.php');return document.MM_returnValue"" value="COMPLETE PURCHASE" ;return document.mm_returnvalue="document.mm_returnvalue" />
      </div></td>
      <td width="446"><blockquote>
          <p>
            <input name="cancel" type="button" class = "button" id="cancel" onclick="MM_goToURL('parent','customer_menu.php');return document.MM_returnValue"" value="CANCEL" ;return document.mm_returnvalue="document.mm_returnvalue" />
          </p>
      </blockquote></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>

<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</body>
</html>
<?php
mysql_free_result($Pay);
?> 