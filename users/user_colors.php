<?php
    include 'database.php';

    $pdo = new PDO('sqlite:database/db.sqlite');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'];
        $colors = $_POST['colors'];

        $pdo->beginTransaction();
        $stmt = $pdo->prepare('DELETE FROM user_colors WHERE user_id = ?');
        $stmt->execute([$user_id]);

        $stmt = $pdo->prepare('INSERT INTO user_colors (user_id, color_id) VALUES (?, ?)');
        foreach ($colors as $color_id) {
            $stmt->execute([$user_id, $color_id]);
        }
        $pdo->commit();

        header('Location: index.php');
    } else {
        $user_id = $_GET['id'];
        $stmt = $pdo->prepare('SELECT * FROM colors');
        $stmt->execute();
        $colors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('SELECT color_id FROM user_colors WHERE user_id = ?');
        $stmt->execute([$user_id]);
        $user_colors = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Cores do Usuário</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Gerenciar Cores do Usuário</h1>
    <form method="post">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <?php foreach ($colors as $color): ?>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="color_<?= $color['id'] ?>" name="colors[]" value="<?= $color['id'] ?>" <?= in_array($color['id'], $user_colors) ? 'checked' : '' ?>>
            <label class="form-check-label" for="color_<?= $color['id'] ?>"><?= htmlspecialchars($color['name']) ?></label>
        </div>
        <?php endforeach; ?>
        <br>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
</body>
</html>
