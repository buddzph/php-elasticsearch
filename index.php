<?php
require_once 'app/init.php';

if(isset($_GET['q'])){
    $q = $_GET['q'];
    $query = $client->search([
        'body' => [
            'query' => [
                'bool' => [
                    'should' => [
                        'match' => ['title' => $q],
                        'match' => ['body' => $q]
                    ]
                ]
            ]
        ]
    ]);

    // echo '<pre>', print_r($query), '</pre>';

    if($query['hits']['total'] >= 1) {
        $results = $query['hits']['hits'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Elastic Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="" method="get">
        <label for="searchq">Search Something
            <input type="text" name="q" id="q">
        </label><br />

        <input type="submit" value="Search">
    </form>
    <?php
    if(isset($results)) {
        foreach($results as $r) {
            ?>
            <div class="result">
                <a href="#<?php echo $r['_id'] ?>"><?php echo $r['_source']['title'] ?></a>
                <div class="result-keywords"><?php echo implode(', ', $r['_source']['keywords']) ?></div>
            </div>
            <?php
        }
    }
    ?>
</body>
</html>