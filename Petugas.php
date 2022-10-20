<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('petugas_model');
    }

    public function index()
    {
        $data['title'] = 'Petugas Ukur';
        $data['petugas'] = $this->petugas_model->get_data('petugas_ukur')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/index', $data);
        $this->load->view('templates/footer');
    }

    public function surat_tugas()
    {
        $data['title'] = 'Surat Tugas';
        $data['petugas'] = $this->petugas_model->get_data('petugas_ukur')->result();
        $data['surat_tugas'] = $this->petugas_model->get_data('surat_tugas')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['laporan'] = $this->petugas_model->getdatawithstatus('surat_tugas')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/surat_tugas', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Ukur';
        $data['petugas'] = $this->petugas_model->get_data('petugas_ukur')->result();
        $data['surat_tugas'] = $this->petugas_model->get_data('surat_tugas')->result();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['laporan'] = $this->petugas_model->getdatawithstatus('pengukuran')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function penugasan()
    { {
            $data['title'] = 'Petugas Ukur';
            $data['petugas'] = $this->petugas_model->get_data('petugas_ukur')->result();
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('petugas/penugasan', $data);
            $this->load->view('templates/footer');
        }
    }
    public function tambah()
    {
        $data['title'] = 'Tambah Petugas';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/tambah');
        $this->load->view('templates/footer');
    }

    public function input_laporan()
    {
        $data['title'] = 'Input Laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/input_laporan', $data);
        $this->load->view('templates/footer');
    }

    public function edit_laporan()
    {
        $data['title'] = 'Edit Laporan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/edit_laporan', $data);
        $this->load->view('templates/footer');
    }

    public function edit_data($id)
    {
        $data['title'] = 'Edit Data Petugas';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['petugas'] = $this->petugas_model->ambil_id($id)->result()[0];
        // var_dump($data['petugas']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/edit_data', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            $data = array(
                'nama_petugas' => $this->input->post('nama_petugas'),
                'no_telp' => $this->input->post('no_telp'),
                'alamat' => $this->input->post('alamat'),
                'id_berkas' => $this->input->post('id_berkas'),
                'nip_petugas' => $this->input->post('nip_petugas'),
                'jabatan' => $this->input->post('jabatan'),


            );

            $this->petugas_model->insert_data($data, 'petugas_ukur');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('petugas');
        }
    }

    public function tambah_laporan()
    {
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'gif|jpg|png|PNG';
        $config['max_size']             = 2048;
        $config['max_width']            = 1980;
        $config['max_height']           = 1080;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $gambar = $this->upload->data();
            $gambar = $gambar['file_name'];
            $tanggal = date('Y-m-d');
            $no_surat = $this->input->post('no_surat', TRUE);
            $nip = $this->input->post('nip_petugas', TRUE);
            $no_berkas = $this->input->post('no_berkas', TRUE);
            $volume_awal = $this->input->post('volume_awal', TRUE);
            $volume_akhir = $this->input->post('volume_akhir', TRUE);
            $status = $this->input->post('status', TRUE);

            $data = array(
                'tgl_pengerjaan' => $tanggal,
                'no_surat' => $no_surat,
                'nip_petugas' => $nip,
                'no_berkas' => $no_berkas,
                'volume_awal' => $volume_awal,
                'volume_akhir' => $volume_akhir,
                'status' => $status,

            );
            $this->db->insert('pengukuran', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Diupload!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('petugas/surat_tugas');
        } else {
            $gambar = $this->upload->data();
            $gambar = $gambar['file_name'];
            $tanggal = $this->input->post('tgl_pengerjaan', TRUE);
            $no_surat = $this->input->post('no_surat', TRUE);
            $nip = $this->input->post('nip_petugas', TRUE);
            $no_berkas = $this->input->post('no_berkas', TRUE);
            $volume_awal = $this->input->post('volume_awal', TRUE);
            $volume_akhir = $this->input->post('volume_akhir', TRUE);
            $status = $this->input->post('status', TRUE);

            $data = array(
                'tgl_pengerjaan' => $tanggal,
                'no_surat' => $no_surat,
                'nip_petugas' => $nip,
                'no_berkas' => $no_berkas,
                'volume_awal' => $volume_awal,
                'volume_akhir' => $volume_akhir,
                'status' => $status,

            );
            $this->db->insert('pengukuran', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('petugas/laporan');
        }
    }

    // public function edit($id_petugas)
    // {
    //     $this->_rules();
    //     if ($this->form_validation->run() == false) {
    //         $this->index();
    //     } else {
    //         $data = array(
    //             'nama_petugas' => $this->input->post('nama_petugas'),
    //             'no_telp' => $this->input->post('no_telp'),
    //             'alamat' => $this->input->post('alamat'),
    //             'id_berkas' => $this->input->post('id_berkas'),
    //             'nip_petugas' => $this->input->post('nip_petugas'),
    //             'jabatan' => $this->input->post('jabatan'),

    //         );

    //         $this->petugas_model->update_data($data, 'petugas_ukur');
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //         Data Berhasil Ditambah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    //         redirect('petugas');
    //     }
    // }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('id_berkas', 'Nomor Berkas', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('nip_petugas', 'NIP Petugas', 'required', array(
            'required' => '%s harus diisi !!'
        ));
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required', array(
            'required' => '%s harus diisi !!'
        ));
    }

    public function delete($id)
    {
        $where = array('id_petugas' => $id);

        $this->petugas_model->delete($where, 'petugas_ukur');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('petugas');
    }
}
