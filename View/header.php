<header class="container-fluid">
        <div class="row">
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-3">
                <div class="logo">
                    <a href="index.php?page=contacts"><img class="img-fluid" src="View/images/book.png" alt=""></a>
                </div>
            </div>
            <div class="title col-lg-5 col-md-10 col-sm-10 col-xs-9">
                <h1>Phonebook.com</h1>
                <div class="hello">
                    <?php
                    if (isset($_SESSION['logged_user'])) {
                        $username = $_SESSION['logged_user']['username'];
                        echo "Welcome, <a href='index.php?page=profile' class='username'>$username</a> to your phonebook!";
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <nav class="menu navbar navbar-expand-lg">
                    <ul>
                        <li><a href="index.php?page=profile" id="profile"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                        <li><a href="index.php?page=contacts" id="contacts"><i class="fas fa-address-book"></i> Contacts</a></li>
                        <li><a href="index.php?page=add-contact" id="add-contact"><i class="fa fa-address-card" aria-hidden="true"></i> Add</a></li>
                        <?php if (isset($_SESSION['logged_user'])){ ?>
                            <li id="logout" class="hide"><a href="index.php?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        <?php } else {?>
                            <li><a href="index.php?page=login" id="login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <?php }?>
                    </ul>


                </nav>
            </div>
        </div>
</header>
<script>
    $(document).ready(function () {
        var userId = "<?php if (isset($_SESSION['logged_user'])) {
            echo $_SESSION['logged_user']['id'];
        } else {
            false;
        }?>";
        userId = parseInt(userId);
        console.log(userId);
        var profile = $('#profile');
        var contacts = $('#contacts');
        var addContact = $('#add-contact');
        var login = $('#login');
        if (!<?php echo isset($_SESSION['logged_user']) ? 'true' : 'false'; ?>) {
            login.addClass('visited-link');
        }
        else {
            if (document.location.href.match(/[^\/]+$/)[0] === 'index.php?page=contacts') {
                contacts.addClass('visited-link');
            }
            else {
                contacts.removeClass('visited-link');
            }
            if (document.location.href.match(/[^\/]+$/)[0] === 'index.php?page=profile') {
                profile.addClass('visited-link');
            }
            else {
                profile.removeClass('visited-link');
            }
            if (document.location.href.match(/[^\/]+$/)[0] === 'index.php?page=add-contact') {
                addContact.addClass('visited-link');
            }
            else {
                addContact.removeClass('visited-link');
            }
        }
    });
</script>
