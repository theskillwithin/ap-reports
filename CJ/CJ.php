<?php
$arr_one = array();
if (($fp = fopen("cjreport.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
    $arr_one[$data[0]] = $data;
  }
  fclose($fp);
}
$arr_two = array();
if (($fp = fopen("orders.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
    $arr_two[$data[0]] = $data;
  }
  fclose($fp);
}
$classes_field_count = sizeof(current($arr_two));
$members = array_keys($arr_one);
foreach ($members as $key) {
  if (!isset($arr_two[$key])) {
    $arr_two[$key] = range(0, ($classes_field_count - 1));
  }
  unset($arr_two[$key][0]);
  $result_arr[$key] = array_merge($arr_one[$key], $arr_two[$key]);      
}
if (($fp = fopen("output.csv", "w")) !== FALSE) {
  foreach ($result_arr as $fields) {
    fputcsv($fp, $fields, ',');
  }
  fclose($fp);
}

?>