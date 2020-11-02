<?php

namespace src\Controller;

use src\App\Lib;

class UserController
{
    public function login()
    {
        extract($_POST);
        if ($id == 'admin' && $pass = 'admin') {
            $_SESSION['user'] = true;
            Lib::msgAndGo("성공적으로 로그인 되었습니다.", "/");
        } else {
            Lib::msgAndGo("아이디 또는 비밀번호 오류.", "/login");
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        Lib::msgAndGo("성공적으로 로그아웃 되었습니다.", "/");
    }
}
