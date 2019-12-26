<?php
/*
 * Core Exception Class for Accesscard
 */

class CRM_Core_Exception_Accesscard extends CRM_Core_Exception {

  /**
   * Function needed to delive access protected error messages to UI
   */

  public static function return_api_exception($entity, $action, $params) {
    try {
      civicrm_api3($entity, $action, $params); 
    }
    catch (CiviCRM_API3_Exception $e) {
            $error_message = $e->message;
    return $error_message;
    }
  }
}
