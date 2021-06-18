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
?><?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "UserType";
  $MM_redirectLoginSuccess = "staff_menu.php";
  $MM_redirectLoginFailed = "sorry.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_rabbitfarm, $rabbitfarm);
  	
  $LoginRS__query=sprintf("SELECT Username, Password, UserType FROM tblcustomer WHERE Username=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $rabbitfarm) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'UserType');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>login</title>
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

.button1 {      background-color:#6666CC;
    border: none;
    color: white;
    padding: 8px 40px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 24px;
	font-family:"Agency FB";
	font-weight:bold;
    margin: 10px 4px;
    cursor: pointer;
    border-radius: 8px;
    transition-duration: 0.3s;
	opacity: 0.8;
}

.button1:hover {
    opacity: 1 ;
    color: white;
}
.style52 {font-family: "Agency FB"; font-size: 14px; }
.style53 {	font-size: 16px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style54 {color: #990033}
.style55 {color: #262626}
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
.style56 {font-size: 34px}
.style57 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 18px;
}
.style58 {font-size: 18px}
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

<form id="form2" name="form2" method="POST" action="<?php echo $loginFormAction; ?>">
  <div align="center"><span class="style28 style56">Login Form</span>  </div>
  <p>&nbsp;</p>
  <table width="30%" border="0" align="center">
    <tr>
      <td width="33%" height="43"><p class="style57"><span class="style16">Username</span> :</p></td>
      <td width="67%"><label>
        <input name="Username" type="text" class="style18" id="Username" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="41" class="style14 style58">Password :</td>
      <td><label>
        <input name="Password" type="password" class="style18" id="Password" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td colspan="2"><p>&nbsp;</p>
          <p align="center">
            <input type="submit" name="sign_in" id="sign_in" class="button1" value="SIGN IN" />
      </p></td>
    </tr>
  </table>
  <p align="center" class="style17 style26">&nbsp;</p>
  <p align="center"><span class="style52"><span class="style53">Don't have an account? Sign up<span class="style55"> <a href="sign_up.php" class="style54">here</a></span></span><span class="style55">.</span></span></p>
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