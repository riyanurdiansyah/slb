<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller
{

    public function adduser_post()
    {
        $username = $this->post('username');
        $nama = $this->post('nama');

        $data = [
            'username' => $username,
            'nama' => $nama
        ];

        $user = $this->db->get_where('tb_users', ['username' => $username])->row_array();

        if ($user) {
            $this->response([
                'status' => 'failed',
                'message' => 'Nomor induk sudah terdaftar'
            ], 201);
        } else {
            $this->User_model->regisUser($data);
            $this->response([
                'status'    => 'success',
                'message'   => 'Registrasi berhasil'
            ], 200);
        }
    }

    public function registrasi_post()
    {
        $username = $this->post('username');
        $nama = $this->post('nama');
        $password = $this->post('password');
        $no_hp = $this->post('no_hp');
        $jenis_kelamin = $this->post('jenis_kelamin');
        $tgl_lahir = $this->post('tgl_lahir');
        $alamat = $this->post('alamat');
        $role = $this->post('role_id');

        if ($jenis_kelamin == "Perempuan") {
            $foto = 'cewe.jpg';
        } else {
            $foto = 'cowo.jpg';
        }

        $data = [
            'username' => $username,
            'nama' => $nama,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'no_hp' => $no_hp,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat,
            'foto' => $foto,
            'role_id'  => $role
        ];

        $user = $this->db->get_where('tb_users', ['username' => $username])->row_array();

        if ($user) {
            $this->response([
                'status' => 'failed',
                'message' => 'Nomor induk sudah terdaftar'
            ], 201);
        } else {
            $this->User_model->regisUser($data);
            $this->response([
                'status'    => 'success',
                'message'   => 'Registrasi berhasil'
            ], 200);
        }
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        $output = $this->User_model->loginUser($username, $password);
        if (!empty($output) and $output != FALSE) {
            $data = [
                'id' => $output->id,
                'username' => $output->username,
                'nama' => $output->nama,
                'no_hp' => $output->no_hp,
                'jenis_kelamin' => $output->jenis_kelamin,
                'tgl_lahir' => $output->tgl_lahir,
                'alamat' => $output->alamat,
                'kelas' => $output->kelas,
                'foto' => $output->foto,
                'role_id' => $output->role_id
            ];

            $this->response([
                'status'  => 'success',
                'message' => 'Login berhasil',
                'data'    => $data
            ], 200);
        } else {

            $data = [
                'id' => '',
                'username' => '',
                'nama' => '',
                'no_hp' => '',
                'jenis_kelamin' => '',
                'tgl_lahir' => '',
                'alamat' => '',
                'foto' => '',
                'role_id' => ''
            ];

            $this->response([
                'status'  => 'failed',
                'message' => 'Login gagal',
                'data' => $data
            ], 201);
        }
    }

    public function users_get()
    {
        $user = $this->User_model->getUsers();

        $this->response($user, 200);
    }

    public function user_get()
    {
        $key = $this->get('key');
        $kode = $this->get('kode');

        $user = $this->User_model->getUser($key, $kode);

        $this->response($user, 200);
    }

    public function deleteuser_post()
    {
        $username = $this->post('username');

        $user = $this->User_model->deleteUser($username);

        if ($user > 0) {
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menghapus data'
            ], 201);
        }
    }

    public function deletebaca_post()
    {
        $id = $this->post('id');

        $user = $this->User_model->deleteBaca($id);

        if ($user > 0) {
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menghapus data'
            ], 201);
        }
    }

    public function soal_get()
    {
        $metode = $this->get('metode_id');
        $user = $this->User_model->getSoal($metode);

        $this->response($user, 200);
    }

    public function baca_get()
    {
        $metode = $this->get('metode_id');

        $user = $this->User_model->getBaca($metode);

        $this->response($user, 200);
    }

    public function ubahpass_put()
    {
        $password = $this->put('password');
        $username = $this->put('username');
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $user = $this->User_model->updatePass($username, $data);

        if ($user) {
            $this->response([
                'status' => 'success',
                'message' => 'Berhasil merubah password'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal merubah password'
            ], 200);
        }
    }

    public function kategori_get()
    {
        $user = $this->User_model->getKategori();

        $this->response($user, 200);
    }

    public function gambar_get()
    {
        $id = $this->get('kategori_id');

        $user = $this->User_model->getGambar($id);

        $this->response($user, 200);
    }

    public function updatesiswa_put()
    {

        $username = $this->put('username');
        $hp = $this->put('no_hp');
        $jenis_kelamin = $this->put('jenis_kelamin');
        $tgl_lahir = $this->put('tgl_lahir');
        $alamat = $this->put('alamat');

        $data = [
            'no_hp' => $hp,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat
        ];
        $user = $this->User_model->updateSiswa($username, $data);

        if ($user) {
            $this->response([
                'status' => 'success',
                'message' => 'Berhasil mengupdate data'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal merubah data'
            ], 200);
        }
    }

    public function userbyid_get()
    {
        $key = $this->get('key');

        $user = $this->User_model->getUserById($key);

        $this->response($user, 200);
    }

    public function tambahbaca_post()
    {
        $penjelasan = $this->post('penjelasan');
        $metode = $this->post('metode_id');

        if ($metode === 1) {
            $nama = 'bisindo';
        } else {
            $nama = 'sibi';
        }

        $config['upload_path']      = './assets/baca huruf/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']         = '20480';
        $config['file_name']        = $nama;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('materi')) {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal mengupload data'
            ], 201);
        } else {
            $newFile = $this->upload->data('file_name');
            $data = [
                'materi' => $newFile,
                'penjelasan' => $penjelasan,
                'metode_id' => $metode
            ];
            $user =  $this->User_model->tambahBaca($data);
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ], 201);
        }
    }

    public function updatebacafoto_post()
    {
        $id = $this->post('id');
        $materi = $this->post('materi');
        $penjelasan = $this->post('penjelasan');
        $metode_id = $this->post('metode_id');

        if ($metode_id === 1) {
            $nama = 'bisindo';
        } else {
            $nama = 'sibi';
        }

        if ($id === 0) {
            $this->response([
                'status' => 'failed',
                'message' => 'Id tidak boleh kosong'
            ], 201);
        } else {

            $config['upload_path']      = './assets/baca huruf/';
            $config['allowed_types']    = 'png|jpg|jpeg';
            $config['max_size']         = '20480';
            $config['file_name']        = $nama;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('materi')) {
                $this->response([
                    'status' => 'failed',
                    'message' => 'Gagal mengupdate data'
                ], 201);
            } else {
                $newFile = $this->upload->data('file_name');
                $data = [
                    'materi' => $newFile,
                    'penjelasan' => $penjelasan,
                    'metode_id' => $metode_id
                ];
                $this->User_model->updateBaca($id, $data);
                $this->response([
                    'status' => 'success',
                    'message' => 'Data berhasil diupdate'
                ], 200);
            }
        }
    }

    public function updatebaca_post()
    {
        $id = $this->post('id');
        $penjelasan = $this->post('penjelasan');

        $data = [
            'penjelasan' => $penjelasan
        ];

        $user = $this->User_model->updateBaca($id, $data);

        if ($user) {
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil diupdate'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Data gagal diupdate'
            ], 201);
        }
    }

    public function tambahkategori_post()
    {
        $nama = $this->post('nama');

        $config['upload_path']      = './assets/tebak gambar/kategori/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']         = '20480';
        $config['file_name']        = $nama;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menambah data'
            ], 201);
        } else {
            $newFile = $this->upload->data('file_name');
            $data = [
                'foto' => $newFile,
                'nama' => $nama
            ];
            $this->User_model->tambahKategori($data);
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ], 200);
        }
    }

    public function tambahgambar_post()
    {
        $nama = $this->post('nama');
        $kategori_id = $this->post('kategori_id');

        $config['upload_path']      = './assets/tebak gambar/gambar/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']         = '20480';
        $config['file_name']        = $nama;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menambah data'
            ], 201);
        } else {
            $newFile = $this->upload->data('file_name');
            $data = [
                'foto' => $newFile,
                'nama' => $nama,
                'kategori_id' => $kategori_id
            ];
            $this->User_model->tambahGambar($data);
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ], 200);
        }
    }

    public function deletegambar_post()
    {
        $id = $this->post('id');

        $user = $this->User_model->deleteGambar($id);

        if ($user > 0) {
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menghapus data'
            ], 201);
        }
    }

    public function tebakhuruf_get()
    {
        $metode_id = $this->get('metode_id');

        $user = $this->User_model->getTebakHuruf($metode_id);

        $this->response($user, 200);
    }

    public function tambahtbkhuruf_post()
    {
        $metode_id = $this->post('metode_id');
        $jawaban = $this->post('jawaban');

        $nama = 'tbk_huruf';

        $config['upload_path']      = './assets/tebak huruf/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']         = '20480';
        $config['file_name']        = $nama;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('soal')) {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menambah data'
            ], 201);
        } else {
            $newFile = $this->upload->data('file_name');
            $data = [
                'soal' => $newFile,
                'jawaban' => $jawaban,
                'metode_id' => $metode_id
            ];
            $this->User_model->tambahTbkHuruf($data);
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ], 200);
        }
    }

    public function tebakkata_get()
    {
        $metode_id = $this->get('metode_id');

        $user = $this->User_model->getTebakKata($metode_id);

        $this->response($user, 200);
    }

    public function tambahtbkkata_post()
    {
        $metode_id = $this->post('metode_id');
        $jawaban = $this->post('jawaban');

        $nama = 'tbk_kata';

        $config['upload_path']      = './assets/tebak kata/';
        $config['allowed_types']    = 'png|jpg|jpeg';
        $config['max_size']         = '20480';
        $config['file_name']        = $nama;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('soal')) {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menambah data'
            ], 201);
        } else {
            $newFile = $this->upload->data('file_name');
            $data = [
                'soal' => $newFile,
                'jawaban' => $jawaban,
                'metode_id' => $metode_id
            ];
            $this->User_model->tambahTbkKata($data);
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan'
            ], 200);
        }
    }

    public function deletetebak_post()
    {
        $id = $this->post('id');

        $user = $this->User_model->deleteTbkHuruf($id);

        if ($user > 0) {
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menghapus data'
            ], 201);
        }
    }

    public function deletetebakkata_post()
    {
        $id = $this->post('id');

        $user = $this->User_model->deleteTbkKata($id);

        if ($user > 0) {
            $this->response([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => 'failed',
                'message' => 'Gagal menghapus data'
            ], 201);
        }
    }
}
