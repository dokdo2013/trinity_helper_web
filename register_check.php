<?php
    require_once('database.php');
    session_start();
    $iserr = 0;
    // POST로 잘 넘어왔는지 확인
    if(isset($_POST["auth"])){
        $user_auth = $_POST["auth"];
    }else{
        $_SESSION["err"] = "주의 : 인증번호가 입력되지 않았습니다.";
        $iserr = 1;
        header("Location: index.php");
    }

    // AUTHCODE 값이 있는지 확인
    if(isset($_SESSION["AUTHCODE"])){
        $real_auth = $_SESSION["AUTHCODE"];
        unset($_SESSION["AUTHCODE"]);
    }else{
        $_SESSION["err"] = "주의 : 인증번호 정보가 없습니다.";
        $iserr = 1;
        header("Location: index.php");
    }

    // AUTHCODE가 일치하는지 확인
    if($iserr == 0){
        if(trim($user_auth) == $real_auth){
            // 인증 성공
            $_SESSION["login"] = 1;
            $_SESSION["phone"] = $_SESSION["POST_PHONE"];
            unset($_SESSION["POST_PHONE"]);
            // 2020.08.29 수정 - 회원가입 창으로 이동
            header("Location: signin.php");
            //header("Location: mypage.php");
        }else{
            // 인증 실패
            $_SESSION["err"] = "주의 : 인증번호가 일치하지 않습니다. 다시 시도해주세요.";
            $iserr = 1;
            header("Location: index.php");    
        }
    }else{
        $_SESSION["err"] = "주의 : 잘못된 접근입니다.";
        $iserr = 1;
        header("Location: index.php");
    }
