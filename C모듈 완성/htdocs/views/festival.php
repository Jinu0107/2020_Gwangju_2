<script src="resources/js/Festival.js"></script>
<!-- 대표 축제 리스트 -->
<div class="j_festival section">
    <div class="container">
        <div class="section_title center">
            <hr>
            <h1><span class="bold">JEONBUK</span> FESTIVAL</h1>
            <p>전북 대표 축제</p>
        </div>
        <div class="flex_e">
            <a href="?page=1&searchType=album"><button class="btn0 festival_btns  btn2" data-type="album"><i class="fa fa-image"></i>앨범형</button></a>
            <a href="?page=1&searchType=list"><button class="btn0  festival_btns btn2 disable" data-type="list"><i class="fa fa-bars"></i>목록형</button></a>
        </div>
        <div class="content">
            <!-- <div class="album">
                    <div class="main_festival">
                        <img src="xml/festivalImages/001_10001/10001_1.jpg" alt="" class="img_cover">
                        <div class="text">
                            <div class="title">
                                대표 축제
                            </div>
                            <p>대한민국, 춘향에 물들다. 꽃보다 붉은, 춘향과 몽룡의 사랑이 사랑의 도시 남원에서 춘향제로 피어납니다. 민족의 정체성이 위협받는 상황에서 춘향의 정절과 순수한
                                사랑을
                                민족운동으로 승화시키며 시작한 춘향제는 90년의 유구한 역사와 전통을 자랑하며 우리들 곁에서 지고지순한 사랑으로 거듭나고 있습니다. 사랑과 만남을 주제로
                                문화,
                                공연예술, 체험행사가 가득한 세계적인 사랑 축제의 장으로 여러분을 초대합니다. 대한민국 대표 관광명소 광한루원은 지금 춘향아씨가 그네 타던 그 시절로 돌아가
                                있답니다. 사랑하는 이와 함께 춘향에 빠져 아름다운 추억을 듬뿍 담아 가시기 바랍니다. </p>
                            <span>2017.06.24~06.30</span>
                            <div class="btn_group">
                                <button class="btn0 btn2">
                                    자세히 보기
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="festivalList">
                        <div class="card" data-id="1" data-toggle="modal" data-target=".view_modal">
                            <img src="/xml/festivalImages/001_10001/10001_1.jpg" alt="No Image" title='No Image'>
                            <div class="text">
                                <div class="title">
                                    태권도
                                </div>
                                <span>2020-20-20</span>
                            </div>
                            <div class="cnt flex_c">
                                4
                            </div>
                        </div>
                    </div>
                </div> -->
            <!-- <div class="list">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style=" text-align: center; width: 5%;">번호</th>
                                <th style=" text-align: center; width: 60%;">제목</th>
                                <th style=" text-align: center; width: 10%;">기간</th>
                                <th style=" text-align: center; width: 15%;">장소</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="1" data-toggle="modal" data-target=".view_modal">
                                <td style="text-align: center;">dasdadsads</td>
                                <td style="text-align: center;">dasads</td>
                                <td style="text-align: center;">dsa</td>
                                <td style="text-align: center;">12312342</td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
        </div>
        <div class="page_btn_group flex_c">
            <!-- <a href="" class="disable">&lt</a> -->
            <!-- <a href="" class="active">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <a href="">&gt</a> -->
        </div>
        <!-- 모달 시작 -->
        <div class="modal" id="view_modal">
            <div class="inner">
                <div class="title">타이틀</div>
                <div class="info">
                    <div class="img_box">
                        <img src="xml/festivalImages/007_10008/10008_3.jpg" alt="No Image">
                    </div>
                    <div class="text">
                        <table class="table">
                            <tr>
                                <th width="30%">지역</th>
                                <th width="70%" class="area">남원</th>
                            </tr>
                            <tr>
                                <th width="30%">장소</th>
                                <th width="70%" class="location">전북 남원 운봉 바래봉실 214</th>
                            </tr>
                            <tr>
                                <th width="30%">기간</th>
                                <th width="70%" class="dt">2020.04.30 - 05.05</th>
                            </tr>
                        </table>
                        <p class="cn">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam ducimus voluptate
                            accusamus dolorum recusandae veritatis fugit eos ea, quis sed repellendus, pariatur
                            debitis velit alias veniam modi error dolor illo!
                        </p>
                    </div>
                </div>
                <div class="slide">
                    <div class="slide_pannel">
                        <img src="xml/festivalImages/007_10008/10008_3.jpg" class="img_cover" style="width : calc(100% / 4);" alt="No Image">
                        <img src="xml/festivalImages/007_10008/10008_3.jpg" class="img_cover" style="width : calc(100% / 4);" alt="No Image">
                        <img src="xml/festivalImages/007_10008/10008_3.jpg" class="img_cover" style="width : calc(100% / 4);" alt="No Image">
                        <img src="xml/festivalImages/007_10008/10008_3.jpg" class="img_cover" style="width : calc(100% / 4);" alt="No Image">
                    </div>
                </div>
                <div class="pagination">
                    <button class="btn0 btn2 rel" data-value="-1" disabled>&lt;</button>
                    <button class="btn0 bnt1 numBtn" data-value="0">1</button>
                    <button class="btn0 bnt2 numBtn" data-value="1">2</button>
                    <button class="btn0 bnt2 numBtn" data-value="2">3</button>
                    <button class="btn0 bnt2 numBtn" data-value="3">4</button>
                    <button class="btn0 btn2 rel" data-value="1">&gt;<button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 모달 끝 -->

<!-- 대표 축제 리스트 -->