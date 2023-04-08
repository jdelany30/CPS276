<?php
require_once 'Proc/notesProc.php';
$dt = new noteProc();
$output = $dt->checkSubmit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <h1>Add Note</h1>
    </div>
    <div class="row mb-3">
        <a href="displayNote.php">Display Notes</a>
    </div>
        <h2><?php echo $output;?></h2>
    <form method="POST" action="#">
        <div class="mb-3">
            <label for="dataTime" class="form-label">Date and Time</label>
            <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea name="note" class="form-control" id="note" aria-describedby="note" rows="3" style="height: 300px"></textarea>
        </div>
        <div>
            <input class="btn btn-primary" type="submit" id="addNote" name="addNote" value="Add Note">
        </div>
    </form>
</body>
</html>