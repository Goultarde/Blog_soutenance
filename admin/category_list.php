<?php
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php

        // Si la méthode de requête est GET
        if(isset($_GET['delid'])){
        //     Récupérer la valeur de delid
            $delid = $_GET['delid'];
            //     Supprimer la catégorie de la table category
            $delid_query = "DELETE FROM category WHERE category_id = '$delid'";
            $delete_data = $bd->delete($delid_query);
            //     Si la catégorie est supprimée
            if($delete_data){
                // Afficher un message de succès
                echo "Cette table n'existe plus";
            }
            else{
                // Afficher un message d'erreur
                echo "Table non supprimé";
            }
        }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>N. De série</th>
                        <th>Nom Catégorie</th>
                        <th>Action</th>
                    </tr>
                </thead> 
<tbody>
                <?php
                    // Récupérer toutes les catégories de la table category
                    $query="SELECT * FROM category";
                    // Tant que la catégorie est récupérée
                    $category= $db->select($query);
                    //     Afficher la catégorie
                if($category){
                    while($result=$category->fetch_assoc()){
                        $query="SELECT * FROM category";


                ?>
                    <tr class="odd gradeX">
                        <td><?=$result['category_id']?></td>
                        <td><?=$result['name']?></td>
                        <td><a href="edit_category.php?catid=<?php echo $result['category_id']; ?>">Modifier</a>
                            || <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer?')" href="delete_category.php?catid=<?php echo $result['category_id']; ?>">Supprimer</a></td>
                    </tr>
                    <?php }
                   } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>

<?php
// Inclure le fichier footer.php
include 'includes/footer.php'
?> 