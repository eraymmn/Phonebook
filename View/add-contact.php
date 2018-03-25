<section>
    <h1>Add contact</h1>
    <form action="index.php" method="post" class="my-form">
        <input type="text" required name="first_name">
        <label>first name</label>
        <input type="text" required name="last_name">
        <label>last name</label>
        <input type="text" required name="phone_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
        <label>phone number</label>
        <input type="submit" name="add-contact" value="add contact" class="table-button">
    </form>
</section>
