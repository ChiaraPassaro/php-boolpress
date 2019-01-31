<?php
    include 'data.php';
    include 'functions.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title></title>
    </head>
    <body>
        <?php
            $slug_get = $_GET['slug'];
                foreach ($posts as $post) {
                    if ($slug_get === $post['slug']){
                        $title = $post['title'];
                        $date = getFormatDate($post['published_at']);
                        $img = $post['image'];
                        $content = $post['content'];
                        $tags = implode(', ', $post['tag']);
                        $is_post = true;
                    } else{
                     $message_error = 'La pagina non esiste';
                    }
                }
        ?>

        <?php if($is_post){ ?>
            <div class="post-detail">
                <h1 class="post__title"><?php echo $title; ?></h1>
                <div class="post__date"><?php echo $date; ?></div>
                <div class="post__img"><img src="<?php echo $img; ?>" alt="<?php echo $title; ?>"></div>
                <div class="post__content"><?php echo $content; ?></div>
                <div class="post__tag">Tags: <?php echo $tags; ?></div>
            </div>
        <?php } else { ?>
            <h1 class="error"><?php echo $message_error; ?></h1>
        <?php } ?>

    </body>
</html>
