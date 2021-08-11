<?php
    require_once('database.php');
    session_start();
    if(isset($_SESSION["err"])){
        $err = "<p class=\"main-notice\">".$_SESSION["err"]."</p>";
        unset($_SESSION["err"]);
    }else{
        $err = "";
    }
    // 세션 있으면 마이페이지로
    if(isset($_SESSION["login"])){
        if($_SESSION["login"] == 1){
            header("Location: mypage.php");
        }
    }

    // 공지사항 설정 Part
    $notice_numbers = 2;
    $notice_title = array();
    $notice_content = array();
    
    $notice_title[0] = "운영 시간 안내";
    $notice_content[0] = "안녕하세요 관리자입니다. 사이트 자체는 항상 이용 가능하지만 문자 메세지 전송 서비스는 '수강신청/정정 기간'에만 운영됩니다. 아래 기간을 참고하시기 바랍니다.<br><br>1차 정정기간 : 2020. 8. 18(화) 08:30 ~ 17:00<br>2차 정정기간 : 2020. 8. 31(월) ~ 9. 4(금) 09:00 ~ 17:00";

    $notice_title[1] = "제휴 문의";
    $notice_content[1] = "안녕하세요 관리자입니다. 가톨릭대학교 학생들에게 가장 효과적으로 홍보할 수 있는 방법. 트리니티 헬퍼 제휴광고 공지사항입니다.<br><br>수강신청 이틀간 활성방문자수 600명(IP주소 기반), 페이지뷰 5000회 기록!<br>에타에 올려서 홍보가 되나요? 인스타, 페북 홍보는 더더욱 힘듭니다. 비대면 수업이 유력한 지금, 개강 첫 주에 이보다 쉽게 홍보할 수 있는 공간은 없습니다.<br><br>제휴문의 : <a href=\"https://open.kakao.com/o/s0BcBcqc\">오픈채팅 바로가기</a>";

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
        .my-block{
            display: block;
            height: 50px;
            border: 1px solid #00AAFF;
            border-radius: 4px;
            margin-bottom: 5px;
            line-height: 50px;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="noto-extra" style="margin-top: 30px">트리니티 헬퍼</h1>
        <h5 class="noto-regular" style="margin-top: 40px; line-height: 30px; margin-bottom: 20px">트리니티 헬퍼는 수강 정정시 자리가 나면 등록한 전화번호로 문자를 보내주는 서비스입니다.</h5>
        <div class="login" style="margin: 80px 0 40px 0">
            <form action="register.php" method="post">
                <?=$err?>
                <!--<p class="main-notice">변경된 운영규칙을 반드시 확인하시기 바랍니다. (하단 공지사항 참조)</p>-->
                <p class="main-notice">여러분의 올클을 응원합니다! 문의는 카카오톡으로 해주세요.</p>
                <!--<p class="main-notice">문자전송 서비스 운영 시간이 아닙니다. (하단 공지사항 참조)</p>-->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <input type="tel" class="form-control form-control-lg" name="phone" placeholder="전화번호 입력 ('-' 빼고 숫자만)" style="font-size:16px; text-align:center" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <input type="submit" class="col-4 btn btn-info" value="로그인" style="margin: 20px 0">
                </div>
            </form>
            <p style="font-size: 12px">전화번호 이외에 일체 개인정보는 수집하지 않으며, 입력한 전화번호는 수강정정 기간이 끝난 직후 즉시 폐기하겠습니다. 개인정보 보호에 관한 문의는 아래 카카오톡 오픈채팅으로 진행해주시기 바랍니다.</p>
        </div>
        <hr style="margin: 10px 0; color: white; background-color: white">
        <div class="my-card notice">
            <p class="my-title">비로그인 서비스</p>
            <a href="free_search.php"><div class="my-text my-block"><i class="fas fa-search"></i> 강의별 인원 검색</div></a>
        </div>
        <div class="my-card notice">
            <p class="my-title">이용문의</p>
            <p class="my-text">카카오톡 오픈채팅으로 문의하실 수 있습니다. 시간대에 따라 바쁘면 답장이 늦어질 수 있으니 양해 바랍니다.</p>
            <p class="my-text"><a href="https://open.kakao.com/o/s0BcBcqc">오픈채팅 보내기</a></p>
        </div>
        <div class="my-card notice">
            <p class="my-title">공지사항</p>
            <div class="accordion" id="noticeaccordion">
                <?php for($i=0;$i<$notice_numbers;$i++){ ?>
                    <div class="card">
                        <div class="card-header" style="padding: 5px" id="heading<?=$i?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link my-title" style="text-align: left; font-size:14px" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
                            <?=$notice_title[$i]?>
                            </button>
                        </h2>
                        </div>

                        <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#noticeaccordion">
                        <div class="card-body my-text">
                            <?=$notice_content[$i]?>
                        </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="my-card support">
            <p class="my-title">후원 안내</p>
            <p class="my-text">트리니티 헬퍼는 개인이 개발하여 운영하고 있는 서비스로, 서버 유지비용과 메시지 전송 비용 등 운영 비용 일체를 사비로 부담하고 있습니다. 이에 잘 사용하신 학우분이 계시면 적은 금액이라도 후원해주시면 감사히 잘 쓰도록 하겠습니다.</p>
            <p class="my-text">우리은행 1002359708525 (예금주 : 조현우)</p>
            <a href="https://qr.kakaopay.com/281006011000078802241614"><img src="kakaopay.png" alt="카카오페이로 후원하기" style="width: 162.5px; height: 46.5px"></a>
        </div>
        <div class="my-card support">
            <p class="my-title">감사합니다.</p>
            <p class="my-text">아래는 후원자 명단입니다. 트리니티 헬퍼 운영비로 잘 활용하겠습니다. 후원해주셔서 감사합니다.</p>
            <p class="my-text">실명을 모두 공개하거나, 실명 대신 닉네임을 사용하고싶으신 분은 오픈채팅으로 연락 주시면 수정하겠습니다.</p>
            <p class="my-text">곽*정님, 권*민님, 조*나님, 김*구님, *인님, 이*림님, 덕분에님, 송*우님, 감사합니다님, 너무나유용한기능감사님, 헬퍼후원님, 익명님, 김*원님</p>
        </div>
    </div>
</body>
</html>