<?php
ob_start();
// Inclure le fichier header.php
include_once "includes/header.php";
// Inclure le fichier sidebar.php
include_once "includes/sidebar.php";
?>

<?php
// Inclure la variable $db = new Database();
$db = new Database();


// Si la méthode de requête est GET
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
// Alors
//     Récupérer la valeur de del_postid
$del_postid = $_GET['del_postid'];
//     Si del_postid est vide
    if(empty($del_postid)){
//         Alors
//             Rediriger vers post_list.php*
        header('post_list.php');
    }
//     Sinon
    else {
//         Récupérer la valeur de delete_id
$del_postid = $_GET['del_postid'];

//         Récupérer les données de la table post
$query="SELECT * FROM post";
$post= $db->select($query);

    //         Tant que les données sont récupérées
while($post->fetch_assoc()){
    $query="SELECT * FROM post";
    //             Récupérer la valeur de image
    $image=$_GET['img_link'];
//             Supprimer l'image
    $delete_img = "DELETE FROM post WHERE image = '$image'";
    $delete_data = $db->delete($delete_img);
//         Supprimer les données de la table post
//         Si les données sont supprimées
if($delete_data){
    //             Alors
    //                 Afficher un message de succès
    //                 Rediriger vers post_list.php
    echo "<span style='color:green;font-size:18px;'>Data Suprimer</ span>";
    header('location:post_list.php');
}
//             Sinon
//                 Afficher un message d'erreur
//                 Rediriger vers post_list.php
else{
    echo "<span style='color:red;font-size:18px;'>Data Non Suprimer</ span>";
    header('location:post_list.php');
}
            }
    }
}
?>
<?php
include_once "includes/footer.php";
ob_end_flush();
?>