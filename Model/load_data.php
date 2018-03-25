<?php

const DB_NAME = 'phonebook';
const DB_IP = 'localhost';
const DB_PORT = '3306';
const DB_USER = 'root';


function getUserId($username, $password) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("SELECT user_id FROM users WHERE username = ? AND password = ?");
    $statement->execute(array($username, $password));
    $user_id = $statement->fetch();
    return $user_id;
}

function existsUser($username, $password) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? AND password = ?");
    $statement->execute(array($username, $password));
    $row = $statement->fetch(); // return first row of table
    return $row[0] > 0;
}

function registerUser($username, $password) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $statement->execute(array($username, $password));
//    existsUser($username, $password);
}

function getContacts($user_id) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $contacts = [];
    $cn = [];
    $statement = $pdo->prepare("SELECT contacts.contact_id, contacts.first_name, contacts.last_name, contacts.phone_number 
                                FROM contacts 
                                JOIN users ON users.user_id = contacts.user_id 
                                WHERE users.user_id = ? ORDER BY contacts.first_name");
    $statement->execute(array($user_id));
    foreach ($statement->fetchAll() as $contact) {
        $cn['contact_id'] = $contact['contact_id'];
        $cn['first_name'] = $contact['first_name'];
        $cn['last_name'] = $contact['last_name'];
        $cn['phone_number'] =  $contact['phone_number'];
        $contacts[] = $cn;
    }
    return $contacts;
}

function addContact($first_name, $last_name, $phone_number, $user_id) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("INSERT INTO contacts (first_name, last_name, phone_number, user_id) VALUES (?, ?, ?, ?)");
    $statement->execute(array($first_name, $last_name, $phone_number, $user_id));
}

function deleteContact($contact_id) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("DELETE FROM contacts WHERE contacts.contact_id = ?");
    $statement->execute(array($contact_id));
}

function editContact($first_name, $last_name, $phone_number, $contact_id) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("UPDATE contacts SET first_name = ?, last_name = ?, phone_number = ? WHERE contacts.contact_id = ?");
    $statement->execute(array($first_name, $last_name, $phone_number, $contact_id));
}

function getUserPassword($user_id) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("SELECT password FROM users WHERE user_id = ?");
    $statement->execute(array($user_id));
    $result = $statement->fetch();
    return $result[0];
}

function changePassword($new_password, $user_id) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("UPDATE users SET password = ? WHERE user_id = ?");
    $statement->execute(array($new_password, $user_id));
}

function searchUser($username) {
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute(array($username));
    $result = $statement->fetch();
    return $result;
}



