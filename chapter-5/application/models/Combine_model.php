<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Combine_model extends CI_Model
{




    public function getSubMenu($limit, $start)
    {
        $this->db->select('sub_menu.*, menu.menu');
        $this->db->from('sub_menu');
        $this->db->join('menu', 'sub_menu.menu_id = menu.id');
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }




    public function getUser($limit, $start)
    {
        $this->db->select('user.*, role.role');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }




    public function UserAccess($id)
    {
        $this->db->select('user.*, role.role');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where('user.id', $id);

        return $this->db->get()->result_array();
    }




    public function getFormat()
    {
        $query = "SELECT `product`.*, `format`.`format`
                FROM `product` JOIN `format`
                ON `product`.`format_id` = `format`.`id`
        ";

        return $this->db->query($query)->result_array();
    }




    public function getCategoriesFormat($limit, $start)
    {
        $this->db->select('set_uid_item.*, categories.categories, format.format');
        $this->db->from('set_uid_item');
        $this->db->join('categories', 'set_uid_item.categories_id = categories.id');
        $this->db->join('format', 'set_uid_item.format_id = format.id');
        $this->db->limit($limit, $start);

        $result = $this->db->get()->result_array();

        return $result;
    }




    public function getCategoriesFormatContent($email, $limit, $start)
    {
        $this->db->select('product.*, categories.categories, format.format');
        $this->db->from('product');
        $this->db->join('categories', 'product.categories_id = categories.id');
        $this->db->join('format', 'product.format_id = format.id');
        $this->db->where('product.email', $email);
        $this->db->limit($limit, $start);

        $result = $this->db->get()->result_array();

        return $result;
    }




    public function getEditContent($email, $id)
    {
        $this->db->select('product.*, categories.categories, format.format');
        $this->db->from('product');
        $this->db->join('categories', 'product.categories_id = categories.id');
        $this->db->join('format', 'product.format_id = format.id');
        $this->db->where('product.email', $email);
        $this->db->where('product.id', $id);

        $result = $this->db->get()->result_array();

        return $result;
    }




    public function getTransaction($email, $limit, $start, $type)
    {
        $this->db->select('purchase.*, payment_method.payment, delivery_method.delivery');
        $this->db->from('purchase');

        if ($type == 'purchase') {
            $this->db->join('payment_method', 'purchase.payment_id = payment_method.id', 'left');
            $this->db->join('delivery_method', 'purchase.delivery_id = delivery_method.id', 'left');
            $this->db->where('purchase.email_buyer', $email);
        } elseif ($type == 'store') {
            $this->db->join('payment_method', 'purchase.payment_id = payment_method.id', 'left');
            $this->db->join('delivery_method', 'purchase.delivery_id = delivery_method.id', 'left');
            $this->db->where('purchase.email_seller', $email);
        }

        $this->db->limit($limit, $start);

        $result = $this->db->get()->result_array();

        return $result;
    }
}
