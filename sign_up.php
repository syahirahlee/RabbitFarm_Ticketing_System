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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO tblcustomer (Username, Password, Name, IC_No, Contact_No, Email, UserType) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['IC_No'], "text"),
                       GetSQLValueString($_POST['Contact_No'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['UserType'], "text"));

  mysql_select_db($database_rabbitfarm, $rabbitfarm);
  $Result1 = mysql_query($insertSQL, $rabbitfarm) or die(mysql_error());

  $insertGoTo = "successSignUP.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up</title>
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

.button11:hover {
    opacity: 1 ;
    color: white;
}
.style53 {	font-size: 16px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.button11 {background-color:#6666CC;
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
.style61 {
	font-size: 22px;
	font-family: "Berlin Sans FB";
}
.style63 {color: #CC0066}
.style64 {
	font-size: 18px
}
.style65 {font-size: 36px}
.style66 {font-size: 23px}
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

<form action="<?php echo $editFormAction; ?>" id="form2" name="form2" method="POST">
  <div align="center"><span class="style28 style65">Sign Up Form</span>  </div>
  <p>&nbsp;</p>
  <table width="484" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td height="87" colspan="2"><div align="left" class="style61">
        <p class="style66">Please fill in the details:</p>
        <p class="style64"><span class="style63">*</span> Note : Do not insert  '-' </p>
      </div></td>
    </tr>
    <tr>
      <td width="150" height="59"><span class="style53 style64"> Username</span></td>
      <td width="299"><label>
        <input name="Username" type="text" class="style18" id="Username" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="49"><span class="style53 style64">Password</span></td>
      <td><label>
        <input name="Password" type="password" class="style18" id="Password" value="" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="44"><span class="style53 style64">Name</span></td>
      <td><label>
        <input name="Name" type="text" class="style18" id="Name" size="40" maxlength="40" />
      </label></td>
    </tr>
    <tr>
      <td height="50"><span class="style53 style64">IC no<span class="style63">*</span></span></td>
      <td><label>
        <input name="IC_No" type="text" class="style18" id="IC_No" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="49"><span class="style53 style64">Contact no<span class="style63">*</span></span></td>
      <td><label>
        <input name="Contact_No" type="text" class="style18" id="Contact_No" maxlength="10" />
      </label></td>
    </tr>
    <tr>
      <td height="45"><span class="style53 style64">Email</span></td>
      <td><label>
        <input name="Email" type="text" class="style18" id="Email" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="UserType" type="hidden" id="UserType" value="Customer" /></td>
    </tr>
    <tr>
      <td colspan="2"><label>
          <div align="center">
            <input type="submit" name="sign_up" id="sign_up" class="button11" value="SIGN UP" />
          </div>
        <div align="center"></div>
        </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center" class="style17 style26">&nbsp;</p>
  
    <input type="hidden" name="MM_insert" value="form2" />
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