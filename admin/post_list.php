<?php
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">SL No</th>
                        <th width="13%">Titre du post</th>
                        <th width="25%">Description</th>
                        <th width="10%">Categorie</th>
                        <th width="10%">Image</th>
                        <th width="10%">Autheur</th>
                        <th width="5%">Tags</th>
                        <th width="10%">Date</th>
                        <th width="12%"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM post";
                    $query2 = "SELECT * FROM category ";
                    $list = $db->crate($query);
                    $list2 = $db->crate($query2);
                    $i = 0;
                    while ($result = $list->fetch_assoc() and $result2 = $list2->fetch_assoc() ){ 
                        //     Afficher la catégorie
                        $i ++;
                        
                     
                       


                    
                    // Récupérer les données de la table post
                    // Tant que les données sont récupérées
                    //     Afficher les données
                    echo $result['image']
                    ?>
                    <tr class="odd gradeX">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['title'];?></td>
                        <td><?php echo $result['body'];?></td>
                        <td><?php echo $result2['name'];?></td>
                        <td><img src="<?php echo $result['image']?>" height="40px" width="80px" alt=""></td>
                        <td><?php echo $result['author'];?></td>
                        <td><?php echo $result['tags'];?></td>
                        <td><?php echo $result['date'];?></td>
                        <td><a href="edit_post.php?edit_postid=">Modifier</a>
                            || <a onclick="return confirm('Etes vous sur de vouloir supprimer ?')" href="delete_post.php?del_postid=">Supprimer</a></td>
                    </tr>
                    <?php
                    
                    }
                    ?>
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