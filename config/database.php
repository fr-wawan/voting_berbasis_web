<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=voting_berbasis_web", "root", "");
} catch (PDOException $e) {
    echo $e->getMessage();
}
