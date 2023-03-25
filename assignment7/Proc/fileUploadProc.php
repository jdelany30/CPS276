<?php

require 'PdoMethods.php';

class fileUploadProc extends PdoMethods {


    public function fileSet($info){
       if ($info['size'] > 100000){
            $warning = "File too big";
            return $warning;
        }
        elseif ($info["type"] != "application/pdf"){
            $warning = "Only file type pdf";
            return $warning;
        }
        $tmpPath = $info['tmp_name'];
        
        $pdo = new PdoMethods();

        $sql = "INSERT INTO files (fname, fpath) VALUES (:fname, :fpath)";
        $bindings = [
            [':fname',$_POST['fname'],'str'],
            [':fpath',$tmpPath,'str'],
        ];

        $result = $pdo->otherBinded($sql, $bindings);
        if(move_uploaded_file($info['tmp_name'], "/home/j/d/jdelany/public_html/CPS276/assignment7/files/" . $info['tmp_name'])){
            $warning = "File was added";
            return $warning;
        }
        else{
            $warning = "File could not be added";
            return $warning;
        }
        
    }

}





?>