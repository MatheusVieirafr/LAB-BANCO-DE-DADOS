<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exclusão de Função</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f57c00; /* Laranja */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        h1 {
            color: #fff; /* Texto branco */
            margin-top: 30px;
        }
        p, button {
            color: #fff; /* Texto branco */
            font-size: 18px;
            margin: 10px 0;
        }
        form {
            background-color: #fff; /* Fundo branco */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 50%;
            max-width: 500px;
        }
        button {
            background-color: #f57c00; /* Laranja */
            color: #fff; /* Texto branco */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }
        button:last-child {
            margin-right: 0;
        }
        button:hover {
            background-color: #ff9800; /* Laranja mais claro */
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Exclusão de Função</h1>
    <?php
    if(isset($_GET['id'])) {
        include('conexao.php');
        $id = $_GET['id'];

        $query = "SELECT * FROM funcao WHERE id = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo "<p>ID: " . $row['id'] . "</p>";
            echo "<p>Descrição: " . $row['descricao'] . "</p>";
            
            echo "<p>Confirma a exclusão?</p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<div class='btn-container'>";
            echo "<button type='submit' name='confirmar'>Sim</button>";
            echo "<button type='button' onclick='history.back();'>Não</button>";
            echo "</div>";
            echo "</form>";
        } else {
            echo "Função não encontrada.";
        }

        mysqli_close($con);
    } else {
        echo "ID da função não especificado.";
    }
    ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar'])) {
        include('conexao.php');

        $id = $_POST['id'];
        $query = "DELETE FROM funcao WHERE id = $id";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<p style='color: #4caf50;'>Função excluída com sucesso!</p>";
        } else {
            echo "<p style='color: #f44336;'>ERRO ao excluir a função: " . mysqli_error($con) . "</p>";
        }

        mysqli_close($con);
    }
    ?>
</body>
</html>
