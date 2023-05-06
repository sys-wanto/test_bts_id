<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model
{

  /**
   * __construct function.
   * 
   * @access public
   * @return void
   */
  public function __construct()
  {

    parent::__construct();
    $this->load->database();

  }

  public function get_user_checklist($id){
    $stmt = "SELECT * FROM checklist c INNER JOIN users u ON u.id = c.user_id where c.user_id = ?";
    $query = $this->db->query($stmt, array($id));
    if($query->num_rows() >=1){
      return $this->db->result();
    }else{
      return null;
    }
  }
}