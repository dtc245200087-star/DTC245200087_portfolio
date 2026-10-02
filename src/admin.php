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
$profile = $pdo->query("SELECT * FROM profile LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$projects = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Admin - Quan ly Portfolio</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="hero small"><h1>Trang Quan Tri</h1><p><a href="index.php">Ve trang chu</a></p></header>
<main class="container">
  <section>
    <h2>Thong tin ca nhan</h2>
    <form method="post" class="form-box">
      <input type="hidden" name="update_profile" value="1">
      <label>Ho ten <input name="fullname" value="<?= htmlspecialchars($profile['fullname']) ?>" required></label>
      <label>Chuyen nganh <input name="major" value="<?= htmlspecialchars($profile['major']) ?>"></label>
      <label>Gioi thieu <textarea name="bio"><?= htmlspecialchars($profile['bio']) ?></textarea></label>
      <label>Email <input name="email" value="<?= htmlspecialchars($profile['email']) ?>"></label>
      <label>GitHub <input name="github" value="<?= htmlspecialchars($profile['github']) ?>"></label>
      <button type="submit">Cap nhat</button>
    </form>
  </section>

  <section>
    <h2>Them du an</h2>
    <form method="post" class="form-box">
      <input type="hidden" name="add" value="1">
      <label>Tieu de <input name="title" required></label>
      <label>Mo ta <textarea name="description"></textarea></label>
      <label>Cong nghe <input name="tech_stack"></label>
      <label>Link <input name="link"></label>
      <button type="submit">Them</button>
    </form>
  </section>

  <section>
    <h2>Danh sach du an (<?= count($projects) ?>)</h2>
    <table>
      <tr><th>ID</th><th>Tieu de</th><th>Cong nghe</th><th>Hanh dong</th></tr>
      <?php foreach ($projects as $p): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['title']) ?></td>
        <td><?= htmlspecialchars($p['tech_stack']) ?></td>
        <td><a href="?delete=<?= $p['id'] ?>" onclick="return confirm('Xoa?')">Xoa</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </section>
</main>
</body>
</html>
