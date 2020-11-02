<div class="update section">
    <div class="container">
        <div class="section_title center">
            <hr>
            <h1><span class="bold">FESTIVAL</span> UPDATE</h1>
            <p>축제 현황 - 축제 수정 페이지</p>
        </div>
        <form action="/update_process" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idx" value="<?= $festival->idx ?>">
            <div class="form_box">
                <div class="form-group">
                    <label for="">축제명</label>
                    <input type="text" name="name" class="form-control" value="<?= $festival->name ?>">
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="">지역</label>
                        <input type="text" name="area" class="form-control" value="<?= $festival->area ?>">
                    </div>
                    <div class="col-lg-6">
                        <label for="">기간</label>
                        <input type="text" name="date" class="form-control" value="<?= $festival->date ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">장소</label>
                    <input type="text" name="location" class="form-control" value="<?= $festival->location ?>">
                </div>
                <div class="form-group">
                    <label for="">축제 사진</label>
                    <span class="small">선택 후 저장하면 사진이 삭제 됩니다.</span>
                    <div class="image_group">
                        <input type="checkbox" name="del_img[]" id="" value="temp" checked style="display: none;">
                        <?php foreach ($images as $img) : ?>
                            <div>
                                <input type="checkbox" name="del_img[]" id="" value="<?= $img->idx ?>">
                                <span><?= $img->name ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">추가 사진</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" multiple id="file_input" name="add_img[]">
                        <label for="file_input" class="custom-file-label">컨트롤을 누르고 다중선택 가능</label>
                    </div>
                </div>
                <div class="btn_group flex_e">
                    <a href="/delete?idx=<?= $festival->idx ?>"><button class="btn0 btn1" type="button">삭제</button></a>
                    <button class="btn0 btn2">저장</button>
                </div>
            </div>
        </form>
    </div>
</div>