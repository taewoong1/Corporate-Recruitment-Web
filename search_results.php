<?php
include 'config.php';

// 폼에서 제출된 데이터 가져오기
$salary = $_GET['salary'];
$location = $_GET['location'];
$size = $_GET['size'];

// 연봉 조건 처리
if ($salary == '7000 이상') {
    $salary_condition = "salary >= 7000";
} else {
    $salary_condition = "salary < $salary";
}

// 쿼리 작성
$sql = "SELECT company_id, company_name, salary, location, size 
        FROM P_JOB_COMPANY 
        WHERE $salary_condition
        AND location = '$location'
        AND size = '$size'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>채용 검색 결과</title>
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
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ced4da;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>채용 검색 결과</h1>
    </header>
    <main>
        <h1>검색 결과</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>회사명</th>
                        <th>연봉</th>
                        <th>지역</th>
                        <th>규모</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><a href="position_details.php?company_id=<?php echo htmlspecialchars($row['company_id']); ?>"><?php echo htmlspecialchars($row['company_name']); ?></a></td>
                            <td><?php echo htmlspecialchars($row['salary']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['size']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>검색 결과가 없습니다.</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php
$conn->close();
?>

