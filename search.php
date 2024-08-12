<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>채용 정보 검색</title>
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
            margin-bottom: 5px;
            color: #495057;
        }
        input, select, button {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        footer {
            margin-top: 20px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <header>
        <h1>채용 정보 검색 시스템</h1>
        <p>원하는 채용 정보를 빠르고 쉽게 찾아보세요</p>
    </header>
    <main>
        <h1>채용 정보 검색</h1>
        <form action="search_results.php" method="GET">
            <label for="salary">연봉:</label>
            <select id="salary" name="salary" required>
                <option value="">선택하세요</option>
                <option value="3000">3000만원 미만</option>
                <option value="5000">5000만원 미만</option>
                <option value="7000">7000만원 미만</option>
                <option value="7000 이상">7000만원 이상</option>
            </select>

            <label for="location">지역:</label>
            <select id="location" name="location" required>
                <option value="">선택하세요</option>
                <option value="서울특별시">서울특별시</option>
                <option value="부산광역시">부산광역시</option>
                <option value="대구광역시">대구광역시</option>
                <option value="인천광역시">인천광역시</option>
                <option value="광주광역시">광주광역시</option>
                <option value="대전광역시">대전광역시</option>
                <option value="울산광역시">울산광역시</option>
                <option value="세종특별자치시">세종특별자치시</option>
                <option value="경기도">경기도</option>
                <option value="강원도">강원도</option>
                <option value="충청북도">충청북도</option>
                <option value="충청남도">충청남도</option>
                <option value="전라북도">전라북도</option>
                <option value="전라남도">전라남도</option>
                <option value="경상북도">경상북도</option>
                <option value="경상남도">경상남도</option>
                <option value="제주특별자치도">제주특별자치도</option>
            </select>

            <label for="size">회사 규모:</label>
            <select id="size" name="size" required>
                <option value="">선택하세요</option>
                <option value="대기업">대기업</option>
                <option value="중소기업">중소기업</option>
            </select>

            <button type="submit">검색</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 채용 정보 검색 시스템. 모든 권리 보유.</p>
    </footer>
</body>
</html>
