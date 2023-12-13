<?php
require "../controller/coachC.php";
require "../model/coach.php";
$coachC = new coachC();

if(!isset($_POST['tri'])){
  $listCoachs= $coachC->displaycoachs();}
  else{
   
  $listCoachs= $coachC->trisCoach($_POST["tri"]);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+icons+sharp">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link rel="stylesheet" href="../css/stylePanel.css">
<link rel="stylesheet" href="../css/achref.css">

<script src="../js/filter.js"></script>
</head>
<body>
<table border="1" id="myTable">

<thead>
    <th col-index=1>id Coach</th>

    <th col-index=2>nomCoach <br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>

    <th col-index=3>prenomCoach<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
    </th>

    <th col-index=4>tel<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>

    <th col-index=5>mail<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>

    <th col-index=6>specialite<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>
    <th col-index=7>experience<br>
        <select class="table-filter" onchange="filter_rows()">
            <option value="all"></option>
        </select>
    </th>
    <th >Détails
        
    </th>
    <th >Actions
        
        </th>


</thead>
<tbody>
<?php
for ($i = 0; $i < count($listCoachs); $i++) {
?>
<tr>
    <td><?= $listCoachs[$i]["idCoach"]; ?></td>
    <td><?= $listCoachs[$i]["nomCoach"]; ?></td>
    <td><?= $listCoachs[$i]["prenomCoach"]; ?></td>
    <td><?= $listCoachs[$i]["tel"]; ?></td>
    <td><?= $listCoachs[$i]["mail"]; ?></td>
    <td><?= $listCoachs[$i]["specialite"]; ?></td>
    <td><?= $listCoachs[$i]["experience"]; ?></td>
    <td><?= $listCoachs[$i]["details"]; ?></td>
    <td><button class="danger" onclick="removeCoach(<?= $listCoachs[$i]['idCoach']; ?>)">Supprimer</button>
    <button class="primary" onclick="updateCoach(<?= $listCoachs[$i]['idCoach']; ?>)">Update</button></td>
</tr>
<?php } ?>
</tbody>
</table>

</body>
</html>