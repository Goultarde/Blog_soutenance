<?php
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<?php
// Si la méthode de requête est GET
if (isset($_GET['edit_postid'])) {
// Alors
//     Récupérer la valeur de edit_postid
    $edit_postid = $_GET['edit_postid'];
//     Si edit_postid est vide
    if('del_postid' == ''){
//         Alors
//             Rediriger vers post_list.php
    header('post_list.php');
    }else{
//     Sinon
//         Récupérer la valeur de id
$edit_postid = $_GET['edit_postid'];
    }   
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Ajouter un nouveau post</h2>
        <?php
        // Si la méthode de requête est POST
        //     Récupérer la valeur de title
        //     Récupérer la valeur de category_id
        //     Récupérer la valeur de author
        //     Récupérer la valeur de tags
        //     Récupérer la valeur de body
        //     Récupérer la valeur de image

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
 
 
            if ($title == '') {
             echo "<span style='color:red;front-size:18px;'>Le champ ne doit pas être vide</span>";
         } if ($file_size == 0){
            $query = "UPDATE post SET title ='$title', category_id='$category_id', author='$author', tags='$tags', body='$body' WHERE id='$edit_postid'";
            $update_cat =  $db->update($query);
            if ($update_cat) {
                echo "<span style='color:green;font-size:18px;'>POST modifier avec succès</span>";
            } else {
                echo "<span style='color:red;font-size:18px;'>POST non modifier</span>";
            }     
         }else{
            if ($file_size > 1848567) {
                echo "<span class='error'>La taille de l'image doit être inférieur à 1 Mo! </span>";
            } elseif (in_array($file_ext, $permited) == false) {
                echo "<span class='error'>Vous ne pouvez telecharger que :-" . implode('.', $permited) . "</span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
   
   
                $query = "UPDATE post SET title ='$title', category_id='$category_id', image='$uploaded_image', author='$author', tags='$tags', body='$body' WHERE id='$edit_postid'";
                $update_cat =  $db->update($query);
                       if ($update_cat) {
                           echo "<span style='color:green;font-size:18px;'>POST modifier avec succès</span>";
                       } else {
                           echo "<span style='color:red;font-size:18px;'>POST non modifier</span>";
                       }     
    
            }
         }
        
       
    }
        ?>
        <div class="block">
            <?php
            
            $query="SELECT * FROM post WHERE id='$edit_postid'";
            $post= $db->select($query);
            $print = $post->fetch_assoc();
            
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $print['title'];?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Categories</label>
                        </td>
                        <td>
                            <select id="select" name="category_id">
                                <option>Selectionner une catégorie</option>
                                <?php
                                 $query = "SELECT * FROM category";
                                 $show_category = $db->select($query);
                                 if ($show_category) {
                                     while ($result = $show_category->fetch_assoc()) {
                                 ?>
                                         <option value="<?php echo $result['category_id'] ?>"><?php echo $result['name'] ?></option>
                                 <?php };
                                 }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Télécharger une image</label>
                        </td>
                        <td>
                            <img src="<?php echo $print['image'];?>" height="60px" width="100px" alt="">
                            <input type="file" name="image" value="<?php echo $print['image'];?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom de l'auteur</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $print['author'];?>" />
                            <td></td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $print['tags'];?>" />
                            <td></td>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Contenu</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?php echo $print['body'];?></textarea>
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
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php
// Inclure le fichier footer.php
include "includes/footer.php";
?>