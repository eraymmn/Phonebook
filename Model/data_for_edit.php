<?php
if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare("SELECT contacts.first_name, contacts.last_name, contacts.phone_number 
                                FROM contacts
                                WHERE contacts.contact_id = ?");
    $statement->execute(array($contact_id));
    $contact = $statement->fetchAll();
    $result = [];
    foreach ($contact as $c) {
        $result['contact_id'] = $contact_id;
        $result['first_name'] = $c['first_name'];
        $result['last_name'] = $c['last_name'];
        $result['phone_number'] = $c['phone_number'];
        break;
    }
}


