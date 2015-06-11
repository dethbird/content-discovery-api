<?php
    /**
    * 
    *    _____                                 __                
    *   /  _  \ ______ ______     ______ _____/  |_ __ ________  
    *  /  /_\  \\____ \\____ \   /  ___// __ \   __\  |  \____ \ 
    * /    |    \  |_> >  |_> >  \___ \\  ___/|  | |  |  /  |_> >
    * \____|__  /   __/|   __/  /____  >\___  >__| |____/|   __/ 
    *         \/|__|   |__|          \/     \/           |__|    
    */
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    define("APPLICATION_PATH", __DIR__ . "/..");
    date_default_timezone_set('America/New_York');

    // Ensure src/ is on include_path
    set_include_path(implode(PATH_SEPARATOR, array(
        APPLICATION_PATH ,
        APPLICATION_PATH . '/src',
        get_include_path(),
    )));

    //read env file
    // # just points to environment config yml
    global $app,
        $configs;

    // $env = parse_ini_file("env.ini");
    // $configs = parse_ini_file($env['config_file']);



    /**
    * __________               __                                
    * \______   \ ____   _____/  |_  __________________  ______  
    * |    |  _//  _ \ /  _ \   __\/  ___/\_  __ \__  \ \____ \ 
    * |    |   (  <_> |  <_> )  |  \___ \  |  | \// __ \|  |_> >
    * |______  /\____/ \____/|__| /____  > |__|  (____  /   __/ 
    *         \/                        \/             \/|__|    
    */

    require 'vendor/autoload.php';
    require_once 'vendor/php-activerecord/php-activerecord/ActiveRecord.php';
    require_once 'src/logger.php';

    ActiveRecord\Config::initialize(function($cfg)
    {
        global $configs;
        $cfg->set_model_directory('../models');
        $cfg->set_connections(array('development' =>
        "mysql://". $configs['mysql_user'] .":" .$configs['mysql_password']. "@" .$configs['mysql_host']. "/" .$configs['mysql_database']. "?charset=utf8"));
    });

    $app = new \Slim\Slim();
    $app->response->headers->set('Content-Type', 'application/json'); //default response type
    $app->response->headers->set("Access-Control-Allow-Origin", "*"); // CORS
    $app->response->headers->set("Access-Control-Allow-Methods", "*");
    $app->response->headers->set("Access-Control-Allow-Headers", "*");




    /**
    * __________                   .__                       
    * \______   \ ____  ________ __|__|______   ____   ______
    * |       _// __ \/ ____/  |  \  \_  __ \_/ __ \ /  ___/
    * |    |   \  ___< <_|  |  |  /  ||  | \/\  ___/ \___ \ 
    * |____|_  /\___  >__   |____/|__||__|    \___  >____  >
    *         \/     \/   |__|                     \/     \/    
    */
    
    // require_once('Library/Service/UserService.php');
    // require_once('Library/Service/Response/ServiceResponse.php');


    /**
    * __________               __  .__                
    * \______   \ ____  __ ___/  |_|__| ____    ____  
    * |       _//  _ \|  |  \   __\  |/    \  / ___\ 
    * |    |   (  <_> )  |  /|  | |  |   |  \/ /_/  >
    * |____|_  /\____/|____/ |__| |__|___|  /\___  / 
    *         \/                           \//_____/    
    */

    /**
    * Authentication should be run as middleware before each route
    */
    $authenticate = function($app) 
    {

        global $user;

        return function () use ( $app, $user ) 
        {
            $request = $app->request;

            //noop
        };
    };

    $app->get('/hello', $authenticate($app), function () use ($app) {
        
        $request = $app->request;

        //Hello response
        $response = new stdClass();
        $response->message = "hello";
        
        // JSON encoded list of tracks
        $app->response->setBody(json_encode($response));


    });

    $app->get('/tracks', $authenticate($app), function () use ($app) {
        
        $request = $app->request;

        //Fetch some tracks

        
        // JSON encoded list of tracks
        $app->response->setBody(json_encode($response));


    });




    /**
    * __________            ._._._.
    * \______   \__ __  ____| | | |
    * |       _/  |  \/    \ | | |
    * |    |   \  |  /   |  \|\|\|  
    * |____|_  /____/|___|  /_____
    *        \/           \/\/\/\/  
    */
    $app->run();
?>