<?php
$referer = isset($_GET['referer']) ? $_GET['referer'] : 'admin.php';

$readmePath = __DIR__ . '/../../README.md';

if (file_exists($readmePath)) {
    $content = file_get_contents($readmePath);
} else {
    $content = "Le fichier README.md n'existe pas.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail sur Projet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold text-center mb-6">Détails du Projet</h1>
    
        <a href="<?php echo htmlspecialchars($referer); ?>" 
           class="bg-gradient-to-r from-red-400 via-orange-500 to-yellow-600 px-8 py-1 rounded-lg text-white font-bold mt-6 inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>

        </a>

    <div id="readme-content" class="mt-4 p-6 border border-gray-300 bg-gray-50 text-gray-700 rounded-lg shadow-md max-w-3xl mx-auto overflow-auto">
        <?php echo nl2br(htmlspecialchars($content)); ?>
    </div>
    
</body>
</html>
