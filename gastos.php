<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
include('db.php');

$email = $_SESSION['email'];
$query = "SELECT * FROM transacao WHERE tipo='gasto' AND idConta IN (SELECT id FROM conta WHERE emailUsuario='$email')";
$result = mysqli_query($conn, $query);
$gastos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Gastos</h1>
        <canvas id="gastosChart"></canvas>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gastos as $gasto): ?>
                <tr>
                    <td><?php echo $gasto['descricao']; ?></td>
                    <td><?php echo $gasto['valor']; ?></td>
                    <td><?php echo $gasto['data']; ?></td>
                    <td><?php echo $gasto['idCategoria']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_gasto.php" class="add-button">Adicionar Gasto</a>
    </div>
    <script src="scripts.js"></script>
</body>
</html>