<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insert_model extends CI_Model
{
    public function insert_upload($uploaded_file, $username, $address, $phone_number)
    {
        $data = [
            'username' => $username,
            'email' => $this->session->userdata('email'),
            'name_item' => $this->input->post('item'),
            'description' => $this->input->post('about'),
            'address' => $address ? $address : '-',
            'phone_number' => $phone_number ? $phone_number : '-',
            'price' => $this->input->post('price') ? $this->input->post('price') : '0',
            'file' => $uploaded_file,
            'categories_id' => $this->input->post('categories'),
            'format_id' => $this->input->post('format'),
            'date_create' => time()
        ];
        $this->db->insert('product', $data);
    }
}
