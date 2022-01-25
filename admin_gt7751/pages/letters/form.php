<?php if(!defined('db_name')) { header("Location: ../../"); exit(); die(); } ?>

<?php include "pages/__tools/lang_tabs.php"; ?>

<style>
    table.view, table.view th, table.view td {
        border: 1px solid black;
        padding: 10px;
    }
</style>

<form action="" method="post" enctype="multipart/form-data" class="<?php echo $hideForm?>">
    <table class="view">
        <thead>
            <tr>
                <th>Göndərən</th>
                <th>E-mail</th>
                <th>Başlıq</th>
                <th>Mətn</th>
                <th>Telefon</th>
                <th>Tarix</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $information["name"]; ?></td>
                <td><?php echo $information["email"]; ?></td>
                <td><?php echo $information["subject"]; ?></td>
                <td><?php echo $information["message"]; ?></td>
                <td><?php echo $information["phone"]; ?></td>
                <td><?php echo $information["datetime"]; ?></td>
            </tr>
        </tbody>
    </table>
	<hr />
</form>