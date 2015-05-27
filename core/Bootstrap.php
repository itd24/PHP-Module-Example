<?php

/**
 * The Bootstrapper class.
 * It represents the starting point of our application
 */
class Bootstrap
{
    
    /**
     * helper function, gets a module name from the GET parameters. If no module name is present, a default name is returned
     * @return string
     */
    private static function getModule() {
        $module = "site";
        if (isset($_GET['module']) && trim($_GET['module']) != "") $module = $_GET['module'];
        return $module;
    }
    
    /**
     * helper function, gets an action name from the GET parameters. If no action name is present, a default name is returned
     * @return string
     */
    private static function getAction() {
        $action = "index";
        if (isset($_GET['action']) && trim($_GET['action']) != "") $action = $_GET['action'];
        return $action;
    }
    
    /** starts the appliction */
    public static function start() {
        
        //*****includes*********
        require "Settings.php";
        require "TemplateEngine.php";
        require "Controller.php";
        require "ModuleManager.php";
        require "ViewBag.php";
        
        //**********************
        
        $moduleManager = new ModuleManager();
        $moduleManager->loadModules();
        
        $module = self::getModule();
        $action = self::getAction();
        
        $moduleManager->invokeModule($module, $action);
    }
}
?>