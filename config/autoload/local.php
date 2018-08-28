<?php

return [
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'database' => 'test',
        'username' => 'root',
        'charset'  => 'utf8',
        'password'  => '',
    ],
    'dataStore' => [
        'bookDbStore' => [
            'class' => \rollun\datastore\DataStore\DbTable::class,
            'tableName' => 'books',
            'dbAdapter' => \Zend\Db\Adapter\AdapterInterface::class
        ],
        'bookCsvStore' => [
            'class' => \rollun\datastore\DataStore\CsvBase::class,
            'filename' => 'data/books.csv',
            'delimiter' => ','
        ],
        'bookHttpStore' => [
            'class' => \rollun\datastore\DataStore\HttpClient::class,
            'url' => 'http://localhost:8010/api/datastore/bookCsvStore',
        ],
    ],
];