<?php
// background.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

include 'config.php';

// 즐겨찾기 목록 가져오기
$seeker_id = $_SESSION['seeker_id'];
$sql = "SELECT * FROM P_JOB_FAVORITES WHERE seeker_id = '$seeker_id'";
$favorites_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인 페이지</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        header {
            background-color: #007bff;
            color: white;
            width: 100%;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        main {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
        p {
            color: #495057;
            margin-bottom: 40px;
        }
        button {
            width: 80%;
            padding: 15px;
            margin: 10px 0;
            border: none;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        footer {
            margin-top: 40px;
            color: #6c757d;
        }
        .favorite-list {
            text-align: left;
            margin-top: 20px;
        }
        .favorite-list h2 {
            color: #343a40;
        }
        .favorite-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>메인 페이지</h1>
    </header>
    <main>
        <h1>환영합니다, <?php echo htmlspecialchars($_SESSION['username']); ?>님!</h1>
        <p>채용 정보 검색 시스템에 오신 것을 환영합니다.<br>
        아래 버튼을 클릭하여 원하는 정보를 찾아보세요.</p>
        <button onclick="location.href='search.php'">채용정보 검색</button>
        <button onclick="location.href='mypage.php'">마이페이지</button>
        <div class="favorite-list">
            <h2>즐겨찾기 목록</h2>
            <?php if ($favorites_result->num_rows > 0): ?>
                <?php while ($favorite = $favorites_result->fetch_assoc()): ?>
                    <div class="favorite-item">
                        <h3><?php echo htmlspecialchars($favorite['title']); ?></h3>
                        <p><strong>설명:</strong> <?php echo nl2br(htmlspecialchars($favorite['description'])); ?></p>
                        <p><strong>요구사항:</strong> <?php echo nl2br(htmlspecialchars($favorite['requirements'])); ?></p>
                        <p><strong>지역:</strong> <?php echo htmlspecialchars($favorite['location']); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>즐겨찾기한 포지션이 없습니다.</p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 채용 정보 검색 시스템. 모든 권리 보유.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

