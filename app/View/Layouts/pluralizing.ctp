<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script> 
<?php // echo $this->fetch('script');***instead of using fetch to get the script from we can include any script here with above script syntax to include the jquery?>
<script type="text/javascript">
	$(document).ready(function () {
		alert('JQuery is succesfully included');
	});
</script>
</head>
<body>
<?php echo $this->fetch('content'); ?>
<?php  echo $this->Js->writeBuffer(); //****this is very important, it will print all the 
//javascript prepared by cakePHP here, without this statement, javascript prepared by cakePHP
//will not be available in user browser?>
</body>
</html>