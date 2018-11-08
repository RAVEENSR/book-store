<?php
/**
 * This class represents a database activities regarding the administrator login operation.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    /**
     * LoginModel constructor.
     */
    public function __construct() {
        // CI_Model constructor call
        parent::__construct();
        // load database object
        $this->load->database();
    }

    public function register($username, $password, $firstName, $lastName){
        $hashedPassword =$password;
        $data = array('username' => $username, 'password' => $hashedPassword, 'firstName' => $firstName, 'lastName' =>
            $lastName);
        $this->db->insert('admin',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    /**
     * Gets the row containing username and passsword of admin.
     * @param $username String Username of the admin
     * @param $password String Password of the admin
     * @return bool|ArrayObject Returns the result array if found or false if not found.
     */
    public function login($username, $password) {
        $this->db->where(array('username' => $username,'password' => $password));
        $result = $this->db->get('admin');
        // check the number of rows in the result
        if ($result->num_rows() !== 1) {
            return false;
        } else {
            return true;
        }
    }
}
?>