<?php
$a=1;
$b=1;

$table= "<table border='1'>";

while ($a<16){
    $table.="<tr>";
    $b=0;
    while ($b<6){
        $table.="<td> row $a cell $b </td>";
        $b++;
    }
    $a++;
    $table.="</tr>";
}
$table.= "</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Part 3</title>
</head>
<body>
	<div id="wrapper">
        <p><?php echo $table ?></p>