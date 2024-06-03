<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loggut</title>
</head>
<body>

    <?php
    // Starter en PHP-sesjon
    session_start();

    // Ødelegger alle sesjonsdata
    session_destroy();

    // Omdirigerer brukeren tilbake til innloggingssiden eller hjemmesiden
    header("Location: index.php");
    exit();
    ?>
</body>
</html>