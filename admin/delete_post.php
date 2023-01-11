<?php
// Inclure le fichier header.php
include 'includes/header.php';
// Inclure le fichier sidebar.php
include 'includes/sidebar.php';
?>

<?php
// Inclure la variable $db = new Database();
$db = new Database();
// Si la méthode de requête est GET
// Alors
//     Récupérer la valeur de del_postid
//     Si del_postid est vide
//         Alors
//             Rediriger vers post_list.php
//     Sinon
//         Récupérer la valeur de delete_id
//         Récupérer les données de la table post
//         Tant que les données sont récupérées
//             Récupérer la valeur de imglink
//             Supprimer l'image
//         Supprimer les données de la table post
//         Si les données sont supprimées
//             Alors
//                 Afficher un message de succès
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $del_postid = $_GET["del_postid"] ;
}
if (!isset($del_postid) || $del_postid == NULL ){
    header('location:category_list.php');
    }else{
        $del_postid = $_GET["del_postid"] ;
        
    }
?>


<?php
ob_start();
// Inclure le fichier header.php
include "includes/header.php";
// Inclure le fichier sidebar.php
include "includes/sidebar.php";
?>
<?php
$id = $_GET['catid'];
$query = "DELETE FROM category WHERE category_id=$id";
$delete_cat =  $db->delete($query);

?>
<?php
// Inclure le fichier footer.php
include 'includes/footer.php';
header('location:category_list.php');
ob_end_flush();
?>