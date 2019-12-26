<?php
/*
 +--------------------------------------------------------------------------+
 | Copyright IT Bliss LLC (c) 2013                                          |
 +--------------------------------------------------------------------------+
 | This program is free software: you can redistribute it and/or modify     |
 | it under the terms of the GNU Affero General Public License as published |
 | by the Free Software Foundation, either version 3 of the License, or     |
 | (at your option) any later version.                                      |
 |                                                                          |
 | This program is distributed in the hope that it will be useful,          |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
 | GNU Affero General Public License for more details.                      |
 |                                                                          |
 | You should have received a copy of the GNU Affero General Public License |
 | along with this program.  If not, see <http://www.gnu.org/licenses/>.    |
 +--------------------------------------------------------------------------+
*/

class CRM_Accesscard_Form_CardID extends CRM_Core_Form {

    function preProcess() {
        $this->_action = CRM_Utils_Request::retrieve('action', 'String', $this, FALSE, 'add');
        $this->_contactId = CRM_Utils_Request::retrieve('cid', 'Positive', $this, TRUE);

        $this->_cardId = null;
        if ($this->_contactId) {
          try {
              $this->_cardId = civicrm_api3('Cards', 'getvalue', array(
               'sequential' => 1,
                'return' => "card_id",
                'contact_id' =>  $this->_contactId,
            ));
          } catch (Exception $e) {
            $this->_cardId = Null;
          }
       } 
    }

    function buildQuickForm() {
        $this->applyFilter('__ALL__', 'trim');
        $this->add('text', 'card_id', ts('Card ID'), array('size' => "16", 'maxlength' => "16"));

        $buttons = array(
            array(
                'type' => 'upload',
                'name' => ts('Save'),
                'subName' => 'view',
                'isDefault' => TRUE,
            ),
            array(
                'type' => 'cancel',
                'name' => ts('Cancel'),
            ),
        );
        $this->addButtons($buttons);
    }

    /**
     * This function sets the default values for the form. Note that in edit/view mode
     etLayout("../layouts/strip64.json"); the default values are retrieved from the database
     *
     * @access public
     *
     * @return None
     */
    function setDefaultValues() {
        return array('card_id' => $this->_cardId);
    }

    /**
     * Form submission of new/edit api is processed.
     *
     * @access public
     *
     * @return None
     */
    public function postProcess() {
        //get the submitted values in an array
        $params = $this->controller->exportValues($this->_name);
        // create a new card record or update.  
        if (!empty($this->_contactId) && !empty($params['card_id'])) {
          $error_message = CRM_Core_Exception_Accesscard::return_api_exception('Cards', 'create', array(
           'sequential' => 1,
           'card_id' => $params['card_id'],
           'contact_id' =>  $this->_contactId,
          ));
           if (!empty($error_message)) {
            CRM_Core_Session::setStatus($error_message);
            return;
          }
        } else if (!empty($this->_contactId) && empty($params['card_id'])) {
          // We're deleting a record.
          try {
            $id = civicrm_api3('Cards', 'getvalue', array(
             'sequential' => 1,
              'return' => "id",
              'contact_id' =>  $this->_contactId,
            )); 
          } catch (CiviCRM_API3_Exception $e) {
            $error_message = CRM_Core_Exception_Accesscard::return_api_exception('Cards', 'getvalue', array(
             'sequential' => 1,
              'return' => 'id',
              'contact_id' =>  $this->_contactId,
            ));
            CRM_Core_Session::setStatus($error_message);
            return;
          }
          $error_message = CRM_Core_Exception_Accesscard::return_api_exception('Cards', 'delete', array(
           'sequential' => 1,
           'id' => $id,
          ));
          if (!empty($error_message)) {
            CRM_Core_Session::setStatus($error_message);
            return;
          }
       }
        if (!empty($params['card_id']) && empty($e)) {
          CRM_Core_Session::setStatus("Card ID updated.");
        } else {
          CRM_Core_Session::setStatus("Card ID deleted.");
        }
    }
}
