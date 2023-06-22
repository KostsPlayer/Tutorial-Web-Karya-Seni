<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete_model extends CI_Model
{



    public function deleteMenu($id)
    {
        $this->db->delete('menu', ['id' => $id]);
    }



    public function deleteSubmenu($id)
    {
        $this->db->delete('sub_menu', ['id' => $id]);
    }



    public function deleteRole($id)
    {
        $this->db->delete('role', ['id' => $id]);
    }



    public function deleteContact($id)
    {
        $this->db->delete('main_contact', ['id' => $id]);
    }



    public function deleteMember($id)
    {
        $this->db->delete('user', ['id' => $id]);
    }



    public function deleteCategories($id)
    {
        $this->db->delete('categories', ['id' => $id]);
    }



    public function deleteFormat($id)
    {
        $this->db->delete('format', ['id' => $id]);
    }



    public function deleteitem($id)
    {
        $this->db->delete('set_uid_item', ['id' => $id]);
    }
    


    public function deleteGallery($id)
    {
        $this->db->delete('product', ['id' => $id]);
    }



    public function deletePayment($id)
    {
        $this->db->delete('payment_method', ['id' => $id]);
    }


    
    public function deleteDelivery($id)
    {
        $this->db->delete('delivery_method', ['id' => $id]);
    }
    
    
    
    public function deleteHistory($id)
    {
        $this->db->delete('purchase', ['id' => $id]);
        $this->db->delete('shipping', ['id' => $id]);
    }



    public function deleteAllHistory($email)
    {
        $this->db->where('purchase.email_buyer', $email);
        $this->db->delete('purchase');
    }
}
