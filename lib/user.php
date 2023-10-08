<?php
function show_user($b){
    global $mysqli;

    //επιστρεφει με βασει το ονομα τα στοιχεια του χρηστη
    session_start();
    $sql = 'select username,user_id from users where user_id=?';
    $st = $mysqli -> prepare($sql);
    $st -> bind_param('s',$_SESSION["user_id"]);
    $st -> execute();
    $res = $st -> get_result();

    header('Content-type: application/json');
    print json_encode($res->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}
function add_user(){
    //echo $_POST['username'];
    //echo $_POST['password'];
    //query το οποιο τσεκαρει εαν υπαρχει ηδη το ονομα χρηστη μεσα στο db.και εαν υπαρχε δεν τον αφηνει να κανει register
    global $mysqli;
    $sql = 'select count(username) as count from users where username=?';
    $st = $mysqli -> prepare($sql);
    $st -> bind_param('s',$_POST['username']);
    $st -> execute();
    $res = $st -> get_result();
    $r = $res -> fetch_all(MYSQLI_ASSOC);
    if($r[0]['count']>0){
        header("HTTP/1.1 400 Bad Request");
        print json_encode(['errormesg'=>"Username already taken!."]);
        exit;
    }
    //τσεκαρει εαν εχουν δωθει απο τον χρηστη τα στοιχεια username και password , ωστε να μπορεσει να γινει σωστα η καταχωρηση χρηστη.
    if(isset($_POST['username']) && isset($_POST['password'])){
        $sql2 = 'insert into users(username,password) values(?,?)';
        $st2 = $mysqli -> prepare($sql2);
        $st2 -> bind_param('ss',$_POST['username'],$_POST['password']);
        $st2 -> execute();
    }else{
        header("HTTP/1.1 400 Bad Request");
        print json_encode(['errormesg'=>"You din't gave a username or a password!!."]);
        exit;
    }
}

function log_in(){
    global $mysqli;
    $sql = 'select exists(select username,password from users where username=? and password=?) AS user_exists';
    $st = $mysqli -> prepare($sql);
    $st -> bind_param('ss',$_POST['username'],$_POST['password']);
    $st -> execute();
    $res = $st -> get_result();
    $r = $res -> fetch_all(MYSQLI_ASSOC);
    if($r[0]['user_exists']==1){
        $sql2 = 'select user_id from users where username=? and password=?';
        $st2 = $mysqli ->prepare($sql2);
        $st2 -> bind_param('ss',$_POST['username'],$_POST['password']);
        $st2 -> execute();
        $res = $st2 -> get_result();
        $r = $res -> fetch_assoc();


        session_start();
        $_SESSION["user_id"] = $r['user_id'];
    
    }else{
        header("HTTP/1.1 400 Bad Request");
        print json_encode(['errormesg'=>"Wrong username or password!."]);
        exit;
    }
}

function log_out(){
    session_start();
    session_destroy();
}
?>