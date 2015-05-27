<?php
class siteController extends Controller
{
    
    /**
     * index - the default action for this controller
     * @return void
     */
    public function actionIndex() {
        $this->render("index", array("action" => "Index"));
    }
    
    /**
     * Save - another example action for this module
     * @return void
     */
    public function actionSave() {
        $this->render("index", array("action" => "Save"));
    }
}
?>