<?PHP
    var_dump($_GET);
    var_dump($_POST);
     $post = file_get_contents('php://input');
    var_dump($post);
?>
