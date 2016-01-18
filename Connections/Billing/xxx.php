<?php
if (isset($_POST['choice']))
{
echo $_POST['choice'];
}
?>

<!DOCTYPE html>
<html>
<body onLoad="initFormEvents()"; "document.onmousemover= document.onkeypress= function()" style="background-color: #C0C0C0" topmargin="6" marginheight="6">
<form method="post" action="xxx.php" id="searchform" target="" autocomplete="off">

<!--
<input type="radio" name="choice" onChange="this.form.submit();"  onSelect="this.form.submit();" onClick="this.form.submit();" value="Yes" <?php if((isset($_POST['choice'])) && ($_POST['choice'] == 'Yes') ) {  print 'checked="checked"'; } ?> />Yes
<input type="radio" name="choice" onChange="this.form.submit();" onSelect="this.form.submit();" onClick="this.form.submit();" value="No" <?php if((isset($_POST['choice'])) && ($_POST['choice'] == 'No')) { print 'checked="checked"';} ?> />NO 
-->
<input  type="radio" name="choice" value="1" onClick="onselect="formSubmit();" onselect="formSubmit();"> YES
<input type="radio" name="choice" value="0" onClick="onselect="formSubmit();" onselect="formSubmit();">NO
<input type="submit" name="submit" value="submit">
</form>

</body>
</html>
