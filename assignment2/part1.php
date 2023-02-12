<?php
$top=1;
$inden=1;
$list="<ul>";
for ($i=0; $i<4;$i++){
   $list.="<li> $top";
    $list.="<ul>";
    $top++;
    $inden=1;
    for ($j=0; $j<5 ;$j++){
    $list.="<li> $inden </li>";
    $inden++;
    }
    $list.="</li>";
    $list.="</ul>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Part 1</title>
</head>
<body>
	<div id="wrapper">
        <p><?php echo $list ?> </p>
