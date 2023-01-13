<?php
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
            $title = mysqli_real_escape_string($db->link,$_POST['title']);
 
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_temp = $_FILES['logo']['tmp_name'];
 
            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/" . $unique_image;

            if($title == '') {
                echo "<span class='error'>Le titre ne peut pas être vide</span>";
            } 
            else{
                if ($file_size == 0){
                    $query = "UPDATE title SET title='$title'";
                    $update_blog = $db->update($query);
                    echo "<span class='success'> titre crée avec succès. </span>";
                }
                else{
                    if ($file_size > 1848567) {
                        echo "<span class='error'>La taille de l'image doit être inférieur à 1 Mo! </span>";
                    } 
                    if($title == '') {
                        echo 'Il y a une erreur dans le titre';
                    }elseif (in_array($file_ext, $permited) == false) {
                        echo "<span class='error'>Vous ne pouvez telecharger que :-" . implode('.', $permited) . "</span>";
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE title SET title='$title', logo='$uploaded_image'";
                        $update_blog = $db->update($query);
            
                        if ($update_blog) {
                            echo "<span class='success'> Données crées avec succès. </span>";
                        }else {
                            echo "<span class= 'error'> Données non créées! </span>";
                        }
                        
                    }
                }
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
        // Récupérer les données de la table title_slogan
        // Tant que les données sont récupérées
        //     Afficher les données
        ?>
        <?php
                $query = "SELECT * FROM title WHERE id='1'";
                $title = $db->select($query);
                if ($title) {
                    $logo = $title->fetch_assoc();
                }

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
                <img src="<?php echo $logo['logo'] ?>" alt="Logo" />
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