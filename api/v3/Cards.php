<?php

/**
 * Cards.create API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_cards_create_spec(&$spec) {
   $spec['contact_id']['api.required'] = 1;
   $spec['card_id']['api.required'] = 1;
}

/**
 * Cards.create API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_cards_create($params) {
  // avoid trying to add the same card id twice
  try{
    $existing_card_contact = civicrm_api3('Cards', 'getvalue', array(
     'sequential' => 1,
     'return' => "contact_id",
     'card_id' => $params['card_id'],
    ));
  } catch (Exception $e) {
  }
  if (!empty($existing_card_contact) && ($existing_card_contact != $params['contact_id'])) {
    $display_name = civicrm_api3('Contact', 'getvalue', array(
     'sequential' => 1,
     'return' => "display_name",
     'id' => $existing_card_contact,
    ));
   // throw error Existing card id for contact $existing_card_contact
    return civicrm_api3_create_error("Card already provisioned for contact {$display_name}");
  }
  // update instead if a contact_id is passed. if we find one, fetch the id since basic create requires it.
  if (!empty($params['contact_id'])) {
    try{
      $existing_id = civicrm_api3('Cards', 'getvalue', array(
       'sequential' => 1,
       'return' => "id",
       'contact_id'=> $params['contact_id'],
      ));
    } catch (Exception $e) {
    }
    // get the display name if so we can give a more helpful error if we need to later on 
    if (!empty($existing_id)) {
      $display_name = civicrm_api3('Contact', 'getvalue', array(
       'sequential' => 1,
       'return' => "display_name",
       'id' => $params['contact_id'],
      ));
      // if id and contact_id are passed, make sure our records agree. probably a rare edge-case.
      if (!empty($params['id']))  {
        if ($params['id'] != $existing_id) {
          return civicrm_api3_create_error("A record with id {$existing_id} already exists for contact {$display_name}");
        }
      } 
      $params['id'] = $existing_id;  
    }
  }
  return _civicrm_api3_basic_create(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Cards.delete API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_cards_delete($params) {
  return _civicrm_api3_basic_delete(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Cards.get API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_cards_get($params) {
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}
