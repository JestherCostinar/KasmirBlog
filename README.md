## General Info

---
![banner-kasmir-blog](https://user-images.githubusercontent.com/56688615/173782543-72898098-c8da-490b-8a55-436e1211cb10.JPG)
Made a structured Mvc Framework with PHP and Build a Blog Website shop for my personalblog

to use the project you must edit the config file in app/config/env.php and enter the corresponding data

### Screenshot
![blog](https://user-images.githubusercontent.com/56688615/173782993-33495550-d892-4bb4-8be4-cacf09abfbcb.JPG)


## Installation

---

A little intro about the installation.

```
$ git clone JestherCostinar/KasmirBlog
$ cd ../path/to/the/file
$ .
$ php -S localhost:8080
```

```
### Change the env files
// App config
define("APPROOT", dirname(dirname(__FILE__)));
define("URLROOT", "http://localhost/KasmirBlog");
define("SITENAME", "Kasmir Blog");
define("AUTHOR", "Jesther Costinar");

// Database config
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cms');
```
