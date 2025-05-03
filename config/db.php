<?php
require_once 'config/config.php';

try {
    // MsSQL adatbázis kapcsolat létrehozása PDO-val
    $conn = new PDO("sqlsrv:server=" . $db_config['host'] . ";Database=" . $db_config['dbname'], 
                    $db_config['username'], 
                    $db_config['password']);

    // Beállítjuk az SQL hibaüzenetek megjelenítését
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    die("Hiba az adatbázis kapcsolatban: " . $e->getMessage());
}

// Segédfüggvények az adatbázis kezeléséhez

/**
 * Lekérdezés futtatása és eredmények visszaadása tömbként
 * @param string $sql
 * @param array $params
 * @return array
 */
function fetchAll($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Egyetlen rekord lekérdezése
 * @param string $sql
 * @param array $params
 * @return mixed
 */
function fetchOne($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Adat beszúrása vagy módosítása
 * @param string $sql
 * @param array $params
 * @return bool
 */
function executeQuery($sql, $params = []) {
    global $conn;
    $stmt = $conn->prepare($sql);
    return $stmt->execute($params);
}

/**
 * Adat törlése
 * @param string $sql
 * @param array $params
 * @return bool
 */
function deleteRecord($sql, $params = []) {
    return executeQuery($sql, $params);
}
?>