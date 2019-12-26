<?php

class CRM_Accesscard_BAO_Cards extends CRM_Accesscard_DAO_Cards {

  /**
   * Create a new Cards based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Accesscard_DAO_Cards|NULL
   *
  public static function create($params) {
    $className = 'CRM_Accesscard_DAO_Cards';
    $entityName = 'Cards';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */
}
