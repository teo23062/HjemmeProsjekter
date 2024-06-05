<?php
session_start();

include 'connection.php';

if (isset($_SESSION['loggetinn']) && $_SESSION['loggetinn'] === true && isset($_POST['score'])) {
    $brukernavn = $_SESSION['brukernavn']; // Assuming you store the username in the session
    $score = $_POST['score'];

    $stmt = $mysqli->prepare("INSERT INTO hex_leaderboard (brukernavn, poeng) VALUES (?, ?)");
    $stmt->bind_param('si', $brukernavn, $score);

    if ($stmt->execute()) {
        $response = ['message' => 'Score saved successfully'];
    } else {
        $response = ['error' => 'Failed to save score'];
    }

    $stmt->close();
} else {
    $response = ['error' => 'Unauthorized access'];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
