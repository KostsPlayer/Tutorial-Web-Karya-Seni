<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fiture extends CI_Controller
{




    public function __construct()
    {
        parent::__construct();
        $this->load->model('Delete_model', 'delete');
        $this->load->model('Update_model', 'update');
        $this->load->model('Combine_model', 'combine');
        $this->load->model('Insert_model', 'insert');
    }




    public function index()
    {
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('fiture/index', $data);
        $this->load->view('templates/footer');
    }




    public function upload()
    {
        $data['title'] = 'Upload';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $username = $data['user']['name'];
        $address = $data['user']['address'];
        $phone_number = $data['user']['phone_number'];

        $data['categories'] = $this->db->get('categories')->result_array();
        $data['format'] = $this->db->get('format')->result_array();

        $this->form_validation->set_rules('item', 'Name Arts', 'required');
        $this->form_validation->set_rules('categories', 'Categories', 'required');
        $this->form_validation->set_rules('about', 'Description', 'required');
        $this->form_validation->set_rules('format', 'Format', 'required');
        $this->form_validation->set_rules('price', 'Price', 'numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('fiture/upload', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_result = $this->_upload();

            if ($upload_result['success']) {
                $this->insert->insert_upload($upload_result['uploaded_file'], $username, $address, $phone_number);
                $this->session->set_flashdata('message', 'Upload successful!');
            } else {
                $this->session->set_flashdata('message_error', $this->upload->display_errors());
            }
            redirect('fiture/upload');
        }
    }




    private function _upload()
    {
        $upload_image = $_FILES['content']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webm|mp4|ogv|ogg|mp3|mpeg|wav|pdf|doc|docx|xls|xlsx';
            $config['max_size']     = '655360';
            $config['upload_path'] = './upload/client';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('content')) {
                $this->session->set_flashdata('message_error', $this->upload->display_errors());
            } else {
                $uploaded_file = $this->upload->data('file_name');
                $format_id = $this->input->post('format');

                // Mendapatkan ekstensi file yang diunggah
                $file_ext = pathinfo($uploaded_file, PATHINFO_EXTENSION);

                // Mendapatkan daftar ekstensi file yang diizinkan berdasarkan format yang dipilih
                $allowed_exts = [];

                // Format gambar
                if ($format_id == '1') {
                    $allowed_exts = ['png', 'jpg', 'jpeg', 'gif'];
                }
                // Format video
                elseif ($format_id == '2') {
                    $allowed_exts = ['mp4', 'webm', 'ogv', 'ogg'];
                }
                // Format audio
                elseif ($format_id == '3') {
                    $allowed_exts = ['mp3', 'wav'];
                }
                // Format dokumen
                elseif ($format_id == '4') {
                    $allowed_exts = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
                }

                if (!in_array($file_ext, $allowed_exts)) {
                    // Hapus file yang diunggah jika ekstensi tidak sesuai
                    unlink('./upload/client/' . $uploaded_file);

                    $this->session->set_flashdata('message_error', 'Format must be same with extension!');

                    return ['success' => false];
                } else {
                    // Perbarui nama file yang diunggah dengan nama asli file
                    $content = $this->upload->data('orig_name');
                    rename('./upload/client/' . $uploaded_file, './upload/client/' . $content);

                    return [
                        'success' => true,
                        'uploaded_file' => $content
                    ];
                }
            }
        }
    }




    public function gallery()
    {
        $data['title'] = 'Gallery';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/fiture/gallery';
        $config['total_rows'] = $this->db->get_where('product', ['email' => $email])->num_rows();
        $config['per_page'] = 8;

        //Inisialize Pagination
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['getContent'] = $this->combine->getCategoriesFormatContent($email, $config['per_page'], $data['start']);

        $data['categories'] = $this->db->get('categories')->result_array();
        $data['format'] = $this->db->get('format')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('fiture/gallery', $data);
        $this->load->view('templates/footer');
    }




    public function deleteGallery($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteGallery($id);
        $this->session->set_flashdata('message', 'Delete Successful!');
        redirect('fiture/gallery');
    }




    public function updateGallery($id)
    {
        $data['title'] = 'Edit Content';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $username = $data['user']['name'];
        $address = $data['user']['address'];

        $data['getContent'] = $this->combine->getCategoriesFormatContent($email, $config['per_page'], $data['start']);
        $content = $data['getContent']['file'];

        $this->form_validation->set_rules('item', 'Name Arts', 'required');
        $this->form_validation->set_rules('about', 'Descriptiom', 'required');
        $this->form_validation->set_rules('categories', 'Categories', 'required');
        $this->form_validation->set_rules('format', 'Format', 'required');
        $this->form_validation->set_rules('price', 'Price', 'numeric');

        if ($this->form_validation->run() == false) {
            //..
        } else {

            $update_image = $this->_updateGallery();

            // Perubahan: Periksa apakah update_image bukan false
        if ($update_image !== false) {
            if ($update_image['success']) {
                $this->db->set('file', $update_image['update_image']);

                $this->session->set_flashdata('message', 'Content successfully update!');
            } else {
                $this->session->set_flashdata('message_error', $this->upload->display_errors());
            }
            redirect('fiture/gallery');
        }

            $this->db->set([
                'username' => $username,
                'email' => $this->session->userdata('email'),
                'name_item' => $this->input->post('item'),
                'address' => $address,
                'price' => $this->input->post('price') ? $this->input->post('price') : '0',
                'categories_id' => $this->input->post('categories'),
                'format_id' => $this->input->post('format'),
                'date_create' => time()
            ]);
            $this->db->where('id', $id);
            $this->db->update('product');
            $this->session->set_flashdata('message', 'Content successfully update!');
        }
    }



    private function _updateGallery()
    {
        $upload_image = $_FILES['content']['name'];

        if ($upload_image) {

            $config['allowed_types'] = 'gif|jpg|jpeg|png|PNG|mp4|mkv|mov|wav|mp3|webm|pdf|doc|docx|xls|xlsx';
            $config['max_size']     = '163840';
            $config['upload_path'] = './upload/client';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('content')) {
                $this->session->set_flashdata('message_error', $this->upload->display_errors());

            } else {
                $format_id = $this->input->post('format');

                // Mendapatkan ekstensi file yang diunggah
                $uploaded_file = $this->upload->data('file_name');
                $file_ext = pathinfo($uploaded_file, PATHINFO_EXTENSION);

                // Mendapatkan daftar ekstensi file yang diizinkan berdasarkan format yang dipilih
                $allowed_exts = [];

                if ($format_id == '1') {
                    // Format gambar
                    $allowed_exts = ['png', 'jpg', 'jpeg', 'gif', 'PNG'];
                } elseif ($format_id == '2') {
                    // Format video
                    $allowed_exts = ['mp4', 'mkv', 'mov', 'webm'];
                } elseif ($format_id == '3') {
                    // Format audio
                    $allowed_exts = ['mp3', 'wav'];
                } elseif ($format_id == '4') {
                    // Format dokumen
                    $allowed_exts = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
                }

                if (!in_array($file_ext, $allowed_exts)) {
                    // Hapus file yang diunggah jika ekstensi tidak sesuai
                    unlink('./upload/client/' . $uploaded_file);

                    $this->session->set_flashdata('message_error', 'Format must be same with extension!');
                } else {
                    return [
                        'success' => true,
                        'update_image' => $uploaded_file
                    ];
                }
            }
        }
    }
}
