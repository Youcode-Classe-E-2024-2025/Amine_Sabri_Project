<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Example Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="p-6 flex justify-between items-center shadow-lg">
        <h1 class=" text-2xl font-bold">TaskProjet</h1>
        <div class="flex space-x-2 items-center">
            <h2>Sabri Amine</h2>
            <div class= "relative">
                <img id="img_menu" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" width="30px">
                <ul id="menu_navbar" class = "absolute border-2 border-grey-400 right-[1px] top-14 w-28 p-2 hidden">
                    <li>My Profile</li>
                    <li>Logout</li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="container mx-auto p-6">

    </main>
    <script>
        const menu_navbar = document.querySelector("#menu_navbar");
        const img_menu = document.querySelector("#img_menu");

        img_menu.addEventListener('click', function() {
            menu_navbar.classList.toggle("hidden");
        });
    </script>
</body>
</html>
