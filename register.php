<?php
    require_once('database.php');
    session_start();

    $iserr = 0;

    // POST로 정상값이 넘어왔는지 확인
    if(isset($_POST["phone"])){
        $phone = $_POST["phone"];
    }else{
        $_SESSION["err"] = "주의 : 전화번호가 입력되지 않았습니다.";
        $iserr = 1;
        header("Location: index.php");
    }

    // 전화번호 형식이 올바른지 확인
    $phone = str_replace("-", "", $phone);
    if(!is_numeric($phone)){
        $_SESSION["err"] = "주의 : 전화번호 형식에 맞춰서 입력해주세요.";
        $iserr = 1;
        header("Location: index.php");
    }

    // 회원정보 확인
    // 로그인 정보가 있는 휴대전화번호일 경우 : 비밀번호 입력
    
    // 로그인 정보가 없는 휴대전화번호일 경우 : 비밀번호 등록 화면으로 이동
    

    // 문자 전송
    if($iserr == 0){
        $authcode = mt_rand(1000, 9999);
        $msg = "트리니티 헬퍼 인증코드는 [".$authcode."]입니다";
        $_SESSION["AUTHCODE"] = $authcode;
        $_SESSION["POST_PHONE"] = $phone;

        $url = "https://api-sms.cloud.toast.com/sms/v2.3/appKeys/{APP_KEY}/sender/sms";
        $key = 'appKey={APP_KEY}';
        $data = array(
            'body' => $msg,
            'sendNo' => '01029073897',
            'recipientList' => [[
                'recipientNo' => $phone
            ]]
        );
        $ch = curl_init();                                 //curl 초기화
        curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
        curl_setopt($ch, CURLOPT_POSTFIELDS, $key);        //키값 지정
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json')); //헤더 지정
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));       //POST data
        curl_setopt($ch, CURLOPT_POST, true);              //true시 post 전송 
        
        $response = curl_exec($ch);
        curl_close($ch);    
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
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 class="noto-extra" style="margin-top: 30px">트리니티 헬퍼</h1>
        <h4 class="noto-bold" style="line-height: 30px; margin-bottom: 20px">전화번호 인증</h4>
        <div class="login" style="margin: 80px 0 40px 0">
            <form action="register_check.php" method="post">
                <p class="main-notice">입력하신 전화번호로 인증번호가 전송되었습니다. 인증번호를 입력해주세요.</p>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <input type="number" class="form-control form-control-lg" name="auth" placeholder="인증번호 입력" style="font-size:16px; text-align:center" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <input type="submit" class="col-4 btn btn-info" value="인증" style="margin: 20px 0">
                </div>
            </form>
        </div>
    </div>
</body>
</html>