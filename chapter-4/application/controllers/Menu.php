<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
        $this->load->model('Combine_model', 'combine');
        $this->load->model('Delete_model', 'delete');
        $this->load->model('Update_model', 'update');
    }



    public function index()
    {
        $data['title'] = 'Menu Manajement';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/menu/index';
        $config['total_rows'] = $this->db->get('menu')->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['menu'] = $this->db->limit($config['per_page'], $data['start'])->get('menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', 'New menu added');
            redirect('menu');
        }
    }




    public function deleteMenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteMenu($id);
        $this->session->set_flashdata('message', 'Delete Successful!');
        redirect('menu');
    }




    public function updateMenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('updateMenu', 'Update Menu', 'required');

        if ($this->form_validation->run() == false) {
            echo "Failed";
        } else {
            $this->update->updateMenu($id);
            $this->session->set_flashdata('message', 'Update Successful!');
            redirect('menu');
        }
    }




    public function submenu()
    {
        $data['title'] = 'Submenu Manajement';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/menu/submenu';
        $config['total_rows'] = $this->db->get('sub_menu')->num_rows();
        $config['per_page'] = 8;

        //Inisialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['subMenu'] = $this->combine->getSubMenu($config['per_page'], $data['start']);

        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('sub_menu', $data);
            $this->session->set_flashdata('message', 'New Submenu added!');
            redirect('menu/submenu');
        }
    }




    public function delete_submenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteSubmenu($id);

        $this->session->set_flashdata('message', 'Delete Successful!');
        redirect('menu/submenu');
    }




    public function updateSubmenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('update_title', 'Title', 'required');
        $this->form_validation->set_rules('update_menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('update_url', 'Url', 'required');
        $this->form_validation->set_rules('update_icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            echo $this->form_validation->display_errors();
        } else {
            $this->update->updateSubmenu($id);
            $this->session->set_flashdata('message', 'Update Successful!');
            redirect('menu/submenu');
        }
    }




}
