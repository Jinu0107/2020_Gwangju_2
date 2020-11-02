<?php $festivals = $data[0] ?>

<div class="festivalCS section">
    <div class="container">
        <div class="section_title center">
            <hr>
            <h1><span class="bold">JEONBUK</span> FESTIVALS</h1>
            <p>축제 현황 - 목록</p>
        </div>
        <div class="btn_group flex_e">
            <?php

            use src\App\Lib;

            if (isset($_SESSION['user'])) : ?>
                <a href="/insert"><button class="btn0 btn1">축제 등록</button></a>
            <?php endif; ?>
        </div>
        <table class="table">
            <thead>
                <th>번호</th>
                <th>축제명 (사진)</th>
                <th>다운로드</th>
                <th width="20%">기간</th>
                <th>장소</th>
            </thead>
            <tbody>
       
            </tbody>
        </table>
        <div class="pagination_group flex_c">
            <a href="#" class="disable">&lt;</a>
            <a href="#" class="active">1</a>
            <a href="#" class="disable">&gt;</a>
        </div>
    </div>
</div>

<script>
    const datas = <?= Lib::sendJson($festivals) ?>;
</script>

<script src="resources/js/FestivalCS.js"></script>