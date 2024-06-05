<?php
include 'connection.php';

$response = [];

try {
    // SQL-spørring for å hente brukernavn og poeng
    $result = $mysqli->query("SELECT brukernavn, poeng FROM hex_leaderboard ORDER BY poeng DESC");

    if (!$result) {
        throw new Exception($mysqli->error);
    } else {
        // Henter leaderboard-data
        $leaderboard = [];
        while ($row = $result->fetch_assoc()) {
            $leaderboard[] = $row;
        }
        $response = $leaderboard;
    }
} catch (Exception $e) {
    // Fanger eventuelle feil og legger til i responsen
    $response = ['error' => $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
