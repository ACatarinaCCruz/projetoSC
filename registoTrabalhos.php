<?php

$dsn = "mysql:host=localhost;dbname=serviceCenter";
$user = "root";
$passwd = "";
$pdo = new PDO($dsn, $user, $passwd);

if (isset($_GET["idDelete"])) {

    $data = [
        'codTrabalho' => $_GET["idDelete"]
    ];

    $sql = "DELETE FROM trabalhos WHERE codTrabalho = :codTrabalho";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    header("Location:registoTrabalhos.php");
}

if (isset($_POST['registoTrabalhos'])) {

    $observacao = $_POST['observacao'];
    $equipamentosUsados = $_POST['equipamentosUsados'];
    $duracao = $_POST['duracao'];
    $dia = $_POST['dia'];

    $data = [
        'observacao' => $observacao,
        'equipamentosUsados' => $equipamentosUsados,
        'duracao' => $duracao,
        'dia' => $dia,
    ];

    $sql = "INSERT INTO trabalhos(codTrabalho, observacao, equipamentosUsados, duracao, dia, codUtilizador, codEquipamento) VALUES ('', :observacao, :equipamentosUsados, :duracao, :dia, 1, 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

if (isset($_GET["codTrabalho"])) {

    $stm = $pdo->query("SELECT * FROM trabalhos WHERE codTrabalho = " . $_GET["codTrabalho"]);
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);
    $trabalho = $rows[0];
} else {
    $trabalho["codTrabalho"] = "";
    $trabalho["observacao"] = "";
    $trabalho["equipamentosUsados"] = "";
    $trabalho["duracao"] = "";
    $trabalho["dia"] = "";
}

if (isset($_POST['editarTrabalho'])) {

    $codTrabalho = $_POST['codTrabalho'];
    $duracao = $_POST['duracao'];
    $equipamentosUsados = $_POST['equipamentosUsados'];
    $observacao = $_POST['observacao'];

    $data = [
        'codTrabalho' => $codTrabalho,
        'observacao' => $duracao,
        'equipamentosUsados' => $equipamentosUsados,
        'duracao' => $duracao,
        'dia' => $dia,
    ];

    $sql = "UPDATE trabalhos SET observacao = :observacao, equipamentosUsados = :equipamentosUsados, duracao = :duracao, dia = :dia WHERE codTrabalho = :codTrabalho";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

$stm = $pdo->query("SELECT * FROM trabalhos");
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Trabalhos</title>
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>

    <header>
        <nav class="navbar navbar-dark bg-dark">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="serviceCenter.php" class="nav-link px-2 text-light">Service Center</a></li>
                <li class="nav-item"><a href="registoTrabalhos.php" class="nav-link px-2 text-secondary">Trabalhos</a></li>
                <li class="nav-item"><a href="consultaStock.php" class="nav-link px-1 text-light">Consulta Stock</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link px-2 text-light">Sign out</a></li>
            </ul>
        </nav>
    </header>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trabalhos</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 text-left">
                <form action="registoTrabalhos.php" method="post">

                    <input type="hidden" name="codTrabalho" value="<?= $trabalho["codTrabalho"] ?>" />

                    <div class="form-group">
                        <label>Observação</label>
                        <input type="text" required maxlength="150" name="observacao" class="form-control" id="observacao" 
                        value="<?= $trabalho["observacao"] ?>">
                    </div><br>
                    <div class="form-group">
                        <label>Equipamentos Utilizados: </label>
                        <select name="eqUsados" id="eqUsados">
                            <option value="null" selected>Nenhum</option>
                            <option value="RAM's">RAM</option>
                            <option value="SSD's">SSD</option>
                            <option value="Ratos">Ratos</option>
                        </select>
                    </div><br>
                    <div class="form-group">
                        <label>Duração</label>
                        <input type="time" required maxlength="10" name="duracao" class="form-control" id="duracao" 
                        value="<?= $trabalho["duracao"] ?>">
                    </div><br>
                    <div class="form-group">
                        <label>Dia</label>
                        <input type="date" required maxlength="10" name="dia" class="form-control" id="dia" 
                        value="<?= $trabalho["dia"] ?>">
                    </div><br>
                    <?php
                    if (isset($_GET["codTrabalho"])) {
                        printf("<div class='text-center mb-3'>
                        <button type='submit' name='editarTrabalho' class='btn btn-block mybtn btn-secondary' tx-tfm>Editar
                        Trabalho</button>
                        </div>");
                    } else {
                        printf("<div class='text-center mb-3'>
                        <button type='submit' name='registoTrabalho' class='btn btn-block mybtn btn-secondary tx-tfm'>Registar
                        Trabalho</button>
                        </div>");
                    }
                    ?>
                </form>
            </div>
            <div class="col-md-9">
                <table class="table">
                    <tr>
                        <th scope="col">codTrabalho</th>
                        <th scope="col">Observações</th>
                        <th scope="col">Equipamentos Usados</th>
                        <th scope="col">Duração</th>
                        <th scope="col">Dia</th>
                        <th scope="col">codUtilizador</th>
                        <th scope="col">codEquipamento</th>
                        <th scope="col">*</th>
                    </tr>
                    <tbody class="table-group-divider">
                        <?php
                        foreach ($rows as $row) {
                            printf("<tr><td>{$row['codTrabalho']}</td>
                     <td>{$row['observacao']}</td>
                     <td>{$row['equipamentosUsados']}</td>
                     <td>{$row['duracao']}</td>
                     <td>{$row['dia']}</td>
                     <td>{$row['codUtilizador']}</td>
                     <td>{$row['codEquipamento']}</td>
                     <td><a class='editarEliminar' href='registoTrabalhos.php?codTrabalho={$row['codTrabalho']}'>Editar</a> | <a class='editarEliminar' href='registoTrabalhos.php?idDelete={$row['codTrabalho']}'>Eliminar</a></td><br>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>