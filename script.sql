CREATE DATABASE devhub;

USE devhub;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bio TEXT,
    email VARCHAR(255) NOT NULL UNIQUE,
    foto_perfil VARCHAR(255),
    nome VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    projeto_atual VARCHAR(255),
    username VARCHAR(255) NOT NULL UNIQUE
);


CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

/* OBS .    script ainda não implementados,  mais robusto e completo 
para criar a tabela posts para versão futura do projeto.

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bio TEXT,
    email VARCHAR(255) NOT NULL UNIQUE,
    foto_perfil VARCHAR(255),
    nome VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    projeto_atual VARCHAR(255),
    username VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    conteudo TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
*/

