<?php
include '../db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';

        // ตรวจสอบว่ากรอกข้อมูลมาหรือไม่
        if (empty($name) || empty($phone)) {
            echo 'error: กรุณากรอกชื่อและเบอร์โทรศัพท์';
            exit;
        }

        // ตรวจสอบเบอร์ซ้ำ
        $stmtCheck = $pdo->prepare("SELECT id FROM members WHERE phone = ?");
        $stmtCheck->execute([$phone]);

        if ($stmtCheck->rowCount() > 0) {
            echo 'error: เบอร์โทรศัพท์นี้สมัครแล้ว';
            exit;
        }

        // เพิ่มสมาชิกใหม่
        $stmt = $pdo->prepare("INSERT INTO members (name, phone) VALUES (:name, :phone)");
        $stmt->execute([
            ':name' => $name,
            ':phone' => $phone
        ]);

        echo 'success';
        exit;
    }
?>
