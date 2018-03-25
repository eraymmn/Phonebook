<?php
    $contacts = getContacts($_SESSION['logged_user']['id']);
?>
<section>
    <h1>My contacts</h1>
    <div>
        <form action="" class="my-form">
            <input type="text" id="myInput" required onkeyup="findContacts()">
            <label>Search contacts</label>
        </form>
    </div>
    <div class=>
        <table class="contacts table-dark" id="myTable">
            <thead>
            <tr class="header">
                <th><i class="fa fa-user" aria-hidden="true"></i> First name</th>
                <th><i class="fa fa-user" aria-hidden="true"></i> Last name</th>
                <th><i class="fa fa-phone" aria-hidden="true"></i> Phone number</th>
                <th><i class="fas fa-pencil-alt"></i> Edit</th>
                <th><i class="fa fa-trash" aria-hidden="true"></i> Delete</th>
            </tr>
            </thead>
            <tbody>
                <tr >
                <?php
                    foreach ($contacts as $contact) { ?>
                        <td data-label="First name:"><?= $contact['first_name'] ?></td>
                        <td data-label="Last Name:"><?= $contact['last_name'] ?></td>
                        <td data-label="Phone:"><?= $contact['phone_number'] ?></td>
                        <td data-label="">
                            <form action="index.php?contact_id">
                                <input type="hidden" value="<?= $contact['contact_id']?>" name="contact_id">
                                <input class="edit-button" type="submit" value="edit" name="edit">
                            </form>
                        </td>
                        <td data-label="" >
                            <form action="index.php" method="post">
                                <input type="hidden" value="<?= $contact['contact_id']?>" name="contact_id">
                                <input class="delete-button" type="submit" value="delete" name="delete-contact">
                            </form>
                        </td>
                </tr>
                    <?php }
                ?>
            </tbody>
        </table>
    </div>
</section>
</div>

<script>
    function findContacts() {
        var input, filter, table, tr, first_name, last_name, phone_number, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            first_name = tr[i].getElementsByTagName("td")[0];
            last_name = tr[i].getElementsByTagName("td")[1];
            phone_number = tr[i].getElementsByTagName("td")[2];
            if (first_name) {
                if (first_name.innerHTML.toUpperCase().indexOf(filter) > -1
                    || last_name.innerHTML.toUpperCase().indexOf(filter) > -1
                    || phone_number.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
