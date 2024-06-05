<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
include('db.php');

$email = $_SESSION['email'];
$query = "SELECT * FROM investimento WHERE usuario_email='$email'";
$result = mysqli_query($conn, $query);
$investimentos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investimentos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Investimentos</h1>
        <canvas id="investimentosChart"></canvas>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor Atual</th>
                    <th>Retorno</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($investimentos as $investimento): ?>
                <tr>
                    <td><?php echo $investimento['nome']; ?></td>
                    <td><?php echo $investimento['valor_atual']; ?></td>
                    <td><?php echo $investimento['retorno']; ?></td>
                    <td><?php echo $investimento['data']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_investimento.php" class="add-button">Adicionar Investimento</a>
    </div>
    <script src="scripts.js"></script>
</body>
</html>