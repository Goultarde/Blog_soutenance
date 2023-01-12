<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Ajouter une nouvelle catégorie</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                if (empty($name)) {
                    echo "<span style='color:red;font-size:18px;'>Le champ ne doit pas être vide</span>";
                } else {
                    $query = "INSERT INTO category (name) VALUES ('$name')";
                    $create_cat =  $db->crate($query);
                    if ($create_cat) {
                        echo "<span style='color:green;font-size:18px;'>Catégorie créée avec succès</span>";
                    } else {
                        echo "<span style='color:red;font-size:18px;'>Catégorie non créée</span>";
                    }
                }
            }
            ?>
            <form method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Entrez le nom de la catégorie..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Sauvegarder" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<?php