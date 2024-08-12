<?php
include 'config.php';
session_start();

if (!isset($_SESSION['seeker_id'])) {
    echo "로그인이 필요합니다.";
    exit();
}

$seeker_id = $_SESSION['seeker_id'];
$position_id = $_POST['position_id'];

// 포지션 정보 가져오기
$sql = "SELECT title, description, requirements, location FROM P_JOB_POSITION WHERE position_id='$position_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // 즐겨찾기 추가 쿼리
    $stmt = $conn->prepare("INSERT INTO P_JOB_FAVORITES (seeker_id, position_id, title, description, requirements, location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $seeker_id, $position_id, $row['title'], $row['description'], $row['requirements'], $row['location']);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
} else {
    echo "포지션을 찾을 수 없습니다.";
}

$conn->close();
?>
