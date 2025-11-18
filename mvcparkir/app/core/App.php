<?php
// app/core/App.php
class App {
    private $config;
    public function __construct($config) {
        $this->config = $config;
        $url = $this->parseUrl();
        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'DashboardController';
        $method = $url[1] ?? 'index';
        $params = array_slice($url, 2);

        $controllerFile = __DIR__ . "/../controllers/{$controllerName}.php";
        if (!file_exists($controllerFile)) {
            $controllerName = 'DashboardController';
            $method = 'index';
            $params = [];
        }

        require_once $controllerFile;
        $controller = new $controllerName($config ?? []);
        if (!method_exists($controller, $method)) $method = 'index';
        call_user_func_array([$controller, $method], $params);
    }
    private function parseUrl(){
        if (isset($_GET['url'])) {
            $u = rtrim($_GET['url'],'/');
            return explode('/', filter_var($u, FILTER_SANITIZE_URL));
        }
        return [];
    }
}
