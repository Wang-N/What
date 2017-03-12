<?php
use Workerman\Worker;
require_once './Workerman/Autoloader.php';
require_once './config.php';

// What监听UDP2333，text协议
$what_worker = new Worker("tcp://0.0.0.0:2333");
$what_worker->name = 'what_tcp';
// $what_worker->transport = 'tcp';
// What数据库一直保持连接
$link = mysqli_connect(HOST, USER, PASSWORD);
mysqli_select_db($link, DB_NAME);

// 启动5个进程对外提供服务
$what_worker->count = 5;

// 接收到数据时存储并回复
$what_worker->onMessage = function($connection, $data)
{
    // include './sub.php';
    $connection->send("heiheihei");
};

// 运行worker
Worker::runAll();
?>