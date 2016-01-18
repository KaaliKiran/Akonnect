<!DOCTYPE html>
<html>
<body>
<form method="post" action="select.php?" id="searchform" target="" autocomplete="off">
<div id="office">
<select name="baroffice" onClick="onselect="formSubmit();" onselect="formSubmit();">
<option value="-1" selected="selected">- Select the Camera Model -</option>
			<?php
			$titleunit_name= "O'Fallon & Highway K&N";
			$cleantitleunit_name=addslashes("$titleunit_name");
			//echo "<option value=$cleantitleunit_name name= '$titleunit_name'>"; 
			
echo '<option  onselect="/formSubmit();/" value="' . htmlspecialchars($titleunit_name) . '" name="' . htmlspecialchars($titleunit_name) . '">"' . htmlspecialchars($titleunit_name) . '"</option>';
			
			?>

			
</select>

</div><br>
<br><Br>

<input type="radio" name="choice" onClick="this.form.submit();" value="Yes" <?php if((isset($_POST['choice'])) && ($_POST['choice'] == 'Yes') ) {  print 'checked="checked"'; } ?> />Yes

<input type="radio" name="choice" onClick="this.form.submit();" value="No" <?php if((isset($_POST['choice'])) && ($_POST['choice'] == 'No')) { print 'checked="checked"';} ?> />NO
<input type="submit" name="submit" value="submit">
<br><Br>
</form>

<?php
//$baroffice = str_replace("\'","'",($_POST['baroffice']));
if (isset($_POST['baroffice']))
{
//echo "baroffice=$baroffice<br>";
echo "titleunit_name=$titleunit_name<br>";
//echo "cleantitleunit_name=$cleantitleunit_name<br>";
}
else
{echo "";
};
?>
</body>
</html>
