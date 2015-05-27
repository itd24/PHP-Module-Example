<?php

/**
 * the base controller class, all controllers inherit from this class
 */
class Controller
{
    
    public function __construct() {
    }
    
    /**
     * render function, renders a given template
     * @param string $template - the template name without an extension
     * @param array $data - the variables which will be injected into the template
     * @return string - the rendered template
     */
    protected function render($template, $data = array()) {
        
        $rc = new ReflectionClass(get_class($this));
        $currentDirectory = dirname($rc->getFileName());
        $viewPath = dirname($currentDirectory) . "/views/" . $template . ".php";
        
        $bag = ViewBag::init();
        
        $layoutData = array("modules" => $bag->get("moduleUrls", array()), "activeModule" => $bag->get("activeModule", ""));
        
        echo TemplateEngine::render($viewPath, $data, $layoutData);
    }
}
?>