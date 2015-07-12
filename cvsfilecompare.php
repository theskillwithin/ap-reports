<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Free Gifts test FTW APP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet">
	<link href="cdn.datatables.net/1.10.0/js/jquery.dataTables.jss" rel="stylesheet">  
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div class="container">
<div class="row text-left">
<h1 class="text-center">Free Gifts Report</h1>

<?php
include "main.php";
$main = new MainClass();
$main->displayData();
if ( isset($_POST['code']) ) {
	$data = $_POST;
	$main->addToReference($data);
}
?>
</div>
<div class"row">
<h3>Add New Code</h3>
<p>
<form action="cvsfilecompare.php" method="post" class="form-inline">
<div class="form-group">
Code <input type="text" name="code">
</div>
<!-- <div class="form-group">
Description <input type="text" name="desc"> -->
</div>
<div class="form-group">
Cost $<input type="text" name="cost"> 
</div>
<input type='hidden' name='csv' value='<?php echo $_POST['csv']; ?>' />
<input type="submit" class="btn btn-default">
</form>
</p>
<h3>Download CSV</h3>
<p><input value="Export as CSV 1" type="button" onclick="$('#thetable').table2CSV()"></p>
<p>&nbsp;</p>
<p class="text-center">Baked By: Austin Peterson</p>
<p>&nbsp;</p>
</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="table2CSV.js" >
</script> 


  </body>
</html>
