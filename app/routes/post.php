<?php

$app->get('/', function() use ($app) {

    $db = DB::getInstance();
    
    $posts = $app->db->query("
        SELECT posts.*, users.name AS author
        FROM posts
        LEFT JOIN users
        ON posts.user_id = users.id
    ")->fetchAll(PDO::FETCH_ASSOC);

    $app->render('post/home.php', [
        'posts' => $posts
    ]);
})->name('home');


$app->get('/posts/:postId', function($postId) use ($app) {
    
    $post = $app->db->prepare("
        SELECT
        posts.*, users.name AS author
        FROM posts
        LEFT JOIN users 
        ON posts.user_id = users.id
        WHERE posts.id = :postId
    ");

    $post->execute(['postId' => $postId]);

    $post = $post->fetch(PDO::FETCH_ASSOC);

    if(!$post) {
        $app->notFound();
    }

    $app->render('post/show.php', [
        'post' => $post
    ]);
})->name('posts.show');