<?php
    require_once('database.php');
    session_start();
    $iserr = 0;    
    
    // 세션 있는지 확인
    if(isset($_SESSION["login"])){
        if($_SESSION["login"] != 1){
            $_SESSION["err"] = "주의 : 세션이 만료되었습니다.";
            $iserr = 1;
            header("Location: index.php");    
        }
    }else{
        $_SESSION["err"] = "주의 : 세션이 만료되었습니다.";
        $iserr = 1;
        header("Location: index.php");
    }

    // 데이터 받아오기
    $q1 = "SELECT count(*) FROM cuk WHERE stat = 1";
    $r1 = $mysqli->query($q1);
    $d1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
    $totalapp = $d1['count(*)'];

    $q2 = "SELECT * FROM cuk_server";
    $r2 = $mysqli->query($q2);
    $i = 0;
    $serv = array();
    while($d2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)){
        $serv[$i] = $d2['running_time'];
        $i++;
    }
    $serv1 = $serv[0];
//    $serv2 = $serv[1];
//    $serv3 = $serv[2];
//    $serv4 = $serv[3];
//    $serv_res = ($serv1 + $serv2 + $serv3 + $serv4) / 16;
    $serv_res = $serv1;
    $avg = round($serv_res, 2);

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111513614-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-111513614-3');
    </script>
    <script data-ad-client="ca-pub-7503255255011124" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>트리니티 헬퍼</title>
    <!-- include libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- Custom CSS -->
    <style>
        body{
            background-color: #212529;
        }
        .wrapper{
            max-width: 576px;
            margin: 0 auto;
            color: white;
            font-family: 'Noto Sans KR', sans-serif;
            padding: 15px;
        }
        .noto-thin { font-weight: 100; }
        .noto-regular { font-weight: 400; }
        .noto-bold { font-weight: 700; }
        .noto-extra { font-weight: 900; }
        .my-card {
            min-height: 100px;
            background-color: white;
            border-radius: 10px;
            margin: 20px 0;
            padding: 15px;
        }
        .my-title{
            color: #212529;
            font-size: 16px;
        }
        .my-text{
            color: #212529;
            font-size: 12px;
        }
        .main-notice{
            color: gold;
            font-size: 12px;
            text-align: center;
        }
        ul,li{
            color: #212529;
            font-size: 14px;
        }
        .my-block{
            display: block;
            height: 35px;
            border: 1px solid #00AAFF;
            border-radius: 4px;
            margin-bottom: 5px;
            line-height: 35px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="noto-extra" style="margin-top: 30px">트리니티 헬퍼</h1>
        <h4 class="noto-bold" style="line-height: 30px">마이페이지 <span style="font-size: 16px">(<?=$_SESSION["phone"]?> | <a href="logout.php">로그아웃</a>)</span></h4>
        <div class="login" style="margin: 20px 0 40px 0">
            <div class="my-card notice">
                <p class="my-title">서비스 바로가기</p>
                <a href="apply.php"><div class="my-text my-block"><i class="fas fa-pencil-alt"></i> 문자알림 신청</div></a>
                <a href="view.php"><div class="my-text my-block"><i class="fas fa-cog"></i> 문자알림 관리</div></a>
                <a href="search.php"><div class="my-text my-block"><i class="fas fa-search"></i> 강의별 인원 검색 / 즐겨찾기 추가</div></a>
                <a href="star.php"><div class="my-text my-block"><i class="fas fa-star"></i> 즐겨찾기 모음</div></a>
            </div>
            <div class="my-card notice">
                <p class="my-title">실시간 서버상태</p>
                <p class="my-text">총 신청과목 수 : <?=$totalapp?>개</p>
                <!--<p class="my-text">평균 조회주기 : <?php //$avg?>초</p>-->
                <p class="my-text">서버 1 : <?=$serv1?>초<!--<br>서버 2 : <?php //$serv2?>초<br>서버 3 : <?php //$serv3?>초<br>서버 4 : <?php //$serv4?>초--></p>
                <p class="my-text">'조회주기'란 한 서버가 전체 신청과목 조회를 한 번 끝마치는데 걸리는 시간을 뜻합니다.</p>
                <p class="my-text">조회주기가 20초 미만일 경우 문자 전송 비용 절약을 위해 조회주기가 20초로 고정됩니다.</p>
            </div>
            <div class="my-card support">
                <p class="my-title">후원 안내</p>
                <p class="my-text">트리니티 헬퍼는 개인이 개발하여 운영하고 있는 서비스로, 서버 유지비용과 메시지 전송 비용 등 운영 비용 일체를 사비로 부담하고 있습니다. 이에 잘 사용하신 학우분이 계시면 적은 금액이라도 후원해주시면 감사히 잘 쓰도록 하겠습니다.</p>
                <p class="my-text">우리은행 1002359708525 (예금주 : 조현우)</p>
                <a href="https://qr.kakaopay.com/281006011000078802241614"><img src="kakaopay.png" alt="카카오페이로 후원하기" style="width: 162.5px; height: 46.5px"></a>
            </div>
            <div class="my-card notice">
<!--                <p class="my-title"><a href="board/intro.html">이용방법 안내 (클릭시 이동)</a></p>-->
                <p class="my-title">이용 문의</p>
                <p class="my-text">이용 중 궁금하신 점은 아래 오픈채팅 링크로 문의 주세요. 시간대에 따라 바쁘면 답장이 늦어질 수 있으니 양해 바랍니다.</p>
                <p class="my-text"><a href="https://open.kakao.com/o/s0BcBcqc">오픈채팅 보내기</a></p>
            </div>
            <div class="my-card support">
                <p class="my-title">감사합니다.</p>
                <p class="my-text">아래는 후원자 명단입니다. 트리니티 헬퍼 운영비로 잘 활용하겠습니다. 후원해주셔서 감사합니다.</p>
                <p class="my-text">실명을 모두 공개하거나, 실명 대신 닉네임을 사용하고싶으신 분은 오픈채팅으로 연락 주시면 수정하겠습니다.</p>
                <p class="my-text">곽*정님, 권*민님, 조*나님, 김*구님, *인님, 이*림님, 덕분에님, 송*우님, 감사합니다님, 너무나유용한기능감사님, 헬퍼후원님, 익명님</p>
            </div>
        </div>
    </div>
</body>
</html>