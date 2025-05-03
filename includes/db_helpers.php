<?php
require_once 'src/models/Database.php';

/**
 * Új rekord mentése adatbázisba
 */
function insertRecord($table, $columns, $values) {
    $placeholders = implode(",", array_fill(0, count($values), "?"));
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    return Database::executeQuery($sql, $values);
}

/**
 * Egy adott rekord lekérése
 */
function fetchRecordById($table, $id) {
    $sql = "SELECT * FROM $table WHERE id = ?";
    return Database::fetchOne($sql, [$id]);
}

/**
 * Összes rekord lekérése egy adott táblából
 */
function fetchAllRecords($table) {
    $sql = "SELECT * FROM $table";
    return Database::fetchAll($sql);
}
?>
