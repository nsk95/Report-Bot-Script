<?php

if( file_exists( __DIR__.'/../config/config.ini' ) == true ) {
    $ini = parse_ini_file( __DIR__.'/../config/config.ini' );
}
else {
    echo 'Config.ini could not be found.';
    die();
}

if( file_exists( __DIR__.'/../vendor/autoload.php' ) == true ) {
    include_once(  __DIR__.'/../vendor/autoload.php' );
}
else {
    echo 'autoload.php could not be found.';
    die();
}

if( $ini['showDebug'] == '1' ) {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

if( isset( $_POST['checkMysql'] ) == true ) {
    $formValues = array();
    parse_str($_POST['formData'], $formValues);
    
    if( isset( $formValues['server'] ) == false ||
        isset( $formValues['username'] ) == false ||
        isset( $formValues['password'] ) == false ||
        isset( $formValues['database'] ) == false) {
        echo '0';
        die();
    }
    else {

        $server     = rtrim( ltrim( $formValues['server'] ) );
        $username   = rtrim( ltrim( $formValues['username'] ) );
        $password   = rtrim( ltrim( $formValues['password'] ) );
        $database   = rtrim( ltrim( $formValues['database'] ) );
        $connection = @mysqli_connect( $server, $username, $password, $database);

        if( $connection == false ) {
            echo '0';
        }
        else {
            $file   = __DIR__.'/../config/config.ini';
            $data   = PHP_EOL.'db.server = '.$server.PHP_EOL.'db.username = '.$username.PHP_EOL.'db.password = '.$password.PHP_EOL.'db.database = '.$database.PHP_EOL; 
            $fpc    = @file_put_contents( $file, $data, FILE_APPEND | LOCK_EX );

            if( $fpc === false ) {
                echo '0';
            }
            else {
                echo '1';
            }
        }
        die();
    }
}

if ( $ini['installAllowed'] == '1' ) {
    if( file_exists( __DIR__.'/../config/FIRST_INSTALL' ) == false ) {
        echo 'you need to create the file: FIRST_INSTALL into the config directory <br/>
        to confirm that you are allowed to run this script';
        die();
    }
    else {
       echo 'hehe';
    }
}