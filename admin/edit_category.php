<?php
 ob_start();
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<?php
// Si la méthode de requête est GET
// Alors
//     Récupérer la valeur de catid
//     Si catid est vide
//         Alors
//             Rediriger vers category_list.php
//     Sinon
//         Récupérer la valeur de id

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $catid = $_GET['catid'];
    
}

if (!isset($_GET['catid']) || $_GET['catid'] == NULL ){
header('location:category_list.php');
}else{
    $id = $_GET['catid'];
    
}

?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <!--                Category update query-->
            <?php
            // Si la méthode de requête est POST
            // Alors
            //     Récupérer la valeur de name
            //     Si name est vide
            //         Alors
            //             Afficher un message d'erreur
            //         Sinon
            //             Mettre à jour la catégorie dans la table category
            //             Si la catégorie est mise à jour
            //                 Alors
            //                     Afficher un message de succès
            //                 Sinon
            //                     Afficher un message d'erreur
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $name = mysqli_real_escape_string($db->link, $name);
                if(empty($name)){
                    echo 'error';
                }else{
                    
                    $query = "UPDATE category SET name='$name' WHERE category_id=$id";
                    $update_cat =  $db->update($query);
                    if ($update_cat) {
                        echo "<span style='color:green;font-size:18px;'>Catégorie modifier avec succès</span>";
                    } else {
                        echo "<span style='color:red;font-size:18px;'>Catégorie non modifier</span>";
                    }                    
                }
                
            }
            ?>
            <!--                Show selected Category -->
            <?php
            // Récupérer les données de la table category
            // Tant que les données sont récupérées
            //     Afficher les données
            ?>
            <form method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" value="" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Modifier" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
// Inclure le fichier footer.php
include 'includes/footer.php';
ob_end_flush();
?>