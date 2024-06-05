<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $idCategoria = $_POST['idCategoria'];
    $email = $_SESSION['email'];

    $query = "INSERT INTO transacao (descricao, valor, data, tipo, idConta, idCategoria) VALUES ('$descricao', '$valor', '$data', 'gasto', (SELECT id FROM conta WHERE emailUsuario='$email'), '$idCategoria')";
    mysqli_query($conn, $query);
    header('Location: gastos.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Gasto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Gasto</h1>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" step="0.01" name="valor" placeholder="Valor" required>
            <input type="date" name="data" required>
            <input type="number" name="idCategoria" placeholder="ID da Categoria" required>
            <button type="submit">Adicionar</button>
        </form>
    </div>
</body>
</html>