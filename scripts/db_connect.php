<?php
// データベース接続情報
if (isset($_SERVER['HTTP_HOST'])) {
    $host = $_SERVER['HTTP_HOST'];
} else {
    $host = 'localhost'; // CLI実行時用
}

$dsn = $host === 'localhost' ? 'mysql:host=localhost;dbname=rosetta;charset=utf8' : 'mysql:host=localhost;dbname=LAA1589542-rosetta;charset=utf8';
$user = $host === 'localhost' ? 'root' : 'user';
$password = $host === 'localhost' ? '' : '0927';

try {
    // PDOインスタンスを作成
    $pdo = new PDO($dsn, $user, $password);
    // エラーモードを例外モードに設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('Location: ./error.php');
    exit;
}
