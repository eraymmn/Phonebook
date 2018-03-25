<?php
session_start(['cookie_httponly' => true]);

if(isset($_GET["page"]) && $_GET["page"] == "logout"){
    session_destroy();
    header("location:index.php?page=login");
    die();
}
if (isset($_POST['login'])) {
    $error = false;
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    $username = preg_replace('/\s+/', '', $username);
    $password = preg_replace('/\s+/', '', $password);
    if (empty($username) || empty($password) ) {
        $error = "All inputs are required! Please fill in them.";
    }
    elseif(!existsUser($username, sha1($password))) {
        $error = "Wrong username or password!";
    }
    if (!$error) {
        if (existsUser($username, sha1($password))) {
            $id = getUserId($username, sha1($password))['user_id'];
            $_SESSION['logged_user']['id'] = $id;
            $_SESSION['logged_user']['username'] = $username;
            header('location: index.php?page=contacts');
        }
    }
}
if (isset($_POST['register'])) {
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    $confirm_pass = htmlentities($_POST['confirm_pass']);


    $username = preg_replace('/\s+/', '', $username);
    $password = preg_replace('/\s+/', '', $password);
    $confirm_pass = preg_replace('/\s+/', '', $confirm_pass);
    $error = false;
    if (searchUser($username)) {
        $error = "Username already exists! Please try another.";
    }
    elseif(empty($username) || empty($password) || empty($confirm_pass)) {
        $error = "All inputs are required! Please fill in them.";
    }
    elseif($password !== $confirm_pass) {
        $error = "Passwords miss match!";
    }
    if (!$error) {
        registerUser($username, sha1($password));
        $id = getUserId($username, sha1($password))['user_id'];
        $_SESSION['logged_user']['id'] = $id;
        $_SESSION['logged_user']['username'] = $username;
        header('location: index.php?page=contacts');
    }

}
if (isset($_POST['add-contact'])) {
    $first_name = htmlentities($_POST['first_name']);
    $last_name = htmlentities($_POST['last_name']);
    $phone_number = htmlentities($_POST['phone_number']);

    $first_name = preg_replace('/\s+/', '', $first_name);
    $last_name = preg_replace('/\s+/', '', $last_name);
    $phone_number = preg_replace('/\s+/', '', $phone_number);
    $error = false;
    if (empty($first_name) || empty($last_name) || empty($phone_number)) {
        $error = "All inputs are required! Please fill in them.";
    }

    if (!$error) {
        $userId = $_SESSION['logged_user']['id'];
        addContact($first_name, $last_name, $phone_number, $userId);
        header('location: index.php?page=contacts');
    }
}
if (isset($_POST['delete-contact'])) {
    $contact_id = $_POST['contact_id'];
    deleteContact($contact_id);
    header('location: index.php?page=contacts');
}
if (isset($_GET['edit'])) {
    $contact_id = $_GET['contact_id'];
    header("location: index.php?page=edit-contact&id=$contact_id");
}
if (isset($_POST['edit-contact'])) {
    $contact_id = htmlentities($_POST['contact_id']);
    $first_name = htmlentities($_POST['first_name']);
    $last_name = htmlentities($_POST['last_name']);
    $phone_number = htmlentities($_POST['phone_number']);

    $first_name = preg_replace('/\s+/', '', $first_name);
    $last_name = preg_replace('/\s+/', '', $last_name);
    $phone_number = preg_replace('/\s+/', '', $phone_number);

    $error = false;
    if (empty($first_name) || empty($last_name) || empty($phone_number)) {
        $error = "All inputs are required! Please fill in them.";
    }

    if (!$error) {
        $userId = $_SESSION['logged_user']['id'];
        editContact($first_name, $last_name, $phone_number, $contact_id);
        header('location: index.php?page=contacts');
    }

}
if (isset($_POST['change_password'])) {
    $userId = htmlentities($_POST['user_id']);
    $oldPassword = htmlentities($_POST['old_password']);
    $newPassword = htmlentities($_POST['new_password']);
    $confirm_password = htmlentities($_POST['confirm_password']);

    $newPassword = preg_replace('/\s+/', '', $newPassword);
    $confirm_password = preg_replace('/\s+/', '', $confirm_password);

    $error = false;
    $success = false;
    $current_password = getUserPassword($userId);
    if ($current_password !== sha1($oldPassword)) {
        $error = "Old password entered is wrong! Please try again.";
    }
    elseif (empty($oldPassword) || empty($newPassword) || empty($confirm_password)) {
        $error = "All inputs are required! Please fill in them.";
    }
    elseif($newPassword !== $confirm_password) {
        $error = "The entered passwords do not match!";
    }

    if (!$error) {
        changePassword(sha1($newPassword), $userId);
        $success = "The password successfully changed!";
    }
}





