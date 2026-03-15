<?php
class Aventureiro
{
  private ?int $id;
  private string $nome;
  private int $classeId;
  private int $exp;
  private string $status;
  private ?DateTime $dataCriacao;

  public function __construct($nome, $classeId, $exp, $status = 'Y', $id = null, $dataCriacao = null)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->classeId = $classeId;
    $this->exp = $exp;
    $this->status = $status;
    $this->dataCriacao = $dataCriacao;
  }

  public function select()
  {
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

  public function insert()
  {
    try{
      $server =  new PDO('mysql:host=localhost:3306;dbname=rpg_crud', 'root', 'toor');
      $server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $server->prepare('INSERT INTO aventureiros (nome, classe_id, exp, status) VALUES (:nome, :classeId, :exp, :status)');
      $stmt->execute([
        ':nome' => $this->nome,
        ':classeId' => $this->classeId,
        ':exp' => $this->exp,
        ':status' => $this->status
      ]);
    } catch (PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
  }
}

#$Kleber = new Aventureiro('Kleber', 1, 100);
#$Kleber->select();

#$Luan = new Aventureiro('Luan', 2, 200);
#$Luan->insert();
#$Luan->select();

$Teste = new Aventureiro('Teste', 6, 120);
$Teste->insert();
$Teste->select();