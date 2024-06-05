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
                <th>Brukernavn</th>
                <th>Poeng</th>
            </tr>
        </thead>
        <tbody>
            <!-- Leaderboard-data vil bli satt inn her -->
        </tbody>
    </table>

    <script>
        // Funksjon for å hente og oppdatere leaderboard
        function updateLeaderboard() {
            fetch('get_leaderboard.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log data for debugging
                    const tbody = document.querySelector('#leaderboard tbody');
                    tbody.innerHTML = ''; // Tøm eksisterende rader

                    data.forEach(entry => {
                        const row = document.createElement('tr');
                        const usernameCell = document.createElement('td');
                        const scoreCell = document.createElement('td');
                        usernameCell.textContent = entry.brukernavn;
                        scoreCell.textContent = entry.poeng;
                        row.appendChild(usernameCell);
                        row.appendChild(scoreCell);
                        tbody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching leaderboard data:', error));
        }

        // Initial oppdatering
        updateLeaderboard();

        // Oppdater leaderboard hvert 5. minutt (300000 millisekunder)
        setInterval(updateLeaderboard, 300000);
    </script>
</body>
</html>
