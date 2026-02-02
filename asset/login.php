<?php
session_start();
include 'db_con.php';

$user = '';
$password = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = trim($_POST['user']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM alumni_db WHERE user = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $row['user'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnia Website</title>

    <!-- Tailwind -->
    <link rel="stylesheet" href="./output.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="w-full min-h-screen bg-slate-500 flex items-center justify-center">

    <div
        class="w-full md:w-1/2 min-h-screen md:min-h-[75vh] md:grid md:grid-cols-3 flex shadow-lg rounded-lg overflow-hidden">

        <!-- LEFT IMAGE -->
        <div class="hidden md:flex justify-center items-center">
            <img src="/asset/img/image-banoyo.jpg" alt="Login Banner"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
        </div>

        <!-- LOGIN FORM -->
        <form method="POST" action=""
            class="md:col-span-2 w-full bg-yellow-100 flex flex-col justify-center items-center gap-4 px-6">

            <div class="w-full flex justify-end">
                <a href="/index.php">
                    <i class="fa-solid fa-xmark text-slate-500 text-xl"></i>
                </a>
            </div>

            <h2 class="uppercase font-bold text-2xl text-slate-600">
                Welcome Back!
            </h2>

            <!-- ERROR MESSAGE -->
            <?php if (!empty($error)): ?>
            <div class="bg-red-200 text-red-700 px-4 py-2 rounded-md text-sm w-full text-center">
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <!-- USERNAME -->
            <div class="flex items-center gap-2 w-full max-w-sm">
                <i class="fa-solid fa-user text-slate-500"></i>
                <input type="text" name="user" class="w-full border border-slate-500 p-2 rounded-md"
                    placeholder="Enter your Username" required>
            </div>

            <!-- PASSWORD -->
            <div class="flex items-center gap-2 w-full max-w-sm">
                <i class="fa-solid fa-lock text-slate-500"></i>
                <input type="password" name="password" class="w-full border border-slate-500 p-2 rounded-md"
                    placeholder="Enter your Password" required>
            </div>

            <!-- LINKS -->
            <div class="flex justify-between w-full max-w-sm text-sm">
                <a href="#" class="text-slate-500 font-semibold hover:underline">
                    Forgot password?
                </a>
                <a href="#" class="text-slate-500 font-semibold hover:underline">
                    Sign-up
                </a>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="bg-slate-600 hover:bg-slate-500 text-white uppercase font-semibold 
                       px-8 py-2 rounded-md w-full max-w-sm transition">
                Login
            </button>

            <!-- ICON -->
            <div class="mt-4">
                <img src="/icon/logo_15465616.png" alt="Logo" class="w-6 h-6">
            </div>

        </form>
    </div>
    <script>
    function login(event) {
        event.preventDefault();

        const user = document.getElementById('user').value;
        const password = document.getElementById('password').value;
        const button = event.target.querySelector('button');
        const originalText = button.textContent;

        button.textContent = 'Logging in...';
        button.disabled = true;

        setTimeout(() => {
            if (user === '' && password === '') {
                alert('Welcome user');
                window.location.href = '/landing/landing.html';
            } else {
                alert('User not found');
                button.textContent = originalText;
                button.disabled = false;
            }
        }, 1500);
    }
    </script>
</body>

</html>