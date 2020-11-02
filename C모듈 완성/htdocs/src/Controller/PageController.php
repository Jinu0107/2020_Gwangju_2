<?php

namespace src\Controller;

use src\App\DB;
use src\App\Lib;
use ZipArchive;

class PageController
{
    public function down()
    {
        extract($_GET);
        $dbfiles = DB::fetchAll("SELECT * FROM files WHERE pidx = ?", [$idx]);
        $download_name =  $idx . "." . $type;
        $cnt = 0;
        foreach ($dbfiles as $file) {
            if ($file->type == 1) {
                $file->download_path = __IMAGE . "/$file->path/$file->name";
            } else {
                $file->download_path = __IMAGE . "/$file->name";
            }

            if (file_exists($file->download_path)) {
                $cnt++;
            }
        }
        if ($cnt == 0) {
            Lib::msgAndGo("다운로드할 이미지가 없습니다.", "/festivalCS");
        } else {
            if ($type == 'zip') {
                $zip = new ZipArchive();
                $zip->open($download_name, ZipArchive::CREATE);
                foreach ($dbfiles as $file) {
                    $zip->addFile($file->download_path, $file->name);
                }
                $zip->close();
            } else if ($type == 'tar') {
                $tar = new \PharData($download_name);
                foreach ($dbfiles as $file) {
                    $tar->addFile($file->download_path, $file->name);
                }
            }

            header("Content-Disposition: attachment; filename=$download_name");
            header("Content-length: " . filesize($download_name));
            readfile("$download_name");
            sleep(1);
            unlink($download_name);
        }
    }

    public function update()
    {
        extract($_POST);
        $files = $_FILES['add_img'];
        $data = [$name, $area, $date, $location, $idx];
        $data = array_map("trim", $data);
        if (in_array("", $data)) {
            Lib::msgAndGo("필수값이 비어있습니다.", "/");
            return;
        }

        if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2} ~ [0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
            Lib::msgAndGo("날짜형식이 올바르지 않습니다.", "/festivalCS");
            return;
        }

        DB::execute("UPDATE festivals SET name = ? , area = ? , date = ? , location = ? WHERE idx = ?", $data);

        if (count($del_img) != 1) {
            foreach ($del_img as $d) {
                DB::execute("DELETE FROM files WHERE idx = ?", [$d]);
            }
        }

        $no_img = 0;
        $pidx = $idx;
        if ($files['name'][0] != "") {
            foreach ($files['name'] as $key => $value) {
                $exit = strtolower(array_pop(explode(".", $value)));
                if ($exit != "jpg" && $exit != 'png' && $exit != 'gif') {
                    $no_img++;
                    continue;
                }
                $filename = time() . "_" . $value;
                $data = [null, $pidx, $filename, 0, ""];
                DB::execute("INSERT INTO `files`(`idx`, `pidx`, `name`, `type`, `path`) VALUES (? , ? , ? , ? , ?)", $data);
                move_uploaded_file($files['tmp_name'][$key], __IMAGE . "/" . $filename);
            }
        }

        Lib::msgAndGo($no_img == 0 ? "성공적으로 수정되었습니다." : "성공적으로 수정 되었고 $no_img 개의 파일은 이미지가 아님으로 추가되지 못 했습니다.", "/festivalCS");
    }

    public function insert()
    {
        extract($_POST);
        $files = $_FILES['add_img'];
        $data = [$name, $area, $date, $location];
        $data = array_map("trim", $data);
        if (in_array("", $data)) {
            Lib::msgAndGo("필수값이 비어있습니다.", "/");
            return;
        }

        if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2} ~ [0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date)) {
            Lib::msgAndGo("날짜형식이 올바르지 않습니다.", "/festivalCS");
            return;
        }
        $data = [null, 123, $name, $date, "", $area, $location];
        DB::execute("INSERT INTO `festivals`(`idx`, `no`, `name`, `date`, `content`, `area`, `location`) VALUES (? , ? , ? , ? , ? , ? , ?)", $data);

        $no_img = 0;
        $pidx = DB::lastId();
        if ($files['name'][0] != "") {
            foreach ($files['name'] as $key => $value) {
                $exit = strtolower(array_pop(explode(".", $value)));
                if ($exit != "jpg" && $exit != 'png' && $exit != 'gif') {
                    $no_img++;
                    continue;
                }
                $filename = time() . "_" . $value;
                $data = [null, $pidx, $filename, 0, ""];
                DB::execute("INSERT INTO `files`(`idx`, `pidx`, `name`, `type`, `path`) VALUES (? , ? , ? , ? , ?)", $data);
                move_uploaded_file($files['tmp_name'][$key], __IMAGE . "/" . $filename);
            }
        }

        Lib::msgAndGo($no_img == 0 ? "성공적으로 추가되었습니다." : "성공적으로 추가 되었고 $no_img 개의 파일은 이미지가 아님으로 추가되지 못 했습니다.", "/festivalCS");
    }

    public function delete()
    {
        $idx = $_GET['idx'];
        DB::execute("DELETE FROM festivals WHERE idx = ?", [$idx]);
        Lib::msgAndGo("성공적으로 삭제 되었습니다.", "/festivalCS");
    }

    public function getImage()
    {
        header("Content-type: image/jpg");
        extract($_GET);
        if ($folder == "null") {
            readfile(__IMAGE . "/$name");
        } else {
            readfile(__IMAGE . "/$folder/$name");
        }
    }

    public function review()
    {
        extract($_POST);
        $data = [$idx, $name, $comment, $score];
        $data = array_map("trim", $data);
        if (in_array("", $data)) {
            Lib::msgAndGo("필수값이 비어있습니다. ", "/festivalCS");
            return;
        }

        $data = [null, $idx, $name, $comment, $score];

        DB::execute("INSERT INTO `reviews`(`idx`, `pidx`, `name`, `comment`, `score`) VALUES (? , ? , ? , ? , ?)", $data);
        Lib::msgAndGo("성공적으로 등록이 되었습니다. ", "/festivalCS");
    }


    public function delete_review()
    {
        $idx = $_GET['idx'];
        DB::execute("DELETE FROM reviews WHERE idx = ?", [$idx]);
        Lib::msgAndGo("성공적으로 삭제 되었습니다. ", "/festivalCS");
    }


    public function api()
    {
        $type = $_GET['searchType'];
        $year = $_GET['year'];
        $month = "";
        if ($type == 'M') {
            $month = $_GET['month'];
            $month = str_pad($month, 2, "0", STR_PAD_LEFT);
            $result = DB::fetchAll("SELECT * FROM festivals WHERE substr(date , 1 , 4) = ? AND substr(date , 6 , 2) = ? ", [$year, $month]);

            Lib::sendJson($result);
        } else if ($type == 'Y') {
            $result = DB::fetchAll("SELECT * FROM festivals WHERE substr(date , 1 , 4) = ?", [$year]);

            Lib::sendJson($result);
        }
    }
}
