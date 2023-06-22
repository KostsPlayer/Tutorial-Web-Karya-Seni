<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{



    public function __construct()
    {
        parent::__construct();
    }



    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }



    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Username', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('number', 'Number', 'trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_profile', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $number = $this->input->post('number');

            $new_image = $this->_image();

            // Jika gambar berhasil diunggah, lakukan pembaruan data
            if ($new_image !== false) {
                $this->db->set('image', $new_image);
            }
            $this->db->set([
                'name' => $name,
                'address' => $address,
                'phone_number' => $number
            ]);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', 'Your profile has been updated!');
            redirect('user');
        }
    }

    private function _image()
    {
        // Cek jika ada gambar yang mau diupload
        $upload_image = $_FILES['image']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']     = '16384';
            $config['upload_path'] = './assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                return $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        return false;
    }




    public function change_password()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message_error', 'Wrong current password!');
                redirect('user/change_password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message_error', 'New password cannot be the same as current!');
                    redirect('user/change_password');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', 'Password has been changed!');
                    redirect('user/change_password');
                }
            }
        }
    }
}
