<?php

namespace src\App;



class Route
{
    private static $GET = [];
    private static $POST = [];

    public static function get($url, $action)
    {
        self::$GET[] =   [$url, $action];
    }


    public static function post($url, $action)
    {
        self::$POST[] =   [$url, $action];
    }

    public static function init()
    {
        $path = explode("?", $_SERVER['REQUEST_URI']);
        $actions = self::${$_SERVER['REQUEST_METHOD']};
        foreach ($actions as $action) {
            if ($action[0] == $path[0]) {
                $do = explode("@", $action[1]);
                $controller = "src\\Controller\\" . $do[0];
                $ci = new $controller();
                $ci->{$do[1]}();
                return;
            }
        }
        echo "잘못 들어옴";
    }
}
