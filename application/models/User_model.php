<?php

class User_model extends CI_Model
{
    public function regisUser($data)
    {
        $this->db->insert('tb_users', $data);
        return $this->db->affected_rows();
    }

    public function loginUser($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('tb_users');

        if ($query->num_rows()) {
            $user_pass = $query->row('password');
            if (password_verify($password, $user_pass)) {
                return $query->row();
            }
            return false;
        } else {
            return false;
        }
    }

    public function getUser($key, $kode)
    {
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('role_id', $kode);
        $this->db->like('nama', $key);
        $this->db->order_by('nama', 'ASC');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUsers()
    {
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->order_by('username', 'ASC');
        $this->db->where('role_id', 2);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUserById($key)
    {
        $this->db->select('*');
        $this->db->from('tb_users');
        $this->db->where('username', $key);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteUser($username)
    {
        $this->db->delete('tb_users', ['username' => $username]);
        return $this->db->affected_rows();
    }

    public function deleteBaca($id)
    {
        $this->db->delete('tb_baca_huruf', ['id' => $id]);
        return $this->db->affected_rows();
    }


    public function deleteGambar($id)
    {
        $this->db->delete('tb_baca_gambar', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getSoal($metode)
    {
        $this->db->select('*');
        $this->db->from('tb_tebak_huruf');
        $this->db->where('metode_id', $metode);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getBaca($metode)
    {
        $this->db->select('*');
        $this->db->from('tb_baca_huruf');
        $this->db->where('metode_id', $metode);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori_gambar');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getGambar($id)
    {
        $this->db->select('*');
        $this->db->from('tb_baca_gambar');
        $this->db->where('kategori_id', $id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function updatePass($username, $data)
    {
        $this->db->update('tb_users', $data, ['username' => $username]);
        return $this->db->affected_rows();
    }

    public function updateSiswa($username, $data)
    {
        $this->db->update('tb_users', $data, ['username' => $username]);
        return $this->db->affected_rows();
    }

    public function tambahBaca($data)
    {
        $this->db->insert('tb_baca_huruf', $data);
        return $this->db->affected_rows();
    }

    public function updateBaca($id, $data)
    {
        $this->db->update('tb_baca_huruf', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function tambahKategori($data)
    {
        $this->db->insert('tb_kategori_gambar', $data);
        return $this->db->affected_rows();
    }

    public function tambahGambar($data)
    {
        $this->db->insert('tb_baca_gambar', $data);
        return $this->db->affected_rows();
    }

    public function getTebakHuruf($metode)
    {
        $this->db->select('*');
        $this->db->from('tb_tebak_huruf');
        $this->db->where('metode_id', $metode);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahTbkHuruf($data)
    {
        $this->db->insert('tb_tebak_huruf', $data);
        return $this->db->affected_rows();
    }

    public function getTebakKata($metode)
    {
        $this->db->select('*');
        $this->db->from('tb_tebak_kata');
        $this->db->where('metode_id', $metode);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahTbkKata($data)
    {
        $this->db->insert('tb_tebak_kata', $data);
        return $this->db->affected_rows();
    }

    public function deleteTbkHuruf($id)
    {
        $this->db->delete('tb_tebak_huruf', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTbkKata($id)
    {
        $this->db->delete('tb_tebak_kata', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
