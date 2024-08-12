<?php
// delete_account.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// 데이터베이스 연결
include 'config.php';
$seeker_id = $_SESSION['seeker_id'];

// 트랜잭션 시작
$conn->begin_transaction();

try {
    // P_JOB_APPLICATION에서 해당 사용자의 레코드 삭제
    $sql = "DELETE FROM P_JOB_APPLICATION WHERE seeker_id='$seeker_id'";
    if ($conn->query($sql) !== TRUE) {
        throw new Exception("P_JOB_APPLICATION 레코드 삭제 중 오류 발생: " . $conn->error);
    }

    // P_JOB_SEEKER에서 사용자 삭제
    $sql = "DELETE FROM P_JOB_SEEKER WHERE seeker_id='$seeker_id'";
    if ($conn->query($sql) !== TRUE) {
        throw new Exception("P_JOB_SEEKER 레코드 삭제 중 오류 발생: " . $conn->error);
    }

    // 트랜잭션 커밋
    $conn->commit();

    // 세션 종료
    session_destroy();
    header('Location: index.php');
    exit();
} catch (Exception $e) {
    // 트랜잭션 롤백
    $conn->rollback();
    echo $e->getMessage();
}
?>
