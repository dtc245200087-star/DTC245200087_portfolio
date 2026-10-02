<?php require 'db.php';
$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Portfolio - <?= htmlspecialchars($profile['fullname'] ?? '') ?></title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="hero">
  <h1><?= htmlspecialchars($profile['fullname'] ?? 'Portfolio') ?></h1>
  <p class="subtitle"><?= htmlspecialchars($profile['major'] ?? '') ?> — <?= htmlspecialchars($profile['student_id'] ?? '') ?></p>
  <p class="bio"><?= htmlspecialchars($profile['bio'] ?? '') ?></p>
  <p>
    Email: <a href="mailto:<?= htmlspecialchars($profile['email'] ?? '') ?>"><?= htmlspecialchars($profile['email'] ?? '') ?></a>
    | GitHub: <a href="<?= htmlspecialchars($profile['github'] ?? '#') ?>" target="_blank">Link</a>
  </p>
</header>

<main class="container">
  <h2>Dự án của tôi</h2>
  <div class="grid">
    <div class="card cv-preview">
      <h3>CV cá nhân</h3>
      <p>Thông tin về bản thân: học vấn, kỹ năng, kinh nghiệm, chứng chỉ, ngôn ngữ, sở thích</p>
      <span class="tag">CV, Thông tin cá nhân</span>
      <p><a href="cv.php">Xem thêm</a></p>
    </div>
    <?php foreach ($projects as $p): ?>
    <div class="card">
      <h3><?= htmlspecialchars($p['title']) ?></h3>
      <p><?= htmlspecialchars($p['description']) ?></p>
      <span class="tag"><?= htmlspecialchars($p['tech_stack']) ?></span>
      <?php if ($p['link']): ?>
        <p><a href="<?= htmlspecialchars($p['link']) ?>" target="_blank">Xem thêm</a></p>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</main>

<footer>
  <p>&copy; 2026 <?= htmlspecialchars($profile['fullname'] ?? '') ?> — MSSV: <?= htmlspecialchars($profile['student_id'] ?? '') ?></p>
  <p><a href="admin.php">Trang quản trị</a></p>
</footer>
</body>
</html>
