<?php
class App_Controller {
  public $view = "";
  private $view_path = "";
  private $controllerName = "";
  public $request;

  /**
   *
   * @param unknown $controllerName
   */
  public function __construct($controllerName) {
    $this->controllerName = $controllerName;
    $this->view = new App_View();
  }

  /**
   * Child classes will override this method to run
   * before any actions are executed
   */
  public function init() {
  }

  /**
   * Set the path to the view files
   * @param unknown $view_path
   */
  public function set_view_path($view_path) {
    $this->view_path = $view_path;
    $this->view->set_view_path($view_path);
  }

  /**
   * Make a request object available to all controllers
   * @param unknown $request
   */
  public function set_request($request) {
    $this->request = $request;
  }

  /**
   * Check if a form has been posted.
   * @return boolean
   */
  public function isPosted() {
    if(count($_POST) > 0) {
      return true;
    }
    return false;
  }
}