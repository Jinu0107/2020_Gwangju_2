<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>전북 축제</title>
    <link rel="stylesheet" href="resources/vendor/bootstrap-4.4.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="resources/vendor/fontawesome/css/font-awesome.css">
    <link rel="stylesheet" href="resources/css/style.css">
    <link rel="stylesheet" href="resources/vendor/jquery-ui-1.12.1/jquery-ui.min.css">
    <script src="resources/vendor/jquery-3.5.0.min.js"></script>
    <script src="resources/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="resources/js/common.js"></script>
</head>

<body>
    <!-- 헤더 시작 -->
    <div class="modal" id="location_modal">
        <div class="inner"></div>
    </div>
    <header>
        <div class="header_top">
            <div class="container flex_b">
                <div class="search">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search..">
                </div>
                <nav>
                    <select name="select_1" id="select_1">
                        <option value="">한국어 </option>
                        <option value="">English</option>
                        <option value="">中文(简体)</option>
                    </select>
                    <a href="#" class="flex_c">전라북도청</a>
                    <a href="#" class="flex_c">회원가입</a>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a href="/logout" class="flex_c">로그아웃</a>
                    <?php else : ?>
                        <a href="/login" class="flex_c">로그인</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        <div class="header_bottom">
            <div class="container flex_b">
                <div class="logo">
                    <img src="resources/img/logo.png" alt="" class="img_cover">
                </div>
                <nav>
                    <a href="/" class="flex_c">HOME</a>
                    <a href="/festival" class="flex_c">전북 대표 축제</a>
                    <a href="/festivalCS" class="flex_c">축제 정보</a>
                    <a href="/cal" class="flex_c">축제 일정</a>
                    <a href="/current" class="flex_c">환율안내</a>
                    <a href="#" class="flex_c">종합지원센터</a>
                </nav>
                <div class="menu_2depth">
                    <div class="container">
                        <div>
                            <a href="/sub" class="flex_c">공지사항</a>
                            <a href="#" class="flex_c">센터 소개</a>
                            <a href="#" class="flex_c">관광정보 문의</a>
                            <a href="#" class="flex_c">데이터 공개</a>
                            <a href="#" class="flex_c location">찾아오시는 길</a>
                        </div>
                    </div>
                </div>
                <div class="ham">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="ham_menu">
                    <nav>
                        <select name="select_2" id="select_2">
                            <option value="">한국어 </option>
                            <option value="">English</option>
                            <option value="">中文(简体)</option>
                        </select>
                        <a href="#" class="flex_c">전라북도청</a>
                        <a href="#" class="flex_c">회원가입</a>
                        <a href="#" class="flex_c">로그인</a>
                        <a href="#" class="flex_c">HOME</a>
                        <a href="#" class="flex_c">전북 대표 축제</a>
                        <a href="#" class="flex_c">축제 정보</a>
                        <a href="#" class="flex_c">축제 일정</a>
                        <a href="#" class="flex_c">환율안내</a>
                        <a href="#" class="flex_c">종합지원센터</a>
                        <a href="#" class="flex_c">공지사항</a>
                        <a href="#" class="flex_c">센터 소개</a>
                        <a href="#" class="flex_c">관광정보 문의</a>
                        <a href="#" class="flex_c">데이터 공개</a>
                        <a href="#" class="flex_c">찾아오시는 길</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- 헤더 끝 -->