<?php 

include ('database.php');

$obj = new query();

$condition_arr = ['name' => 'Mahedi', 'id'=>'1'];
// getting data from table
// $result = $obj->getData('user', '*',$condition_arr,'','','7');

// inserting data to table
$condition_arr_insert = ['name'=>'Sumit', 'email'=>'sumit@gmail.com', 'mobile'=>'01834388533'];
// $result = $obj->insertData('user', $condition_arr_insert);

// delete data from a table
// $obj->deleteData('user', $condition_arr);


// update column value in a table
$condition_arr_update = ['name'=>'Fatema', 'email'=>'fatema@gmail.com'];
$obj->updateData('user', $condition_arr_update, 'id', 2);

// echo '<pre>';

// print_r($result);

 ?>