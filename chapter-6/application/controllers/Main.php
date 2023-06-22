<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{




    public function __construct()
    {
        parent::__construct();
        $this->load->model('Delete_model', 'delete');
        $this->load->model('Update_model', 'update');
    }




    public function index()
    {
        $data['title'] = 'ARTS';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['getCategories'] = $this->db->get('categories')->result_array();
        $data['getFormat'] = $this->db->get('format')->result_array();

        $data['take_content'] = $this->db->get('product')->result_array();
        $data['contact'] = $this->db->get('main_contact')->result_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/index', $data);
        $this->load->view('templates/main_footer', $data);
    }




    public function itemDetail($id)
    {
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['getData'] = $this->db->get_where('product', ['id' => $id])->result_array();

        $data['contact'] = $this->db->get('main_contact')->result_array();
        $data['format'] = $this->db->get_where('format', ['id' => $id])->result_array();

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/itemdetail', $data);
        $this->load->view('templates/main_footer', $data);
    }




    public function downloadImage($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['getData'] = $this->db->get_where('product', ['id' => $id])->result_array();

        $getfile = $this->db->get_where('product', ['id' => $id])->row_array();
        $image = $getfile['file'];

        $this->load->helper('download');

        $file = 'upload/client/' . $image;

        force_download($file, null);
    }




    public function contact()
    {
        $data['title'] = 'Office';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/main/contact';
        $config['total_rows'] = $this->db->get('main_contact')->num_rows();
        $config['per_page'] = 4;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['contact'] = $this->db->limit($config['per_page'], $data['start'])->get('main_contact')->result_array();

        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('map', 'Map', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('number', 'Number', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('main/contact', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'location' => $this->input->post('location'),
                'map' => $this->input->post('map'),
                'email' => $this->input->post('email'),
                'number' => $this->input->post('number'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('main_contact', $data);
            $this->session->set_flashdata('message', 'New Main Contact Added');
            redirect('main/contact');
        }
    }




    public function delete_contact($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteContact($id);
        $this->session->set_flashdata('message', 'Delete Main Contact Successful!');
        redirect('main/contact');
    }




    public function update_contact($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateContact($id);
        $this->session->set_flashdata('message', 'Update Main Contact Successful!');
        redirect('main/contact');
    }
}
