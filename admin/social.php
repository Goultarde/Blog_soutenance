<?php
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Mettre à jour les médias sociaux</h2>
        <!--   For update social media -->
        <?php
        // Si la méthode de requête est POST
        // Alors
        //     Récupérer la valeur de facebook
        //     Récupérer la valeur de github
        //     Récupérer la valeur de skype
        //     Récupérer la valeur de linkedin
        //     Récupérer la valeur de google
        //     Si facebook, github, skype, linkedin ou google est vide
        //         Alors
        //             Afficher un message d'erreur
        //         Sinon
        //             Mettre à jour les médias sociaux dans la table tbl_social
        //             Si les médias sociaux sont mis à jour
        //                 Alors
        //                     Afficher un message de succès
        //                 Sinon
        //                     Afficher un message d'erreur
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $facebook = mysqli_real_escape_string($db->link,$_POST['facebook']);
            $github = mysqli_real_escape_string($db->link,$_POST['github']);
            $skype = mysqli_real_escape_string($db->link,$_POST['skype']);
            $linkedin = mysqli_real_escape_string($db->link,$_POST['linkedin']);
            $google = mysqli_real_escape_string($db->link,$_POST['google']);
            
            if (empty($facebook)) {
                echo "<span style='color:red;font-size:18px;'>Le champ ne doit pas être vide</span>";
            }elseif(empty($github)){
                echo "<span style='color:red;font-size:18px;'>Le champ ne doit pas être vide</span>";
            }elseif(empty($skype)){
                echo "<span style='color:red;font-size:18px;'>Le champ ne doit pas être vide</span>";
            }elseif(empty($linkedin)){
                echo "<span style='color:red;font-size:18px;'>Le champ ne doit pas être vide</span>";
            }elseif(empty($google)){
                echo "<span style='color:red;font-size:18px;'>Le champ ne doit pas être vide</span>";
            } else{
                    
                $query = "UPDATE social SET facebook='$facebook', github='$github' ,skype='$skype', linkedin='$linkedin', google='$google'";
                $update_social =  $db->update($query);
                if ($update_social) {
                    echo "<span style='color:green;font-size:18px;'>réseau ajouter</span>";
                } else {
                    echo "<span style='color:red;font-size:18px;'>réseau non modifier</span>";
                }                    
            }
        }
        ?>

        <div class="block">
            <!--     For show social link from database-->
            <?php
            // Récupérer les données de la table tbl_social
            // Tant que les données sont récupérées
            //     Afficher les données
            // Récupérer les données de la table post
            // Tant que les données sont récupérées
            //     Afficher les données
            $query = "SELECT * FROM social";
            $list = $db->select($query);
            $result = $list->fetch_assoc()
                    ?>
                    
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input type="text" name="facebook" value="<?php echo $result['facebook'];?>" class="medium"/>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Github</label>
                        </td>
                        <td>
                            <input type="text" name="github" value="<?php echo $result['github'];?>" class=" medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Skype</label>
                        </td>
                        <td>
                            <input type="text" name="skype" value="<?php echo $result['skype'];?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>LinkedIn</label>
                        </td>
                        <td>
                            <input type="text" name="linkedin" value="<?php echo $result['linkedin'];?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Google </label>
                        </td>
                        <td>
                            <input type="text" name="google" value="<?php echo $result['google'];?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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
include "includes/footer.php"
?>