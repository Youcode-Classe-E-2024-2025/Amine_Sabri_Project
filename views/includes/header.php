<header class="p-6 flex justify-between items-center shadow-lg ">
    <h1 class="text-2xl font-bold">TaskProjet</h1>
    <div class="flex space-x-2 items-center">
        <h2><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ' ' ?></h2>
        <div class="relative">
            <img id="img_menu" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" width="30px">
            <ul id="menu_navbar" class="absolute border-2 border-grey-400 right-[1px] top-14 w-28 p-2 hidden">
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
        header("Location: ../sign/signIn.html");
        exit(); 
    }
}
?>
