<?php

namespace src\Controller;


class MasterController
{
    public function render($page, $data = [])
    {
        extract($data);
        require __VIEWS . __DS . "layout" . __DS . "header.php";
        require __VIEWS . __DS . $page . ".php";
        require __VIEWS . __DS . "layout" . __DS . "footer.php";
    }
}
