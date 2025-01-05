<?php
$getId = $_GET['id'];
$getId_projet = $_GET['id_project'];
// var_dump($getId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Update Task Status</h2>
        <form action="http://localhost/amine_Sabri_Project/index.php?action=updateTaskStatus" method="POST">
            <input type="hidden" name="taskId" value="<?php echo $getId?>">
            <input type="hidden" name="id_projet" value="<?php echo $getId_projet?>">

            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">New Status</label>
                <select id="status" name="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="to_do">Todo</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">done</option>
                </select>
            </div>
            
            <button type="submit"
                class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Update Status
            </button>
        </form>
    </div>
</body>
</html>
