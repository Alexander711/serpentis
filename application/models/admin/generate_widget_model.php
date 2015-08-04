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
                'html_priv_transport' => htmlspecialchars($data['html_priv_transport']),
            );

            $this->db->insert('priv_transport', $array2);
        }

        if ($data['html_pub_transport'] != '') {
            $array3 = array(
                'id_site' => $id_site,
                'html_pub_transport' => htmlspecialchars($data['html_pub_transport']),
            );

            $this->db->insert('pub_transport', $array3);
        }

        if ($data['html_taxi'] != '') {
            $array4 = array(
                'id_site' => $id_site,
                'html_taxi' => htmlspecialchars($data['html_taxi']),
            );

            $this->db->insert('taxi', $array4);
        }

        if ($data['html_rent_car'] != '') {
            $array5 = array(
                'id_site' => $id_site,
                'html_rent_car' => htmlspecialchars($data['html_rent_car']),
            );

            $this->db->insert('rent_car', $array5);
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

        if ($data['html_priv_transport'] != '' && isset($data['turn_on_priv_transport'])) {
            if ($data['id_priv_transport'] != '') {
                $array2 = array('html_priv_transport' => htmlspecialchars($data['html_priv_transport']));

                $this->db->update('priv_transport', $array2, array('id_site' => (int) $id_site));
            } else {
                $array2 = array(
                    'id_site' => (int) $id_site,
                    'html_priv_transport' => htmlspecialchars($data['html_priv_transport'])
                );

                $this->db->insert('priv_transport', $array2);
            }
        } elseif (!isset($data['turn_on_priv_transport']) && $data['id_priv_transport'] != '') {
            echo 1;
            exit;
            $this->db->delete('priv_transport', array('id' => (int) $data['id_priv_transport']));
        }

        if ($data ['html_pub_transport'] != '' && isset($data['turn_on_pub_transport'])) {
            if ($data['id_pub_transport'] != '') {
                $array3 = array('html_pub_transport' => htmlspecialchars($data['html_pub_transport']));

                $this->db->update('pub_transport', $array3, array('id_site' => (int) $id_site));
            } else {
                $array3 = array(
                    'id_site' => (int) $id_site,
                    'html_pub_transport' => htmlspecialchars($data['html_pub_transport'])
                );

                $this->db->insert('pub_transport', $array3);
            }
        } elseif (!isset($data['turn_on_pub_transport']) && $data['id_pub_transport'] != '') {
            $this->db->delete('pub_transport', array('id' => (int) $data['id_pub_transport']));
        }

        if ($data['html_taxi'] != '' && isset($data['turn_on_taxi'])) {
            if ($data['id_taxi'] != '') {
                $array4 = array('html_taxi' => htmlspecialchars($data['html_taxi']));

                $this->db->update('taxi', $array4, array('id_site' => (int) $id_site));
            } else {
                $array4 = array(
                    'id_site' => (int) $id_site,
                    'html_taxi' => htmlspecialchars($data['html_taxi'])
                );

                $this->db->insert('taxi', $array4);
            }
        } elseif (!isset($data['turn_on_taxi']) && $data['id_taxi'] != '') {
            $this->db->delete('taxi', array('id' => (int) $data['id_taxi']));
        }

        if ($data['html_rent_car'] != '' && isset($data['turn_on_rent_car'])) {
            if ($data['id_rent_car'] != '') {
                $array5 = array('html_rent_car' => htmlspecialchars($data['html_rent_car']));

                $this->db->update('rent_car', $array5, array('id_site' => (int) $id_site));
            } else {
                $array5 = array(
                    'id_site' => (int) $id_site,
                    'html_rent_car' => htmlspecialchars($data['html_rent_car'])
                );

                $this->db->insert('rent_car', $array5);
            }
        } elseif (!isset($data['turn_on_rent_car']) && $data['id_rent_car'] != '') {
            $this->db->delete('rent_car', array('id' => (int) $data['id_rent_car']));
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
        $query = $this->db->query("SELECT id AS id_site,
                                          site_url,
                                          img_marker,
                                          img_map
                                   FROM site
                                   WHERE id = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        $result = $query->row_array();

        $query = $this->db->query("SELECT id AS id_priv_transport,
                                          html_priv_transport
                                   FROM priv_transport
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {

            $data = $query->row_array();

            $result['id_priv_transport'] = $data['id_priv_transport'];
            $result['html_priv_transport'] = $data['html_priv_transport'];
        }

        $query = $this->db->query("SELECT id AS id_pub_transport,
                                          html_pub_transport
                                   FROM pub_transport
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {
            $data = $query->row_array();

            $result['id_pub_transport'] = $data['id_pub_transport'];
            $result['html_pub_transport'] = $data['html_pub_transport'];
        }

        $query = $this->db->query("SELECT id AS id_taxi,
                                          html_taxi
                                   FROM taxi
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {
            $data = $query->row_array();

            $result['id_taxi'] = $data['id_taxi'];
            $result['html_taxi'] = $data['html_taxi'];
        }

        $query = $this->db->query("SELECT id AS id_rent_car,
                                          html_rent_car
                                   FROM rent_car
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {
            $data = $query->row_array();

            $result['id_rent_car'] = $data['id_rent_car'];
            $result['html_rent_car'] = $data['html_rent_car'];
        }

        return $result;
    }

    public function get_all_widgets() {
        $query = $this->db->query("SELECT site.id,
                                          site.site_url,
                                          site.is_installed,
                                          site.is_active,
                                          priv_transport.html_priv_transport,
                                          pub_transport.html_pub_transport,
                                          taxi.html_taxi,
                                          rent_car.html_rent_car
                                   FROM `site` 
                                   LEFT JOIN priv_transport ON site.id = priv_transport.id_site
                                   LEFT JOIN pub_transport ON site.id = pub_transport.id_site
                                   LEFT JOIN taxi ON site.id = taxi.id_site
                                   LEFT JOIN rent_car ON site.id = rent_car.id_site
                                   GROUP BY site.id");

        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

    public function get_img_window_for_widget($id) {
        $query = $this->db->query("SELECT img_marker,
                                          img_map
                                   FROM site
                                   WHERE id = '" . (int) $id . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function delete_widget($id) {
        $this->db->trans_start();
        $this->db->delete('site', array('id' => (int) $id));

        $this->db->delete('priv_transport', array('id_site' => (int) $id));

        $this->db->delete('pub_transport', array('id_site' => (int) $id));

        $this->db->delete('taxi', array('id_site' => (int) $id));

        $this->db->delete('rent_car', array('id_site' => (int) $id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return 'del_error';
        } else {
            $this->db->trans_commit();

            return 'del_ok';
        }
    }

    public function get_site_url_code_widget_by_id($id) {
        $query = $this->db->query("SELECT site_url,
                                          code_widget
                                   FROM site
                                   WHERE id = '" . (int) $id . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function update_field_is_installed($id, $flag) {
        $query = $this->db->update('site', array('is_installed' => (int) $flag), array('id' => (int) $id));

        if (!$query) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function update_field_is_active($id, $active_status) {
        $query = $this->db->update('site', array('is_active' => (int) $active_status), array('id' => (int) $id));

        if (!$query) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_data_widget_by_code($code) {
        $query = $this->db->query("SELECT id AS id_site,
                                          site_url
                                   FROM site
                                   WHERE code_widget = '" . mysql_real_escape_string($code) . "'");

        if (!$query) {
            return false;
        }

        $result = $query->row_array();

        $id_site = $result['id_site'];
        
        $query = $this->db->query("SELECT html_priv_transport
                                   FROM priv_transport
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {

            $data = $query->row_array();

            $result['html_priv_transport'] = htmlspecialchars_decode($data['html_priv_transport']);
        }

        $query = $this->db->query("SELECT html_pub_transport
                                   FROM pub_transport
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {
            $data = $query->row_array();

            $result['html_pub_transport'] = htmlspecialchars_decode($data['html_pub_transport']);
        }

        $query = $this->db->query("SELECT html_taxi
                                   FROM taxi
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {
            $data = $query->row_array();
            
            $result['html_taxi'] = htmlspecialchars_decode($data['html_taxi']);
        }

        $query = $this->db->query("SELECT html_rent_car
                                   FROM rent_car
                                   WHERE id_site = '" . (int) $id_site . "'");

        if (!$query) {
            return false;
        }

        if (!empty($query->row_array())) {
            $data = $query->row_array();

            $result['html_rent_car'] = htmlspecialchars_decode($data['html_rent_car']);
        }

        return $result;
    }

}

?>