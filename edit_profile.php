<?php
// edit_profile.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// 데이터베이스 연결
include 'config.php';
$seeker_id = $_SESSION['seeker_id'];

// 사용자 정보 가져오기
$sql = "SELECT name, email, phone, certificate, education, experience, location FROM P_JOB_SEEKER WHERE seeker_id='$seeker_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user_info = $result->fetch_assoc();
} else {
    echo "사용자 정보를 찾을 수 없습니다.";
    exit();
}

// 수정 요청 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $certificate = $_POST['certificate'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $location = $_POST['location'];

    // 트랜잭션 시작
    $conn->begin_transaction();

    try {
        // P_JOB_SEEKER에서 사용자 정보 업데이트
        $sql = "UPDATE P_JOB_SEEKER SET 
                    name='$name',
                    email='$email',
                    phone='$phone',
                    certificate='$certificate',
                    education='$education',
                    experience='$experience',
                    location='$location'
                WHERE seeker_id='$seeker_id'";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("P_JOB_SEEKER 정보 수정 중 오류 발생: " . $conn->error);
        }

        // 여기서 외래 키로 참조된 다른 테이블도 업데이트할 수 있습니다.
        // 예: P_JOB_APPLICATION, 다른 외래 키가 있는 테이블 업데이트
        // 필요한 경우 아래에 업데이트 쿼리를 추가하십시오.

        // 트랜잭션 커밋
        $conn->commit();
        
        // 정보가 성공적으로 수정되었음을 알리는 메시지
        header('Location: mypage.php');
        exit();
    } catch (Exception $e) {
        // 트랜잭션 롤백
        $conn->rollback();
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        }
        h1 {
            color: #343a40;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type="text"], input[type="email"], textarea {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-top: 5px;
        }
        button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <main>
        <h1>Edit Profile</h1>
        <form action="edit_profile.php" method="post">
            <label for="name">이름:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_info['name']); ?>" required>

            <label for="email">이메일:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_info['email']); ?>" required>

            <label for="phone">전화번호:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user_info['phone']); ?>" required>

            <label for="certificate">자격증:</label>
            <input type="text" id="certificate" name="certificate" value="<?php echo htmlspecialchars($user_info['certificate']); ?>" required>

            <label for="education">학력:</label>
            <input type="text" id="education" name="education" value="<?php echo htmlspecialchars($user_info['education']); ?>" required>

            <label for="experience">경력:</label>
            <input type="text" id="experience" name="experience" value="<?php echo htmlspecialchars($user_info['experience']); ?>" required>

            <label for="location">지역:</label>
            <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($user_info['location']); ?>" required>

            <button type="submit">정보 수정</button>
        </form>
    </main>
</body>
</html>
