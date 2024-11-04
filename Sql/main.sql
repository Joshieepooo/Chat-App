CREATE DATABASE IF NOT EXISTS chat;
USE chat;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    unique_id INT NOT NULL UNIQUE,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    img VARCHAR(255),
    status VARCHAR(50) DEFAULT 'Offline now',
    last_chat TIMESTAMP NULL DEFAULT NULL,  -- Allow NULL values
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- Table for storing chat messages
CREATE TABLE IF NOT EXISTS messages (
    msg_id INT AUTO_INCREMENT PRIMARY KEY,
    incoming_msg_id INT NOT NULL,
    outgoing_msg_id INT NOT NULL,
    msg TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (incoming_msg_id) REFERENCES users(unique_id),
    FOREIGN KEY (outgoing_msg_id) REFERENCES users(unique_id)
);
