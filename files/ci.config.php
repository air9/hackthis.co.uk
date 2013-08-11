<?php
    // Config variables for CircleCI unit tests

    // Site variables
    $config['path'] = realpath($_SERVER["DOCUMENT_ROOT"] . '/../');

    // Database configuration
    $config['db']['driver'] = 'mysql';
    $config['db']['host'] = 'localhost';
    $config['db']['username'] = 'ubuntu';
    $config['db']['password'] = '';
    $config['db']['database'] = 'hackthis';

    $config['facebook']['secret'] = '';
    $config['facebook']['public'] = '';

    $config['lastfm']['public'] = '';
?>