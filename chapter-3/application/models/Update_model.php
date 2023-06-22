<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_model extends CI_Model
{



    public function updateMenu($id)
    {
        $this->db->set('menu', $this->input->post('updateMenu'));
        $this->db->where('id', $id);
        $this->db->update('menu');
    }




    public function updateSubmenu($id)
    {
        $this->db->set([
            'title' => $this->input->post('update_title'),
            'menu_id' => $this->input->post('update_menu_id'),
            'url' => $this->input->post('update_url'),
            'icon' => $this->input->post('update_icon'),
            'is_active' => $this->input->post('update_is_active')
        ]);

        $this->db->where('id', $id);
        $this->db->update('sub_menu');
    }




    public function updateRole($id)
    {
        $this->db->set('role', $this->input->post('role'));
        $this->db->where('id', $id);
        $this->db->update('role');
    }




    public function updateContact($id)
    {
        $this->db->set([
            'location' => $this->input->post('updateLocation'),
            'map' => $this->input->post('updateMap'),
            'email' => $this->input->post('updateEmail'),
            'number' => $this->input->post('updateNumber'),
            'is_active' => $this->input->post('update_is_active')
        ]);
        $this->db->where('id', $id);
        $this->db->update('main_contact');
    }




    public function updateCategories($id)
    {
        $this->db->set([
            'categories' => $this->input->post('update'),
            'icon' => $this->input->post('updateIcon'),
            'about' => $this->input->post('updateAbout')
        ]);
        $this->db->where('id', $id);
        $this->db->update('categories');
    }




    public function updateFormat($id)
    {
        $this->db->set([
            'format' => $this->input->post('update'),
            'icon' => $this->input->post('updateIcon'),
            'about' => $this->input->post('updateAbout')
        ]);
        $this->db->where('id', $id);
        $this->db->update('format');
    }




    public function updateItem($id)
    {
        $categoriesId = $this->input->post('categories_id');
        $formatId = $this->input->post('format_id');
        $time = $this->input->post('time');
        $newIditem = $categoriesId . $formatId . $time;

        $this->db->set([
            'categories_id' => $categoriesId,
            'format_id' => $formatId,
            'time' => $time,
            'new_uid' => $newIditem
        ]);
        $this->db->where('id', $id);
        $this->db->update('set_uid_item');
    }




    public function updatePayment($id)
    {
        $this->db->set('payment', $this->input->post('update'));
        $this->db->where('id', $id);
        $this->db->update('payment_method');
    }




    public function updateDelivery($id)
    {
        $this->db->set('delivery', $this->input->post('update'));
        $this->db->where('id', $id);
        $this->db->update('delivery_method');
    }




    public function updateInfo($id)
    {
        $forPurchase = [
            'name' => $this->input->post('updateName'),
            'address' => $this->input->post('updateAddress'),
            'quantity' => $this->input->post('updateQuantity'),
            'number' => $this->input->post('updateNumber'),
            'payment_id' => $this->input->post('updatePaymentId'),
            'delivery_id' => $this->input->post('updateDeliveryId')
        ];
        $this->db->where('id', $id);
        $this->db->update('purchase', $forPurchase);

        $forShipping = [
            'name' => $this->input->post('updateName'),
            'address_buyer' => $this->input->post('updateAddress')
        ];
        $this->db->where('id', $id);
        $this->db->update('shipping', $forShipping);
    }




    public function galleryWithPhoto($id, $username, $address, $uploaded_file)
    {
        $update_content = [
            'username' => $username,
            'email' => $this->session->userdata('email'),
            'name_item' => $this->input->post('name_item'),
            'address' => $address,
            'price' => $this->input->post('price') ? $this->input->post('price') : '0',
            'file' => $uploaded_file,
            'categories_id' => $this->input->post('categories'),
            'format_id' => $this->input->post('format'),
            'date_create' => time()
        ];
        $this->db->where('id', $id);
        $this->db->update('product', $update_content);
    }




    public function galleryWithoutPhoto($id)
    {
    }
}
