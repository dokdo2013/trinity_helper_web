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

    // Post 값이 있는지 확인
    if(isset($_POST["subj"]) && isset($_POST["class"])){
        $subj = $_POST["subj"];
        $class = $_POST["class"];
        $phone = $_SESSION["phone"];
        $stat = 1;
    }else{
        $_SESSION["err"] = "주의 : 잘못된 접근입니다.";
        $iserr = 1;
        header("Location: mypage.php");
    }

    // 신청 작업
    if($iserr == 0){
        $q = "INSERT INTO cuk(subj, class, phone, stat) VALUES('$subj', '$class', '$phone', $stat)";
        $mysqli->query($q);
        header("Location: view.php");
    }
