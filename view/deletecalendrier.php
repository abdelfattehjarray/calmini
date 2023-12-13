<?php
include_once ('../controller/rendez_vousC.php');

// Vérifier si l'ID du rendez-vous a été envoyé via POST
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=projetwb';
    $username = 'root';
    $password = '';
    $pdo = new PDO($dsn, $username, $password);

    // Requête SQL pour supprimer le rendez-vous
    $query = "DELETE FROM l_rendezvous WHERE id=:id";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id);
    $result = $statement->execute();

    // Vérifier si la suppression a réussi
    if($result) {
        $response = array('status' => 'success', 'message' => 'Le rendez-vous a été supprimé.');
    } else {
        $response = array('status' => 'error', 'message' => 'Une erreur s\'est produite lors de la suppression du rendez-vous.');
    }

    // Retourner la réponse au format JSON
    echo json_encode($response);
}