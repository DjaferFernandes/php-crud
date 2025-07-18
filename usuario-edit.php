<?php
session_start();
require'conexao.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">    
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Usuário
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM usuarios WHERE id = '$usuario_id'";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $usuario = mysqli_fetch_array($query);
                        ?>
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">
                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" value="<?=$usuario['nome']?>" class="form-control" required>
                                <label>Email</label>
                                <input type="email" name="email" value="<?=$usuario['email']?>" class="form-control" required>
                                <label>Data de Nascimento</label>
                                <input type="date" name="data_nascimento" value="<?=$usuario['data_nascimento']?>" class="form-control" required>
                                <label>Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                            <button type="submit" name="update_usuario" class="btn btn-primary">Atualizar</button>
                        </form>
                        <?php
                        }} else {
                            echo "<div class='alert alert-danger'>ID do usuário não fornecido.</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>  
        </div>
    </div>                            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>