﻿<?php
include 'includes/header.php';
include 'includes/sidebar.php';
?>
<style>
    .left {
        float: left;
        width: 60%;
    }

    .right {
        float: left;
        width: 40%;
    }

    .right img {
        height: 140px;
        width: 150px;
    }
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Mettre a jour le titre et la description du site</h2>
        <!--            For Update website Title & Logo-->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $logo = $_POST['logo']; 
            if(empty($title)) {
                echo 'Il y a une erreur dans le titre';
            }else if (empty($logo)) {
                $query = "UPDATE title SET title='$title' WHERE id=1";
                $update_title =  $db->update($query);
                if ($sql){
                    echo "Mise à jour reussie";
                }else {
                    echo "Erreur";
                }
            } else {
                
            }
        }

        // Si la méthode de requête est POST
        // Alors
        //     Récupérer la valeur de title
        //     Récupérer la valeur de logo
        //     Si title est vide
        //         Alors
        //             Afficher un message d'erreur
        //         Sinon
        //             Si logo est vide
        //                 Alors
        //                     Mettre à jour le titre dans la table title_slogan
        //                     Si le titre est mis à jour
        //                         Alors
        //                             Afficher un message de succès
        //                         Sinon
        //                             Afficher un message d'erreur
        //                 Sinon
        //                     Si l'extension du logo est permise
        //                         Alors
        //                             Si la taille du logo est inférieure à 1 Mo
        //                                 Alors
        //                                     Déplacer le logo dans le dossier uploads
        //                                     Mettre à jour le titre et le logo dans la table title_slogan
        //                                     Si le titre et le logo sont mis à jour
        //                                         Alors
        //                                             Afficher un message de succès
        //                                         Sinon
        //                                             Afficher un message d'erreur
        //                                 Sinon
        //                                     Afficher un message d'erreur
        //                             Sinon
        //                                 Afficher un message d'erreur
        //                     Sinon
        //                         Afficher un message d'erreur
        ?>


        <!--               For show blog title  & logo from database-->
        <?php
        $sql = "SELECT * FROM title_slogan";
        // $result = mysqli_query($con, $sql);
        // if (mysqli_num_rows($result) > 0) {
        //     while($row = mysqli_fetch_assoc($result)) {
        //         echo "title: " . $row["title"]. " - slogan: " . $row["slogan"]. "<br>";
        //     }
        // }
        // Récupérer les données de la table title_slogan
        // Tant que les données sont récupérées
        //     Afficher les données
        ?>
        <div class="block sloginblock">
            <div class="left">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Titre du site Web</label>
                            </td>
                            <td>
                                <input type="text" value="" name="title" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Télécharger le logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Modifier" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="right">
                <img src="uploads/logo.png" alt="logo">
            </div>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php
include 'includes/footer.php';
?>