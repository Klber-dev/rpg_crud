<?php

//Criação da classe aventureiro
class Aventureiro
{

  //? serve para dizer que a variável pode ser null
  private ?int $id;
  private string $nome;
  private int $classeId;
  private int $exp;
  private string $status;
  private ?DateTime $dataCriacao;


  //Construtor da classe
  public function __construct($nome, $classeId, $exp, $status = 'Y', $id = null, $dataCriacao = null)
  {
    $this->id = $id;
    $this->nome = $nome;
    $this->classeId = $classeId;
    $this->exp = $exp;
    $this->status = $status;
    $this->dataCriacao = $dataCriacao;
  }


  //Puxa os dados deste aventureiro do banco de dados 
  public function select()
  {
    //Primeiro um try catch para lidar com possíveis erros de conexão ou consulta ao banco de dados
    try {
      //Criando uma conexão com o banco de dados usando PDO, root é o usuário e '' é a senha
      $server =  new PDO('mysql:host=localhost:3306;dbname=rpg_crud', 'root', 'toor');
      //Definindo o modo de erro do PDO para exceção, não sei ainda ao certo como funciona
      $server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //Consulta SQL a moda harcoded apenas para testar, depois tem que ser algo mais dinâmico
      $data = ($server->query('SELECT * FROM aventureiros WHERE nome = ' . $server->quote($this->nome)))->fetchAll(PDO::FETCH_ASSOC);

      // $data->fetchAll(PDO::FETCH_ASSOC);

      #var_dump($data);
      //Retorna os dados do aventureiro como um array associativo só pra testar
      return $data;
    } catch (PDOException $e) {
      //Pra exibir erro
      echo 'ERROR: ' . $e->getMessage();
    }
  }

  //Insere os dados deste aventureiro no banco de dados
  public function insert()
  {
    try {
      $server =  new PDO('mysql:host=localhost:3306;dbname=rpg_crud', 'root', 'toor');
      $server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //Prepared stmt pra previnir injection. O prepare é tipo um template da query, e o execute é onde a gente passa os valores pra preencher esse template
      $stmt = $server->prepare('INSERT INTO aventureiros (aventureiro_nome, classe_id, xp, status) VALUES (:nome, :classeId, :exp, :status)');
      //Passando parâmetros para o execute, usando os atributos do objeto atual ($this)
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

  //Atualiza os dados deste aventureiro no banco de dados
  public function update($nnome)
  {
    try {
      $server = new PDO('mysql:host=localhost:3306;dbname=rpg_crud', 'root', 'toor');
      $server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //Aqui se aplica o mesmmo conceito só que pra update, o id tá hardcoded só pra testar, depois tem que ser algo mais pampa
      $stmt = $server->prepare('UPDATE aventureiros SET nome = :nome where id = :id');
      $stmt->execute([
        ':nome' => $nnome,
        //id no pelo
        ':id' => $this->id
      ]);

    } catch (PDOException $e) {
      echo 'Erro' . $e->getMessage();
    }
  }

  public function delete(){
    try{
      $server = new PDO('mysql:host=localhost:3306;dbname=rpg_crud', 'root', 'toor');
      $server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $server->prepare('DELETE FROM aventureiros WHERE id = :id');
      $stmt->execute([
        ':id' => $this->id
      ]);
    }catch(PDOException $e){
      echo 'Erro' . $e->getMessage();
    }

  }
}