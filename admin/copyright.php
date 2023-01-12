<?php
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Mettre à jour le texte du droit d'auteur</h2>
        <!--   For update copyright media -->
        <?php

        // Si la méthode de requête est POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Alors
        //     Récupérer la valeur de copyright
            $copyright = $title = mysqli_real_escape_string($db->link,$_POST['copyright']);
            
        //     Si copyright est vide
            if(empty($copyright)){
                //Afficher un message d'erreur
                echo "Il n'y a pas de copyright";
            }
            else {
                //Mettre à jour le copyright dans la table footer
                $copyright_get = "UPDATE footer SET copyright='$copyright'";
                $copyright_update = $db->update($copyright_get);
                // Si le copyright est mis à jour
                if($copyright_update){
                    // Afficher un message de succès
                    echo "Copyright mis à jour";
                }
                else{
                    // Afficher un message d'erreur
                    echo "Erreur";
                }
            }
    }
        ?>

        <div class="block copyblock">
            <!--    For show social link from database-->
            <?php
            // Récupérer le copyright de la table footer
            $query = "SELECT * FROM footer";
            // Tant que le copyright est récupéré
            $copyright_query= $db->select($query);
            if($copyright_query){
                while($result=$copyright_query->fetch_assoc()){
                    $query="SELECT * FROM footer";
                    //     Afficher le copyright
                    echo $result['copyright'];
                }}
            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="" name="copyright" class="large" />
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
include "includes/footer.php";
?>