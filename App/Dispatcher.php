<?php
class App_Dispatcher {
  private $controller = "";
  private $action = "";
  private $view_file_path = "";
  private $request;

  /**
   * Parse file name and create controller and action.
   * Leverages __autoload function in common.php
   * example: payroll_calenders.php autoload /classes/Controller/Payroll/Calenders.php
   * and calls function <action>Action where <action> is a GET parameter
   */
  function __construct() {
    // Example:
    // ["path"]=>
    // string(38) "/customers/admin/payroll_calendars.php"
    // ["query"]=>
    // string(10) "action=new"
    $parsed_url = parse_url( $_SERVER[REQUEST_URI]);

    // Build the controller name
    $file_name = basename($parsed_url["path"], ".php");
    $file_name_array = explode("_", $file_name);
    foreach($file_name_array as $index => $file_name_part) {
      if($file_name_part == "") {
        unset($file_name_array[$index]);
      }
      else {
        $file_name_array[$index] = ucfirst($file_name_part);
      }
    }
    $this->controller = "Controller_".implode("_", $file_name_array);

    // Get the action name
    // Example: <action_name>_action where <action_name> is a string
    if ($_GET["action"] != "") {
      $this->action = $_GET["action"]."_action";
    } else {
      $this->action = "index_action";
    }

    // Example: View/Payroll/Calendars/
    $this->view_file_path = "View".DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $file_name_array);

    // Request
    $this->request = new App_Request();
  }

  /**
   * Routes to the correct controlller and execute action
   */
  function dispatch() {
    $controller = new $this->controller($this->controller);
    $controller->set_view_path($this->view_file_path);
    $controller->set_request($this->request);
    $controller->init();
    $controller->{$this->action}();
  }
}