<?php
require'conexao.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Viualizar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">    
                <div class="card">
                    <?php
                    $sql = 'SELECT * FROM usuarios';
                    $usuario = mysqli_query($conexao, $sql) or die("Erro ao buscar usuário: " . mysqli_error($conexao));
                    $usuario = mysqli_fetch_assoc($usuario);
                    if (!$usuario) {
                        echo "<div class='alert alert-danger'>Usuário não encontrado.</div>";
                        exit;
                    }
                    ?>
                    <div class="card-header">
                        <h4>Vizualizar usuario
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class= "mb-3">
                            <label>Nome</label>
                            <p class="form-control">
                                <?= htmlspecialchars($usuario['nome']) ?>
                            </p>
                        </div>
                        <div class= "mb-3">
                            <label>Email</label>
                            <p class="form-control">
                                <?= htmlspecialchars($usuario['email']) ?>
                            </p>
                        </div>
                        <div class= "mb-3">
                            <label>Data de nascimento</label>
                            <p class="form-control">
                                <?= date('d/m/Y', strtotime($usuario['data_nascimento'])) ?>
                            </p>
                        </div>
                    <?php
            
                    ?>
                    </div>
                </div>
            </div>  
        </div>
    </div>                            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>