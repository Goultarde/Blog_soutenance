<?php
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Ajouter un nouveau post</h2>
        <?php
       

       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $title = mysqli_real_escape_string($db->link,$_POST['title']);
           $category_id = mysqli_real_escape_string($db->link,$_POST['category_id']);
           $author = mysqli_real_escape_string($db->link,$_POST['author']);
           $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
           $body = mysqli_real_escape_string($db->link,$_POST['body']);

           $permited = array('jpg', 'jpeg', 'png', 'gif');
           $file_name = $_FILES['image']['name'];
           $file_size = $_FILES['image']['size'];
           $file_temp = $_FILES['image']['tmp_name'];

           $div = explode('.', $file_name);
           $file_ext = strtolower(end($div));
           $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
           $uploaded_image = "uploads/" . $unique_image;


           if ($title == ''||$category_id == 'Select Category'|| $file_name == ''||$author == ''||$tags == ''||$body == '') {
            echo "<span style='color:red;front-size:18px;'>Les champs ne doivent pas être vide</span>";
        } elseif ($file_size > 1848567) {
            echo "<span class='error'>La taille de l'image doit être inférieur à 1 Mo! </span>";
        } elseif (in_array($file_ext, $permited) == false) {
            echo "<span class='error'>Vous ne pouvez telecharger que :-" . implode('.', $permited) . "</span>";
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO post(category_id, title, body, image, author, tags) VALUES ('$category_id','$title', '$body', '$uploaded_image', '$author', '$tags')";
            $inserted_rows = $db->crate($query);

            if ($inserted_rows) {
                echo "<span class='success'> Données crées avec succès. </span>";
            }else {
                echo "<span class= 'error'> Données non créées! </span>";
            }

        }


    }; 


        ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Entrez le titre du post" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category_id">
                                <option>Select Category </option>
                                
                                <?php
                                $query = "SELECT * FROM category";
                                $show_category = $db->select($query);
                                if ($show_category) {
                                    while ($result = $show_category->fetch_assoc()) {
                                ?>
                                        <option value="<?php echo $result['category_id'] ?>"><?php echo $result['name'] ?></option>
                                <?php };
                                } ?>
                                
                                <option value=""></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Télecharger une image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom de l'auteur</label>
                        </td>
                        <td>
                            <input type="text" name="author" placeholder="Entrez le nom de l'auteur." />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Entrez le tag ici ..." />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Sauvegarder" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<?php
// Inclure le fichier footer.php
?>