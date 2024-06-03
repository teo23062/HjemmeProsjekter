<?php
// Include the database connection script
include 'connection.php';

// Fetch leaderboard data including username and score
$result = $mysqli->query("SELECT brukernavn, poeng FROM hex_leaderboard ORDER BY poeng DESC");

if (!$result) {
    // Handle query error
    $error = $mysqli->error;
    $response = ['error' => $error];
} else {
    // Fetch leaderboard data
    $leaderboard = [];
    while ($row = $result->fetch_assoc()) {
        $leaderboard[] = $row;
    }
    $response = $leaderboard;
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
