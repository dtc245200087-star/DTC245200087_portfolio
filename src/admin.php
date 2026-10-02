<?php require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $pdo->prepare("INSERT INTO projects (title, description, tech_stack, link) VALUES (?,?,?,?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['tech_stack'], $_POST['link']]);
    header("Location: admin.php"); exit;
}
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: admin.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $stmt = $pdo->prepare("UPDATE profile SET fullname=?, major=?, bio=?, email=?, github=? WHERE id=1");
    $stmt->execute([$_POST['fullname'], $_POST['major'], $_POST['bio'], $_POST['email'], $_POST['github']]);
    header("Location: admin.php"); exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cv'])) {
    $stmt = $pdo->prepare("UPDATE cv_details SET about_long=?, skills=?, education=?, experience=?, certifications=?, languages=?, interests=? WHERE id=1");
    $stmt->execute([$_POST['about_long'], $_POST['skills'], $_POST['education'], $_POST['experience'], $_POST['certifications'], $_POST['languages'], $_POST['interests']]);
    header("Location: admin.php"); exit;
}
$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$cv = $pdo->query("SELECT * FROM cv_details LIMIT 1")->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Admin - Quản lý Portfolio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="hero small"><h1>Trang Quản Trị</h1><p><a href="index.php">Về trang chủ</a></p></header>
<main class="container">
  <section>
    <h2>Thông tin cá nhân</h2>
    <form method="post" class="form-box">
      <input type="hidden" name="update_profile" value="1">
      <label>Họ tên <input name="fullname" value="<?= htmlspecialchars($profile['fullname']) ?>" required></label>
      <label>Chuyên ngành <input name="major" value="<?= htmlspecialchars($profile['major']) ?>"></label>
      <label>Giới thiệu ngắn <textarea name="bio"><?= htmlspecialchars($profile['bio']) ?></textarea></label>
      <label>Email <input name="email" value="<?= htmlspecialchars($profile['email']) ?>"></label>
      <label>GitHub <input name="github" value="<?= htmlspecialchars($profile['github']) ?>"></label>
      <button type="submit">Cập nhật</button>
    </form>
  </section>

  <section>
    <h2>Thông tin CV (Về tôi)</h2>
    <form method="post" class="form-box">
      <input type="hidden" name="update_cv" value="1">
      <label>Giới thiệu chi tiết <textarea name="about_long" rows="3"><?= htmlspecialchars($cv['about_long'] ?? '') ?></textarea></label>
      <label>Kỹ năng (cách nhau bằng dấu phẩy) <textarea name="skills" rows="2"><?= htmlspecialchars($cv['skills'] ?? '') ?></textarea></label>
      <label>Học vấn <textarea name="education" rows="2"><?= htmlspecialchars($cv['education'] ?? '') ?></textarea></label>
      <label>Kinh nghiệm <textarea name="experience" rows="2"><?= htmlspecialchars($cv['experience'] ?? '') ?></textarea></label>
      <label>Chứng chỉ <textarea name="certifications" rows="2"><?= htmlspecialchars($cv['certifications'] ?? '') ?></textarea></label>
      <label>Ngôn ngữ <input name="languages" value="<?= htmlspecialchars($cv['languages'] ?? '') ?>"></label>
      <label>Sở thích <input name="interests" value="<?= htmlspecialchars($cv['interests'] ?? '') ?>"></label>
      <button type="submit">Cập nhật CV</button>
    </form>
  </section>

  <section>
    <h2>Thêm dự án</h2>
    <form method="post" class="form-box">
      <input type="hidden" name="add" value="1">
      <label>Tiêu đề <input name="title" required></label>
      <label>Mô tả <textarea name="description"></textarea></label>
      <label>Công nghệ <input name="tech_stack"></label>
      <label>Link <input name="link"></label>
      <button type="submit">Thêm</button>
    </form>
  </section>

  <section>
    <h2>Danh sách dự án (<?= count($projects) ?>)</h2>
    <table>
      <tr><th>ID</th><th>Tiêu đề</th><th>Công nghệ</th><th>Hành động</th></tr>
      <?php foreach ($projects as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['title']) ?></td>
        <td><?= htmlspecialchars($p['tech_stack']) ?></td>
        <td><a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>
</main>
</body>
</html>
