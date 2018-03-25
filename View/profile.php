<section>
    <h1>Change password</h1>
    <form action="index.php" method="post" class="my-form">
        <input type="password" required name="old_password" id="old_password">
        <label>old password</label>
        <input type="password" required name="new_password" id="new_password">
        <label>new password</label>
        <input type="password" required name="confirm_password" id="confirmPassword">
        <label>confirm password</label>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['logged_user']['id']?>">
        <input type="submit" name="change_password" value="change" class="table-button">
    </form>
</section>
