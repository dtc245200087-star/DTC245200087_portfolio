<?php require 'db.php';
$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$cv = $pdo->query("SELECT * FROM cv_details LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>CV - <?= htmlspecialchars($profile['fullname'] ?? '') ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="hero small">
  <h1>CV Cá Nhân</h1>
  <p><a href="index.php">← Về trang chủ</a></p>
</header>

<main class="container">
  <section class="cv-section">
    <h2>Thông tin cá nhân</h2>
    <div class="cv-grid">
      <div class="cv-card">
        <h3>Họ tên</h3>
        <p><?= htmlspecialchars($profile['fullname'] ?? '') ?></p>
      </div>
      <div class="cv-card">
        <h3>Mã sinh viên</h3>
        <p><?= htmlspecialchars($profile['student_id'] ?? '') ?></p>
      </div>
      <div class="cv-card">
        <h3>Chuyên ngành</h3>
        <p><?= htmlspecialchars($profile['major'] ?? '') ?></p>
      </div>
      <div class="cv-card">
        <h3>Email</h3>
        <p><?= htmlspecialchars($profile['email'] ?? '') ?></p>
      </div>
    </div>
  </section>

  <section class="cv-section">
    <h2>Chi tiết CV</h2>
    <div class="cv-grid">
      <div class="cv-card">
        <h3>Giới thiệu</h3>
        <p><?= htmlspecialchars($cv['about_long'] ?? '') ?></p>
      </div>
      <div class="cv-card">
        <h3>Học vấn</h3>
        <p><?= nl2br(htmlspecialchars($cv['education'] ?? '')) ?></p>
      </div>
      <div class="cv-card">
        <h3>Kỹ năng</h3>
        <div class="skill-tags">
          <?php foreach (explode(',', $cv['skills'] ?? '') as $skill): ?>
            <span class="skill-tag"><?= htmlspecialchars(trim($skill)) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="cv-card">
        <h3>Kinh nghiệm</h3>
        <p><?= nl2br(htmlspecialchars($cv['experience'] ?? '')) ?></p>
      </div>
      <div class="cv-card">
        <h3>Chứng chỉ</h3>
        <p><?= nl2br(htmlspecialchars($cv['certifications'] ?? '')) ?></p>
      </div>
      <div class="cv-card">
        <h3>Ngôn ngữ</h3>
        <p><?= htmlspecialchars($cv['languages'] ?? '') ?></p>
      </div>
      <div class="cv-card">
        <h3>Sở thích</h3>
        <p><?= htmlspecialchars($cv['interests'] ?? '') ?></p>
      </div>
    </div>
  </section>
</main>

<footer>
  <p>&copy; 2026 <?= htmlspecialchars($profile['fullname'] ?? '') ?> — MSSV: <?= htmlspecialchars($profile['student_id'] ?? '') ?></p>
  <p><a href="index.php">Trang chủ</a> | <a href="admin.php">Quản trị</a></p>
</footer>
</body>
</html>
