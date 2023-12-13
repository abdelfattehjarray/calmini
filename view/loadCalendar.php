<?php

require_once "configagenda.php";


$data = array();
$sql = "SELECT * from agenda";
$db = configagenda::getConnexion();
$query = $db->prepare($sql);
$query->execute();

$result = $query->fetchAll();
foreach($result as $row) {
    $data[] = array(
        "id" => $row["id"],
        "title" => $row["title"],
        "start" => $row["start_coach"],
        "end" => $row["end_coach"]
    );
}
//json format
echo json_encode($data);
?>