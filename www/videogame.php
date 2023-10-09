<?php
require_once "../lib/dbConnection.php";
require_once "../lib/user.php";
require_once "../lib/games.php";
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $input = json_decode(file_get_contents('php://input'),true);
      if($input==null) {
        $input=[];
    }
    
    switch ($r=array_shift($request)) {
        case 'user' : 
            handle_user($method,$request);
        break;
        case 'login' :
            handle_login($method,$request);
        break;
        case 'logout' :
            handle_logout($method,$request);
            //echo "logout";
        break;
        case 'videogames' :
            handle_games($method,$request);
        break;
        case 'filter':
            handle_filter($method);
        break;
        case 'sort':
            handle_sort($method);
        break;

        default: 	
        header("HTTP/1.1 404 Not Found");
        exit;
    }

    function handle_user($method,$b){
        if($method=='GET'){
            //epistrofi tou user
            show_user($b);
        }
        else if($method=='POST'){
            //arxikopoihsh user
            add_user();
        }
        else{
            header('HTTP/1.1405 Method Not Allowed');
        }
    }

    function handle_games($method,$input){
        if($method=='GET'){
            //epistrofi twn games toy user
            show_videogames();
        }
         else if($method=='POST'){
             //arxikopoihsh neou videogame
             create_videogame();
         }
         else if($method=='PUT'){
             //Edit enos videogame
             edit_videogame($input);
         }
         else if($method=='DELETE'){
             //diagrafi enos videogame
             delete_videogame($input);
         }
        else{
            header('HTTP/1.1405 Method Not Allowed');
        }
    }
    function handle_login($method,$request){
        if($method=='POST'){
            log_in();
        }else{
            header('HTTP/1.1405 Method Not Allowed');
        }
    }
    function handle_logout($method){
        if($method=='POST'){
            log_out();
        }else{
            header('HTTP/1.1405 Method Not Allowed');
        }
    }
    function handle_filter($method){
        if($method=='GET'){
            filter_games();
        }else{
            header('HTTP/1.1405 Method Not Allowed');
        }
    }
    function handle_sort($method){
        if($method=='GET'){            
            sort_games();
        }else{
            header('HTTP/1.1405 Method Not Allowed');
        }
    }

?>