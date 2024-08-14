<?php
    include "koneksi.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $check_query = "SELECT * FROM akun_user WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $check_query);

        if($result){
            if(mysqli_num_rows($result) > 0){
                session_start();
                $_SESSION['username'] = $username;

                if(isset($_POST["remember_me"])){
                    setcookie("username", $username, time() + (86400 * 30), "/");
                } else{
                    if(isset($_COOKIE["username"])){
                        setcookie("username", "", time() - 3600, "/");
                    }
                }

                header("Location: /public/dashboard.php");
                exit();
            } else {
                echo "<script>
                  alert('Username dan password tidak ada.');
                  window.location.href='../sign-in.php';
                </script>";
            }
        } else {
            echo "<script>alert('Terjadi kesalahan dalam query');</script>";
        }
        mysqli_close($conn);
    } else{
        if(isset($_COOKIE["username"])){
            $username = $_COOKIE["username"];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
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
          <div
            class="w-1/2 bg-baby-blue flex flex-col justify-center items-center p-8"
          >
            <img src="gambar/icon.png" alt="logo" class="w-1/2 mb-3" />
            <h1 class="text-cool-blue text-5xl font-semibold">StokEase</h1>
          </div>
          <div class="w-1/2 bg-light-sky-blue p-8 relative">
            <div class="flex justify-between mb-6">
              <button
                class="w-1/2 bg-baby-blue rounded-l-full p-1 relative overflow-hidden text-cool-blue font-bold flex justify-center shadow-md"
              >
                <a href="sign-in.php">Sign In</a>
              </button>
              <button
                class="w-1/2 bg-cool-blue rounded-r-full p-1 relative text-baby-blue font-bold flex justify-center shadow-md"
              >
                <a href="sign-up.php">Sign Up</a>
              </button>
            </div>
            <form action="sign-in.php" method="post">
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
                    value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>"
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
              <div class="flex justify-between items-center mb-4">
                <div>
                  <input type="checkbox" id="remember_me" name="remember_me" />
                  <label for="remember_me" class="text-cool-blue text-sm"
                    >Remember Me</label
                  >
                </div>
                <a href="forget-password.php" class="text-cool-blue text-sm"
                  >Forget Password?</a
                >
              </div>
              <div class="flex justify-center mb-5">
                <button
                  class="w-1/3 bg-cool-blue text-white font-medium py-1 px-4 rounded-full flex items-center justify-center hover:bg-baby-blue;text-cool-blue shadow-md"
                  type="submit"
                >
                  Sign In
                </button>
              </div>
            </form>
            <div class="flex justify-center mb-4">
              <div class="text-cool-blue text-sm">Or login with</div>
            </div>
            <div class="flex justify-center">
              <button
                class="w-2/5 bg-white font-medium py-1 px-4 rounded-full flex items-center justify-center hover:bg-baby-blue"
                type="button"
              >
                <img src="gambar/google.png" alt="google" class="w-5 mr-2" />
                <span class="text-gradient">Google</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
