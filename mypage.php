<?php
// mypage.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// 데이터베이스 연결
include 'config.php';
$seeker_id = $_SESSION['seeker_id'];

// 사용자 정보 가져오기
$sql = "SELECT seeker_id, name, email, phone, certificate, education, experience, location FROM P_JOB_SEEKER WHERE seeker_id='$seeker_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
} else {
    echo "사용자 정보를 찾을 수 없습니다.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        main {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            max-width: 600px;
            width: 100%;
            margin: 20px;
            position: relative;
        }
        h1 {
            color: #343a40;
        }
        p, ul {
            color: #495057;
        }
        .user-info {
            list-style: none;
            padding: 0;
        }
        .user-info li {
            padding: 10px 0;
            border-bottom: 1px solid #ced4da;
        }
        .user-info li:last-child {
            border-bottom: none;
        }
        .delete-btn, .edit-btn {
            position: absolute;
            bottom: 20px;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .delete-btn {
            right: 20px;
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .edit-btn {
            left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <main>
        <h1>My Page</h1>
        <h2>내 정보</h2>
        <ul class="user-info">
            <li><strong>아이디:</strong> <?php echo htmlspecialchars($user_info['seeker_id']); ?></li>
            <li><strong>이름:</strong> <?php echo htmlspecialchars($user_info['name']); ?></li>
            <li><strong>이메일:</strong> <?php echo htmlspecialchars($user_info['email']); ?></li>
            <li><strong>전화번호:</strong> <?php echo htmlspecialchars($user_info['phone']); ?></li>
            <li><strong>자격증:</strong> <?php echo htmlspecialchars($user_info['certificate']); ?></li>
            <li><strong>학력:</strong> <?php echo htmlspecialchars($user_info['education']); ?></li>
            <li><strong>경력:</strong> <?php echo htmlspecialchars($user_info['experience']); ?></li>
            <li><strong>지역:</strong> <?php echo htmlspecialchars($user_info['location']); ?></li>
        </ul>
        <form action="delete_account.php" method="post" onsubmit="return confirm('정말로 회원 탈퇴하시겠습니까?');">
            <button type="submit" class="delete-btn">회원 탈퇴</button>
        </form>
        <form action="edit_profile.php" method="get">
            <button type="submit" class="edit-btn">회원정보수정</button>
        </form>
    </main>
</body>
</html>
