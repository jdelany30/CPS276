<?php
    class AddNameProc{
        private $_arr=array();
        public function addClearNames(){
            if(isset($_POST['clearName'])){
                return "";
            }
            if(isset($_POST['addName'])){
                $visName= explode(" ",$_POST['visitorName']);
                $firstName=$visName[0];
                $lastName=$visName[1];
                $reLast=$lastName.", ".$firstName;
                $nList= explode("\n",$_POST['nameList']);
                $output= array_merge(array($reLast), $nList);
                sort($output);
                $str = implode("\n",$output);
                return $str;
            }
        }
    }
?>