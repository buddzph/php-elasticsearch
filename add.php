<?php
require_once 'app/init.php';

if(!empty($_POST)) {
    if(isset($_POST['title'], $_POST['body'], $_POST['keywords'])){
        $title = $_POST['title'];
        $body = $_POST['body'];
        $keywords = explode(',', $_POST['keywords']);

        $indexed = $client->index([
            'index' => 'articles',
            'type' => 'article',
            'body' => [
                'title' => $title,
                'body' => $body,
                'keywords' => $keywords
            ]
        ]);

        if($indexed) {
            print_r($indexed);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/main.css">
    <title>Form Add</title>
</head>
<body>
    <form action="" method="post">
        <label for="title">
            Title 
            <input type="text" name="title" id="title">
        </label><br />
        <label for="body">
            Body
            <textarea name="body" id="body" cols="30" rows="10"></textarea>
        </label><br />
        <label for="keywords">
            Keywords
            <input type="text" name="keywords" id="keywords" placeholder="comma, seperated">
        </label><br />

        <input type="submit" value="Add">
    </form>
</body>
</html>