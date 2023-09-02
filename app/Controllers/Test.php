<?php
// app/Controllers/Test.php

namespace App\Controllers;

class Test extends BaseController
{
    public function databaseTest()
    {
        // Load the database library
        $db = \Config\Database::connect();

        // Example query
        $query = $db->query('SELECT * FROM users');
        $result = $query->getResult();

        // Print the result for testing purposes
        var_dump($result);
    }
}
