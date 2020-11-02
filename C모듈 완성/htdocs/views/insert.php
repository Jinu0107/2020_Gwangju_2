<div class="insert section">
    <div class="container">
        <div class="section_title center">
            <hr>
            <h1><span class="bold">FESTIVAL</span> INSERT</h1>
            <p>축제 현황 - 축제 등록 페이지</p>
        </div>
        <form action="/insert_process" method="post" enctype="multipart/form-data">
            <div class="form_box">
                <div class="form-group">
                    <label for="">축제명</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="">지역</label>
                        <input type="text" name="area" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label for="">기간</label>
                        <input type="text" name="date" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">장소</label>
                    <input type="text" name="location" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">추가 사진</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" multiple id="file_input" name="add_img[]">
                        <label for="file_input" class="custom-file-label">컨트롤을 누르고 다중선택 가능</label>
                    </div>
                </div>
                <div class="btn_group flex_e">
                    <button class="btn0 btn2">저장</button>
                </div>
            </div>
        </form>
    </div>
</div>