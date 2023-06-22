<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }




    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', 'New Role Added!');
            redirect('admin/role');
        }
    }




    public function delete_role($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteRole($id);

        $this->session->set_flashdata('message', 'Delete Role Successful!');
        redirect('admin/role');
    }




    public function update_role($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateRole($id);
        $this->session->set_flashdata('message', 'Update Role Successful!');
        redirect('admin/role');
    }




    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }




    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('access_menu', $data);
        } else {
            $this->db->delete('access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Access Changed!');
    }




    public function member()
    {
        $data['title'] = 'Member';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/admin/member';
        $config['total_rows'] = $this->db->get('user')->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['getUser'] = $this->combine->getUser($config['per_page'], $data['start']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/member', $data);
        $this->load->view('templates/footer');
    }




    public function memberAccess($id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['UserAccess'] = $this->combine->UserAccess($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/member-access', $data);
        $this->load->view('templates/footer');
    }



    public function disableActivated()
    {
        $userId = $this->input->post('user_id');

        // Ubah status is_active pengguna dengan ID $userId menjadi 0
        // Misalnya, jika Anda menggunakan model User_model:
        $data = ['is_active' => 0];

        // Update status is_active pengguna dengan ID $userId menjadi 0
        $this->db->where('id', $userId);
        $this->db->update('users', $data);

        // Berikan respon JSON sebagai tanda berhasil
        echo json_encode(['status' => 'success']);
    }




    public function deleteMember($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteMember($id);

        $this->session->set_flashdata('message', 'Delete Member Successful!');
        redirect('admin/member');
    }
}
