<?php
function get_model()
{
    global $config;
    $mod = (!empty($_GET['mod'])) ? $_GET['mod'] : $config['default_model'];
    return $mod;
}
function get_controller()
{
    global $config;
    $controller = (!empty($_GET['controller'])) ? $_GET['controller'] : $config['default_controller'];
    return $controller;
}

function get_action()
{
    global $config;
    $controller = (!empty($_GET['action'])) ? $_GET['action'] : $config['default_action'];
    return $controller;
}

function load($key, $name)
{
    if ($key == "lib")
        $path = LIBPATH . "/" . "{$name}.php";
    if ($key == "helper")
        $path = HELPERPATH . "/" . "{$name}.php";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Không tồn tại: {$name}";
    }
}

function call_function($data = array())
{
    if (is_array($data)) {
        foreach ($data as $item) {
            if (function_exists($item())) {
                $item();
            }
        }
    }
}

function load_module($name)
{
    $path = MODULESPATH . "/" . get_model() . "/" . "models" . "/" . "{$name}Model.php";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Không tồn tại {$name}";
    }
}

function load_view($name, $data_array = array())
{
    global $data;
    $data = $data_array;
    $path = MODULESPATH . "/" . get_model() . "/" . "views" . "/" . "{$name}View.php";
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $item) {
                $$key = $item;
            }
        }
        require "$path";
    } else {
        echo "Không tồn tại {$data}";
    }
}


function get_header($data = '')
{
    if (empty($data)) {
        $name = "header.php";
    } else {
        $name = "header-{$data}.php";
    }
    $path = LAYOUTPATH . "/" . "$name";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Không tồn tại: {$path}";
    }
}

function get_footer($data = '')
{
    if (empty($data)) {
        $name = "footer.php";
    } else {
        $name = "footer-{$data}.php";
    }
    $path = LAYOUTPATH . "/" . "$name";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Không tồn tại: {$path}";
    }
}

function get_sidebar($data = '')
{
    if (empty($data)) {
        $name = "sidebar.php";
    } else {
        $name = "sidebar-{$data}.php";
    }
    $path = LAYOUTPATH . "/" . "$name";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Không tồn tại: {$path}";
    }
}
