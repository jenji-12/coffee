<?php 
include '../header.php';
include '../navber.php'; 

    // ดึงข้อมูลสมาชิกทั้งหมด
    $stmt = $pdo->query("SELECT id, name, phone, cups_bought FROM members ORDER BY name");
    $members = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>รายชื่อสมาชิกและคะแนนสะสม - Coffee Shop</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="../css/members.css">
</head>

<body>


  
<div class="container">
    <div class="rounded-box">
        <h2 class="dashboard-title">รายชื่อสมาชิกและแก้วสะสม</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อสมาชิก</th>
                    <th>เบอร์โทร</th>
                    <th>แก้วสะสม</th>
                    <th>แก้วฟรี</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($members) > 0): ?>
                    <?php foreach($members as $index => $m): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($m['name']) ?></td>
                            <td><?= htmlspecialchars($m['phone']) ?></td>
                            <td><?= htmlspecialchars($m['cups_bought']) ?></td>
                            <td><?= floor($m['cups_bought']/10) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">ไม่มีสมาชิกในระบบ</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
