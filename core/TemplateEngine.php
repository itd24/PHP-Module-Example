<?php

/**
 * a simple template engine
 */
class TemplateEngine
{
    
    /**
     * the layout for our pages, right now it only allows the default layout, defined in our Settings.php file
     */
    private static $layout = DEFAULT_LAYOUT;
    
    /**
     * renderTemplate - renders a template file
     * @param string $template - the path to the template
     * @param array $data - the variables we want to inject
     * @return string - the rendered template
     */
    private static function renderTemplate($template, $data = array()) {
        if (is_array($data)) extract($data);
        
        ob_start();
        
        include ($template);
        
        return ob_get_clean();
    }
    
    /**
     * render - renders a template inside the default layout
     * @param string $template - the template location
     * @param array $data - the data we want to inject into our template
     * @param array $layoutData - the data we want to inject into our default layout
     * @return string - the rendered page
     */
    public static function render($template, $data = array(), $layoutData = array()) {
        
        $parsedTemplate = self::renderTemplate($template, $data);
        
        return self::renderTemplate(self::$layout, array_merge(array("content" => $parsedTemplate), $layoutData));
    }
}
?>