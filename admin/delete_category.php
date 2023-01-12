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
ob_end_flush()
?>