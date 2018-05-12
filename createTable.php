<?php

include_once "./includes/connection.php";

$con = new DB_Handler();

echo json_encode($con->query("CREATE TABLE users(
                                            id VARCHAR(255) PRIMARY KEY ,
                                            name VARCHAR(255),
                                            surname VARCHAR(255),
                                            phone VARCHAR(255) NOT NULL,
                                            email VARCHAR(255),
                                            purchased_level INT DEFAULT 0,
                                            token VARCHAR(255)
                            )",true)
);
echo "\n";

echo json_encode($con->query("CREATE TABLE questions(
                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                            word VARCHAR(255),
                                            meaning VARCHAR(255),
                                            pronoun VARCHAR(255),
                                            level int DEFAULT 0       
                            )",true)
);
echo "\n";

echo json_encode($con->query("CREATE TABLE answers(
                                            id INT AUTO_INCREMENT PRIMARY KEY,
                                            qid INT,
                                            uid VARCHAR(255),
                                            stat CHAR DEFAULT 't',
                                            FOREIGN KEY (uid) REFERENCES users(id) ON DELETE CASCADE,
                                            FOREIGN KEY (qid) REFERENCES questions(id) ON DELETE CASCADE
                            )",true)
);
echo "\n";

echo json_encode($con->query("CREATE TABLE user_status(
                                            uid VARCHAR(255),
                                            true_quest INT DEFAULT 0,
                                            false_quest INT DEFAULT 0,
                                            last_quest INT DEFAULT 1,
                                            FOREIGN KEY (last_quest) REFERENCES questions(id) ON DELETE CASCADE,
                                            FOREIGN KEY (uid) REFERENCES users(id) ON DELETE CASCADE
                                             
                            )",true)
);
echo "\n";

