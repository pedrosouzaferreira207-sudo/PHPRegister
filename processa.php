<?php
session_start();

$erros = [];


$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];
$data = $_POST['data'];
$telefone = trim($_POST['telefone']);




if (empty($nome)) {
    $erros[] = "Nome não pode estar vazio";
} elseif (strlen($nome) < 3) {
    $erros[] = "Nome deve ter no mínimo 3 caracteres";
} elseif (strpos($nome, ' ') === false) {
    $erros[] = "Digite nome e sobrenome";
}


if (empty($email)) {
    $erros[] = "Email não pode estar vazio";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = "Email inválido";
}


if (empty($senha)) {
    $erros[] = "Senha vazia";
} elseif (strlen($senha) < 6) {
    $erros[] = "Senha deve ter no mínimo 6 caracteres";
} elseif (!preg_match('/[A-Z]/', $senha)) {
    $erros[] = "Senha precisa de letra maiúscula";
} elseif (!preg_match('/[0-9]/', $senha)) {
    $erros[] = "Senha precisa de número";
}


if ($senha !== $confirmar) {
    $erros[] = "Senhas não coincidem";
}


if (empty($data)) {
    $erros[] = "Data obrigatória";
} else {
    $idade = (new DateTime())->diff(new DateTime($data))->y;
    if ($idade < 18) {
        $erros[] = "Você precisa ter 18 anos";
    }
}


if (empty($telefone)) {
    $erros[] = "Telefone obrigatório";
} else {
    $limpo = preg_replace('/[^0-9]/', '', $telefone);

    if (!preg_match('/^[0-9()\-\s]+$/', $telefone)) {
        $erros[] = "Telefone inválido";
    }

    if (strlen($limpo) < 10 || strlen($limpo) > 15) {
        $erros[] = "Telefone deve ter entre 10 e 15 números";
    }
}



if (!empty($erros)) {
    $_SESSION['erros'] = $erros;
    header("Location: index.php");
    exit;
} else {
    $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
    header("Location: index.php");
    exit;
}
?>