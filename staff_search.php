<?php require_once('Connections/rabbitfarm.php'); ?>
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

$colname_searching = "-1";
if (isset($_GET['Username'])) {
  $colname_searching = $_GET['Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_searching = sprintf("SELECT * FROM tblticket WHERE Username = %s", GetSQLValueString($colname_searching, "text"));
$searching = mysql_query($query_searching, $rabbitfarm) or die(mysql_error());
$row_searching = mysql_fetch_assoc($searching);
$totalRows_searching = mysql_num_rows($searching);

$colname_Update = "-1";
if (isset($_GET['Username'])) {
  $colname_Update = $_GET['Username'];
}
mysql_select_db($database_rabbitfarm, $rabbitfarm);
$query_Update = sprintf("SELECT * FROM tblticket WHERE Username = %s", GetSQLValueString($colname_Update, "text"));
$Update = mysql_query($query_Update, $rabbitfarm) or die(mysql_error());
$row_Update = mysql_fetch_assoc($Update);
$totalRows_Update = mysql_num_rows($Update);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Customer</title>
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
    opacity: 1;
    color: white;
}
.style63 {color: #CC0066}
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
    opacity: 1;
    color: white;
}
.style64 {font-size: 20px; }
.style18 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px; }

-->
</style>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

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
</head>

<body>
<form id="form1" name="form1" method="get">
  <table width="100%" border="0" bgcolor="#FFCC99">
    <tr>
      <td><blockquote>
          <p align="center"><span class="style2 style5"><span class="style9"><img src="pic/rabbit-153203_640.png" alt="" width="104" height="97" />SEARCH CUSTOMER TICKETING RECORD</span></span></p>
      </blockquote></td>
    </tr>
  </table>
  <p align="center" class="style2 style4">Please enter username:</p>
  <p align="center" class="style1 style2">
    <label>
    <input name="Username" type="text" id="Username" size="15" maxlength="12" />
    </label>
    <label>
    <input name="submit" type="submit" class="button" id="submit" value="ENTER" />
    </label>
  </p>
</form>
<form id="form2" name="form2" method="POST" onenter ="return false;">
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
                <blockquote>&nbsp;</blockquote>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
  <table width="482" border="0" align="center">
    <tr>
      <td height="34" colspan="2"><p class="style20">Customer information</p>
      </td>
    </tr>
    <tr>
      <td width="153" height="34"><span class="style18 style24 style21"> Username</span></td>
      <td width="319"><label><?php echo $row_Update['Username']; ?></label></td>
    </tr>
    
    <tr>
      <td height="34"><span class="style18 style24 style21">Name</span></td>
      <td><label><?php echo $row_Update['Name']; ?></label></td>
    </tr>
    <tr>
      <td height="33"><span class="style18 style24 style21">IC no<span class="style63">*</span></span></td>
      <td><label></label>
      <?php echo $row_Update['IC_No']; ?></td>
    </tr>
    
    <tr>
      <td height="33"><span class="style18 style24 style21">Contact no<span class="style63">*</span></span></td>
      <td><label></label>
      <?php echo $row_Update['Contact_No']; ?></td>
    </tr>
    <tr>
      <td height="34"><span class="style18 style24 style21">Email</span></td>
      <td><label></label>
      <?php echo $row_Update['Email']; ?></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><input name="Usertype" type="hidden" id="Usertype" value="<?php echo $row_Update['UserType']; ?>" /></td>
    </tr>
    <tr>
      <td height="42" colspan="2"><p class="style64">Ticketing information</p>      </td>
    </tr>
    <tr>
      <td height="34"><span class="style18 style21 style24">Date</span></td>
      <td><label></label>
      <?php echo $row_Update['Date']; ?></td>
    </tr>
    <tr>
      <td height="35"><span class="style18 style21 style24">Package type</span></td>
      <td><label></label>
      <?php echo $row_Update['PackageType']; ?></td>
    </tr>
    <tr>
      <td height="42"><span class="style18 style21 style24">Quantity</span></td>
      <td><?php echo $row_Update['Quantity']; ?></td>
    </tr>
    
    <tr>
      <td height="42" class="style26">Total price</td>
      <td><label><?php echo $row_Update['Total_price']; ?></label></td>
    </tr>
    <tr>
      <td height="30" class="style26">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td height="118" colspan="2"><label> </label>
          
        <div align="right"></div>        <div align="center">
          <input name="back" type="button" class="button" id="back" onclick="MM_goToURL('parent','staff_menu.php');return document.MM_returnValue" value="BACK TO MENU" />
          </div></td>
    </tr>
  </table>
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

mysql_free_result($Update);
?>