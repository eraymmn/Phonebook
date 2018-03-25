<?php
// all DB
require_once "Model/load_data.php";
require_once "Controller/user_controller.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phonebook</title>
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="View/css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="View/css/main.css">
    <link rel="stylesheet" href="View/css/responsive.css">
    <script src="View/js/jquery-3.2.1.min.js"></script>
</head>

<body>
    <?php require_once "View/header.php"; ?>

    <div class="main-container">
        <div id="particles-js">
        <?php
        if(isset($error) && $error){
            if (isset($_POST['register'])) {
                echo "<div class='warning-box'>$error</div>";
                require_once 'View/register.php';
            }
            if (isset($_POST['login'])) {
                echo "<div class='warning-box'>$error</div>";
                require_once 'View/login.php';
            }
            if (isset($_POST['add-contact'])) {
                echo "<div class='warning-box'>$error</div>";
                require_once 'View/add-contact.php';
            }
            if (isset($_POST['edit-contact'])) {
                echo "<div class='warning-box'>$error</div>";
                require_once 'View/edit-contact.php';
            }
            if (isset($_POST['change_password'])) {
                echo "<div class='warning-box'>$error</div>";
                require_once "View/profile.php";
            }
        }
        elseif (isset($success) && $success) {
            echo "<div class='success-box'>$success</div>";
            require_once "View/profile.php";
        }
        elseif(isset($_GET["page"])) {
            $page_name = $_GET["page"];
            $page = htmlentities($_GET["page"]);
            if(isset($_SESSION["logged_user"])){
                require_once "View/$page.php";
            }
            elseif ($page === "register"){
                require_once "View/register.php";
            }
            else{
                require_once "View/login.php";
            }
        }
        else{
            if (isset($_SESSION["logged_user"])) {
                require_once "View/contacts.php";
            }
            else {
                require_once "View/login.php";
            }
        }
        ?>
        </div>
    </div>
    <?php require_once "View/footer.php";?>
</body>
</html>

<script src="View/js/particles.js"></script>
<script src="View/js/app.js"></script>
