<?php
/**
 * Description of Core
 *
 * @author junior
 */
class Core 
{    
    public function run() 
    {
        //$url = substr($_SERVER['PHP_SELF'], 10);
        $url = explode('index.php', $_SERVER['PHP_SELF']);
        $url = end($url);
        $params = array();
        if(!empty($url)){
            $url = explode('/', $url);
            array_shift($url);
            $currentController = $url[0].'Controller';
            array_shift($url);
            
            $currentAction = isset($url[0]) ? $url[0]  : 'index';
            array_shift($url);
            
            if(count($url)>0){
                $params = $url;
            }
            
        }else{
            $currentController = 'homeController';
            $currentAction = 'index';
        }
        
        $c = new $currentController();
        //$c->$currentAction();
        call_user_func_array(array($c, $currentAction), $params);
    }
    
}
