<?php
class App_Request {
  /**
   * Store all parameters from _GET and _POST
   * _POST params has priority on name conflicts
   */
  function __construct() {
    foreach ($_GET as $index => $value) {
      $this->$index = $value;
    }
    foreach ($_POST as $index => $value) {
      $this->$index = $value;
    }
  }
}