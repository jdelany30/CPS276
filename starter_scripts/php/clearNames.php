<?php
require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "TRUNCATE TABLE names;";
$records = $pdo->otherNotBinded($sql);

if($records === "error"){
    $response = (object)[
        "masterstatus" => "error",
        "msg" => "Could not delete names from database"
    ];
    echo json_encode($response);
}
else {
    $response = (object)[
        "masterstatus" => "success",
        "msg" => "All names were deleted"
    ];
    echo json_encode($response);
}
?>