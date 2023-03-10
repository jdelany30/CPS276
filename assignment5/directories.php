<?php
class Directories{
    public function addNewFile(){
            if(isset($_POST['submit'])){
                if(isset($_POST['fileName'])){
                    $fname=($_POST['fileName']);
                    if(is_dir("directories/$fname")){
                        return "Directory with that name already exists";
                    }
                    $create = mkdir("directories/$fname", 0777, true);
                    if ($create){
                        chmod("directories/$fname", 0777);
                        $file = fopen("directories/$fname/readme.txt", "w");
                        $contents = ($_POST['fileContent']);
                        $rc = fwrite($file, $contents);
                        fclose($file);
                        if ($rc){
                            return "File and directory were successfully created.<br><a href='directories/$fname/readme.txt'>Path were file is located</a>";
                        }
                    }
                    else{
                        return "File Could Not Be Created";
                    }
                }
                else{
                    return "Direcory Could Not Be Created";
                }
        }
    
    }

}
?>