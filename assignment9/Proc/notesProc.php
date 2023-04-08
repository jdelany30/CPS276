<?php

class noteProc{
    function checkSubmit()
    {
        if(isset($_POST["addNote"])){
            return $this->addNote();
        }
        elseif (isset($_POST["getNotes"])) {
            return $this->getNotes();
        }
    }

    function addNote()
    {
        require_once "Proc/PdoMethods.php";
        if(empty($_POST["dateTime"])){
            return "You must enter a date and time";
        }
        if(empty($_POST["note"])){
            return "You must enter a note";
        }
        $strTime = $_POST["dateTime"];
        $time = strtotime($strTime);
        $note = $_POST["note"];
        
        $pdo = new PdoMethods();

        $sql = "INSERT INTO note (date_time, note) VALUES (:date_time, :note);";
        $bindings = [
            [":date_time",$time,"int"],
            [":note",$note,"str"]
        ];

        if ($pdo->otherBinded($sql, $bindings) == "error")
        {
            return "Error uploading note.";
        }
        else
        {
            return "Note has been added.";
        }
    }

    function getNotes()
    {  
        require_once "Proc/PdoMethods.php";
        $output = '<table class="table  table-striped">
        <thead>
        <tr>
          <th scope="col">Date and Time</th>
          <th scope="col">Note</th>
        </tr>
      </thead>
      <tbody>';
        $begTime = strtotime($_POST["beginTime"]);
        $endTime = strtotime($_POST["endTime"]);
        $pdo = new PdoMethods();

        $sql = "SELECT date_time, note FROM note WHERE date_time between :begTime AND :endTime ORDER BY date_time DESC;";
        $bindings = [
            [":begTime",$begTime,"int"],
            [":endTime",$endTime,"int"]
        ];
        $records = $pdo->selectBinded($sql, $bindings);
        foreach($records as $row)
        {
            $output .= '<tr><td>';
            $output .= date("n/d/Y h:i a", $row["date_time"]);
            $output .= '</td><td>'.$row["note"].'</td></tr>';
        }
        $output .= "</tbody></table>";
        return $output;
    }
}
?>