<?php
$output = "";
if(isset($_POST['submit'])){
  require_once "Proc/fileUploadProc.php";
  $crud= new fileUploadProc();
  $output = $crud->fileSet($_FILES['file']);
}
?>


<!doctype html>
<html lang="en">

<head>
  <title>Assignment 7</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
  <body>
      <h1>File Upload</h1>
        <form action="fileUpload.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <a href="https://russet-v8.wccnet.edu/~jdelany/CPS276/assignment7/listFiles.php">File List</a>
            <p><?php echo $output ?></p>
        </div>
        <div class="mb-3">
      		  <label for="user">File Name</label>
      		  <input type="text" class="form-control" name="fname" id="fname">
        </div>
        <div class="input-group mb-3">
            <input type="file" class="btn" id="file" name="file">
        </div>
         <div class="mb-3">
            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Upload File"/>
         </div>
        </form>
</html>