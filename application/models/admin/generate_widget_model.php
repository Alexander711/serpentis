<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_widget_model extends CI_Model {

    public function save_new_widget($data) {

        $this->db->trans_start();

        $array1 = array(
            'site_url' => $data['site_url'],
            'code_widget' => create_random_code(32),
            'img_marker' => $data['new_img_marker'],
            'img_map' => $data['new_img_map'],
        );

        $this->db->insert('site', $array1);

        $id_site = $this->db->insert_id();

        if ($data['html_priv_transport'] != '') {
            $array2 = array(
                'id_site' => $id_site,
                'html_code' => htmlspecialchars($data['html_priv_transport']),
                'type' => 'priv_transport',
            );

            $this->db->insert('section_widget', $array2);
        }

        if ($data['html_pub_transport'] != '') {
            $array3 = array(
                'id_site' => $id_site,
                'html_code' => htmlspecialchars($data['html_pub_transport']),
                'type' => 'pub_transport',
            );

            $this->db->insert('section_widget', $array3);
        }

        if ($data['html_taxi'] != '') {
            $array4 = array(
                'id_site' => $id_site,
                'html_code' => htmlspecialchars($data['html_taxi']),
                'type' => 'taxi',
            );

            $this->db->insert('section_widget', $array4);
        }

        if ($data['html_rent_car'] != '') {
            $array5 = array(
                'id_site' => $id_site,
                'html_code' => htmlspecialchars($data['html_rent_car']),
                'type' => 'rent_car',
            );

            $this->db->insert('section_widget', $array5);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return 'error_insert';
        } else {
            $this->db->trans_commit();

            return 'ok_insert';
        }
    }

    public function update_widget($data, $id_site) {
        $this->db->trans_start();

        $array1 = array(
            'site_url' => $data['site_url'],
            'img_marker' => $data['new_img_marker'],
            'img_map' => $data['new_img_map'],
        );

        $this->db->where('id', (int) $id_site);
        $this->db->update('site', $array1);

        if ($data['html_priv_transport'] != '') {
            $array2 = array('html_code' => htmlspecialchars($data ['html_priv_transport']));

            $this->db->update('site', $array2, array('id_site' => (int) $id_site, 'type' => 'priv_transport'));
        }

        if ($data ['html_pub_transport'] != '') {
            $array3 = array('html_code' => htmlspecialchars($data['html_pub_transport']));

            $this->db->update('site', $array3, array('id_site' => (int) $id_site, 'type' => 'pub_transport'));
        }

        if ($data['html_taxi'] != '') {
            $array4 = array('html_code' => htmlspecialchars($data['html_taxi']));

            $this->db->update('site', $array4, array('id_site' => (int) $id_site, 'type' => 'taxi'));
        }

        if ($data['html_rent_car'] != '') {
            $array5 = array('html_code' => htmlspecialchars($data['html_rent_car']));

            $this->db->update('site', $array5, array('id_site' => (int) $id_site, 'type' => 'rent_car'));
        }
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return 'error_update';
        } else {
            $this->db->trans_commit();

            return 'ok_update';
        }
    }

    public function check_exist_site($site_name, $id_site = 0) {
        $query = $this->db->query("SELECT *
                FROM site
                WHERE site_url = '" . mysql_real_escape_string($site_name) . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (empty($data) || $id_site == $data['id']) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_data_widget($id_site) {
        $query = $this->db->query("SELECT id as id_site,
                                          site_url,
                                          code_widget,
                                          img_marker,
                                          img_map
                                   FROM site
                                   WHERE id = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

}

?>