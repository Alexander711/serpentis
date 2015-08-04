<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authorization_model extends CI_Model {

    /**
     * Функция находит пользователя в БД по email и паролю
     * @param array $post_data
     * @return array
     */
    public function check_user($post_data) {
        $query = $this->db->query("SELECT *
                FROM users
                WHERE email = '" . mysql_real_escape_string($post_data['email_user'])
                . "' AND pass = '" . md5(mysql_real_escape_string($post_data['pass'])) . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function check_auth() {
        if ($this->session->userdata('id_user')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_email_exist($email_user) {
        $query = $this->db->query("SELECT *
                FROM users
                WHERE email = '" . mysql_real_escape_string($email_user) . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function update_user_pass($id_user, $new_password) {
        $this->db->where('id', (int) $id_user);
        $query = $this->db->update('users', array('pass' => md5(mysql_real_escape_string(strip_tags($new_password)))));

        if (!$query) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_data_user_by_id($id_user) {
        $query = $this->db->query("SELECT *
                FROM users
                WHERE id = '" . (int) $id_user . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function update_user_data($id_user, $post_data) {
        $data = array(
            'name' => mysql_real_escape_string(strip_tags($post_data['name'])),
            'last_name' => mysql_real_escape_string(strip_tags($post_data['last_name'])),
            'email' => mysql_real_escape_string(strip_tags($post_data['email_user'])),
            'phone' => mysql_real_escape_string(strip_tags($post_data['phone'])),
        );

        if ($post_data['pass'] != '') {
            $data['pass'] = md5(mysql_real_escape_string(strip_tags($post_data['pass'])));
        }

        $this->db->where('id', (int) $id_user);
        $query = $this->db->update('users', $data);

        if (!$query) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>