<?php 
//Neste arquivo vou aplicar as regras de negócio, em seguida envia-lo para o banco de dados, usando a classe Aventureir

if  ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Faiou';
    exit;
}

$nome = $_POST['nome'] ?? '';
$classeId = $_POST['classe_id'] ?? '';
$exp = $_POST['exp'] ?? '';

if(empty($nome) || empty($classeId) || empty($exp)){
        echo 'Preencha todos os campos';
        exit;
    }

if (!is_numeric($classeId) || !is_numeric($exp)) {
    echo 'Classe ID e EXP devem ser números.';
    exit;
}

if ($classeId < 1 || $classeId > 4) {
    echo 'Classe ID deve ser entre 1 e 4.';
    exit;
}

require_once '../aventureiros/Aventureiro.php';
$aventureiro = new Aventureiro($nome, $classeId, $exp);

$aventureiro->insert();

echo "Tudo";

?>