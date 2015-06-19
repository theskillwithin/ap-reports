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


echo "<table class=\"table table-striped table-bordered\" id=\"thetable\">";
echo "<tr>";
echo "<th>Code</th> <th>Description</th> <th>Qty</th> <th>Cost</th> <th>Totals</th>";
echo "</tr>";

$files = glob("*.csv");
usort($files, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));

echo "<form action='cvsfilecompare.php' method='post'> <select name='csv'>";
foreach($files as $filepath) {
	if ($filepath != 'refrence.csv') {
  echo "<option value='" . $filepath . "'>" . $filepath . "</option>";
	}
}
echo "<input type='submit'>";
echo "</select> </form>";
echo "\n";
echo "Post value: ";
echo $_POST['csv'];

$file = file( $_POST['csv'] );

$file2 = file('refrence.csv');

$total = array();
$column1 = array();
$column2 = array();
$column3 = array();
$test = 0;

foreach ($file2 as $line2) {   //refrence file
			list($c1,$c3)=explode(",", $line2);    // should force 2?
			$c1 = strtolower($c1);
			$c3 = ltrim ($c3,'$');
			$c3 = intval($c3);

			$column1[] = $c1;
			$column3[] = $c3;
		}
foreach ($file as $line) {
	list($col1,$col2,$col3,$col4,$col5)=explode(",", $line);
	if (strpos($col3,'Free') OR strpos($col3,'FREE') !== false) {
		
		$col2 = strtolower($col2);

		$key = array_search($col2, $column1, true);
		if ($key == false) {
			$price = "none";
			$extend = "na";
		} else {
			$price = $column3[$key];
			$extend = $price*$col4;
		}

			if ($price == 0) {
				$class = "danger";
				$test++;
			} else {
				$class = "";
			}

echo "<tr>";
    	echo "<td class=\"$class\">$col2</td> <td class=\"$class\">$col3</td> <td class=\"$class\">$col4</td> <td class=\"$class\">$price</td> <td class=\"$class\">$extend</td>";
    	array_push($total, $extend);
echo "</tr>";

	}		 
}

if ($test == 0) {
	$class2 = "success";
} else {
	$class2 = "";
}

echo "<tr class=\"".$class2."\"><th colspan=\"5\" class=\"$class2\"> TOTAL: $";
echo array_sum($total);
echo "</th></tr>";
echo "</table>";
//print_r ($column1);
//print_r ($column3);


//  add to refrence file

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

	$one = $_POST["code"]; 
	//$two = $_POST["desc"];
	$three = $_POST["cost"];
	//$newwrite = $one . ",\"" . $two . "\"," . $three . "\n";
	$newline = "\n";
	$newwrite = array($one,$three);
	echo "<p>";
	print_r ($newwrite);
	echo "</p>";

$fp = fopen('refrence.csv', 'a');
fputcsv($fp, $newwrite);
fclose($fp);

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

