<?php
namespace App;
class Controller {
    protected function render($view_name, $data = []) {
        extract($data);
        echo "Đường dẫn đến file view: " . $path;
        include __DIR__ . "\Views\\$view_name.php";
    }
}