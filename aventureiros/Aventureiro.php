<?php
class Aventureiro
{
  private ?int $id;
  private string $nome;
  private int $classeId;
  private int $exp;
  private string $status;
  private ?DateTime $dataCriacao;

  public function __construct($id = null, $nome, $classeId, $exp, $status = 'Y', $dataCriacao = null)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->classeId = $classeId;
    $this->exp = $exp;
    $this->status = $status;
    $this->dataCriacao = $dataCriacao;
  }

  public function insert()
  {
    $query = "INSERT INTO aventureiros (nome, classe_id, EXP) VALUES (" . $this->nome . ',' . ',' . $this->classeId . ',' . $this->exp . ')';

    try {
      $server =  new PDO('mysql:host=localhost:3306;dbname=rpg_crud', 'root', 'toor');
      $server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $data = ($server->query('SELECT * FROM aventureiros WHERE nome = ' . $server->quote($this->nome)))->fetchAll(PDO::FETCH_ASSOC);

      // $data->fetchAll(PDO::FETCH_ASSOC);

      var_dump($data);
    } catch (PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
  }
}

$teste = new Aventureiro(null, 'Kleber', 1, 100);
$teste->insert();
