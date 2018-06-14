<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mod_admin');
		$this->load->library('pagination');
		$this->cek_login();
	}

	public function index()
	{
		
		$this->load->view('home');
	}

	public function keluar()
	{
		session_unset();
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}

	public function cek_login()
	{
		$user = $this->session->userdata('log');
		if ($user['id_guru']=="") {
			redirect(base_url().'login','refresh');
		}
	}

	function getDatetimeNow() {
	    $tz_object = new DateTimeZone('Asia/Jakarta');
	    //date_default_timezone_set('Brazil/East');

	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    return $datetime->format('Y\-m\-d\ h:i:s');
	}

	public function data_kelas($data=array())
	{
		$jumlah_data = $this->mod_admin->jumlah_kelas();
		$config['base_url'] = base_url().'admin/kelas/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 5;
		$config['num_links'] = 2;
		//Tambahan untuk styling
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['first_link']='< Pertama ';
        $config['last_link']='Terakhir > ';
        $config['next_link']='> ';
        $config['prev_link']='< ';
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		return $data = array('pesan' => "Data Guru",
					'kelas' => $this->mod_admin->get_master_kelas($config['per_page'],$from),
					'guru' => $this->mod_admin->get_master_guru()->result(),
					'menu' => "Master > Kelas", );
	}

	public function kelas()
	{
		$data = $this->data_kelas();
		$this->load->view('data_kelas', $data, FALSE);
	}

	public function add_master_kelas()
	{
		$data['menu'] = "Tambah > Kelas";
		$data['guru'] = $this->mod_admin->get_master_guru()->result();
		$this->load->view('add_master_kelas', $data, FALSE);
	}

	public function edit_master_kelas()
	{
		$id = $this->uri->segment(3);
		$data['menu'] = "Tambah > Kelas";
		$data['detail'] = $this->mod_admin->where_master_kelas($id)->row_array();
		//print_r($data['detail']);
		//die;
		$data['guru'] = $this->mod_admin->get_master_guru()->result();
		$this->load->view('edit_master_kelas', $data, FALSE);
	}

	public function simpan_master_kelas()
	{
		if ($this->input->post('id')=='') {
			$id = 0;
		}else{
			$id = $this->input->post('id');
		}
		$this->form_validation->set_rules('kelas', 'kelas', 'required');
		$this->form_validation->set_rules('jurusan', 'jurusan', 'required');
		$this->form_validation->set_rules('walas', 'walas', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Ada data yang bermasalah, Silahkan lengkapi data.');
			redirect(base_url().'admin/add_master_kelas','refresh');
		} else {
			
			$cari = $this->mod_admin->where_master_kelas($id)->row_array();
			//print_r($cari);
			//die;
			if (isset($cari)) {
				$datasave = array(
							'kelas' => $this->input->post('kelas'),
							'jurusan' => $this->input->post('jurusan'),
							'id_guru' => $this->input->post('walas'),
							'ket' => $this->input->post('ket'), );
				//echo "dalam isset";
				//die;
				$this->db->where('id', $id);
				$this->mod_admin->update_master_kelas($datasave);
				$this->session->set_flashdata('sukses', 'Data kelas <b>'.$this->input->post('kelas').'-'.$this->input->post('jurusan').'</b>, berhasil di-UPDATE');
				redirect(base_url().'admin/kelas','refresh');
			}else{
				//echo "kena else";
				//die;
				$datasave = array('id' => '',
							'kelas' => $this->input->post('kelas'),
							'jurusan' => $this->input->post('jurusan'),
							'id_guru' => $this->input->post('walas'),
							'ket' => $this->input->post('ket'), );

				$this->mod_admin->simpan_master_kelas($datasave);
				$this->session->set_flashdata('sukses', 'Data kelas <b>'.$this->input->post('kelas').'-'.$this->input->post('jurusan').'</b>, berhasil ditambahkan');
				redirect(base_url().'admin/kelas','refresh');
			}
			
			
		}
	}

	public function hapus_master_kelas()
	{
		$id = $this->uri->segment(3);
		$this->mod_admin->hapus_master_kelas($id);
		if (!$this->mod_admin->hapus_master_kelas($id)) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			redirect(base_url().'admin/kelas','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data Tidak ditemukan');
			redirect(base_url().'admin/kelas','refresh');
		}
	}

	function json(){
        $this->load->library('datatables');
        $this->datatables->select('nis,nama,th_masuk,alamat,status');
        $this->datatables->from('siswa');
        return print_r($this->datatables->generate());
    }

    public function data_siswa($data=array())
	{
		$jumlah_data = $this->mod_admin->jumlah_siswa();
		$config['base_url'] = base_url().'admin/siswa/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 5;
		$config['num_links'] = 2;
		//Tambahan untuk styling
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['first_link']='< Pertama ';
        $config['last_link']='Terakhir > ';
        $config['next_link']='> ';
        $config['prev_link']='< ';
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);
		return $data = array('pesan' => "Data Guru",
					'siswa' => $this->mod_admin->get_siswa($config['per_page'],$from),
					'guru' => $this->mod_admin->get_master_guru()->result(),
					'menu' => "Master > Siswa", );
	}

	public function transaksi()
	{
		//$data = "Tambah > Siswa";
		//echo base64_encode($data);
		$string2 = "37baf20bdb57e8137804264144536d30505167d1585d51a64a54b2c826eba08b3c794277c0212c5e76598aaf919aadcc478385e4594f3ccc5de5cfe5faf2be54RzK0Gqve9Zw0Xiq8J99pUDuX0GYmGRcC78OE86BgZ+4=";
		$string = "base_url().'admin/keluar'";
		$encript =  $this->encryption->encrypt($string);
		echo $encript."<br>".$string;
	}

	public function siswa()
	{
		$data = $this->data_siswa();
		$this->load->view('data_siswa', $data, FALSE);
	}

	public function add_siswa()
	{
		$data['menu'] = "Tambah > Siswa";
		$data['kelas'] = $this->mod_admin->load_kelas()->result();
		$this->load->view('add_siswa', $data, FALSE);
	}

	public function simpan_siswa()
	{
		$nama = $this->input->post('nama');
		$nis = $this->input->post('nis');
		$ns = $this->input->post('ns');
		$kls = $this->input->post('kelas');
		$pic = $this->input->post('gambar');
		$this->form_validation->set_rules('nis', 'nis', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Ada data yang bermasalah, Silahkan lengkapi data.');
			redirect(base_url().'admin/add_siswa','refresh');
		} else {
			# code...
			$nmfile = $this->input->post('nis').'_'.$this->input->post('kelas').'_'.$this->input->post('nama');
			//"file_".time(); //nama file + fungsi time
			$config['upload_path'] = './foto/'; //Folder untuk menyimpan hasil upload
			$config['allowed_types'] = '*'; //type yang dapat diakses bisa anda sesuaikan
		    $config['max_size'] = '3072'; //maksimum besar file 3M
			$config['max_width']  = '5000'; //lebar maksimum 5000 px
			$config['max_height']  = '5000'; //tinggi maksimu 5000 px
			$config['file_name'] = $nmfile; //nama yang terupload nantinya
		    $this->upload->initialize($config);
		    $ambil = $this->mod_admin->where_siswa($this->input->post('ns'))->row_array();
	        //print_r($ambil);
	        //die;
	        if ($ambil) {
	        	//echo $ambil;
	        	//die;
	        	if($_FILES['foto']['name']){
					unlink(base_url().'foto/'.$pic);
	        		if ($this->upload->do_upload('foto')) {
				        $gbr = $this->upload->data(); 
		        		$data = array(
							'nisn' => $this->input->post('nisn'),
							'nama' => $nama,
							'jk' => $this->input->post('jk'),
							'alamat' => $this->input->post('alamat'),
							'tp_lahir' => $this->input->post('tp_lahir'),
							'tgl_lahir' => $this->input->post('tgl_lahir'),
							'sekolah_asal' => $this->input->post('asal'),
							'th_masuk' => $this->input->post('th_masuk'),
							'foto' => $gbr['file_name'],
							'wali' => $this->input->post('wali'),
							'status' => $this->input->post('status'),
						);	
					}
	        	}else{
		        	$data = array(
						'nisn' => $this->input->post('nisn'),
						'nama' => $nama,
						'jk' => $this->input->post('jk'),
						'alamat' => $this->input->post('alamat'),
						'tp_lahir' => $this->input->post('tp_lahir'),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'sekolah_asal' => $this->input->post('asal'),
						'th_masuk' => $this->input->post('th_masuk'),
						'wali' => $this->input->post('wali'),
						'status' => $this->input->post('status'),
				 	);
				}

				$kelas = array(
			 			'id_siswa' => $nis,
			 			'id_kelas' => $kls,
			 	);
			 	//print_r($ns);
			 	//die;
				$this->db->where('id_siswa', $ns);
				$this->mod_admin->update_kelas($kelas);
				$this->db->where('nis', $nis);
				$this->mod_admin->update_siswa($data);
	 			$this->session->set_flashdata('sukses', 'Data atas nama <b>'.$nama.'</b> berhasil diupdate.');
				redirect(base_url().'admin/siswa','refresh');
	        }else{    
		        if($_FILES['foto']['name']){
		        	if ($this->upload->do_upload('foto')) {
				        $gbr = $this->upload->data();
						$data = array(
							'nis' => $nis,
							'nisn' => $this->input->post('nisn'),
							'nama' => $nama,
							'jk' => $this->input->post('jk'),
							'alamat' => $this->input->post('alamat').", RT.".$this->input->post('rt')."/RW.".$this->input->post('rw').", ".$this->input->post('kec').", ".$this->input->post('kab').", ".$this->input->post('prov').". ".$this->input->post('pos'),
							'tp_lahir' => $this->input->post('tp_lahir'),
							'tgl_lahir' => $this->input->post('tgl_lahir'),
							'sekolah_asal' => $this->input->post('asal'),
							'th_masuk' => $this->input->post('th_masuk'),
							'foto' => $nmfile,
							'wali' => $this->input->post('wali'),
							'status' => $this->input->post('status'),
					 	);
					}else{
						$this->session->set_flashdata('error', 'FOTO bermasalah, Silahkan lengkapi data.');
						redirect(base_url().'admin/add_siswa','refresh');
					}
				}else{

					$data = array(
						'nis' => $nis,
						'nisn' => $this->input->post('nisn'),
						'nama' => $nama,
						'jk' => $this->input->post('jk'),
						'alamat' => $this->input->post('alamat').", RT.".$this->input->post('rt')."/RW.".$this->input->post('rw').", ".$this->input->post('kec').", ".$this->input->post('kab').", ".$this->input->post('prov').". ".$this->input->post('pos'),
						'tp_lahir' => $this->input->post('tp_lahir'),
						'tgl_lahir' => $this->input->post('tgl_lahir'),
						'sekolah_asal' => $this->input->post('asal'),
						'th_masuk' => $this->input->post('th_masuk'),
						'foto' => '',
						'wali' => $this->input->post('wali'),
						'status' => $this->input->post('status'),
				 	);
				}

				$kelas = array(
			 			'id' => '',
			 			'id_siswa' => $nis,
			 			'id_kelas' => $kls,
			 	);
			 	//print_r($data);
				//die;
		 		$this->mod_admin->simpan_siswa($data);
			 	$this->mod_admin->simpan_kelas($kelas);
		 		$this->session->set_flashdata('sukses', 'Data atas nama <b>'.$nama.'</b> berhasil ditambahkan ke database.');
				redirect(base_url().'admin/siswa','refresh');
			}
		}
	}

	public function hapus_siswa()
	{
		$nis = $this->uri->segment(3);
		$this->mod_admin->hapus_siswa($nis);
		$this->mod_admin->hapus_kelas($nis);
		if (!$this->mod_admin->hapus_siswa($nis)) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			redirect(base_url().'admin/siswa','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data Tidak ditemukan');
			redirect(base_url().'admin/siswa','refresh');
		}
	}

	public function edit_siswa()
	{
		$nis = $this->uri->segment(3);
		$data['menu'] = "Edit > Kelas";
		$data['dkelas'] = $this->mod_admin->get_kelas($nis)->row_array(); 
		$data['kelas'] = $this->mod_admin->load_kelas()->result();
		$data['detail'] = $this->mod_admin->where_siswa($nis)->row_array();
		$this->load->view('edit_siswa', $data, FALSE);
	}

	public function load_guru()
	{
		return $data = array('menu' => "Master > Guru",
				'data_guru' => $this->mod_admin->get_guru()->result(),
				'admin' => $this->mod_admin->get_admin()->result() , );
		
	}

	public function guru()
	{
		$data = $this->load_guru();
		$this->load->view('data_guru', $data, FALSE);
	}

	public function add_guru()
	{
		$data['menu'] = "Tambah > Data Guru/Admin";
		$this->load->view('add_guru', $data, FALSE);
	}

	public function acaknomor()
	{
		$angka =  mt_rand(1111, 9999);
		return $angka;
	}

	public function simpan_guru()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('uname', 'uname', 'required');
		$this->form_validation->set_rules('pw1', 'pw1', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data yang anda masukkan kurang lengkap, Silahkan ulangi lagi.');
			$data['menu'] = "Tambah > Data Guru/Admin";
			redirect(base_url().'admin/add_guru','refresh');
		} else {
			$nama = $this->input->post('nama');
			$uname = $this->input->post('uname');
			$passw = $this->input->post('pw1');
			$alamat = $this->input->post('alamat');
			$tipe  = $this->input->post('tipe');
			$id = $this->acaknomor();
			$data = array('id_guru' => $id,
						'username' =>$uname,
						'password' =>md5($passw),
						'login_type' => $tipe,
						'last_login' => $this->getDatetimeNow(),
						'status' => '0',
			);
			$data2 = array('id' => $id,
						'nama' => $nama,
						'alamat' => $alamat,
			);
			$this->mod_admin->simpan_guru($data2);
			$this->mod_admin->simpan_admin($data);
			$this->session->set_flashdata('sukses', 'Data atas nama <b>'.$nama.'</b> Berhasil ditambahkan.');
			redirect(base_url().'admin/guru','refresh');
		}
	}

	public function edit_guru()
	{
		$id = $this->uri->segment(3);
		$data = array('menu' => "EDIT > Data Guru",
				'data_guru' => $this->mod_admin->get_guru()->result(),
				'admin' => $this->mod_admin->get_admin()->result(),
				'dguru' => $this->mod_admin->where_guru($id)->row_array(),
				'dadmin' => $this->mod_admin->where_admin($id)->row_array(),
			);
		$this->load->view('edit_guru', $data, FALSE);
	}

	public function update_guru()
	{
		$id = $this->input->post('id');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('uname', 'uname', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data yang anda masukkan kurang lengkap, Silahkan ulangi lagi.');
			$data['menu'] = "Tambah > Data Guru/Admin";
			redirect(base_url().'admin/edit_guru/'.$id,'refresh');
		} else {
			$nama = $this->input->post('nama');
			$uname = $this->input->post('uname');
			$passw = $this->input->post('pw1');
			if ($passw = '') {
				$passw = md5($passw);
			} else{
				$passw = md5($this->input->post('pw2'));
			}
			$alamat = $this->input->post('alamat');
			$tipe  = $this->input->post('tipe');			
			$data = array(
						'username' =>$uname,
						'password' =>$passw,
						'login_type' => $tipe,
						'last_login' => $this->getDatetimeNow(),
						'status' => '0',
			);
			$data2 = array(
						'nama' => $nama,
						'alamat' => $alamat,
			);
			$this->mod_admin->update_guru($id, $data2);
			$this->mod_admin->update_admin($id, $data);
			$this->session->set_flashdata('sukses', 'Data atas nama <b>'.$nama.'</b> Berhasil diupdate.');
			redirect(base_url().'admin/guru','refresh');
		}
	}

	public function hapus_guru()
	{
		$id = $this->uri->segment(3);
		$this->mod_admin->hapus_guru($id);
		$this->mod_admin->hapus_admin($id);
		if (!$this->mod_admin->hapus_siswa($nis)) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			redirect(base_url().'admin/guru','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data Tidak ditemukan');
			redirect(base_url().'admin/guru','refresh');
		}
	}

	public function administrasi()
	{
		$data = array(
				'menu' => "Administrasi > Pembayaran" ,
				'tagihan' => $this->mod_admin->get_tagihan()->result(),
				'kelas' =>$this->mod_admin->load_kelas()->result(), 
		);
		
		$this->load->view('bayar', $data, FALSE);
	}

	public function add_tagihan()
	{
		$data = array(
				'menu' => 'Tambah > Pembayaran',
				'kelas' => $this->mod_admin->load_kelas()->result(),
		);
		$this->load->view('add_tagihan', $data, FALSE);
	}

	public function simpan_tagihan()
	{
		$this->form_validation->set_rules('jenis', 'jenis', 'required');
		$this->form_validation->set_rules('jml', 'jml', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Sialhkan masukkan Jenis Tagihan, serta nominal dengan benar.'); 
			redirect(base_url().'admin/add_tagihan','refresh');
		} else {
			if ($this->input->post('kl')=='0') {
				$kel = '0';
			}else{
				$kel = substr(implode(', ', $this->input->post('kelas')), 0);
			}
			$jenis = $this->input->post('jenis');
			$nom = $this->input->post('jml');
			$jt = $this->input->post('tempo');
			$kelas = $kel;
			$ket = $this->input->post('ket');
			$data = array(
					'id' => '',
					'jenis' => $jenis,
					'nominal' => $nom,
					'jatuh_tempo' => $jt,
					'kelas' => $kelas,
					'keterangan' => $ket,
			);
			$this->mod_admin->simpan_tagihan($data);
			$this->session->set_flashdata('sukses', 'Data tagihan dengan jenis <b>'.$jenis.'</b> berhasil ditambahkan.');
			redirect(base_url().'admin/administrasi','refresh');
		}
	}

	public function edit_tagihan()
	{
		$id = $this->uri->segment(3);
		$data = array('menu' => "EDIT > Data Pembayaran",
				'kelas' => $this->mod_admin->load_kelas()->result(),
				'detail' => $this->mod_admin->where_tagihan($id)->row_array(),
			);
		$this->load->view('edit_tagihan', $data, FALSE);

		//print_r($id);
		//die;
	}

	public function update_tagihan()
	{
		$id = $this->input->post('id');
		//print_r($id); die;
		$this->form_validation->set_rules('jenis', 'jenis', 'required');
		$this->form_validation->set_rules('jml', 'jml', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Sialhkan masukkan Jenis Tagihan, serta nominal dengan benar.'); 
			redirect(base_url().'admin/add_tagihan','refresh');
		} else {
			if ($this->input->post('kl')=='0') {
				$kel = '0';
			}else{
				$kel = substr(implode(', ', $this->input->post('kelas')), 0);
			}
			$jenis = $this->input->post('jenis');
			$nom = $this->input->post('jml');
			$jt = $this->input->post('tempo');
			$kelas = $kel;
			$ket = $this->input->post('ket');
			$data = array(
					'jenis' => $jenis,
					'nominal' => $nom,
					'jatuh_tempo' => $jt,
					'kelas' => $kelas,
					'keterangan' => $ket,
			);
			//print_r($data); die;
			$this->mod_admin->update_tagihan($id, $data);
			$this->session->set_flashdata('sukses', 'Data tagihan dengan jenis <b>'.$jenis.'</b> berhasil ditambahkan.');
			redirect(base_url().'admin/administrasi','refresh');
		}
	}

	public function hapus_tagihan()
	{
		$id = $this->uri->segment(3);
		$this->mod_admin->hapus_tagihan($id);
		$this->session->set_flashdata('sukses', 'Data Berhasil dihapus.');
		redirect(base_url().'admin/administrasi','refresh');
	}

	public function spp()
	{
		//$data =    //$this->data_siswa();
		$data = array(
				'menu' => "Pembayaran > Perawatan Lab",
				'kelas' => $this->mod_admin->load_kelas()->result(),
				'dkelas' => $this->mod_admin->data_kelas()->result(),
				'siswa' => $this->mod_admin->siswa_where()->result(),
			);
		$this->load->view('bayar_spp', $data, FALSE);
	}

	public function add_spp()
	{
		$id = $this->uri->segment(3);
		$data = array(
				'menu' => "BAYAR > Perawatan Lab",
				'kelas' => $this->mod_admin->load_kelas()->result(), 
				'siswa' => $this->mod_admin->where_siswa($id)->row_array(),
				'dkelas' => $this->mod_admin->get_kelas($id)->row_array(),
				'skr' => date('Y-m-d'),
				'spp' => $this->mod_admin->cari_spp($id)->result(),
				'jml_spp' => $this->mod_admin->hit_carispp($id),
			);
		//print_r($data); die;
		$this->load->view('add_spp', $data, FALSE);
	}

	public function simpan_spp()
	{
		$nis = $this->input->post('nis');
		$bulan = $this->input->post('by_b');
		if (!isset($bulan)) {
			$this->session->set_flashdata('error', 'Tidak ada data yang ditambahkan, silahkan pilih bulan pembayaran.');
			redirect(base_url().'admin/add_spp/'.$nis,'refresh');
		} else{
			$nama = $this->input->post('nama');
			$admin =$this->session->userdata('id_guru');
			$tgl = $this->input->post('tgl');
			$oleh = $this->input->post('oleh');
		
			foreach ($bulan as $bl) {
				$data = array(
						'nis' => $nis,
						'id_admin' => $admin,
						'tgl_bayar' => $tgl,
						'bulan' => $bl,
						'oleh' => $oleh,
				);
				$this->mod_admin->simpan_spp($data);
				$this->cetak();
			}
			$this->session->set_flashdata('sukses', 'Data Pembayaran SPP <b>'.$nama.' </b>berhasil ditambahkan.');
			redirect(base_url().'admin/add_spp','refresh');
		}
	}

	public function cetak()
	{
		$prin = $this->mod_admin->get_printer()->result();
		$text = '
		<p>
			<h2>SMK. THORIQUL ULUM PACET</h2>
			<br>
			<h3>Tahun Pelajaran 2018/2019</h3>
			<br>
			<br>
			<h4>BUKTI PEMBAYARAN SPP</h4>
			<hr>
			<br>
			<br>
			Bulan : xxx
			<br>
			Tgl. Bayar : xxx
			<br>
			<br>
			Bendahara,<br><br>
			xxx
		</p>';     
		/* tulis dan buka koneksi ke printer */    
		$printer = printer_open($prin['nilai']);
		print_r($printer); die;  
		/* write the text to the print job */  
		printer_write($printer, $text);   
		/* close the connection */ 
		printer_close($printer);
	}

	public function cari()
	{
		$id = $this->input->post('nani');
		if ($id=='') {
			redirect(base_url().'admin/spp/','refresh');
		}
		if (intval($id)<>0) {
			$hasil = $this->mod_admin->cari_nis($id)->result();
			//print_r($hasil); die;
			if ($hasil==0) {
				$this->session->set_flashdata('error', 'Data dengan NIS <b>'.$id.'</b> tidak ditemukan.');
				redirect(base_url().'admin/spp','refresh');
			}else{
				$data = array(
					'menu' => "Pembayaran > Perawatan Lab",
					'kelas' => $this->mod_admin->load_kelas()->result(),
					'dkelas' => $this->mod_admin->data_kelas()->result(),
					'siswa' => $hasil,
				);
				$this->load->view('bayar_spp', $data, FALSE);
			}
		}else{
			$hasil = $this->mod_admin->cari_nama($id)->result();
			if ($hasil==0) {
				$this->session->set_flashdata('error', 'Data dengan nama <b>'.$id.'</b> tidak ditemukan.');
				redirect(base_url().'admin/spp','refresh');
			}else{
				$data = array(
					'menu' => "Pembayaran > Perawatan Lab",
					'kelas' => $this->mod_admin->load_kelas()->result(),
					'dkelas' => $this->mod_admin->data_kelas()->result(),
					'siswa' => $hasil,
				);
				$this->load->view('bayar_spp', $data, FALSE);
			}
		}
		//print_r($id); die;
	}
	public function lain()
	{
		$id = $this->uri->segment(4);
		$kls = $this->uri->segment(3);
		$data = array(
				'menu' => "Pembayaran > Lain-Lain",
				'kelas' => $this->mod_admin->load_kelas()->result(),
				'siswa' => $this->mod_admin->where_siswa($id)->row_array(),
				'dkelas' => $this->mod_admin->get_kelas($id)->row_array(),
				'skr' => date('Y-m-d'),
				'spp' => $this->mod_admin->cari_spp($id)->result(),
				'jml_spp' => $this->mod_admin->hit_carispp($id),
				'tagihan' => $this->mod_admin->load_tag_where($kls)->result(),
				'bayar' => $this->mod_admin->load_bayar($id)->result(),
				'id' => $id,
			);
		//print_r($data['tagihan']); die;
		//$this->load->view('bayar_spp', $data, FALSE);
		$this->load->view('bayar_lain', $data, FALSE);
	}

	public function tambah_lain()
	{
		$id = $this->input->post('id');
		$pecah = explode("/", $this->input->post('jenis'));
		$user = $this->session->userdata('log');
		$id_tag = $pecah[0];//$this->input->post('jenis');
		$nis = $this->input->post('nis');
		$id_admin = strval($user['id_guru']);
		$tgl_bayar = $this->input->post('tgl');
		$jml = $pecah[1];
		$oleh = $this->input->post('oleh');
		$keterangan = '';
		$data = array(
			'id' =>'',
			'id_tagihan' => $id_tag,
			'nis' => $nis,
			'id_admin' => $id_admin,
			'tgl_bayar' => $tgl_bayar,
			'jml_bayar' => $jml,
			'oleh' => $oleh,
			'keterangan' => $keterangan,
		);
		//print_r($data); die;
		$this->mod_admin->save_temp($data);
		$this->session->set_flashdata('sukses', 'Data pembayaran telah disimpan, silahkan klik PRINT & SIMPAN, untuk menyimpan data.');
		redirect(base_url().'admin/lain/'.$id.'/'.$nis,'refresh');
	}

	

	public function setting()
	{
		$data['menu'] = "SETUP";
		$this->load->view('setup', $data, FALSE);
	}

	public function set_pr()
	{
		$nil = 6;
		$data = array( 'nilai' => $this->input->post('printers'), );
		//print_r($data); die;
		$this->db->where('id', $nil);
		$this->db->update('seting', $data);
		redirect(base_url().'admin/setting','refresh');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */