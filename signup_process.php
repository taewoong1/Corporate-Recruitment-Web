<?php
include 'config.php';

// 폼에서 제출된 데이터 가져오기
$seeker_id = $_POST['seeker_id'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // 비밀번호 해시화
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$certificate = $_POST['certificate'];
$education = $_POST['education'];
$experience = $_POST['experience'];
$location = $_POST['location'];

// 데이터 삽입 쿼리
$sql = "INSERT INTO P_JOB_SEEKER (seeker_id, name, email, phone, certificate, education, experience, location, password)
VALUES ('$seeker_id', '$name', '$email', '$phone', '$certificate', '$education', '$experience', '$location', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit(); // 리디렉션 후 스크립트 종료
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
