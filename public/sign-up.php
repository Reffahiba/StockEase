<?php
    include "koneksi.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $retype_password = $_POST["retype_password"];

        if (empty($username) || empty($email) || empty($password) || empty($retype_password)) {
        echo "Semua bidang harus diisi.";
        } else if ($password != $retype_password) {
            echo "<script> 
                alert('Retype Password tidak benar.');
                window.location.href='../sign-up.php';
                </script>";
        } else {
            $check_query = "SELECT * FROM akun_user WHERE username = '$username'";
            $result = mysqli_query($conn, $check_query);

            if(mysqli_num_rows($result) > 0){
                echo "<script>
                alert('Username sudah digunakan. Silakan coba dengan username yang lain.');
                window.location.href='../sign-up.php';
                </script>";
            } else {
                $sql = "INSERT into akun_user (username, email, password) VALUES ('$username', '$email', '$password')";

                if (mysqli_query($conn, $sql)) {
                    header("Location: ../sign-in.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body
    style="
      background-image: url('gambar/background.jpg');
      background-repeat: no-repeat;
      background-size: 100%;
      background-position: center;
    "
  >
    <div class="container mx-auto h-screen flex justify-center items-center">
      <div class="w-full max-w-3xl">
        <div class="bg-blue-50 rounded-lg overflow-hidden flex shadow-lg">
          <div class="w-1/2 bg-baby-blue p-8 relative">
            <div class="flex justify-between mb-6">
              <button
                class="w-1/2 bg-cool-blue rounded-l-full p-1 relative overflow-hidden text-baby-blue font-bold border-b-1 border-indigo-700 flex justify-center shadow-md"
              >
                <a href="sign-in.php">Sign In</a>
              </button>
              <button
                class="w-1/2 bg-baby-blue rounded-r-full p-1 relative text-cool-blue font-bold border-b-1 border-white flex justify-center shadow-md"
              >
                <a href="sign-up.php">Sign Up</a>
              </button>
            </div>
            <form action="sign-up.php" method="post">
              <div class="mb-4">
                <div
                  class="flex items-center px-5 bg-baby-blue rounded-full shadow-md"
                >
                  <img src="gambar/user.png" alt="user" class="w-7" />
                  <input
                    class="flex-1 py-1 pl-6 bg-baby-blue text-cool-blue font-semibold rounded-full focus:outline-none text-1xl"
                    type="text"
                    name="username"
                    placeholder="Username"
                  />
                </div>
              </div>
              <div class="mb-4">
                <div
                  class="flex items-center px-5 bg-baby-blue rounded-full shadow-md"
                >
                  <img src="gambar/email.png" alt="lock" class="w-7" />
                  <input
                    class="flex-1 py-1 pl-6 bg-baby-blue text-cool-blue font-semibold rounded-full focus:outline-none text-1xl"
                    type="email"
                    name="email"
                    placeholder="Email"
                  />
                </div>
              </div>
              <div class="mb-4">
                <div
                  class="flex items-center px-5 bg-baby-blue rounded-full shadow-md"
                >
                  <img src="gambar/lock-circle.png" alt="lock" class="w-7" />
                  <input
                    class="flex-1 py-1 pl-6 bg-baby-blue text-cool-blue font-semibold rounded-full focus:outline-none text-1xl"
                    type="password"
                    name="password"
                    placeholder="Password"
                  />
                </div>
              </div>
              <div class="mb-7">
                <div
                  class="flex items-center px-5 bg-baby-blue rounded-full shadow-md"
                >
                  <img src="gambar/lock-circle.png" alt="lock" class="w-7" />
                  <input
                    class="flex-1 py-1 pl-6 bg-baby-blue text-cool-blue font-semibold rounded-full focus:outline-none text-1xl"
                    type="password"
                    name="retype_password"
                    placeholder="Retype Password"
                  />
                </div>
              </div>
              <div class="flex justify-center">
                <button
                  class="w-1/3 bg-cool-blue text-white font-medium py-1 px-4 rounded-full flex items-center justify-center hover:bg-baby-blue;text-cool-blue shadow-md"
                  type="submit"
                >
                  Sign Up
                </button>
              </div>
            </form>
          </div>
          <div
            class="w-1/2 bg-light-sky-blue flex flex-col justify-center items-center p-8"
          >
            <img src="gambar/icon.png" alt="logo" class="w-1/2 mb-3" />
            <h1 class="text-cool-blue text-5xl font-semibold">StokEase</h1>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
