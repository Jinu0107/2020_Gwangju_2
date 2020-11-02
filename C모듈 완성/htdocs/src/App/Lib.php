<?php


namespace src\App;


class Lib
{
    public static function sendJson($data)
    {
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public  static function msgAndGo($msg, $url)
    {
        echo "<script>alert('$msg'); location.href='$url'</script>";
    }
}
