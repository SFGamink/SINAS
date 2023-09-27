<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $debitur['cia'] = $this->db->query("SELECT * FROM costumer")->result_array();

        $this->load->view('v_navbar_admin');
        $this->load->view('dashboard/v_dashboard', $debitur);
        $this->load->view('v_footer_admin');
    }

    public function add()
    {
        $debitur = array(
            'judul' => 'Tambah Data Costumer',
            'action' => site_url('dashboard/add_action'),
            'CIF' => set_value('CIF',random_string('numeric',8)),
            'costumer_nama' => set_value('costumer_name'),
            'costumer_nik' => set_value('costumer_nik'),
            'costumer_alamat' => set_value('costumer_alamat'),
            'costumer_kelamin' => set_value('costumer_kelamin'),
            'costumer_lahir' => date('Y-m-d H:i:s'),
        );

        $this->load->view('v_navbar_admin');
        $this->load->view('dashboard/v_dashboard_form', $debitur);
        $this->load->view('v_footer_admin');
    }

    public function add_action()
    {
        $this->_rulesAdd();


        if ($this->form_validation->run() === FALSE) {
            $this->add();
        } else {
            $data = array(
                'CIF' => $this->input->post('CIF',random_string('numeric',8)),
                'costumer_nama' => $this->input->post('costumer_nama'),
                'costumer_nik' => $this->input->post('costumer_nik'),
                'costumer_alamat' => $this->input->post('costumer_alamat'),
                'costumer_kelamin' => $this->input->post('costumer_kelamin'),
                'costumer_lahir' => $this->input->post('costumer_lahir'),

            );
            $this->db->insert('costumer', $data);

            echo '<script language="javascript">';
            echo ' alert ("DATA TELAH BERHASIL DI TAMBAHKAN!!!")';
            echo '</script>';
            echo "<script>window.location.href = '" . site_url('dashboard/index') . "';</script>";
        }
    }

    private function _rulesAdd()
    {

        $rules = [
            [
                'field' => 'costumer_nama',
                'label' => 'Nama Lengkap',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'costumer_nik',
                'label' => 'NIK',
                'rules' => 'trim|required|is_unique[costumer.costumer_nik]|min_length[16]|max_length[17]',
            ],
            [
                'field' => 'CIF',
                'label' => 'CIF',
                'rules' => 'trim|required|is_unique[costumer.CIF]|min_length[8]|max_length[8]',
            ],
        ];

        $this->form_validation->set_rules($rules);
    }

    public function edit($CIF = NULL)
    {
        $row = $this->db->query("SELECT * FROM costumer WHERE CIF = '$CIF'")->row_array();

        if ($row) {
            $data = array(
                'judul' => 'Edit Data Costumer',
                'action' => site_url('dashboard/update_action'),
                'CIF' => set_value('CIF', $row['CIF']),
                'costumer_nama' => set_value('costumer_nama', $row['costumer_nama']),
                'costumer_nik' => set_value('costumer_nik', $row['costumer_nik']),
                'costumer_alamat' => set_value('costumer_alamat', $row['costumer_alamat']),
                'costumer_kelamin' => set_value('costumer_kelamin', $row['costumer_kelamin']),
                'costumer_lahir' => set_value('costumer_lahir', $row['costumer_lahir']),
            );

            $this->load->view('v_navbar_admin');
            $this->load->view('dashboard/v_dashboard_edit', $data);
            $this->load->view('v_footer_admin');
        }
    }

    public function update_action()
{
    $this->_rulesedit();

    // Validate the form data (you can uncomment this if you have validation rules)
    // if ($this->form_validation->run() === FALSE) {
    //     $this->edit($this->input->post("CIF"));
    // } else {
        $CIF = $this->input->post('CIF'); // Get the CIF value from the form input

        $data = array(
            'costumer_nama' => $this->input->post('costumer_nama'),
            'costumer_nik' => $this->input->post('costumer_nik'),
            'costumer_alamat' => $this->input->post('costumer_alamat'),
            'costumer_kelamin' => $this->input->post('costumer_kelamin'),
            'costumer_lahir' => $this->input->post('costumer_lahir'),
        );

        // Update the customer data in the database
        $this->db->where('CIF', $CIF); // Specify the CIF value as the condition
        $this->db->update('costumer', $data);

        // Display a success message and redirect
        echo '<script language="javascript">';
        echo ' alert ("DATA TELAH BERHASIL DI UPDATE!!!")';
        echo '</script>';
        echo "<script>window.location.href = '" . site_url('dashboard/index') . "';</script>";
    // }
}

    private function _rulesedit()
    {

        $rules = [
            [
                'field' => 'costumer_nama',
                'label' => 'Nama Lengkap',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'costumer_nik',
                'label' => 'NIK',
                'rules' => 'trim|required|is_unique[costumer.costumer_nik]|min_length[16]|max_length[17]',
            ],
            [
                'field' => 'CIF',
                'label' => 'CIF',
                'rules' => 'trim|required|is_unique[costumer.CIF]|min_length[6]|max_length[6]',
            ],
        ];

        $this->form_validation->set_rules($rules);
    }

    public function delete($CIF = NULL)
    {
        $row = $this->db->query("DELETE FROM costumer WHERE CIF = '{$CIF}' ");

        echo '<script language="javascript">';
        echo 'alert ("DATA TELAH BERHASIL DI HAPUS!!!")';
        echo '</script>';
        echo "<script>window.location.href = '" . site_url('dashboard/index') . "';</script>";
    }
}
