<?php
session_start();
require 'db_con.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize inputs
    $lastname    = trim($_POST['lastname'] ?? '');
    $middlename  = trim($_POST['middlename'] ?? '');
    $firstname   = trim($_POST['firstname'] ?? '');
    $section     = trim($_POST['section'] ?? '');
    $gender      = trim($_POST['gender'] ?? '');
    $age         = intval($_POST['age'] ?? 0);
    $address     = trim($_POST['address'] ?? '');
    $tel_number  = trim($_POST['tel_number'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $password    = trim($_POST['password'] ?? '');

    // Basic validation
    if (
        empty($lastname) || empty($firstname) || empty($section) ||
        empty($gender) || empty($age) || empty($address) ||
        empty($tel_number) || empty($email) || empty($password)
    ) {
        $error = "All fields are required.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }
    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    }
    else {

        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM alumni_db WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already registered.";
        } else {

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $conn->prepare("
                INSERT INTO alumni_db 
                (lastname, middlename, firstname, section, gender, age, address, tel_number, email, password)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "sssssiisss",
                $lastname,
                $middlename,
                $firstname,
                $section,
                $gender,
                $age,
                $address,
                $tel_number,
                $email,
                $hashedPassword
            );

            if ($stmt->execute()) {
                $success = "Registration successful. You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }

            $stmt->close();
        }
        $check->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="/asset/output.css">
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('/asset/img/image-banoyo.jpg');">
    <!-- Card -->
    <div
        class="w-full max-w-4xl bg-yellow-100 flex flex-col justify-center items-center backdrop-blur-md shadow-xl p-6">
        <a href="/index.html" class="text-2xl">&times;</a>
        <form class="max-w-xl mx-auto space-y-6">
            <h2 class="text-center text-3xl font-bold uppercase text-slate-600">
                Register Form
            </h2>

            <!-- Name -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="text-slate-600 text-sm">Lastname</label>
                    <input type="text" name="lastname" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-slate-600 text-sm">Middlename</label>
                    <input type="text" name="middlename" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-slate-600 text-sm">Firstname</label>
                    <input type="text" name="firstname" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
            </div>

            <!-- Section / Gender / Age -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-slate-600 text-sm">Section</label>
                    <input type="text" name="section" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-slate-600 text-sm">Gender</label>
                    <select name="gender" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                        <option value="" disabled selected>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="text-slate-600 text-sm">Age</label>
                    <input type="number" name="age" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
            </div>

            <!-- Address / Tel / Email -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-slate-600 text-sm">Address</label>
                    <input type="text" name="address" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-slate-600 text-sm">Tel Number</label>
                    <input type="text" name="tel_number" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-slate-600 text-sm">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-between items-center mt-4 gap-4">
                <a href="/asset/login.html" class="text-amber-700 hover:underline text-sm">
                    Already have an account?
                </a>

                <button
                    class="bg-blue-500 px-4 py-2 rounded text-white uppercase font-semibold cursor-pointer hover:bg-blue-600">
                    submit
                </button>
            </div>
        </form>
    </div>
</body>

</html>