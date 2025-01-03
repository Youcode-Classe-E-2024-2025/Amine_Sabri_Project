<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<section class="container mx-auto flex flex-col md:flex-row justify-around md:items-start h-full">
        <div class="todo border-2 border-indigo-500 m-5 lg:w-full pb-4 flex flex-col items-center bg-white shadow-lg rounded-lg md:w-56 ">
            <div class="header-todo rounded-[5px,5px,5px] bg-indigo-500 text-white border-b-2 border-indigo-500 flex justify-between items-center w-full p-3">
                <p id="countTodo" class="font-bold w-7 border-2 border-white bg-white rounded-full text-center text-indigo-700">0</p>
                <h2 class="font-bold text-lg  text-white">TO DO</h2>
                <i class="bi bi-arrow-down-up font-bold  text-white"></i>
            </div>
            <div id="tache" class="tache w-full mt-6 px-3">
                <!-- todo -->
            </div>
        </div>
    
        <div id="doing" class="todo border-2 border-yellow-500 m-5 lg:w-full pb-4 flex flex-col items-center bg-white shadow-lg rounded-lg md:w-56 ">
            <div class="header-todo bg-yellow-500 border-b-2 border-yellow-500 flex justify-between items-center w-full p-3">
                <p id="countDoing" class="font-bold w-7 border-2 border-yellow-500 rounded-full text-center bg-white text-yellow-500">0</p>
                <h2 class="font-bold text-lg text-white">DOING</h2>
                <i class="bi bi-arrow-down-up font-bold text-white"></i>
            </div>
            <div id="doingTasks" class="doing-tasks w-full mt-6 px-3">
                <!-- doing -->
            </div>
        </div>
    
        <div id="done" class="todo border-2 border-green-500 m-5 lg:w-full pb-4 flex flex-col items-center bg-white shadow-lg rounded-lg md:w-56 ">
            <div class="header-todo border-b-2 bg-green-500 border-green-500 flex justify-between items-center w-full p-3">
                <p id="countDone" class="font-bold w-7 border-2 bg-white border-green-500 rounded-full text-center text-green-500">0</p>
                <h2 class="font-bold text-lg text-white">DONE</h2>
                <i class="bi bi-arrow-down-up font-bold text-white"></i>
            </div>
            <div id="doneTasks" class="done-tasks w-full mt-6 px-3">
                <!-- done -->
            </div>
        </div>
    </section>
</body>
</html>