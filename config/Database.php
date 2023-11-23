<?php

function getDBConnection(): ?mysqli
{
    try {
        return new mysqli('127.0.0.1', 'root', '123456', 'store');
    } catch (mysqli_sql_exception $e) {
        return null;
    }
}
