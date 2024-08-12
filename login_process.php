<?php
include 'config.php';
session_start();

// 폼에서 제출된 데이터 가져오기
$seeker_id = $_POST['seeker_id'];

// 사용자 인증 쿼리
$sql = "SELECT * FROM P_JOB_SEEKER WHERE seeker_id = '$seeker_id'";
$result = $conn->query($sql);

// 쿼리 결과 확인
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // 아이디가 존재하는 경우 세션에 사용자 이름과 seeker_id 저장
    $_SESSION['username'] = $row['name'];
    $_SESSION['seeker_id'] = $seeker_id;
    header("Location: background.php");
    exit(); // 리디렉션 후 스크립트 종료
} else {
    echo "아이디 또는 비밀번호가 잘못되었습니다.";
}

$conn->close();
?>


