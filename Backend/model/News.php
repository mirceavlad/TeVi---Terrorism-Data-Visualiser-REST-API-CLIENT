<?php

require_once '../vendor/autoload.php';
include '../controllers/newsController.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);
$news=newsController::getNews();

echo $twig->render('news.php.twig',['values'=>$news]);
?>
