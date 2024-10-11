<?php

include_once 'Database.php';

class DataLoader {
    private $db;
    private $errorLog = 'error_log.csv';

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function loadCSV($filePath): void {
        if (!file_exists(filename: $filePath) || !is_readable(filename: $filePath)) {
            echo "El archivo no se puede leer o no existe.\n";
            return;
        }

        $handle = fopen(filename: $filePath, mode: 'r');
        $header = fgetcsv(stream: $handle);  // Leer los encabezados

        if ($header === false) {
            echo "No se pudo leer el encabezado del CSV.\n";
            return;
        }

        while (($row = fgetcsv(stream: $handle)) !== false) {
            $data = array_combine(keys: $header, values: $row);  // Combinar encabezado con los valores
            $this->insertData($data);
        }

        fclose(stream: $handle);
    }

    private function insertData($data): void {
        // Validación básica
        if (filter_var(value: $data['email'], filter: FILTER_VALIDATE_EMAIL) === false) {
            $this->logError($data, 'Correo inválido');
            return;
        }

        try {
            $query = "INSERT INTO users (id, name, email, created_at) VALUES (:id, :name, :email, :created_at)";
            $stmt = $this->db->prepare(query: $query);

            $stmt->bindParam(param: ':id', var: $data['id'], type: PDO::PARAM_INT);
            $stmt->bindParam(param: ':name', var: $data['name'], type: PDO::PARAM_STR);
            $stmt->bindParam(param: ':email', var: $data['email'], type: PDO::PARAM_STR);
            $stmt->bindParam(param: ':created_at', var: $data['created_at'], type: PDO::PARAM_STR);

            $stmt->execute();
        } catch (PDOException $e) {
            $this->logError($data, $e->getMessage());
        }
    }

    private function logError($data, $errorMessage): void {
        $errorData = array_merge($data, ['error' => $errorMessage]);

        $handle = fopen(filename: $this->errorLog, mode: 'a');
        fputcsv(stream: $handle, fields: $errorData);
        fclose(stream: $handle);
    }
}
