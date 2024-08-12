<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>회원가입</h1>
        <form action="signup_process.php" method="POST">
            <label for="seeker_id">아이디:</label>
            <input type="text" id="seeker_id" name="seeker_id" required><br>
            <label for="password">비밀번호:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="name">이름:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="email">이메일:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="phone">전화번호:</label>
            <input type="tel" id="phone" name="phone" required><br>
            <label for="certificate">자격증:</label>
            <input type="text" id="certificate" name="certificate" required><br>
            <label for="education">학력:</label>
            <select id="education" name="education" required>
                <option value="고졸">고졸</option>
                <option value="학사">학사</option>
                <option value="석사">석사</option>
            </select><br>
            <label for="experience">경력:</label>
            <input type="text" id="experience" name="experience" required><br>
            <label for="location">위치:</label>
            <input type="text" id="location" name="location" required><br>
            <button type="submit">회원가입</button>
        </form>
    </div>
</body>
</html>
