<?php

 if(count($_POST) > 0){
  require_once 'AddNameProc.php';
  $addName = new AddNameProc();
  $output = $addName->addClearNames();
 }
//https://russet-v8.wccnet.edu/~jdelany/CPS276/assignment4/index.php
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flip Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
      <h1>Add Names</h1>
        <form action="index.php" method="post">
            <div class="mb-3">
              <input class="btn btn-primary" type="submit" name="addName" id="addName" value="Add Name" />   <!-- Name is added here -->
              <input class="btn btn-primary" type="submit" name="clearName" id="clearName" value="Clear Name"/> <!-- This will clear the whole textarea -->
            </div>
           <div class="mb-3">
      		   <label for="visitorName">Enter name</label>
      		   <input type="text" class="form-control" name="visitorName" id="visitorName">
            </div>
        <textarea style="height: 500px;" class="form-control" id="nameList" name="nameList"><?php echo $output ?></textarea> <!--Name is output here in reverse (last, first)-->
        </form>
</html>
