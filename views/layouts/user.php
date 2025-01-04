<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    include("../includes/header.php")
    ?>
</body>

<script>
    const menu_navbar = document.querySelector("#menu_navbar");
    const img_menu = document.querySelector("#img_menu");

    img_menu.addEventListener('click', function() {
            menu_navbar.classList.toggle("hidden");
        });
</script>
</html>