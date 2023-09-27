<?php
class Tabungan extends CI_Controller
{
    public function index()
    {

        $tabungan = $this->db->query("SELECT tabungan.tab_rek,tabungan.CIF,tabungan.saldo,tabungan.nama_tab,tabungan.tab_buka,tabungan.tab_tutup, costumer.costumer_nama FROM tabungan LEFT JOIN costumer ON costumer.CIF = tabungan.CIF")->result_array();


        $data = array(
            'judul' => 'Tabel Tabungan',
            'tbng' => $tabungan,
        );

        $this->load->view('v_navbar_admin');
        $this->load->view('tabungan/v_tabungan', $data);
        $this->load->view('v_footer_admin');
    }


    public function add()
    {
        $this->load->model('AppModel'); // Load the model here

        $data = array(
            'judul' => 'Tambah Tabungan',
            'action' => site_url('Tabungan/add_action'),
            'tab_rek' => set_value('tab_rek', random_string('numeric', 13)),
            'nama_tab' => set_value('nama_tab'),
            'saldo' => set_value('saldo'),
            'CIF' => set_value('CIF'),
            'tab_buka' => date('Y-m-d H:i:s'),
            'tab_tutup' => date('Y-m-d H:i:s'),
        );

        $this->load->view('v_navbar_admin');
        $this->load->view('tabungan/v_tabungan_form', $data);
        $this->load->view('v_footer_admin');
    }

    public function add_action()
    {
        $this->_rulesAdd();


        if ($this->form_validation->run() === FALSE) {
            $this->add();
        } else {
            $data = array(
                'tab_rek' => $this->input->post('tab_rek'),
                'nama_tab' => $this->input->post('nama_tab'),
                'saldo' => $this->input->post('saldo'),
                'CIF' => $this->input->post('CIF'),
                'tab_buka' => date('Y-m-d H:i:s'),
                'tab_tutup' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tabungan', $data);

            echo '<script language="javascript">';
            echo ' alert ("DATA TELAH BERHASIL DI TAMBAHKAN!!!")';
            echo '</script>';
            echo "<script>window.location.href = '" . site_url('tabungan/index') . "';</script>";
        }
    }

    private function _rulesAdd()
    {

        $rules = [
            [
                'field' => 'tab_rek',
                'label' => 'Nomor Rekening',
                'rules' => 'trim|required|is_natural|min_length[8]|max_length[13]|is_unique[tabungan.tab_rek]',
            ],
            [
                'field' => 'nama_tab',
                'label' => 'Nama Tabungan',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'saldo',
                'label' => 'Balance',
                'rules' => 'trim|required',
            ],
        ];

        $this->form_validation->set_rules($rules);
    }



    public function edit($CIF = NULL)
    {
        $row = $this->db->query("SELECT * FROM tabungan WHERE CIF = '$CIF'")->row_array();

        $this->load->model('AppModel');

        if ($row) {
            $data = array(
                'judul' => 'Edit Data Tabungan',
                'action' => site_url('tabungan/update_action'),
                'CIF' => set_value('CIF', $row['CIF']),
                'tab_rek' => set_value('tab_rek', $row['tab_rek']),
                'nama_tab' => set_value('nama_tab', $row['nama_tab']),
                'saldo' => set_value('saldo', $row['saldo']),
                'tab_buka' => set_value('tab_buka', $row['tab_buka']),
                'tab_tutup' => set_value('tab_tutup', $row['tab_tutup']),
            );

            $this->load->view('v_navbar_admin');
            $this->load->view('tabungan/v_tabungan_edit', $data);
            $this->load->view('v_footer_admin');
        }
    }

    public function update_action()
    {
        $this->_rulesedit();


        if ($this->form_validation->run() === FALSE) {
            $this->edit($this->input->post('CIF'));
        } else {
            $data = array(
                'tab_rek' => $this->input->post('tab_rek'),
                'nama_tab' => $this->input->post('nama_tab'),
                'saldo' => $this->input->post('saldo'),
                'CIF' => $this->input->post('CIF'),
            );
            $this->db->where('CIF', $this->input->post('CIF'));
            $this->db->update('tabungan', $data);

            echo '<script language="javascript">';
            echo ' alert ("DATA TELAH BERHASIL DI UPDATE!!!")';
            echo '</script>';
            echo "<script>window.location.href = '" . site_url('tabungan/index') . "';</script>";
        }
    }


    private function _rulesedit()
    {

        $rules = [
            [
                'field' => 'tab_rek',
                'label' => 'Nomor Rekening',
                'rules' => 'trim|required|is_natural|min_length[8]|max_length[13]',
            ],
            [
                'field' => 'nama_tab',
                'label' => 'Nama Tabungan',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'saldo',
                'label' => 'Balance',
                'rules' => 'trim|required',
            ],
        ];

        $this->form_validation->set_rules($rules);
    }


    public function delete($CIF = NULL)
    {
        $row = $this->db->query("DELETE FROM tabungan WHERE CIF = '{$CIF}' ");

        echo '<script language="javascript">';
        echo 'alert ("DATA TELAH BERHASIL DI HAPUS!!!")';
        echo '</script>';
        echo "<script>window.location.href = '" . site_url('tabungan/index') . "';</script>";
    }
}
