<?php require_once('Connections/rabbitfarm.php'); ?><?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$colname_Customer_Menu = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Customer_Menu = $_SESSION['MM_Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_Customer_Menu = sprintf("SELECT * FROM tblcustomer WHERE Username = %s", GetSQLValueString($colname_Customer_Menu, "text"));
$Customer_Menu = mysql_query($query_Customer_Menu, $rabbitfarm) or die(mysql_error());
$row_Customer_Menu = mysql_fetch_assoc($Customer_Menu);
$totalRows_Customer_Menu = mysql_num_rows($Customer_Menu);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Menu</title>
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
.style26 {font-family: "Agency FB"}
.style28 {font-family: "Agency FB"; font-size: 32px; }


.button11:hover {
    opacity: 1 ;
    color: white;
}
.button11 {background-color:#6666CC;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
	font-family:: "Geneva";
	font-weight:bold;
    margin: 8px 4px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.3s;
	opacity: 0.8;
}

.style29 {font-family: "Agency FB"; font-size: 24px; }
.style30 {
	font-size: 27px
}
.style31 {
	font-size: 26px;
	font-weight: bold;
	font-style: italic;
}
-->
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<style type="text/css">
<!--
.button111 {background-color:#6666CC;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 24px;
	font-family:: "Geneva";
	font-weight:bold;
    margin: 8px 4px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.3s;
	opacity: 0.8;
}
.button112 {background-color:#6666CC;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
	font-family:: "Geneva";
	font-weight:bold;
    margin: 8px 4px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.3s;
	opacity: 0.8;
}
.button112:hover {
    opacity: 1 ;
    color: white;
}
.style32 {
	font-size: 24px
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
  <div align="center">
    <table width="40%" border="1" bordercolor="#66CCCC">
      <tr>
        <td><p align="center" class="style28"><img src="pic/CUST.png" width="276" height="205" /></p>
          <div align="center">
            <p><span class="style28 style31">Welcome <?php echo $row_Customer_Menu['Username']; ?>! </span>
                <?php $_SESSION["MM_Username"]; ?>
            </p>
          </div>
          <div align="center">
            <p>&nbsp;</p>
            <p>
              <input name="ticket" type="button" class="button112" id="ticket" onclick="MM_goToURL('parent','Cust_PurchaseTicket.php');return document.MM_returnValue" value="Buy Ticket Now" />
            </p>
            <p>
              <input name="view" type="button" class="button112" id="view" onclick="MM_goToURL('parent','View.php');return document.MM_returnValue" value="View Ticketing Details" />
            </p>
            <p class="style29"><a href="<?php echo $logoutAction ?>" class="style30">Log Out</a> </p>
        </div>          </td>
      </tr>
    </table>
  </div>
  <div align="center"></div>
  <p align="center">&nbsp;</p>
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
mysql_free_result($Customer_Menu);
?> 