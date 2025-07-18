<?php 

session_start();
require 'conexao.php';

if(isset($_POST['create_usuario'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);  
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)): ''; 

    $sql= "INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES ('$nome', '$email', '$data_nascimento', '$senha')";
    mysqli_query($conexao, $sql) or die("Erro ao cadastrar usuário: " . mysqli_error($conexao));  
    
    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = "Usuário adicionado com sucesso!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao adicionar usuário.";
        header("Location: usuario-create.php");
        exit;
    }
}
if(isset($_POST['update_usuario'])) {
    
    if(empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['data_nascimento'])) {
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios!";
        header("Location: usuario-edit.php?id=".$_POST['usuario_id']);
        exit;
    }

    $usuario_id = intval($_POST['usuario_id']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $data_nascimento = trim($_POST['data_nascimento']);
    
   
    $password_update = '';
    if(!empty(trim($_POST['senha']))) {
        $password_update = ", senha = ?";
    }

   
    $sql = "UPDATE usuarios SET nome = ?, email = ?, data_nascimento = ? $password_update WHERE id = ?";
    
    $stmt = $conexao->prepare($sql);
    if(!$stmt) {
        die("Erro na preparação: " . $conexao->error);
    }

    if(empty($password_update)) {
        $stmt->bind_param("sssi", $nome, $email, $data_nascimento, $usuario_id);
    } else {
        $hashed_password = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $stmt->bind_param("ssssi", $nome, $email, $data_nascimento, $hashed_password, $usuario_id);
    }

    if($stmt->execute()) {
        if($stmt->affected_rows > 0) {
            $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Nenhum dado foi alterado.";
        }
        header("Location: index.php");
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar usuário: " . $conexao->error;
        header("Location: usuario-edit.php?id=".$usuario_id);
    }
    exit;
}
if (isset($_POST['delete_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";
    mysqli_query($conexao,$sql);

    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao excluir usuário.";
        header("Location: index.php");
        exit;
    }
}