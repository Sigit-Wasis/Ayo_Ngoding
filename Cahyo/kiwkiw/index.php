<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .login-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .login-container button {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            box-sizing: border-box;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .dashboard-container {
            display: none;
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        .dashboard-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container" id="login-page">
        <img src="ca.jpg" alt="Cahyo Anom Image" width="auto" height="130px">
        <h2>CAHYO ANOM</h2>
        <form onsubmit="return login(event)">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>

    <div class="dashboard-container" id="dashboard-page">
        <h1>Selamat datang di Dashboard</h1>
        <p>Welcome Mas Bro</p>

        <div class="widgets">
            <div class="widget">
                <h2>Data 1</h2>
                <p>Deskripsi Data 1</p>
            </div>

            <div class="widget">
                <h2>Data 2</h2>
                <p>Deskripsi Data 2</p>
            </div>
        </div>

        <div class="logout">
            <button onclick="logout()">Logout</button>
        </div>
    </div>

    <script>
        function login(event) {
            event.preventDefault(); // Prevent form submission
            const loginPage = document.getElementById('login-page');
            const dashboardPage = document.getElementById('dashboard-page');
            loginPage.style.display = 'none';
            dashboardPage.style.display = 'block';
            return false;
        }

        function logout() {
            const loginPage = document.getElementById('login-page');
            const dashboardPage = document.getElementById('dashboard-page');
            loginPage.style.display = 'block';
            dashboardPage.style.display = 'none';
        }
    </script>
</body>
</html>
