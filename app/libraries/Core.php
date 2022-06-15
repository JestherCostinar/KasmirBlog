<?php

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        $url = $this->getController($url);
        $url = $this->getMethod($url);

        // Get parameters
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        if (isset($this->currentMethod)) {
            try {
                call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            } catch (Exception $e) {
                echo $e;
            }
        }
    }

    // get Url
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url']);
            $url = trim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }

    // get Controller    
    public function getController($url)
    {
        try {
            if (isset($url[0])) {
                if (file_exists("../app/controllers/" . ucwords($url[0]) . '.php')) {
                    $this->currentController = ucwords($url[0]);
                    unset($url[0]);
                }
            }

            require "../app/controllers/" . $this->currentController . ".php";
            $this->currentController = new $this->currentController;
            return $url;
        } catch (Exception $e) {
            echo "</br> <span style='color:red'>No Page Found </span>";
        }
    }

    // get Method
    public function getMethod($url)
    {
        try {
            if (isset($url[1])) {
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
                return $url;
            }
        } catch (Exception $e) {
            echo "</br> <span style='color:red'>No method Found </span>";
        }
    }
}
