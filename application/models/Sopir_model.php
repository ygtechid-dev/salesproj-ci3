<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sopir_model extends CI_Model {

    public function get_all() {
        return $this->db->get('sopir')->result();
    }
}