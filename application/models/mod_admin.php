<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_admin extends CI_Model {

	public function cek_login($uname, $pwd)
	{
		$data = array('username' => $uname,
					'password' => $pwd, );
		$this->db->where($data);
		return $this->db->get('admin');
	}
	public function get_setting()
	{
		$sekolah = $this->db->get_where('seting', array('nama' => 'sekolah'))->row_array();
		$kasek = $this->db->get_where('seting', array('nama' => 'kasek'))->row_array();
		$bendahara = $this->db->get_where('seting', array('nama' => 'bendahara'))->row_array();
		$spp = $this->db->get_where('seting', array('nama' => 'spp'))->row_array();
		$tapel = $this->db->get_where('seting', array('nama' => 'tapel'))->row_array();
		$setingan = array('sekolah' => $sekolah['nilai'],
						'kasek' =>$kasek['nilai'],
						'bendahara' =>$bendahara['nilai'],
						'spp' =>$spp['nilai'],
						'tapel' =>$tapel['nilai'], );
		return $setingan;
	}

	public function load_kelas()
	{
		$this->db->order_by('kelas', 'asc');
		return $this->db->get('data_master_kelas');
	}

	public function get_master_kelas($number,$offset)
	{
		$this->db->order_by('kelas', 'asc');
		return $this->db->get('data_master_kelas',$number,$offset)->result();
	}

	public function where_master_kelas($id)
	{
		return $this->db->get_where('data_master_kelas', array('id' =>$id , ));
		//return $this->db->get('data_master_kelas',$number,$offset)->result();
	}

	public function jumlah_kelas()
	{
		return $this->db->get('data_master_kelas')->num_rows();
	}

	public function simpan_master_kelas($datasave)
	{
		$this->db->insert('data_master_kelas', $datasave);
	}

	public function update_master_kelas($datasave)
	{
		$this->db->update('data_master_kelas', $datasave);
	}

	public function update_siswa($datasave)
	{
		$this->db->update('data_siswa', $datasave);
	}

	public function update_kelas($datasave)
	{
		$this->db->update('data_kelas', $datasave);
	}

	public function data_kelas()
	{
		return $this->db->get('data_kelas');
	}

	public function hapus_master_kelas($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('data_master_kelas');
	}

	public function get_master_guru()
	{
		return $this->db->get('guru');
	}

	public function load_siswa()
	{
		$this->db->order_by('nama', 'asc');
		return $this->db->get('data_siswa')->result();	
	}

	public function get_siswa($number, $offset)
	{
		$this->db->order_by('nama', 'asc');
		return $this->db->get('data_siswa',$number,$offset)->result();
	}
	
	public function hit_tran()
	{
		return $this->db->get('data_pembayaran')->num_rows();
		# code...
	}
	public function jumlah_siswa()
	{
		return $this->db->get('data_siswa')->num_rows();
	}

	public function simpan_siswa($data)
	{
		$this->db->insert('data_siswa', $data);;
	}

	public function simpan_kelas($kelas)
	{
		$this->db->insert('data_kelas', $kelas);
	}

	public function hapus_siswa($nis)
	{
		$this->db->where('nis', $nis);
		$this->db->delete('data_siswa');
	}

	public function hapus_kelas($nis)
	{
		$this->db->where('id_siswa', $nis);
		$this->db->delete('data_kelas');
	}

	public function get_kelas($nis)
	{
		return $this->db->get_where('data_kelas',  array('id_siswa' => $nis, ));
	}

	public function where_siswa($nis)
	{
		return $this->db->get_where('data_siswa', array('nis' =>$nis , ));
	}

	public function get_guru()
	{
		return $this->db->get('guru');
	}

	public function where_guru($id)
	{
		return $this->db->get_where('guru', array('id' => $id,));
	}

	public function get_admin()
	{
		return $this->db->get('admin');
	}

	public function where_admin($id)
	{
		return $this->db->get_where('admin', array('id_guru' => $id,));
	}

	public function simpan_admin($data)
	{
		$this->db->insert('admin', $data);
	}

	public function simpan_guru($data)
	{
		$this->db->insert('guru', $data);
	}

	public function update_admin($id, $datas)
	{
		$this->db->where('id_guru', $id);
		$this->db->update('admin', $datas);
	}

	public function update_guru($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('guru', $data);
	}

	public function hapus_guru($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('guru');
	}

	public function hapus_admin($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('admin');
	}

	public function get_tagihan()
	{
		$this->db->order_by('id', 'asc');
		return $this->db->get('tagihan');
	}

	public function simpan_tagihan($data)
	{
		$this->db->insert('tagihan', $data);
	}

	public function where_tagihan($id)
	{
		return $this->db->get_where('tagihan', array('id' => $id,));
	}

	public function update_tagihan($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tagihan', $data);
	}

	public function hapus_tagihan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tagihan');
	}

	public function siswa_where()
	{
		return $this->db->get('v_siswa');
	}

	public function cari_spp($nis)
	{
		return $this->db->get_where('spp', array('nis' => $nis,));
	}

	public function hit_carispp($nis)
	{
		$this->db->order_by('bulan', 'asc');
		return $this->db->get_where('spp', array('nis' => $nis,))->num_rows();
	}

	public function simpan_spp($data)
	{
		$this->db->insert('spp', $data);
	}

	public function cari_nis($id)
	{
		$this->db->order_by('nama', 'asc');
		$this->db->like('nis', $id, 'BOTH');
		return $this->db->get('v_siswa');
	}

	public function cari_nama($nama)
	{
		$this->db->order_by('nama', 'asc');
		$this->db->like('nama', $nama, 'BOTH');
		return $this->db->get('v_siswa');
	}

	public function load_tag_where($id)
	{
		$this->db->order_by('jatuh_tempo', 'asc');
		$this->db->like('kelas', $id, 'BOTH');
		$this->db->or_like('kelas', '0', 'BOTH');
		return $this->db->get('tagihan');
	}

	public function load_bayar($id)
	{
		$this->db->order_by('nama', 'asc');
		//$this->db->like('nama', $nama, 'BOTH');
		$this->db->where('nis', $id);
		return $this->db->get('v_bayar');
	}

	public function save_temp($data)
	{
		$this->db->insert('data_pembayaran_temp', $data);
	}

	public function where_bayar($id)
	{
		$this->db->order_by('jenis', 'asc');
		$this->db->where('nis', $id);
		return $this->db->get('v_bayar');
	}

	public function get_printer()
	{
		$this->db->where('id', 6);
		return $this->db->get('seting');
	}

}

/* End of file mod_admin.php */
/* Location: ./application/models/mod_admin.php */