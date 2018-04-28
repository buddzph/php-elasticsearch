<?php
require_once 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

$client = Elasticsearch\ClientBuilder::create()->build();