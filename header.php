<!doctype html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/php-boolpress/dist/css/style.css">
        <title><?php if (isset($page_title)) echo $page_title ?></title>
    </head>
    <body>
    <?php
    $path_server = $_SERVER['HTTP_HOST'];
    $path_folder = explode('/', $_SERVER['PHP_SELF']);
    $path_folder = $path_folder[1];
    $path = $path_server . '/'.$path_folder.'/';
    ?>
    <header>
        <h1 class="blog__title"><a href="http://<?php echo $path; ?>posts.php">Il mio Blog</a></h1>
        <?php if($page === 'posts') include 'search-bar.php'?>
    </header>
