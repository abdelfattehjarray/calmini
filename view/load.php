<?php
include_once ('../controller/rendez_vousC.php');
session_start();

//load.php

$dsn = 'mysql:host=localhost;dbname=projet';
$username = 'root';
$password = '';

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$data = array();

// Récupérer l'ID client connecté depuis la session
$id = $_SESSION['idUser'];
var_dump($_POST);
if (isset($_SESSION['idUser'])) {
    $id = $_SESSION['idUser'];

    // Requête SQL pour sélectionner les rendez-vous du client connecté
    $query = "SELECT r.id, r.calendrier, CONCAT(d.prenomcoach, ' ', d.nomcoach) AS nomcoach
    FROM l_rendezvous r
    INNER JOIN coach d ON r.id_doc = d.idcoach
    WHERE r.id_user=:id_user
    ORDER BY r.id";
$statement = $db->prepare($query);
$statement->bindValue(':id_user', $id);
$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
$data[] = array(
  'id' => $row["id"],
  'start' => $row["calendrier"],
  'title' => $row["nom_doctor"] // Ajouter le nom de docteur à la variable $data
);
    }

    echo json_encode($data);
}