<?php
    include 'database.php';
    $pdo = new PDO('sqlite:database/db.sqlite');
    $query = $pdo->query('SELECT * FROM users');
    $users = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Usuários</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Lista de Usuários</h1>
    <a href="create_user.php" class="btn btn-primary mb-3">Adicionar Usuário</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                <a href="user_colors.php?id=<?= $user['id'] ?>" class="btn btn-info btn-sm">Cores</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
