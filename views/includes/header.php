<header class="p-6 flex justify-between items-center shadow-lg">
    <h1 class="text-2xl font-bold">TaskProjet</h1>
    <?php 
    $userConect = $_SESSION["user_id"];
    $user = User::getUserParId($userConect);

    if ($user && $user['role_id'] == '1') { 
        echo '
        <nav>
            <ul class="flex space-x-5">
                <li><a href="/amine_Sabri_Project/views/layouts/admin.php">Home</a></li>
                <li><a href="/amine_Sabri_Project/views/chart.php">Statistique</a></li>
                <li><a href="/amine_Sabri_Project/views/layouts/manager.php">manager</a></li>
            </ul>
        </nav>';
    }
    ?>
    <div class="flex space-x-2 items-center">
        <h2><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ' ' ?></h2>
        <div class="relative">
            <img id="img_menu" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" width="30px">
            <ul id="menu_navbar" class="absolute border-2 border-grey-400 right-[1px] top-14 w-28 p-2 bg-white hidden">
                <li>My Profile</li>
                <form action="" method="POST">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </ul>
        </div>
    </div>
</header>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        session_destroy(); 
        session_unset(); 
        header("Location: /amine_Sabri_Project/views/sign/signIn.php");
        exit(); 
    }
}
?>


<script>
        const menu_navbar = document.querySelector("#menu_navbar");
        const img_menu = document.querySelector("#img_menu");
        const ModelProjet  = document.querySelector("#ModelProjet ");
        const buttonAddProjet  = document.querySelector("#buttonAddProjet");
        const closeModelProjet  = document.querySelector("#closeModelProjet");


        img_menu.addEventListener('click', function() {
            menu_navbar.classList.toggle("hidden");
        });
        closeModelProjet.addEventListener('click', function() {
            ModelProjet.classList.toggle("hidden");
        });
        buttonAddProjet.addEventListener('click', function() {
            ModelProjet.classList.toggle("hidden");
        });


    </script>