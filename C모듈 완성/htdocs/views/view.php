<div class="festivalView section">
    <div class="container">
        <div class="section_title center">
            <hr>
            <h1><span class="bold">FESTIVAL</span> INFO</h1>
            <p>축제 현황 - 축제 정보</p>
        </div>
        <div class="title"><?= $festival->name ?></div>
        <div class="info">
            <div class="img_box">
                <?php if (count($images) == 0) : ?>
                    <img src="" alt="No Image">
                <?php else : ?>
                    <?php if ($images[0]->path == "") : ?>
                        <img src="/getImage?folder=null&name=<?= $images[0]->name ?>" alt="No Image">
                    <?php else : ?>
                        <img src="/getImage?folder=<?= $images[0]->path ?>&name=<?= $images[0]->name ?>" alt="No Image">
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="text">
                <table class="table">
                    <tr>
                        <th width="30%">지역</th>
                        <th width="70%" class="area"><?= $festival->area ?></th>
                    </tr>
                    <tr>
                        <th width="30%">장소</th>
                        <th width="70%" class="location"><?= $festival->location ?></th>
                    </tr>
                    <tr>
                        <th width="30%">기간</th>
                        <th width="70%" class="dt"><?= $festival->date ?></th>
                    </tr>
                </table>
                <p class="cn">
                    <?= $festival->content ?>
                </p>
            </div>
        </div>
        <div class="section_title">
            <hr>
            <h1>축제 사진</h1>
        </div>
        <div class="sub_img_box">
            <?php foreach ($images as $img) : ?>
                <?php if ($img->path == "") : ?>
                    <img src="/getImage?folder=null&name=<?= $img->name ?>" alt="No Image">
                <?php else : ?>
                    <img src="/getImage?folder=<?= $img->path ?>&name=<?= $img->name ?>" alt="No Image">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="flex_b">
            <h5 class="bold">축제 후기</h5>
            <button class="btn0 btn1" onclick="openModal()">후기 등록</button>
        </div>
        <div class="review_box">
            <?php foreach ($reviews as $review) : ?>
                <div class="review_item flex_b">
                    <div class="review_left">
                        <div class="name_group">
                            <p><?= $review->name ?></p>
                            <div>
                                <?php for ($i = 0; $i < $review->score; $i++) : ?>
                                    <i class="fa fa-star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="text">
                            <?= $review->comment ?>
                        </div>
                    </div>
                    <div class="review_right flex_c">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <a href="/delete_review?idx=<?= $review->idx ?>">
                                <button class="btn0 btn2">삭제</button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="modal" id="review_modal">
    <div class="inner">
        <h5 class="bold">후기 등록</h5>
        <form action="/review_process" method="post">
            <input type="hidden" name="idx" value="<?= $festival->idx ?>">
            <div class="form-group row">
                <div class="col-lg-6">
                    <label for="">이름</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-lg-6">
                    <label for="">별점</label>
                    <select name="score" id="" class="form-control">
                        <option value="">점수를 선택해주세요</option>
                        <option value="1">★</option>
                        <option value="2">★★</option>
                        <option value="3">★★★</option>
                        <option value="4">★★★★</option>
                        <option value="5">★★★★★</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="">후기</label>
                <input type="text" class="form-control" name="comment">
            </div>
            <div class="flex_e">
                <button class="btn0 btn1">저장</button>
            </div>
        </form>
    </div>
</div>


<script>
    $('#review_modal').dialog({
        'width': 800,
        'my': 'center',
        'at': 'center',
        'show': true,
        'hidden': true,
        'modal': true,
        'autoOpen': false
    });

    function openModal() {
        $('#review_modal').dialog("open");
    }
</script>