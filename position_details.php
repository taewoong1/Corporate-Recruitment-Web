<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// 회사 ID 가져오기
$company_id = $_GET['company_id'];

// 포지션 정보 가져오기
$sql = "SELECT p.position_id, p.title, p.description, p.requirements, p.location
        FROM P_JOB_POSITION p
        JOIN P_JOB_COMPANY c ON p.position_id = c.position_id
        WHERE c.company_id = '$company_id'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>포지션 정보</title>
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
        header {
            background-color: #007bff;
            color: white;
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        main {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            max-width: 800px;
            width: 100%;
            margin: 20px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .position-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .position-card:hover {
            transform: translateY(-5px);
        }
        .position-card h2 {
            margin-top: 0;
            color: #007bff;
        }
        .position-card p {
            margin: 5px 0;
            color: #495057;
        }
        .position-card strong {
            color: #343a40;
        }
        .favorite-button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .favorite-button:hover {
            background-color: #0056b3;
        }
        .favorite-button.favorited {
            background-color: #FFD700;
            color: black;
        }
        footer {
            margin-top: 20px;
            color: #6c757d;
        }
    </style>
    <script>
        function addToFavorites(positionId) {
            var button = document.getElementById("favorite-button-" + positionId);
            button.classList.add("favorited");
            
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_favorites.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response.trim() !== "success") {
                        alert("즐겨찾기에 추가하는 데 실패했습니다.");
                    }
                }
            };
            xhr.send("position_id=" + positionId);
        }
    </script>
</head>
<body>
    <header>
        <h1>포지션 정보</h1>
    </header>
    <main>
        <h1>포지션 상세 정보</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="position-card">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><strong>설명:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                    <p><strong>요구사항:</strong> <?php echo nl2br(htmlspecialchars($row['requirements'])); ?></p>
                    <p><strong>지역:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                    <button id="favorite-button-<?php echo htmlspecialchars($row['position_id']); ?>" class="favorite-button" onclick="addToFavorites('<?php echo htmlspecialchars($row['position_id']); ?>')">즐겨찾기</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>해당 회사의 포지션 정보를 찾을 수 없습니다.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 채용 정보 검색 시스템. 모든 권리 보유.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

