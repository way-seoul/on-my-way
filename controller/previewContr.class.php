<?php

Class PreviewContr {
    public static function preview(){
        include './view/previewView.php';

        if(isset($_SESSION['logged_in'])){
            header('location: index.php?action=home');
        }
    }
}
