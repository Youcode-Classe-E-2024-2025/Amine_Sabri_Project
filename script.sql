create DATABASE projetTask;

use projetTask
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('chief', 'user', 'guest') DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    created_by INT,
    visibility ENUM('public', 'private'),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);



CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    name VARCHAR(255),
    status ENUM('to_do', 'in_progress', 'done'),
    assigned_to INT,
    category VARCHAR(250),
    tags ENUM('urgent', 'bug', 'feature'),  
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);



CREATE TABLE project_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (project_id) REFERENCES projects(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE User_task (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (task_id) REFERENCES tasks(id)
);




INSERT INTO users (name, email, password) 
VALUES 
('Amine Sanraj', 'amine@example.com', 'password123'),
('John Doe', 'john.doe@example.com', 'password456'),
('Jane Smith', 'jane.smith@example.com', 'password789');



INSERT INTO projects (name, description, created_by, visibility) 
VALUES 
('Project Alpha', 'This is the first project.', 1, 'public'),
('Project Beta', 'This is a private project.', 2, 'private');


INSERT INTO tasks (project_id, name, status, assigned_to, category, tags) 
VALUES 
(1, 'Task 1 for Alpha', 'to_do', 2, 'Development', 'feature'),
(1, 'Task 2 for Alpha', 'in_progress', 3, 'Design', 'bug'),
(2, 'Task 1 for Beta', 'done', 2, 'Testing', 'urgent');


INSERT INTO project_user (project_id, user_id) 
VALUES 
(1, 1),  -- Amine dans Project Alpha
(1, 2),  -- John dans Project Alpha
(2, 2),  -- John dans Project Beta
(2, 3);  -- Jane dans Project Beta


INSERT INTO User_task (user_id, task_id) 
VALUES 
(2, 1),  -- John pour Task 1 for Alpha
(3, 2),  -- Jane pour Task 2 for Alpha
(2, 3);  -- John pour Task 1 for Beta
