<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{




    public function __construct()
    {
        parent::__construct();
        $this->load->model('Combine_model', 'combine');
        $this->load->model('Delete_model', 'delete');
        $this->load->model('Update_model', 'update');
    }




    public function purchase($id)
    {
        $data['title'] = 'Purchase';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['payment'] = $this->db->get('payment_method')->result_array();
        $data['delivery'] = $this->db->get('delivery_method')->result_array();

        $data['getData'] = $this->db->get_where('product', ['id' => $id])->result_array();

        $product = $this->db->get_where('product', ['id' => $id])->row_array();
        $email_seller = $product['email'];
        $name_seller = $product['username'];

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric');
        $this->form_validation->set_rules('payment', 'Payment Method', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaction/purchase', $data);
            $this->load->view('templates/footer');
        } else {
            $purchaseData = [
                'email_buyer' => $this->session->userdata('email'),
                'email_seller' => $email_seller,
                'name_item' => $this->input->post('name_item'),
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address') ? $this->input->post('address') : '-',
                'quantity' => $this->input->post('quantity'),
                'number' => $this->input->post('phone_number'),
                'payment_id' => $this->input->post('payment'),
                'delivery_id' => $this->input->post('delivery') ? $this->input->post('delivery') : '0',
                'date_create' => time()
            ];
            $this->db->insert('purchase', $purchaseData);

            $purchase_id = $this->db->insert_id();

            $toShippingData = [
                'purchase_id' => $purchase_id,
                'date_transaction' => time(),
                'item' => $this->input->post('name_item'),
                'seller' => $name_seller,
                'email_seller' => $email_seller,
                'buyer' => $this->input->post('name'),
                'email_buyer' => $this->session->userdata('email'),
                'address_buyer' => $this->input->post('address') ? $this->input->post('address') : '-',
                'shipping' => 0,
                'date_shipping' => '',
                'recipient' => 0,
                'date_recipient' => '',
            ];
            $this->db->insert('shipping', $toShippingData);

            $this->session->set_flashdata('message', 'Purchase Successful!');
            redirect('transaction/history');
        }
    }




    public function history()
    {
        $data['title'] = 'History';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/transaction/history';
        $config['total_rows'] = $this->db->get_where('purchase', ['email_buyer' => $email])->num_rows();
        $config['per_page'] = 8;

        //Inisialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['getPurchaseMe'] = $this->combine->getTransaction($email, $config['per_page'], $data['start'], 'purchase');

        $data['payment'] = $this->db->get('payment_method')->result_array();
        $data['delivery'] = $this->db->get('delivery_method')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaction/history', $data);
        $this->load->view('templates/footer');
    }




    public function editInfo($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->update->updateInfo($id);
        $this->session->set_flashdata('message', 'Update Info Successful!');
        redirect('transaction/history');
    }




    public function deleteHistory($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->delete->deleteHistory($id);
        $this->session->set_flashdata('message', 'Delete Successful!');
        redirect('transaction/history');
    }




    public function deleteAllHistory()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];
        $this->delete->deleteAllHistory($email);
        $this->session->set_flashdata('message', 'Delete All History Successful!');
        redirect('transaction/history');
    }




    public function store()
    {
        $data['title'] = 'Storage';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/transaction/store';
        $config['total_rows'] = $this->db->get_where('purchase', ['email_seller' => $email])->num_rows();
        $config['per_page'] = 8;

        //Inisialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['getDataStore'] = $this->combine->getTransaction($email, $config['per_page'],  $data['start'], 'store');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaction/store', $data);
        $this->load->view('templates/footer');
    }




    public function shipping()
    {
        $data['title'] = 'Shipping Proccess';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $email = $data['user']['email'];

        //Pagination
        $config['base_url'] = 'http://localhost/wpu-login/transaction/shipping';
        $config['total_rows'] = $this->db->get_where('shipping', '(email_buyer = "' . $email . '" OR email_seller = "' . $email . '")')->num_rows();
        $config['per_page'] = 8;

        //Inisialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $this->db->where('(email_buyer = "' . $email . '" OR email_seller = "' . $email . '")');
        $data['getShippingData'] = $this->db->limit($config['per_page'], $data['start'])->get_where('shipping', '(email_buyer = "' . $email . '" OR email_seller = "' . $email . '")')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaction/shipping');
        $this->load->view('templates/footer');
    }




    public function updateShippingDate()
    {
        $shippingId = $this->input->post('shippingId');
        $isChecked = $this->input->post('isChecked');
        $currentDate = time();

        $shippingData = $this->db->get_where('shipping', ['id' => $shippingId])->row_array();
        $shipping = $shippingData['shipping'];

        $newShippingValue = $isChecked ? ($shipping == 1 ? 0 : 1) : $shipping;

        $dataShipping = [
            'date_shipping' => $isChecked ? $currentDate : null,
            'shipping' => $newShippingValue,
        ];
        $this->db->where('id', $shippingId);
        $this->db->update('shipping', $dataShipping);

        $response = [
            'status' => 'success',
        ];

        if ($isChecked) {
            $response['message'] = 'The delivery process has been successfully completed.';
        } else {
            $response['message_error'] = 'The delivery process has been reset.';
        }

        echo json_encode($response);
    }

    public function updateRecipientDate()
    {
        $shippingId = $this->input->post('shippingId');
        $isChecked = $this->input->post('isChecked');
        $currentDate = time();

        $recipientData = $this->db->get_where('shipping', ['id' => $shippingId])->row_array();
        $recipient = $recipientData['recipient'];

        $newRecipientValue = $isChecked ? ($recipient == 1 ? 0 : 1) : $recipient;

        $dataRecipient = [
            'date_recipient' => $isChecked ? $currentDate : null,
            'recipient' => $newRecipientValue
        ];
        $this->db->where('id', $shippingId);
        $this->db->update('shipping', $dataRecipient);

        $response = [
            'status' => 'success',
        ];

        if ($isChecked) {
            $response['message'] = 'The items have been successfully received.';
        } else {
            $response['message_error'] = 'The items have been reset.';
        }

        echo json_encode($response);
    }
}
