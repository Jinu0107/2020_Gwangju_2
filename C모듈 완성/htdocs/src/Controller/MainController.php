<?php

namespace src\Controller;

use src\App\DB;
use src\App\Lib;

class MainController extends MasterController
{
    public function index()
    {
        $this->render("index");
    }
    public function sub()
    {
        $this->render("sub");
    }
    public function festival()
    {
        $this->render("festival");
    }
    public function current()
    {
        $this->render("current");
    }

    public function login()
    {
        $this->render("login");
    }

    public function festivalCS()
    {
        $festivals = DB::fetchAll("SELECT * FROM festivals");
        foreach ($festivals as $f) {
            $f->img_cnt = DB::fetch("SELECT count(*) as cnt from files WHERE pidx = ?", [$f->idx])->cnt;
        }
        $this->render("festivalCS", [$festivals]);
    }

    public function update()
    {
        extract($_GET);
        if (isset($_SESSION['user'])) {
            $festival = DB::fetch("SELECT * FROM festivals WHERE idx = ?", [$idx]);
            $images = DB::fetchAll("SELECT * FROM files WHERE pidx = ?", [$idx]);
            $this->render("update", ["festival" => $festival, "images" => $images]);
        } else {
            Lib::msgAndGo("로그인한 회원만 이용할 수 있습니다. ", "/festivalCS");
        }
    }

    public function insert()
    {
        $this->render("insert");
    }

    public function view()
    {
        $idx = $_GET['idx'];
        $festival = DB::fetch("SELECT * FROM festivals WHERE idx = ?", [$idx]);
        $images = DB::fetchAll("SELECT * FROM files WHERE pidx = ?", [$idx]);
        $reviews = DB::fetchAll("SELECT * FROM reviews WHERE pidx = ?", [$idx]);
        $this->render("view", ["festival" => $festival, "images" => $images, "reviews" => $reviews]);
    }

    public function cal()
    {
        $this->render("cal");
    }

    public static function init()
    {
        $result = DB::fetchAll("SELECT * FROM festivals");
        if (count($result) == 0) {
            DB::execute("DELETE FROM festivals");
            DB::execute("DELETE FROM files");
            DB::execute("DELETE FROM reviews");


            $xml = simplexml_load_file("http://localhost/xml/festivalList.xml");
            foreach ($xml->items->item as $item) {
                $data = [null, $item->no, $item->nm, $item->dt, $item->cn, $item->area, $item->location];
                DB::execute("INSERT INTO `festivals`(`idx`, `no`, `name`, `date`, `content`, `area`, `location`) VALUES (? , ? , ? , ? , ? , ? ,?)", $data);
                $item->sn = str_pad($item->sn, 3, "0", STR_PAD_LEFT);
                $idx = DB::lastId();
                foreach ($item->images->image as $image) {
                    $data = [null, $idx, $image, 1, $item->sn . "_" . $item->no];
                    DB::execute("INSERT INTO `files`(`idx`, `pidx`, `name`, `type`, `path`) VALUES (? ,  ? , ? , ? , ?)", $data);
                }
            }
        }
    }
}

MainController::init();
