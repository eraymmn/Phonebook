<?php
    require_once './Model/data_for_edit.php';
?>

<section>
    <h1>Edit contact</h1>
    <form action="index.php?page=edit-contact&id=<?php echo $result['contact_id'] ?>" method="post" class="my-form">
        <input type="text" required name="first_name" id="firstName">
        <label>first name</label>
        <input type="text" required name="last_name" id="lastName">
        <label>last name</label>
        <input type="text" required name="phone_number" id="phoneNumber" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
        <label>phone number</label>
        <input type="hidden" name="contact_id" value="<?php echo $result['contact_id'] ?>">
        <input type="submit" name="edit-contact" value="edit" class="table-button">
    </form>
    <div class="result"></div>
</section>

<script>
    var first_name = "<?php echo $result['first_name']; ?>";
    var last_name = "<?php echo $result['last_name']; ?>";
    var phone_number = "<?php echo $result['phone_number']; ?>";

    $('#firstName').val(first_name);
    $('#lastName').val(last_name);
    $('#phoneNumber').val(phone_number);
</script>