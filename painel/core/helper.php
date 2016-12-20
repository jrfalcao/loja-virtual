<?php

trait helper{
    public function isLogged() 
    {
        if (!empty($_SESSION['admin']) && isset($_SESSION['admin'])) {
            return TRUE;
        }  else {
            return FALSE;
        }
    }
}

