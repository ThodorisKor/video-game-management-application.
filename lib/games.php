<?php
function show_videogames(){
    global $mysqli;
    session_start();
    //print_r($_SESSION["user_id"]);
    $sql = 'select title,description,release_date,genre,game_id from video_games where user_id=?';
    $st = $mysqli -> prepare($sql);
    $st -> bind_param('s',$_SESSION["user_id"]);
    $st -> execute();
    $res = $st -> get_result();

    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}

function create_videogame(){
    global $mysqli;
    session_start();
    $id=(int)$_SESSION["user_id"];

    if(!isset($_POST['title']) || !isset($_POST['desc']) || !isset($_POST['rel_date']) || !isset($_POST['genre'])){
        header("HTTP/1.1 400 Bad Request");
        print json_encode(['errormesg'=>"Please every field!"]);
        exit;
    }
    $sql = 'insert into video_games(title,description,release_date,genre,user_id) values(?,?,?,?,?)';
    $st = $mysqli -> prepare($sql);
    $st -> bind_param('ssssi',$_POST['title'],$_POST['desc'],$_POST['rel_date'],$_POST['genre'],$id);
    $st -> execute();
}

 function edit_videogame($b){
     global $mysqli;
     echo $b;
     session_start();
    //  $id=(int)$_SESSION["user_id"];
    //  $sql = 'update video_Games set title=?,description=?,release_date=?,genre=? where user_id=?';
    //  $st = $mysqli -> prepare($sql);
    //  $st -> bind_param('ssssi',$_POST['title'],$_POST['desc'],$_POST['rel_date'],$_POST['genre'],$id);
    //  $st -> execute();
 }

function delete_videogame($input) {
    if(!isset($input[0])){
        header("HTTP/1.1 400 Bad Request");
        print json_encode(['errormesg'=>"Please give the id of the game you want to delete!"]);
        exit;
    }
    global $mysqli;
    session_start();
    $id=(int)$_SESSION["user_id"];
    $sql = 'delete from video_games where user_id=? and game_id=?';
    $st = $mysqli -> prepare($sql);
    $st -> bind_param('ii',$id,$input[0]);
    $st -> execute();
}
function filter_games(){
    global $mysqli;
     if(isset($_GET['genre'])){
        session_start();
        //print_r($_SESSION["user_id"]);
        $sql = 'select title,description,release_date,genre,game_id from video_games where user_id=? and genre=?';
        $st = $mysqli -> prepare($sql);
        $st -> bind_param('ss',$_SESSION["user_id"],$_GET['genre']);
        $st -> execute();
        $res = $st -> get_result();
        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
     }
}
function sort_games(){
    global $mysqli;
        session_start();
        //print_r($_SESSION["user_id"]);
        $sql = 'select title,description,release_date,genre,game_id from video_games where user_id=? order by release_date';
        $st = $mysqli -> prepare($sql);
        $st -> bind_param('s',$_SESSION["user_id"]);
        $st -> execute();
        $res = $st -> get_result();
        header('Content-type: application/json');
        print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}
?>