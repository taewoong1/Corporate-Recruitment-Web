<?php
$servername = "ibiz.khu.ac.kr"; // 원격 서버의 MySQL 서버 주소
$username = "twlee"; // MySQL 사용자 이름
$password = "2020103958"; // MySQL 사용자 비밀번호
$dbname = "twlee"; // 사용할 데이터베이스 이름

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
