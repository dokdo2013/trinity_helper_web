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

    // Get 값이 있는지 확인
    if(isset($_GET["num"])){
        $num = $_GET["num"];
        $phone = $_SESSION["phone"];
        $stat = 2;
    }else{
        $_SESSION["err"] = "주의 : 잘못된 접근입니다.";
        $iserr = 1;
        header("Location: mypage.php");
    }

    // 신청 작업
    if($iserr == 0){
        $q = "UPDATE cuk_star SET stat = $stat WHERE num = $num and phone = '$phone'";
        $mysqli->query($q);
        header("Location: star.php");
    }
