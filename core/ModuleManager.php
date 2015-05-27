<?php

/**
 * The ModuleManager class - manages loading and initializing of our models
 * @package default
 */
class ModuleManager
{
    
    /**
     * the modules variable will hold the module info
     */
    private $modules = array();
    
    /**
     * the modulesLoaded flag will tell us, if the modules were already loaded
     */
    private $modulesLoaded = false;
    
    /**
     * removeDots - a helper function to remove the . and .. folders from a list of folders
     * @param array $directories - list of folder names
     * @return array - filtered list of folder names
     */
    private function removeDots($directories) {
        $valuesToRemove = array(".", "..");
        foreach ($directories as $key => $value) {
            if (in_array($value, $valuesToRemove)) unset($directories[$key]);
        }
        return array_values($directories);
    }
    
    /**
     * loadModuleDirectories - loads all directories inside the 'modules' directory
     * @return array - list of folder names
     */
    private function loadModuleDirectories() {
        $directories = scandir(ABSOLUTE_MODULE_PATH);
        return $this->removeDots($directories);
    }
    
    /**
     * loadActions - loads all actions inside a specific module controller
     * @param string $controllerName - the name of a specific module controller
     * @return array - a list of module actions
     */
    private function loadActions($controllerName) {
        $actions = array();
        if (!class_exists($controllerName)) {
            return null;
        }
        
        $methods = get_class_methods($controllerName);
        $actions = array_filter($methods, function ($method) {
            return (strlen($method) > 6 && substr($method, 0, 6) === "action");
        });
        
        return $actions;
    }
    
    /**
     * getModuleUrls - returns a list of URLs that point to the module actions
     * @return array - a list of name-value pairs: (actionIdentificator, url)
     */
    public function getModuleUrls() {
        $links = array();
        foreach ($this->modules as $moduleName => $module) {
            foreach ($module as $action) {
                $links[] = array("name" => $moduleName . ":" . str_replace("action", "", $action), "url" => "/" . $moduleName . "/" . str_replace("action", "", $action));
            }
        }
        return $links;
    }
    
    /**
     * loadModules - loads all valid modules inside the modules directory
     * @return void
     */
    public function loadModules() {
        
        $directories = $this->loadModuleDirectories();
        foreach ($directories as $dir) {
            
            $this->modules[$dir] = array();
            
            $controllerPath = ABSOLUTE_MODULE_PATH . $dir . "/controllers/" . $dir . "Controller.php";
            
            if (!file_exists($controllerPath)) {
                continue;
            }
            
            include ($controllerPath);
            
            $controllerClass = $dir . "Controller";
            
            $actions = $this->loadActions($controllerClass);
            if ($actions == null) continue;
            foreach ($actions as $action) {
                $this->modules[$dir][] = $action;
            }
        }
        $this->modulesLoaded = true;
        
        $bag = ViewBag::init();
        $bag->set("moduleUrls", $this->getModuleUrls());
    }
    
    /**
     * invokeModule - invokes a specific module and an action
     * @param string $module - a module name
     * @param string $action - a module action name
     * @return void
     */
    public function invokeModule($module, $action) {
        if (!$this->modulesLoaded) $this->loadModules();
        
        $bag = ViewBag::init();
        $bag->set("activeModule", $module . ":" . ucwords($action));
        
        $className = $module . "Controller";
        $actionName = "action" . ucwords($action);
        
        if (!isset($this->modules[$module])) {
            echo "Module $module not found!";
            die();
        }
        if (!in_array($actionName, $this->modules[$module])) {
            echo "Action $actionName not found!";
            die();
        }
        
        $instance = new $className();
        
        $instance->$actionName();
    }
}
?>