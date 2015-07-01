<?php
class App_View {
  /**  Location for overloaded data.  */
  private $data = array();

  private $view_path;
  private $file_path;
  private $file_name;

  /**
   * Set base path
   */
  function __construct() {
    $this->view_path = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
  }

  /**
   * Set file path to the view files
   * @param unknown $file_path
   */
  function set_view_path($file_path) {
    $this->file_path = $file_path;
  }

  /**
   * Set the view file name to be rendered
   * @param unknown $file_name
   */
  function set_view_file($file_name) {
    $this->file_name = $file_name;
  }

  /**
   * Execute the view file
   */
  function render() {
    $full_path = $this->view_path.$this->file_path.DIRECTORY_SEPARATOR.$this->file_name;
    include($full_path);
  }
}