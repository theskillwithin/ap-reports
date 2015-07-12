<?php
class MainClass{
	function addToReference($data){
		$one = $data["code"]; 
	//$two = $_POST["desc"];
	$three = $data["cost"];
	//$newwrite = $one . ",\"" . $two . "\"," . $three . "\n";
	$newline = "\n";
	$newwrite = array($one,$three);
	// echo "<p>";
	// print_r ($newwrite);
	// echo "</p>";
$fp = fopen('refrence.csv', 'a');

fputcsv($fp, $newwrite);
fclose($fp);
	}
	function refereceFile($file2){
		$column1 = array();
		$column3 = array();
		foreach ($file2 as $line2) {   //refrence file
			list($c1,$c3)=explode(",", $line2);    // should force 2?
			$c1 = strtolower($c1);
			$c3 = ltrim ($c3,'$');
			$c3 = intval($c3);
			$column1[] = $c1;
			$column3[] = $c3;
		}

		$data = array();
		$data['column1']=$column1;
		$data['column3']=$column3;
		return $data;
	}

	function displayData(){
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
if(@$_POST['csv']){
echo $_POST['csv'];
$file = file( $_POST['csv'] );
$file2 = file('refrence.csv');
$total = array();
$column1 = array();
$column2 = array();
$column3 = array();
$test = 0;
$data = $this->refereceFile($file2);
$column1 = $data['column1'];
$column3 =$data['column3'];
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
	}
}
}
