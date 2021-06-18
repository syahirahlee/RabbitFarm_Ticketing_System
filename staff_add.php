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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tblticket (Username, Name, IC_No, Contact_No, Email, UserType, `Date`, PackageType, Quantity, Total_price) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['IC_No'], "text"),
                       GetSQLValueString($_POST['Contact_No'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['UserType'], "text"),
                       GetSQLValueString($_POST['Date'], "date"),
                       GetSQLValueString($_POST['PackageType'], "text"),
                       GetSQLValueString($_POST['Quantity'], "double"),
                       GetSQLValueString($_POST['Total_price'], "double"));

  mysql_select_db($database_rabbitfarm, $rabbitfarm);
  $Result1 = mysql_query($insertSQL, $rabbitfarm) or die(mysql_error());

  $insertGoTo = "successful_staff.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Customer</title>
<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
body,td,th {
	font-family: Berlin Sans FB;
	font-size: 18px;
}
.style4 {
	font-family: "Agency FB";
	font-size: 34px;
	font-weight: bold;
}
.style18 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px; }
.style20 {font-size: 18px}

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
.style64 {font-size: 20px}
-->
</style>
<script type="text/javascript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

//reference for calculation
var theForm = document.forms["form1"];

var ticket_type= new Array();
 ticket_type["normal"]=8;
 ticket_type["school"]=40;

//This function finds the filling price based on the 
//drop down selection
function getTicketPrice()
{
    var TicketPrice=0;
    //Get a reference to the form id="form2"
    var theForm = document.forms["form1"];
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
    var theForm = document.forms["form1"];
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
    form1.Total_price.value = TotalPrice;

}
//-->
</script>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST" onenter ="return false;">
  <table width="100%" border="0" bgcolor="#FFCC99">
    <tr>
      <td><blockquote>
        <div align="center"><span class="style4"><img src="pic/rabbit-153203_640.png" width="104" height="97" />ADD CUSTOMER TICKETING RECORD</span></div>
      </blockquote>      </td>
    </tr>
  </table>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
                <p>&nbsp;</p>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
  <table width="525" border="0" align="center" cellpadding="5" cellspacing="5">
    <tr>
      <td height="34" colspan="2"><div align="left">
        <p class="style20"><span class="style63">*</span> Note : Do not insert  '-' </p>
        <p class="style64">Customer information</p>
      </div></td>
    </tr>
    <tr>
      <td width="125" height="34"><span class="style18"> Username</span></td>
      <td width="365"><label>
        <input name="Username" type="text" class="style18" id="Username" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="34"><span class="style18">Name</span></td>
      <td><label>
        <input name="Name" type="text" class="style18" id="Name" size="40" maxlength="40" />
      </label></td>
    </tr>
    <tr>
      <td height="33"><span class="style18">IC no<span class="style63">*</span></span></td>
      <td><label>
        <input name="IC_No" type="text" class="style18" id="IC_No" maxlength="12" />
      </label></td>
    </tr>
    <tr>
      <td height="33"><span class="style18">Contact no<span class="style63">*</span></span></td>
      <td><label>
        <input name="Contact_No" type="text" class="style18" id="Contact_No" maxlength="10" />
      </label></td>
    </tr>
    <tr>
      <td height="34"><span class="style18">Email</span></td>
      <td><label>
        <input name="Email" type="text" class="style18" id="Email" size="35" />
      </label></td>
    </tr>
    <tr>
      <td height="34">&nbsp;</td>
      <td><input name="UserType" type="hidden" id="UserType" value="Customer" /></td>
    </tr>
    <tr>
      <td height="34" colspan="2"><span class="style64">Ticketing information</span></td>
    </tr>
    <tr>
      <td><span class="style18 style21 style24">Date</span></td>
      <td><label>
      <input name="Date" type="date" class="style18" id="Date" />
      </label></td>
    </tr>
    <tr>
      <td><span class="style18 style21 style24">Package type</span></td>
      <td><label>
      <select name="PackageType" class="style18" id="PackageType">
        <option>Please Select type</option>
        <option value="normal">Normal (RM8)</option>
        <option value="school">School Package (RM40)</option>
      </select>
      </label></td>
    </tr>
    <tr>
      <td><span class="style18 style21 style24">Quantity</span></td>
      <td><label>
        <input name="Quantity" type="text" class="style18" id="Quantity" size="7" />
      </label></td>
    </tr>
    <tr>
      <td height="34" colspan="2"><p align="center"><span class="style20">
        <input name="enter" type="button" class="button121" id="enter"  value="ENTER" button="button"  onclick="calculateTotal()"/>
      </span></p>      </td>
    </tr>
    <tr>
      <td height="34"><span class="style18">Total price</span></td>
      <td><label>
        <input name="Total_price" type="text" class="style18" id="Total_price" size="7" />
      </label></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="44">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label>
        <div align="center">
          <input name="sign_up" type="submit" class="button" id="sign_up" value="ADD" />        
        </div>
      </label></td>
      <td>
        <div align="center">
          <input name="back" type="button" class="button" id="back" onclick="MM_goToURL('parent','staff_menu.php');return document.MM_returnValue" value="BACK TO MENU" />
        </div></td>
    </tr>
  </table>
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
  <p>
  <label></label></p>
  
  
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>
