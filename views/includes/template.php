<section class="container mx-auto flex flex-col md:flex-row justify-around md:items-start h-full">
        <div class="todo border-2 border-indigo-500 m-5 lg:w-full pb-4 flex flex-col items-center bg-white shadow-lg rounded-lg md:w-56 ">
            <div class="header-todo rounded-[5px,5px,5px] bg-indigo-500 text-white border-b-2 border-indigo-500 flex justify-between items-center w-full p-3">
                <p id="countTodo" class="font-bold w-7 border-2 border-white bg-white rounded-full text-center text-indigo-700">0</p>
                <h2 class="font-bold text-lg  text-white">TO DO</h2>
                <i class="bi bi-arrow-down-up font-bold  text-white"></i>
            </div>
            <div id="tache" class="tache w-full mt-6 px-3">
                <!-- todo -->
                <?php $tasks = Task::getAllTask(); ?>
                <?php if (!empty($tasks)): ?>
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['task_status'] === 'to_do'): // Vérifier si le statut est "to_do" ?>
                            <div class="task shadow-lg rounded-lg m-4 w-[300px] bg-gray-100 p-4 transition-transform duration-300 transform hover:scale-105">
                                <div class="header-tache border-b-2 border-gray-300 flex justify-between items-center pb-2">
                                    <i class="bi bi-pencil-square text-blue-600" aria-label="Edit task"></i>
                                    <h3 class="font-semibold text-xl text-gray-800 truncate">
                                        <?= htmlspecialchars($task['task_name']); ?>
                                    </h3>
                                    <i class="bi bi-trash text-red-600 cursor-pointer hover:text-red-800" aria-label="Delete task"></i>
                                </div>
                                <div class="status-tache mt-2 flex justify-between text-[10px]">
                                    <p class="border-2 text-center font-bold rounded-md px-2 border-red-500 text-red-500">
                                        <?= htmlspecialchars($task['task_status']); ?>
                                    </p>
                                    <p class="text-gray-600 break-words max-w-[365px] whitespace-normal">
                                        <strong>Category:</strong> <?= !empty($task['category_name']) ? htmlspecialchars($task['category_name']) : 'No category assigned'; ?>
                                    </p>
                                </div>
                                <div class="description-tache overflow-y-auto h-auto bg-gray-50 p-2 rounded-lg mt-2">
                                </div>
                                <div class="users mt-2 text-gray-600 flex justify-between">
                                    <p class="text-gray-600 break-words max-w-[365px] whitespace-normal text-[10px]">
                                        <strong>Tags:</strong> <?= !empty($task['tag_names']) ? htmlspecialchars($task['tag_names']) : 'No tags available'; ?>
                                    </p>
                                    <p class='text-[10px]'><strong>Users:</strong> 
                                        <?php 
                                            if (!empty($task['working_users'])) {
                                                $users = explode(',', $task['working_users']);
                                                $initials = array_map(function($user) {
                                                    $name_parts = explode(' ', trim($user));
                                                    $first_letter = strtoupper(substr($name_parts[0], 0, 1)); 
                                                    $last_letter = strtoupper(substr($name_parts[1], 0, 1));
                                                    return $first_letter . $last_letter;
                                                }, $users);
                                                echo htmlspecialchars(implode(', ', $initials));
                                            } else {
                                                echo 'No users assigned';
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-red-500 font-semibold">No tasks found or an error occurred.</p>
                <?php endif; ?>
            </div>

        </div>
    
        <div id="doing" class="todo border-2 border-yellow-500 m-5 lg:w-full pb-4 flex flex-col items-center bg-white shadow-lg rounded-lg md:w-56 ">
            <div class="header-todo bg-yellow-500 border-b-2 border-yellow-500 flex justify-between items-center w-full p-3">
                <p id="countDoing" class="font-bold w-7 border-2 border-yellow-500 rounded-full text-center bg-white text-yellow-500">0</p>
                <h2 class="font-bold text-lg text-white">DOING</h2>
                <i class="bi bi-arrow-down-up font-bold text-white"></i>
            </div>
            <div id="doingTasks" class="doing-tasks w-full mt-6 px-3">
                <div id="tache" class="tache w-full mt-6 px-3">
                    <!-- in_progress -->
                    <?php $tasks = Task::getAllTask(); ?>
                    <?php if (!empty($tasks)): ?>
                        <?php foreach ($tasks as $task): ?>
                            <?php if ($task['task_status'] === 'in_progress'): // Vérifier si le statut est "in_progress" ?>
                                <div class="task shadow-lg rounded-lg m-4 w-[300px] bg-gray-100 p-4 transition-transform duration-300 transform hover:scale-105">
                                    <div class="header-tache border-b-2 border-gray-300 flex justify-between items-center pb-2">
                                        <i class="bi bi-pencil-square text-blue-600" aria-label="Edit task"></i>
                                        <h3 class="font-semibold text-xl text-gray-800 truncate">
                                            <?= htmlspecialchars($task['task_name']); ?>
                                        </h3>
                                        <i class="bi bi-trash text-red-600 cursor-pointer hover:text-red-800" aria-label="Delete task"></i>
                                    </div>
                                    <div class="status-tache mt-2 flex justify-between text-[10px]">
                                        <p class="border-2 text-center font-bold rounded-md px-2 border-yellow-500 text-yellow-500">
                                            <?= htmlspecialchars($task['task_status']); ?>
                                        </p>
                                        <p class="text-gray-600 break-words max-w-[365px] whitespace-normal">
                                            <strong>Category:</strong> <?= !empty($task['category_name']) ? htmlspecialchars($task['category_name']) : 'No category assigned'; ?>
                                        </p>
                                    </div>
                                    <div class="description-tache overflow-y-auto h-auto bg-gray-50 p-2 rounded-lg mt-2">
                                    </div>
                                    <div class="users mt-2 text-gray-600 flex justify-between">
                                        <p class="text-gray-600 break-words max-w-[365px] whitespace-normal text-[10px]">
                                            <strong>Tags:</strong> <?= !empty($task['tag_names']) ? htmlspecialchars($task['tag_names']) : 'No tags available'; ?>
                                        </p>
                                        <p class='text-[10px]'><strong>Users:</strong> 
                                            <?php 
                                                if (!empty($task['working_users'])) {
                                                    $users = explode(',', $task['working_users']);
                                                    $initials = array_map(function($user) {
                                                        $name_parts = explode(' ', trim($user));
                                                        $first_letter = strtoupper(substr($name_parts[0], 0, 1)); 
                                                        $last_letter = strtoupper(substr($name_parts[1], 0, 1));
                                                        return $first_letter . $last_letter;
                                                    }, $users);
                                                    echo htmlspecialchars(implode(', ', $initials));
                                                } else {
                                                    echo 'No users assigned';
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-red-500 font-semibold">No tasks found or an error occurred.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    
        <div id="done" class="todo border-2 border-green-500 m-5 lg:w-full pb-4 flex flex-col items-center bg-white shadow-lg rounded-lg md:w-56 ">
            <div class="header-todo border-b-2 bg-green-500 border-green-500 flex justify-between items-center w-full p-3">
                <p id="countDone" class="font-bold w-7 border-2 bg-white border-green-500 rounded-full text-center text-green-500">0</p>
                <h2 class="font-bold text-lg text-white">DONE</h2>
                <i class="bi bi-arrow-down-up font-bold text-white"></i>
            </div>
            <div id="doneTasks" class="done-tasks w-full mt-6 px-3">
                <div id="tache" class="tache w-full mt-6 px-3">
                    <!-- done -->
                    <?php $tasks = Task::getAllTask(); ?>
                    <?php if (!empty($tasks)): ?>
                        <?php foreach ($tasks as $task): ?>
                            <?php if ($task['task_status'] === 'done'):  ?>
                                <div class="task shadow-lg rounded-lg m-4 w-[300px] bg-gray-100 p-4 transition-transform duration-300 transform hover:scale-105">
                                    <div class="header-tache border-b-2 border-gray-300 flex justify-between items-center pb-2">
                                        <i class="bi bi-pencil-square text-blue-600" aria-label="Edit task"></i>
                                        <h3 class="font-semibold text-xl text-gray-800 truncate">
                                            <?= htmlspecialchars($task['task_name']); ?>
                                        </h3>
                                        <i class="bi bi-trash text-red-600 cursor-pointer hover:text-red-800" aria-label="Delete task"></i>
                                    </div>
                                    <div class="status-tache mt-2 flex justify-between text-[10px]">
                                        <p class="border-2 text-center font-bold rounded-md px-2 border-green-500 text-green-500">
                                            <?= htmlspecialchars($task['task_status']); ?>
                                        </p>
                                        <p class="text-gray-600 break-words max-w-[365px] whitespace-normal">
                                            <strong>Category:</strong> <?= !empty($task['category_name']) ? htmlspecialchars($task['category_name']) : 'No category assigned'; ?>
                                        </p>
                                    </div>
                                    <div class="description-tache overflow-y-auto h-auto bg-gray-50 p-2 rounded-lg mt-2">
                                    </div>
                                    <div class="users mt-2 text-gray-600 flex justify-between">
                                        <p class="text-gray-600 break-words max-w-[365px] whitespace-normal text-[10px]">
                                            <strong>Tags:</strong> <?= !empty($task['tag_names']) ? htmlspecialchars($task['tag_names']) : 'No tags available'; ?>
                                        </p>
                                        <p class='text-[10px]'><strong>Users:</strong> 
                                            <?php 
                                                if (!empty($task['working_users'])) {
                                                    $users = explode(',', $task['working_users']);
                                                    $initials = array_map(function($user) {
                                                        $name_parts = explode(' ', trim($user));
                                                        $first_letter = strtoupper(substr($name_parts[0], 0, 1)); 
                                                        $last_letter = strtoupper(substr($name_parts[1], 0, 1));
                                                        return $first_letter . $last_letter;
                                                    }, $users);
                                                    echo htmlspecialchars(implode(', ', $initials));
                                                } else {
                                                    echo 'No users assigned';
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-red-500 font-semibold">No tasks found or an error occurred.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>