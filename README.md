php -S localhost:8000 -t public
http://localhost:8000/posts
----------------------


CREATE DATABASE blog;
USE blog;

CREATE TABLE posts (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-------------------------