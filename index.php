<?php
session_start();
require 'conexao.php';
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <?php include 'mensagem.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <h4>Listagem de Usuários 
                    <a href="usuario-create.php" class="btn btn-primary float-end">Adicionar Usuários</a>
                </h4>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Nascimento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $sql = 'SELECT * FROM usuarios';
                    $result = mysqli_query($conexao, $sql);
                    
                    if (!$result) {
                        die("Erro na consulta: " . mysqli_error($conexao));
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while($usuario = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($usuario['data_nascimento'])); ?></td>
                            <td>
                                <a href="usuario-view.php?id=<?php echo urlencode($usuario['id']); ?>" 
                                   class="btn btn-secondary btn-sm">Visualizar</a>
                                <a href="usuario-edit.php?id=<?php echo urlencode($usuario['id']); ?>" 
                                   class="btn btn-success btn-sm">Editar</a>
                                <form action="acoes.php" method="POST" class="d-inline">
        
                                    <button type="submit" name="delete_usuario" value="<?=$usuario['id']?>" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">Nenhum usuário encontrado.</td></tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>