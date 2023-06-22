<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{




    public function __construct()
    {
        parent::__construct();
        $this->load->model('Delete_model', 'delete');
        $this->load->model('Update_model', 'update');
        $this->load->model('Combine_model', 'combine');
    }




    public function index()
    {
        $data['title'] = 'Item UID';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/item/index';
        $config['total_rows'] = $this->db->get('set_uid_item')->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['item'] = $this->combine->getCategoriesFormat($config['per_page'], $data['start']);

        $data['categories'] = $this->db->get('categories')->result_array();
        $data['format'] = $this->db->get('format')->result_array();
        $data['time'] = date('Y');

        $this->form_validation->set_rules('categories_id', 'Categories ID', 'required');
        $this->form_validation->set_rules('format_id', 'Format ID', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('item/index', $data);
            $this->load->view('templates/footer');
        } else {
            $categoriesId = $this->input->post('categories_id');
            $formatId = $this->input->post('format_id');
            $time = $this->input->post('time');
            $newIditem = $categoriesId . $formatId . $time ;

            $data = [
                'categories_id' => $categoriesId,
                'format_id' => $formatId,
                'time' => $time,
                'new_uid' => $newIditem
            ];
            $this->db->insert('set_uid_item', $data);
            $this->session->set_flashdata('message', 'New Item UID Added!');
            redirect('item');
        }
    }




    public function deleteItem($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteItem($id);
        $this->session->set_flashdata('message', 'Delete Item UID Successful!');
        redirect('item');
    }




    public function updateItem($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateItem($id);
        $this->session->set_flashdata('message', 'Update Item UID Successful!');
        redirect('item');
    }




    public function categories()
    {
        $data['title'] = 'Categories';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/item/categories';
        $config['total_rows'] = $this->db->get('categories')->num_rows();
        $config['per_page'] = 4;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['categories'] = $this->db->limit($config['per_page'], $data['start'])->get('categories')->result_array();

        $this->form_validation->set_rules('categories', 'Categories', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('item/categories', $data);
            $this->load->view('templates/footer');
        } else {
            $data_categories = [
                'categories' => $this->input->post('categories'),
                'icon' => $this->input->post('icon'),
                'about' => $this->input->post('about')
            ];
            $this->db->insert('categories', $data_categories);

            $this->session->set_flashdata('message', 'New Category added');
            redirect('item/categories');
        }
    }




    public function deleteCategories($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteCategories($id);

        $this->session->set_flashdata('message', 'Delete Category Successful!');
        redirect('item/categories');
    }




    public function updateCategories($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateCategories($id);
        $this->session->set_flashdata('message', 'Update Category Successful!');
        redirect('item/categories');
    }




    public function format()
    {
        $data['title'] = 'Format Item';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/item/format';
        $config['total_rows'] = $this->db->get('format')->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['format'] = $this->db->limit($config['per_page'], $data['start'])->get('format')->result_array();

        $this->form_validation->set_rules('format', 'Format', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('item/format', $data);
            $this->load->view('templates/footer');
        } else {
            $data_format = [
                'format' => $this->input->post('format'),
                'icon' => $this->input->post('icon'),
                'about' => $this->input->post('about')
            ];
            $this->db->insert('format', $data_format);
            $this->session->set_flashdata('message', 'New format added');
            redirect('item/format');
        }
    }




    public function deleteformat($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteformat($id);
        $this->session->set_flashdata('message', 'Delete Format Successful!');
        redirect('item/format');
    }




    public function updateformat($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateformat($id);
        $this->session->set_flashdata('message', 'Update Format Successful!');
        redirect('item/format');
    }




    public function payment()
    {
        $data['title'] = 'Payment Method';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/item/payment';
        $config['total_rows'] = $this->db->get('payment_method')->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['payment'] = $this->db->limit($config['per_page'], $data['start'])->get('payment_method')->result_array();

        $this->form_validation->set_rules('payment', 'Payment Method', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('item/payment', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('payment_method', ['payment' => $this->input->post('payment')]);
            $this->session->set_flashdata('message', 'New Payment Method Added!');
            redirect('item/payment');
        }
    }




    public function deletepayment($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deletePayment($id);
        $this->session->set_flashdata('message', 'Delete Paymnet Method Successful!');
        redirect('item/payment');
    }




    public function updatepayment($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updatePayment($id);
        $this->session->set_flashdata('message', 'Update Payment Method Successful!');
        redirect('item/payment');
    }




    public function delivery()
    {
        $data['title'] = 'Delivery Method';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/item/delivery';
        $config['total_rows'] = $this->db->get('delivery_method')->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['delivery'] = $this->db->limit($config['per_page'], $data['start'])->get('delivery_method')->result_array();

        $this->form_validation->set_rules('delivery', 'Delivery Method', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('item/delivery', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('delivery_method', ['delivery' => $this->input->post('delivery')]);
            $this->session->set_flashdata('message', 'New Delivery Method Added!');
            redirect('item/delivery');
        }
    }




    public function deletedelivery($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteDelivery($id);
        $this->session->set_flashdata('message', 'Delete Delivery Method Successful!');
        redirect('item/delivery');
    }




    public function updatedelivery($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateDelivery($id);
        $this->session->set_flashdata('message', 'Update Delivery Method Successful!');
        redirect('item/delivery');
    }
}
