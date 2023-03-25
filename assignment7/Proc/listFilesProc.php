<?php
require "Proc/PdoMethods.php";

function getNames($type){
		
    /* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
    $pdo = new PdoMethods();

    /* CREATE THE SQL */
    $fpath = "SELECT fpath FROM files";
    $fname = "SELECT fname FROM files";
    $sql = "SELECT * FROM files";
    $records = $pdo->selectNotBinded($sql);

    /* IF THERE WAS AN ERROR DISPLAY MESSAGE */
    if($records == 'error'){
        return 'There has been and error processing your request';
    }
    else {
        if(count($records) != 0){
            if($type == 'list'){return createList($records);}
        }

    }
}
	function createList($records){
		$list = '<ol>';
		foreach ($records as $row){
            $tmp1 = $row['fname'];
            $tmp2 = $row['fpath'];
            $list .= "<li><a href='https://russet-v8.wccnet.edu/~jdelany/CPS276/assignment7/files/$tmp2'>$tmp1</a></li>";
		}
		$list .= '</ol>';
		return $list;
    }


?>