<?php

include_once ('../controller/ordonnanceC.php');
$clientC = new ordonnancee();
$clientC->deleteordo($_GET["idordo"]);
header('Location:ListClients.php');


?>