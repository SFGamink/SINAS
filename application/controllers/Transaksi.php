<?php
class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AppModel');
    }

    //menampikan data costumer
    public function index()
    {
        // Cek Query Data Ke
        $query = 'SELECT transaksi.CIF, transaksi.tanggal_transaksi, transaksi.nominal, transaksi.transaksi_jen, transaksi.jenis, tabungan.nama_tab, tabungan.tab_rek, tabungan.saldo FROM transaksi LEFT JOIN  tabungan ON tabungan.CIF = transaksi.CIF';
        $querycostumer = $this->db->query($query)->result_array();

        // Tampung Data Yang Akan Di Kirim
        $data = array(
            'judul' => 'Tabel Transaksi',
            'trns' => $querycostumer,
        );
        // Tampil Data
        $this->load->view('v_navbar_admin.php');
        $this->load->view('transaksi/v_transaksi', $data);
        $this->load->view('v_footer_admin.php');
    }

    // menambahkan data costumer
    public function add()
    {
        $data = array(
            'judul' => 'Tambah Transaksi',
            'action' => site_url('transaksi/add_action'),
            'CIF' => set_value('CIF'),
            'tanggal_transaksi' => set_value('tanggal_transaksi', date('Y-m-d H:i:s')),
            'nominal' => set_value('nominal'),
            'transaksi_jen' => set_value('transaksi_jen'),
            'jenis' => set_value('jenis'),
        );

        $this->load->view('v_navbar_admin.php');
        $this->load->view('transaksi/v_transaksi_form', $data);
        $this->load->view('v_footer_admin.php');
    }

    public function add_action()
    {
        $this->_rulesAdd();

        if ($this->form_validation->run() === FALSE) {
            $this->add();
        } else {
            $saving_id = $this->input->post('CIF');
            $saldo = $this->db->query("SELECT nominal FROM tabungan WHERE CIF = {$saving_id}")->row_array();
            $saldoSebelum = $saldo['saldo'];

            if ($this->input->post('transaksi_jen') == 'masuk') {
                $saldoTerakhir = $saldoSebelum + $this->input->post('nominal');

                $dataSaving = array(
                    'nominal' => $saldoTerakhir
                );
                $this->db->where('CIF', $saving_id);
                $this->db->update('transaksi', $dataSaving);

                $data = array(
                    'CIF' => $this->input->post('CIF'),
                    'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
                    'transaksi_jen' => $this->input->post('transaksi_jen'),
                    'nominal' => $this->input->post('nominal'),
                    'jenis' => $this->input->post('jenis'),
                );
                $this->db->insert('tabungan', $data);

                echo '<script language="javascript">';
                echo ' alert ("TRANSAKSI TELAH BERHASIL DILAKUKAN")';
                echo '</script>';
                echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
            } elseif ($this->input->post('transaksi_jen') == 'keluar') {
                $saldoSebelum = $saldo['saldo'];
                if ($saldoSebelum > 0) {
                    if ($this->input->post('nominal') > $saldoSebelum) {
                        echo '<script>';
                        echo ' alert ("TRANSAKSI TIDAK DAPAT DILAKUKAN MOHON PERIKSA SALDO ANDA")';
                        echo '</script>';
                        echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
                    } else {
                        $saldoTerakhir = $saldoSebelum - $this->input->post('nominal');

                        $dataSaving = array(
                            "saldo" => $saldoTerakhir
                        );
                        $this->db->where('CIF', $saving_id);
                        $this->db->update('tabungan', $dataSaving);

                        $data = array(
                            'tanggal_transaksi' => $this->input->post('tanggal_transaksi'),
                            'transaksi_jen' => $this->input->post('transaksi_jen'),
                            'nominal' => $this->input->post('nominal'),
                            'jenis' => $this->input->post('jenis'),
                        );
                        $this->db->insert('saving_transaction', $data);

                        echo '<script language="javascript">';
                        echo ' alert ("TRANSAKSI TELAH BERHASIL DILAKUKAN")';
                        echo '</script>';
                        echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
                    }
                } else {
                    echo '<script language="javascript">';
                    echo ' alert ("TRANSAKSI TIDAK DAPAT DILAKUKAN MOHON PERIKSA SALDO ANDA")';
                    echo '</script>';
                    echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
                }
            } else {
                echo '<script language="javascript">';
                echo ' alert ("TRANSAKSI DIBATALKAN")';
                echo '</script>';
                echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
            }
        }
    }



    // Aturan Tambah Data
    private function _rulesAdd()
    {

        $rules = [
            // [
            //     'field' => 'transaction_tanggal',
            //     'label' => 'Tanggal Transaksi',
            //     'rules' => 'trim|required',
            // ],
            // [
            //     'field' => 'transaction_type',
            //     'label' => 'Jenis Transaksi',
            //     'rules' => 'required',
            // ],
            // [
            //     'field' => 'transaction_amount',
            //     'label' => 'Nominal',
            //     'rules' => 'trim|required',
            // ],
            // [
            //     'field' => 'saving_id',
            //     'label' => 'Account number',
            //     'rules' => 'trim|required',
            // ],
        ];

        $this->form_validation->set_rules($rules);
    }


    // Edit Data Costumer
    public function edit($id = NULL)
    {
        $query = "SELECT st.transaction_id, st.transaction_tanggal, st.transaction_type, st.transaction_amount, s.saving_id, s.saving_number, s.saving_name, s.saving_balance FROM  saving_transaction st LEFT JOIN  saving s ON s.saving_id = st.saving_id WHERE st.transaction_id = '$id'";
        $row = $this->db->query($query)->row_array();
        // $row = $this->db->query("SELECT * FROM transaksi WHERE transaction_id = '$id'")->row_array();

        if ($row) {
            $data = array(
                'judul' => 'Edit Data Transaction',
                'action' => site_url('transaksi/update_action'),
                'transaction_id' => set_value('transaction_id', $row['transaction_id']),
                'transaction_tanggal' => set_value('transaction_tanggal', $row['transaction_tanggal']),
                'transaction_type' => set_value('transaction_type', $row['transaction_type']),
                'transaction_amount' => set_value('transaction_amount', $row['transaction_amount']),
                'saving_id' => set_value('saving_id', $row['saving_id']),
            );

            $this->load->view('_partHeader');
            $this->load->view('transaksi/v_form', $data);
            $this->load->view('v_footer_admin.php');
        }
    }

    public function update_action()
    {
        $this->_rulesedit();


        if ($this->form_validation->run() === FALSE) {
            $this->edit($this->input->post('transaction_id'));
        } else {
            $data = array(
                'transaction_tanggal' => $this->input->post('transaction_tanggal'),
                'transaction_type' => $this->input->post('transaction_type'),
                'transaction_amount' => $this->input->post('transaction_amount'),
                'saving_id' => $this->input->post('saving_id'),
            );
            $this->db->where('transaction_id', $this->input->post('transaction_id'));
            $this->db->update('saving_transaction', $data);

            echo '<script language="javascript">';
            echo ' alert ("TRANSAKSI TELAH BERHASIL DI UPDATE!!!")';
            echo '</script>';
            echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
        }
    }

    // Aturan Tambah Data
    private function _rulesedit()
    {

        $rules = [
            [
                'field' => 'transaction_tanggal',
                'label' => 'Tanggal Transaksi',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'transaction_amount',
                'label' => 'Nominal',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'saving_id',
                'label' => 'Account number',
                'rules' => 'trim|required',
            ],
        ];

        $this->form_validation->set_rules($rules);
    }

    // Hapus Data Costumer
    public function delete($id = NULL)
    {
        $row = $this->db->query("DELETE FROM saving_transaction WHERE transaction_id = '{$id}' ");

        echo '<script language="javascript">';
        echo 'alert ("TRANSAKSI TELAH BERHASIL DI HAPUS!!!")';
        echo '</script>';
        echo "<script>window.location.href = '" . site_url('transaksi/index') . "';</script>";
    }
}
