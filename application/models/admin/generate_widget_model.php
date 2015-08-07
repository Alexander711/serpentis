<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_widget_model extends CI_Model {

    public function save_new_widget($data, $id_user) {

        $this->db->trans_start();

        $array1 = array(
            'site_url' => $data['site_url'],
            'id_user' => $id_user,
            'code_widget' => create_random_code(32),
            'img_marker' => $data['new_img_marker'],
            'img_map' => $data['new_img_map'],
        );

        $this->db->insert('widgets', $array1);

        $id_widget = $this->db->insert_id();

        if ($data['html_priv_transport'] != '') {
            $array2 = array(
                'id_widget' => $id_widget,
                'html_priv_transport' => htmlspecialchars($data['html_priv_transport']),
            );

            $this->db->insert('priv_transport', $array2);
        }

        if ($data['html_pub_transport'] != '') {
            $array3 = array(
                'id_widget' => $id_widget,
                'html_pub_transport' => htmlspecialchars($data['html_pub_transport']),
            );

            $this->db->insert('pub_transport', $array3);
        }

        if ($data['html_taxi'] != '') {
            $array4 = array(
                'id_widget' => $id_widget,
                'html_taxi' => htmlspecialchars($data['html_taxi']),
            );

            $this->db->insert('taxi', $array4);
        }

        if ($data['html_rent_car'] != '') {
            $array5 = array(
                'id_widget' => $id_widget,
                'html_rent_car' => htmlspecialchars($data['html_rent_car']),
            );

            $this->db->insert('rent_car', $array5);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return 'error_insert';
        } else {
            $this->db->trans_commit();

            return $id_widget;
        }
    }

    public function update_widget($data, $id_widget, $id_user) {
        $this->db->trans_start();

        $array1 = array(
            'site_url' => $data['site_url'],
            'id_user' => $id_user,
            'img_marker' => $data['new_img_marker'],
            'img_map' => $data['new_img_map'],
        );

        $this->db->where('id', (int) $id_widget);
        $this->db->update('widgets', $array1);

        if ($data['html_priv_transport'] != '' && isset($data['turn_on_priv_transport'])) {
            if ($data['id_priv_transport'] != '') {
                $array2 = array('html_priv_transport' => htmlspecialchars($data['html_priv_transport']));

                $this->db->update('priv_transport', $array2, array('id_widget' => (int) $id_widget));
            } else {
                $array2 = array(
                    'id_widget' => (int) $id_widget,
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

                $this->db->update('pub_transport', $array3, array('id_widget' => (int) $id_widget));
            } else {
                $array3 = array(
                    'id_widget' => (int) $id_widget,
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

                $this->db->update('taxi', $array4, array('id_widget' => (int) $id_widget));
            } else {
                $array4 = array(
                    'id_widget' => (int) $id_widget,
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

                $this->db->update('rent_car', $array5, array('id_widget' => (int) $id_widget));
            } else {
                $array5 = array(
                    'id_widget' => (int) $id_widget,
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

    public function check_exist_site($site_url, $id_widget = 0) {
        $query = $this->db->query("SELECT *
                                   FROM widgets
                                   WHERE site_url = '" . mysql_real_escape_string(strip_tags($site_url)) . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (empty($data) || $id_widget == $data['id']) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_data_widget($id_widget) {
        $query = $this->db->query("SELECT id AS id_widget,
                                          site_url,
                                          img_marker,
                                          img_map
                                   FROM widgets
                                   WHERE id = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $result = $query->row_array();

        $query = $this->db->query("SELECT id AS id_priv_transport,
                                          html_priv_transport
                                   FROM priv_transport
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['id_priv_transport'] = $data['id_priv_transport'];
            $result['html_priv_transport'] = $data['html_priv_transport'];
        }

        $query = $this->db->query("SELECT id AS id_pub_transport,
                                          html_pub_transport
                                   FROM pub_transport
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['id_pub_transport'] = $data['id_pub_transport'];
            $result['html_pub_transport'] = $data['html_pub_transport'];
        }

        $query = $this->db->query("SELECT id AS id_taxi,
                                          html_taxi
                                   FROM taxi
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['id_taxi'] = $data['id_taxi'];
            $result['html_taxi'] = $data['html_taxi'];
        }

        $query = $this->db->query("SELECT id AS id_rent_car,
                                          html_rent_car
                                   FROM rent_car
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['id_rent_car'] = $data['id_rent_car'];
            $result['html_rent_car'] = $data['html_rent_car'];
        }

        return $result;
    }

    public function get_all_widgets($search_data = '') {
        $sql = "SELECT widgets.id,
                       widgets.site_url,
                       widgets.is_installed,
                       widgets.is_active,
                       priv_transport.html_priv_transport,
                       pub_transport.html_pub_transport,
                       taxi.html_taxi,
                       rent_car.html_rent_car
                FROM widgets 
                LEFT JOIN priv_transport ON widgets.id = priv_transport.id_widget
                LEFT JOIN pub_transport ON widgets.id = pub_transport.id_widget
                LEFT JOIN taxi ON widgets.id = taxi.id_widget
                LEFT JOIN rent_car ON widgets.id = rent_car.id_widget";
        
        if ($search_data != '') {
            $sql .= " WHERE widgets.site_url LIKE '%" . mysql_real_escape_string(strip_tags($search_data['search_url_site'])) . "%'";
        }

        $sql .= " GROUP BY widgets.id";

        $query = $this->db->query($sql);
        
        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

    public function get_img_window_for_widget($id) {
        $query = $this->db->query("SELECT img_marker,
                                          img_map
                                   FROM widgets
                                   WHERE id = '" . (int) $id . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function delete_widget($id) {
        $this->db->trans_start();
        $this->db->delete('widgets', array('id' => (int) $id));

        $this->db->delete('priv_transport', array('id_widget' => (int) $id));

        $this->db->delete('pub_transport', array('id_widget' => (int) $id));

        $this->db->delete('taxi', array('id_widget' => (int) $id));

        $this->db->delete('rent_car', array('id_widget' => (int) $id));

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
                                   FROM widgets
                                   WHERE id = '" . (int) $id . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function update_field_is_installed($id, $flag) {
        $query = $this->db->update('widgets', array('is_installed' => (int) $flag), array('id' => (int) $id));

        if (!$query) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function update_field_is_active($id, $active_status) {
        $query = $this->db->update('widgets', array('is_active' => (int) $active_status), array('id' => (int) $id));

        if (!$query) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_data_widget_by_code($code) {
        $query = $this->db->query("SELECT id AS id_widget,
                                          site_url,
                                          code_widget
                                   FROM widgets
                                   WHERE code_widget = '" . mysql_real_escape_string(strip_tags($code)) . "'");

        if (!$query) {
            return false;
        }

        $result = $query->row_array();

        $id_widget = $result['id_widget'];

        $query = $this->db->query("SELECT html_priv_transport
                                   FROM priv_transport
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['html_priv_transport'] = htmlspecialchars_decode($data['html_priv_transport']);
        }

        $query = $this->db->query("SELECT html_pub_transport
                                   FROM pub_transport
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['html_pub_transport'] = htmlspecialchars_decode($data['html_pub_transport']);
        }

        $query = $this->db->query("SELECT html_taxi
                                   FROM taxi
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['html_taxi'] = htmlspecialchars_decode($data['html_taxi']);
        }

        $query = $this->db->query("SELECT html_rent_car
                                   FROM rent_car
                                   WHERE id_widget = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        if (!empty($data)) {
            $result['html_rent_car'] = htmlspecialchars_decode($data['html_rent_car']);
        }

        return $result;
    }

    public function get_site_url_data_user_by_code($code) {
        $query = $this->db->query("SELECT widgets.site_url,
                                          users.phone,
                                          users.email,
                                          users.id AS id_user
                                   FROM widgets
                                   JOIN users ON widgets.id_user = users.id
                                   WHERE widgets.code_widget = '" . mysql_real_escape_string(strip_tags($code)) . "'");

        if (!$query) {
            return false;
        }

        return $query->row_array();
    }

    public function save_sms_history($data_sms_history) {
        $this->db->insert('sms_history', $data_sms_history);
    }

    public function generate_widget_body($id_widget) {
        $this->load->helper('file');

        $query = $this->db->query("SELECT code_widget,
                                          is_active,
                                          img_marker,
                                          img_map
                                   FROM widgets
                                   WHERE id = '" . (int) $id_widget . "'");

        if (!$query) {
            return false;
        }

        $data = $query->row_array();

        $string = read_file('./js/widget_body.txt');

        $string = str_replace('{IS_ACTIVE}', $data['is_active'], $string);
        $string = str_replace('{CSS_CONTACT_WINDOW}', base_url('css/style_window_widget.css'), $string);
        $string = str_replace('{URL_CONTACT_WINDOW}', base_url('widget_window/index/' . $data['code_widget']), $string);
        $string = str_replace('{IMG_MARKER}', base_url('uploads/img_attention_window/' . $data['img_marker']), $string);
        $string = str_replace('{IMG_MAP}', base_url('uploads/img_attention_window/' . $data['img_map']), $string);

        return $string;
    }

    public function get_sms_history($search_data = '') {
        $sql = "SELECT phone_contact,
                       status,
                       date_created,
                       site_url,
                       type
                FROM sms_history";

        if ($search_data != '') {
            $string = '';

            if ($search_data['site_url'] != '') {
                $string .= " WHERE site_url = '" . mysql_real_escape_string(strip_tags($search_data['site_url'])) . "'";
            }

            if ($search_data['date_beginning'] != '') {
                if($string == ''){
                    $string .= ' WHERE';
                } else {
                    $string .= ' AND';
                }
                
                $string .= " DATE_FORMAT(date_created,'%d-%m-%Y') >= '" . mysql_real_escape_string(strip_tags($search_data['date_beginning'])) . "'";
            }

            if ($search_data['date_end'] != '') {
                if($string == ''){
                    $string .= ' WHERE';
                } else {
                    $string .= ' AND';
                }
                
                $string .= " DATE_FORMAT(date_created,'%d-%m-%Y') <= '" . mysql_real_escape_string(strip_tags($search_data['date_end'])) . "'";
            }
            
            $sql .= $string;
        }

        $sql .= " ORDER BY date_created DESC";

        $query = $this->db->query($sql);

        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

    public function get_all_sites_from_history() {
        $query = $this->db->query("SELECT DISTINCT site_url
                                   FROM sms_history");

        if (!$query) {
            return false;
        }

        return $query->result_array();
    }

}

?>