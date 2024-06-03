<?php
// Starter en PHP-sesjon hvis du har behov for sesjonsdata (ikke nødvendig for kun å vise leaderboard)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Live Leaderboard</h2>
    <table id="leaderboard">
        <thead>
            <tr>
                <th>Username</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <!-- Leaderboard data will be inserted here -->
        </tbody>
    </table>

    <script>
        // Function to fetch and update the leaderboard
        function updateLeaderboard() {
            fetch('get_leaderboard.php')
            .then(response => response.json())
            .then(data => {

                const tbody = document.querySelector('#leaderboard tbody');
                tbody.innerHTML = ''; // Clear existing rows

                data.forEach(entry => {
                    const row = document.createElement('tr');
                    const usernameCell = document.createElement('td');
                    const scoreCell = document.createElement('td');
                    usernameCell.textContent = entry.brukernavn; // Kontroller at dette er riktig nøkkelnavn
                    scoreCell.textContent = entry.poeng; // Kontroller at dette er riktig nøkkelnavn
                    row.appendChild(usernameCell);
                    row.appendChild(scoreCell);
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching leaderboard data:', error));

        }

        updateLeaderboard();

        setInterval(updateLeaderboard, 1);
    </script>
</body>
</html>
