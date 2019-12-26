<?php

require_once 'accesscard.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function accesscard_civicrm_config(&$config) {
  _accesscard_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function accesscard_civicrm_xmlMenu(&$files) {
  _accesscard_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function accesscard_civicrm_install() {
   _accesscard_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function accesscard_civicrm_uninstall() {
  _accesscard_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function accesscard_civicrm_enable() {
  _accesscard_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function accesscard_civicrm_disable() {
  _accesscard_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function accesscard_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _accesscard_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function accesscard_civicrm_managed(&$entities) {
  return _accesscard_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function accesscard_civicrm_caseTypes(&$caseTypes) {
  _accesscard_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function accesscard_civicrm_angularModules(&$angularModules) {
_accesscard_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function accesscard_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _accesscard_civix_civicrm_alterSettingsFolders($metaDataFolders);
}


/**
 * Implements hook_civicrm_apiWrappers().
 */
function accesscard_civicrm_entityTypes(&$entityTypes) {
  $entityTypes['CRM_Accesscard_DAO_Cards'] = array(
    'name'  => 'Cards',
    'class' => 'CRM_Accesscard_DAO_Cards',
    'table' => 'civicrm_mstk_cards',
  );
}

/**
 * Implementation of hook_civicrm_tabs
 */
function accesscard_civicrm_tabs( &$tabs, $contactID ) {
  $session = CRM_Core_Session::singleton();

  $is_admin = CRM_Core_Permission::check('administer CiviCRM') && CRM_Core_Permission::check('edit all contacts');
  $is_myself = ($contactID && ($contactID == $session->get('userID')));
  if ($is_admin || $is_myself) {
    $url = CRM_Utils_System::url( 'civicrm/accesscard', "reset=1&cid={$contactID}" );
    $tabs[] = array(
      'id' => 'cardid',
      'url' => $url,
      'title' => 'Card ID',
      'weight' => 9999,
    );
  }
}

