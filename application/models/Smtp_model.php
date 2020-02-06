<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smtp_model extends CI_Model {

  function getGeneralSettings(){
 
    $response = array();
 
    // Select record
    $this->db->select('*');
    $q = $this->db->get('general_settings');
    $response = $q->result_array();

    return $response;
  }

}