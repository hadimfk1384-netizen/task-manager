<?php
function setFlashMessage($type , $message){
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}
function getFlashMessage(){
    if(!isset($_SESSION['flash'])){
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}