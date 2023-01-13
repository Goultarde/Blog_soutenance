<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Boîte de réception</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Objet</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = ("SELECT id, name, email, subject FROM contact");
                    $result = $db->select($query);
                    while($msg = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $msg["name"] . "</td>";
                        echo "<td>" . $msg["email"] . "</td>";
                        echo "<td>" . $msg["subject"] . "</td>";
                        echo "<td><a href='view_message.php?msg_id=". $msg["id"] ."'>Voir</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


