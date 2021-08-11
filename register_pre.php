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
    $q = "SELECT count(*) as cnt FROM cuk_account WHERE phone = $phone";
    $r = $mysqli->query($q);
    $d = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $cnt = $d["cnt"];
    // 로그인 정보가 있는 휴대전화번호일 경우 : 비밀번호 입력
    if($cnt > 0){
        header("Location : login.php");
    }
    // 로그인 정보가 없는 휴대전화번호일 경우 : 비밀번호 등록 화면으로 이동
    if($cnt <= 0){
        header("Location : register.php");
    }
