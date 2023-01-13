<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
    $msg_id = $_GET['msg_id'];
    if (empty($msg_id)) {
        header("Location: /inbox.php");
    } else {
        $id = $_GET['msg_id'];
    }
} else {
    header("Location: /inbox.php");
}
// si la méthode de requête est GET
// Alors
//     Récupérer la valeur de msg_id
//     Si msg_id est vide
//         Alors
//             Rediriger vers inbox.php
//     Sinon
//         Récupérer la valeur de id
// Sinon
//     Rediriger vers inbox.php
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Voir les messages</h2>
        <?php
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header("Location: /inbox.php");
         }
        // Si la méthode de requête est POST
        // Alors
        //     Rediriger vers inbox.php
        ?>
        <div class="block">
            <?php
            $query = ("SELECT * FROM contact WHERE id=$id");
            $result = $db->select($query);

            while($msg = $result->fetch_assoc()) {
                echo "Message : " . $msg["message"];
            
            // Selecter tous les messages de la table contact
            // Si le message est sélectionné
            // Alors
            //     Tant que le message est sélectionné
            //         Alors
            //             Afficher le message
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Nom</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $msg["name"] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $msg["email"] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sujet</label>
                        </td>
                        <td>
                            <input type="text" readonly value="<?php echo $msg["subject"] ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea style="width: 60%" readonly rows="12"><?php echo $msg["message"] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a href="inbox.php">Retour</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
}
?>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php
include 'includes/footer.php';
?>