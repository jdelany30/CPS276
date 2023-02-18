<?php

class Calculator{
    private $_firstnumber=0;
    private $_secondnumber=0;

    private function setFirst($first){
        $this->_firstnumber=$first;
    }

    private function setSecond($second){
        $this->_secondnumber=$second;
    }

    private function add(){
           $result=$this->_firstnumber + $this->_secondnumber;
        return "The sum of the numbers is $result <br>";
    }

    private function subtract(){
           $result=$this->_firstnumber - $this->_secondnumber;
        return "The difference of the numbers is $result <br>";
    }

    private function divide(){
        if ($this->_secondnumber == 0){
            return "Cannot Divide by Zero <br>";
        }
            $result=$this->_firstnumber / $this->_secondnumber;
            return "The division of the numbers is $result <br>";
    }

    private function multiply(){
            $result=$this->_firstnumber * $this->_secondnumber;
            return "The product of the numbers is $result <br>";
    }

    public function calc($operator="missing", $first="missing", $second="missing"){
        if(func_num_args() > 3){
            return "You must enter a string and two numbers (too many)<br>";
        }
        if ($second == "missing"){
            return "You must enter a string and two numbers (not enough)<br>";
        }
        if (gettype($first) != "integer"){
            return "You must enter a string and two numbers (not integer)<br>";
        }
        if (gettype($second) != "integer"){
            return "You must enter a string and two numbers (not integer)<br>";
        }
        $this->setFirst($first);
        $this->setSecond($second);
        switch($operator){
           case "+":
           $result=$this->add(); break;
           case "-":
           $result=$this->subtract(); break;
           case "*":
           $result=$this->multiply(); break;
           case "/":
           $result=$this->divide(); break;
           default:
           $result="You Must enter A valid Operator"; 
        }
     return $result;
    }
}
?>