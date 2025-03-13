<?php
$errors = [];
$success_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'] ?? ""));
    $email = htmlspecialchars(trim($_POST['email'] ?? ""));
    $password = htmlspecialchars(trim($_POST['password'] ?? ""));
    $repeat_password = htmlspecialchars(trim($_POST['repeat-password'] ?? ""));

    // Validate Username
    if (empty($username)) {
        $errors['username'] = "Vui lòng nhập họ tên.";
    }

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Vui lòng nhập email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ.";
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Vui lòng nhập mật khẩu.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Mật khẩu phải có ít nhất 6 ký tự.";
    }

    // Validate Repeat Password
    if ($password !== $repeat_password) {
        $errors['repeat-password'] = "Mật khẩu xác nhận không khớp.";
    }

    // If no errors, registration is successful
    if (empty($errors)) {
        $success_message = "Đăng ký thành công! Chào mừng, $username.";
        // Clear form values
        $username = $email = $password = $repeat_password = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Register Page</title>
  </head>
  <body>
    <div class="wrapper fade-in-down">
      <div id="form-content">
        <!-- Tabs Titles -->
        <a href="/login.html">
          <h2 class="inactive underline-hover">Đăng nhập</h2>
        </a>
        <a href="/register.php">
          <h2 class="active">Đăng ký</h2>
        </a>

        <!-- Icon -->
        <div class="fade-in first">
          <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
        </div>

        <!-- Display Errors or Success Message -->
        <?php if (!empty($errors)): ?>
          <div class="error-messages">
            <?php foreach ($errors as $field => $error): ?>
              <p><?php echo $error; ?></p>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
          <div class="success-message">
            <p><?php echo $success_message; ?></p>
          </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <form method="POST" action="">
          <input
            type="text"
            id="username"
            class="fade-in first"
            name="username"
            placeholder="Họ tên"
            value="<?php echo htmlspecialchars($username ?? ''); ?>"
          />
          <?php if (!empty($errors['username'])): ?>
            <p class="error"><?php echo $errors['username']; ?></p>
          <?php endif; ?>

          <input
            type="email"
            id="Email"
            class="fade-in second"
            name="email"
            placeholder="Email"
            value="<?php echo htmlspecialchars($email ?? ''); ?>"
          />
          <?php if (!empty($errors['email'])): ?>
            <p class="error"><?php echo $errors['email']; ?></p>
          <?php endif; ?>

          <input
            type="password"
            id="password"
            class="fade-in third"
            name="password"
            placeholder="Mật khẩu"
          />
          <?php if (!empty($errors['password'])): ?>
            <p class="error"><?php echo $errors['password']; ?></p>
          <?php endif; ?>

          <input
            type="password"
            id="repeat-password"
            class="fade-in fourth"
            name="repeat-password"
            placeholder="Xác nhận mật khẩu"
          />
          <?php if (!empty($errors['repeat-password'])): ?>
            <p class="error"><?php echo $errors['repeat-password']; ?></p>
          <?php endif; ?>

          <input type="submit" class="fade-in five" value="Đăng ký" />
        </form>

        <!-- Remind Password -->
        <div id="form-footer">
          <a class="underline-hover" href="#">Quên mật khẩu?</a>
        </div>
      </div>
    </div>
  </body>
</html>
