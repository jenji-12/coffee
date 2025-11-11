<?php 
include '../header.php'; 
include '../navber.php'; 

?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สมัครสมาชิก - Coffee Shop</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../css/member.css">
</head>
<body>
<div class="rounded-box">
    <h3 class="dashboard-title text-center mb-4">สมัครสมาชิกสะสมแต้ม</h3>
    <form method="POST" action="">
      <input type="text" name="name" placeholder="ชื่อ" required>
      <input type="text" name="phone" placeholder="เบอร์โทรศัพท์" required>
      <button type="submit"><i class="fas fa-user-plus mr-2"></i> สมัครสมาชิก</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);

        // ตรวจสอบซ้ำ
        $check = $pdo->prepare("SELECT id FROM members WHERE phone = ?");
        $check->execute([$phone]);

        if ($check->rowCount() > 0) {
            echo "<p class='message error'>เบอร์นี้มีอยู่ในระบบแล้ว</p>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO members (name, phone) VALUES (?, ?)");
            if ($stmt->execute([$name, $phone])) {
                echo "<p class='message success'>สมัครสมาชิกสำเร็จ</p>";
            } else {
                echo "<p class='message error'>เกิดข้อผิดพลาด</p>";
            }
        }
    }
    ?>
</div>

</body>
</html>
