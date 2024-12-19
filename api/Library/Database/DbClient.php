<?php

namespace Database;

use PDO;

class DbClient
{
    // inicializa um PDO com as variáveis de ambiente
    public function getClient()
    {
        try {
            $dsn = "mysql:host={$_ENV['db_host']};dbname={$_ENV['db_name']}";
            $pdo = new PDO($dsn, $_ENV['db_user'], $_ENV['db_key']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // faz uma query livre ao banco
    public function dbQuery($sql)
    {
        try {
            $client = $this->getClient();

            $stmt = $client->query($sql);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $res;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // insere dados no banco usando 
    // 'prepared statements'
    // retorna o último id inserido
    public function insertData($table, $data)
    {
        $client = $this->getClient();
        
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ":$col", $columns);

        $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") 
                VALUES (" . implode(', ', $placeholders) . ")";
        $stmt = $client->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return $client->lastInsertId();
    }

    // atualiza dados no banco usando
    // 'prepared statements'
    public function updateData($table, $data, $id)
    {
        $client = $this->getClient();
        
        $columns = array_keys($data);
        $update = array_map(fn($col) => "$col = :$col", $columns);

        $sql = "UPDATE $table SET " . implode(', ', $update) . "
                WHERE id = " . $id;
        $stmt = $client->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // exclui dados do banco usando
    // 'prepared statements'
    public function deleteData($table, $where, $filter)
    {
        $client = $this->getClient();
        
        $sql = "DELETE FROM $table " . $where;
        $stmt = $client->prepare($sql);

        try {
            $stmt->execute($filter);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
