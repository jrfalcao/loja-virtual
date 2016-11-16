<?php
/**
 * Description of controller
 *
 * @author junior
 */
class controller {
    
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include './views/'.$viewName.'.php';
    }
    
    public function loadTemplate($viewName, $viewData = array()) {
        $cat = new categorias();
        $viewData['categorias'] = $cat->get();
        include './views/template.php';
    }
    
    public function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        include './views/'.$viewName.'.php';
    }
}
