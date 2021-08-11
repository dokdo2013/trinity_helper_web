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
        <h1 class="noto-extra" style="margin-top: 30px"><a href="mypage.php" style="text-decoration: none; color: white">트리니티 헬퍼</a></h1>
        <h4 class="noto-bold" style="line-height: 30px">문자알림신청 <span style="font-size: 16px">(<?=$_SESSION["phone"]?> | <a href="logout.php">로그아웃</a>)</span></h4>
        <div class="login" style="margin: 20px 0 40px 0">
            <div class="my-card notice">
                <p class="my-title noto-extra">주의사항 (필독)</p>
                <p class="my-text noto-extra">* 아래 조건에 해당되는 경우만 신청하세요</p>
                <p class="my-text"><span class="noto-bold">조건 1:</span> 제한인원이 정해져있음 (무제한 X)<br><span class="noto-bold">조건 2:</span> 제한인원과 신청인원이 동일해야 함 (예 : 45명 중 45명 신청)<br><span class="noto-bold">조건 3:</span> 제한인원과 신청인원 중 어느 하나라도 값이 존재하지 않으면 안됨 (None이 있으면 X)</p>
                <p class="my-text noto-extra">* 아래 수칙을 꼭 지켜주세요.</p>
                <p class="my-text"><span class="noto-bold">수칙 1:</span> 수강 정정에 성공하면 반드시 '관리' 화면에서 신청 내역을 삭제해주세요. 계속 문자 알림이 갑니다.<br><span class="noto-bold">수칙 2:</span> 딱히 제한을 걸어두지는 않았지만 1인당 5개 이상 신청하는 건 자제해주세요.</p>
                <p class="my-text noto-extra">* 아래 유의사항을 꼭 읽어보세요.</p>
                <p class="my-text"><span class="noto-bold">유의사항 1:</span> 통상 자리가 빈지 20초 내로 문자 알림이 갑니다. 다만 통신 환경으로 인해 최대 1분이 걸릴 수 있습니다.<br><span class="noto-bold">유의사항 2:</span> 제한인원과 신청인원만을 비교하기 때문에 자리가 비어있으면 계속 문자가 갑니다.<br><span class="noto-bold">유의사항 3:</span> 수강신청/정정 결과에 대해 트리니티 헬퍼는 책임지지 않습니다.<br><span class="noto-bold">유의사항 4:</span> 위쪽의 '조건'에 부합하지 않으면 문자가 전송되지 않을 수 있습니다.</p>
            </div>
            <div class="my-card notice">
                <p class="my-title">이용 신청</p>
                <form action="apply_check.php" method="post">
                    <div class="form-group">
                        <input class="form-control" type="number" name="subj" placeholder="과목번호" required>
                        <input class="form-control" type="text" name="class" placeholder="분반번호" required>
                        <input type="submit" value="신청" class="form-control btn btn-info" style="margin-top:10px">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>