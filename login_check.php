<?php
    require_once('database.php');
    session_start();
    
    $iserr = 0;
    // 비밀번호 유효성 검사
    if(isset($_POST["passwd"])){
        $passwd = $_POST["passwd"];        
    }else{
        $_SESSION["err"] = "주의 : 비밀번호가 입력되지 않았습니다.";
        $iserr = 1;
        header("Location: index.php");
    }

    // DB에서 값 가져오기
    if(isset($_SESSION["POST_PHONE"])){
        $phone = $_SESSION["POST_PHONE"];
    }else{
        $_SESSION["err"] = "주의 : 전화번호 값이 넘어오지 않았습니다.";
        $iserr = 1;
        header("Location: index.php");
    }
    $q = "SELECT passwd FROM cuk_account WHERE phone = $phone";
    $r = $mysqli->query($q);
    $d = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $real_passwd = $d["passwd"];

    // 입력한 패스워드가 일치하는지 확인
    if($real_passwd == $passwd){
        
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
