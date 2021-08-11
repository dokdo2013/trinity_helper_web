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
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="noto-extra" style="margin-top: 30px">트리니티 헬퍼</h1>
        <h4 class="noto-bold" style="line-height: 30px">마이페이지 <span style="font-size: 16px">(<?=$_SESSION["phone"]?> | <a href="logout.php">로그아웃</a>)</span></h4>
        <div class="login" style="margin: 20px 0 40px 0">
            <div class="my-card notice">
                <p class="my-title">서비스 바로가기</p>
                    <ul>
                        <li><a href="apply.php">문자알림 신청</a></li>
                        <li><a href="view.php">문자알림 관리</a></li>
                    </ul>
                </p>
            </div>
            <div class="my-card notice">
<!--                <p class="my-title"><a href="board/intro.html">이용방법 안내 (클릭시 이동)</a></p>-->
                <p class="my-title">이용 문의</p>
                <p class="my-text">이용 중 궁금하신 점은 아래 오픈채팅 링크로 문의 주세요. 시간대에 따라 바쁘면 답장이 늦어질 수 있으니 양해 바랍니다.</p>
                <p class="my-text"><a href="https://open.kakao.com/o/s0BcBcqc">오픈채팅 보내기</a></p>
            </div>
            <div class="my-card support">
                <p class="my-title">후원 안내</p>
                <p class="my-text">트리니티 헬퍼는 개인이 개발하여 운영하고 있는 서비스로, 서버 유지비용과 메시지 전송 비용 등 운영 비용 일체를 사비로 부담하고 있습니다. 이에 잘 사용하신 학우분이 계시면 적은 금액이라도 후원해주시면 감사히 잘 쓰도록 하겠습니다.</p>
                <p class="my-text">우리은행 1002359708525 (예금주 : 조현우)</p>
                <a href="https://qr.kakaopay.com/281006011000078802241614"><img src="kakaopay.png" alt="카카오페이로 후원하기" style="width: 162.5px; height: 46.5px"></a>
            </div>
        </div>
    </div>
</body>
</html>