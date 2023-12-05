<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="build/css/app.css">

</head>
<body>

    <?php 
    include_once __DIR__ ."/front/header.php";
    echo $contenido; 
    include_once __DIR__ ."/front/footer.php";
    
    ?>
    
    <?php 
    echo $script ?? '' ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>