<?php

if ($argc !== 2) {
    echo '更新する node ファイルを指定してください', PHP_EOL;
    exit(1);
}
$file = $argv[1];
if (!is_writable($file) || !is_file($file)) {
    echo '更新できないファイルです', PHP_EOL;
    exit(1);
}

$node = json_decode(file_get_contents($file));

if (JSON_ERROR_NONE !== ($res = json_last_error())) {
    echo 'json ファイルの読み込みに失敗しました code: '.$res, PHP_EOL;
    exit(1);
}

if ($host = $node->normal->knife_zero->host) {
    $node->normal->fqdn = $host;
}
file_put_contents($file, json_encode($node));

echo 'json ファイルを更新しました', PHP_EOL;
