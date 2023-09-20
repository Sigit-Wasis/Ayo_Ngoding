<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .dashboard {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .widgets {
            display: flex;
            justify-content: space-between;
        }

        .widget {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            width: 48%;
            box-sizing: border-box;
        }

        .widget h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .logout {
            text-align: right;
            margin-top: 20px;
        }

        .logout button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .logout button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Selamat datang di Dashboard</h1>
        <p>Selamat datang, nama pengguna!</p>

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
            <button>Logout</button>
        </div>
    </div>
</body>
</html>
