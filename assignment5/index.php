<?php
$fname="";
$fString="";
$create="";
if(count($_POST) > 0){
  //$fString=($_POST('nameList'));
  //$fname=($_POST('fileName'));
  require_once 'directories.php';
  $addFile = new directories();
  $create = $addFile->addNewFile();
 }
 //mkdir("/home/j/d/jdelany/public_html/CPS276/assignment5/directories/test", 0777);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Directory Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
      <h1>File And Directory Assignment</h1>
      <p> Enter a folder name and the contents of a file. Folder names should contain alpha numeric charecters only.</p>
      <p><?php echo $create ?></p>
        <form action="index.php" method="post">
           <div class="mb-3">
      		  <label for="visitorName">File Name</label>
      		  <input type="text" class="form-control" name="fileName" id="fileName">
            </div>
            <label for="visitorName">File Contents</label>
         <textarea style="height: 500px;" class="form-control" id="fileContent" name="fileContent"></textarea>
         <div class="mb-3">
            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Submit"/>
         </div>
        </form>
</html>