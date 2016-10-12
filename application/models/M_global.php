<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @copyright  (c) 2014-2016
 * @link       http://inorobo.com
 * @since      Version 1.4.7
 *
 * PERINGATAN :
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

class M_global extends CI_Model {

	public function __construct() {
		date_default_timezone_set('Asia/Jakarta');
	}

	/**
	 * find()
	 * Fungsi untuk mengambil record data
	 * @return array
	 */
	public function find($table, $field = '', $value = '', $order_by = '', $order_type = '') {
		if ($field != '' && $value != '') {
			$this->db->where($field, $value);
		}

		if ($order_by != '') {
			if ($order_type != '') {
				$this->db->order_by($order_by, $order_type);
			} else {
				$this->db->order_by($order_by, 'ASC');
			}
		}

		return $this->db->get($table);
	}

	/**
	 * save()
	 * Fungsi untuk menyimpan data kedalam tabel
	 * @return boolean
	 */
	public function save($table, $data) {
		return $this->db->insert($table, $data);
	}

	/**
	 * update()
	 * Fungsi untuk mengupdate record data dalam tabel
	 * @return boolean
	 */
	public function update($field, $value, $table, $data) {
		return $this->db->where($field, $value)->update($table, $data);
	}

	/**
	 * delete()
	 * Fungsi untuk menghapus record data dalam tabel
	 * @return boolean
	 */
	public function delete($field, $value, $table) {
		if (is_array($value)) {
			$this->db->where_in($field, $value);
		} else {
			$this->db->where($field, $value);
		}
		return $this->db->delete($table);
	}

	/**
	 * dropdown()
	 * Fungsi untuk membuat form dropdown
	 * @return array
	 */
	public function dropdown($key, $value, $table, $is_null = FALSE) {
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			if ($is_null != FALSE) {
				$data[NULL] = 'Pilih :';
			}
			foreach ($query->result() as $row) {
				$data[$row->$key] = $row->$value;
			}
			return $data;
		} 
		return [];
	}

	/**
	 * is_exist()
	 * Fungsi untuk mengecek ketersediaan record data
	 * @return boolean
	 */
	public function is_exist($field, $value, $table, $pk = '', $id = '') {
		$this->db->where($field, $value);
		if ($id != '') {
			$this->db->where($pk . ' != ', $id);
		}
		return $this->db->count_all_results($table) > 0 ? TRUE : FALSE;
	}

	/**
	 * Fungsi untuk menu recursive : TOP Navigasi
	 */
	public function get_parent_page($induk = 0) {
		$data = [];
		$this->db->from('posts');
		$this->db->where('post_parent', $induk);
		$this->db->where('post_type', 'page');
		$this->db->order_by('order_pages ASC, post_title ASC');
		$result = $this->db->get();
		foreach ($result->result() as $row) {
			$data[] = [
				'post_id' => $row->post_id,
				'post_title' => $row->post_title,
				'slug' => $row->slug,
				'child' => $this->get_parent_page($row->post_id),
			];
		}

		return $data;
	}

	/**
	 * Fungsi untuk table recursive : file category
	 */
	public function get_parent_table($induk = 0) {
		$data = [];
		$this->db->from('file_category');
		$this->db->where('parent', $induk);
		$this->db->order_by('category', 'ASC');
		$result = $this->db->get();
		foreach ($result->result() as $row) {
			$data[] = [
				'category_id' => $row->category_id,
				'category' => $row->category,
				'child' => $this->get_parent_table($row->category_id),
			];
		}

		return $data;
	}

	/*
	 * fungsi untuk membuat widget category
	 */
	public function widget_post_category() {
		return $this->db->query("
			SELECT p.category_id
				, c.category
				, COUNT(*) as jumlah
			FROM posts p
			LEFT JOIN category c ON c.category_id = p.category_id
			WHERE p.post_type = 'post'
			GROUP BY p.category_id
			ORDER BY c.category ASC
		");
	}

	/**
	 * Fungsi untuk widget arsip post
	 */
	public function widget_archive_posts() {
		return $this->db->query("
			SELECT SUBSTR(post_date, 6, 2) as kode
				, MONTHNAME(post_date) AS bulan,
				(SELECT COUNT(*) FROM posts WHERE MONTHNAME(post_date) = bulan AND post_type = 'post') AS jumlah
			FROM posts
			WHERE YEAR(post_date) = YEAR(CURDATE())
			AND post_type = 'post'
			GROUP BY 1,2
			ORDER BY SUBSTR(post_date, 6, 2)
		");
	}

	/**
	 * Fungsi untuk slide show berita, Tabs pengumuman, dan Tabs Sekilas Info
	 */
	public function posts($type = 'post') {
		return $this->db->query("
			SELECT p.*, u.display_name
			FROM posts p
			LEFT JOIN users u ON p.user_id = u.id
			WHERE p.post_type = '$type'
			ORDER BY p.post_id DESC
			LIMIT 5
		");
	}

	/**
	 * Fungsi untuk Tabs Agenda
	 */
	public function agenda() {
		return $this->db
			->order_by('mulai', 'DESC')
			->limit(5)
			->get('agenda');
	}

	public function get_kelas($kelas_id) {
		$query = $this->db
			->select('kelas')
			->where('kelas_id', $kelas_id)
			->get('kelas');
		if ($query->num_rows() == 1) {
			$res = $query->row();
			return $res->kelas;
		}
		return '';
	}

	public function get_jurusan($jurusan_id) {
		$query = $this->db
						->where('jurusan_id', $jurusan_id)
						->get('jurusan')
						->row_array();
		return $query['jurusan'];
	}

	public function per_bulan($tahun) {
		return $this->db->query("
			SELECT SUBSTR(tanggal_daftar, 6, 2) AS bulan,
			COUNT(no_daftar) AS jumlah
			FROM siswa
			WHERE tanggal_daftar != '0000-00-00'
			AND LEFT(tanggal_daftar, 4) = '$tahun'
			GROUP BY SUBSTR(tanggal_daftar, 6, 2)
			ORDER BY SUBSTR(tanggal_daftar, 6, 2) ASC
		");
	}

	public function per_jalur($tahun) {
		return $this->db->query("
			SELECT jalur_pendaftaran, COUNT(no_daftar) AS jumlah
			FROM view_siswa
			WHERE tanggal_daftar != '0000-00-00'
			AND LEFT(tanggal_daftar, 4) = '$tahun'
			GROUP BY jalur_pendaftaran
			ORDER BY jalur_pendaftaran ASC
		");
	}

	public function per_jurusan($tahun, $pilihan = 'pilihan_satu') {
		return $this->db->query("
			SELECT $pilihan, COUNT(no_daftar) AS jumlah
			FROM view_siswa
			WHERE tanggal_daftar != '0000-00-00'
			AND LEFT(tanggal_daftar, 4) = '$tahun'
			AND $pilihan IS NOT NULL
			GROUP BY $pilihan
			ORDER BY $pilihan ASC
		");
	}

	public function per_kelamin($tahun) {
		return $this->db->query("
			SELECT jenis_kelamin, COUNT(no_daftar) AS jumlah
			FROM siswa
			WHERE tanggal_daftar != '0000-00-00'
			AND LEFT(tanggal_daftar, 4) = '$tahun'
			GROUP BY jenis_kelamin
		");
	}

	public function per_sekolah($tahun) {
		return $this->db->query("
			SELECT sekolah_asal, COUNT(no_daftar) AS jumlah
			FROM siswa
			WHERE tanggal_daftar != '0000-00-00'
			AND LEFT(tanggal_daftar, 4) = '$tahun'
			GROUP BY sekolah_asal
		");
	}

	public function get_prestasi() {
		return $this->db->select('post_id, post_title, post_content, post_image, post_type')
			->where_in('post_type', array('prestasi_sekolah', 'prestasi_ptk', 'prestasi_siswa'))
			->order_by('post_id', 'DESC')
			->limit(10)
			->get('posts');
	}

	public function get_recent_photo() {
		return $this->db
			->select('photo_id, photo_title, photo_thumb, photo_original')
			->order_by('photo_id', 'DESC')
			->get('photo', 8);
	}

	public function get_kepala_sekolah() {
		$ptk_id = $this->setting['ptk_id'];
		return $this->db
			->select('nama, photo')
			->where('id', $ptk_id)
			->get('ptk')
			->row_array();
	}

	public function more_post() {
		return $this->db->query("
			SELECT p.post_id,
				p.post_date,
				p.post_title,
				c.category,
				p.post_content,
				p.post_image,
				p.slug
			FROM posts p
			LEFT JOIN category c ON c.category_id = p.category_id
			WHERE p.post_type = 'post'
			ORDER BY RAND()
			LIMIT 5
		");
	}

	public function get_recent_video() {
		return $this->db->limit(1)->get('video');
	}

	public function result_polling($pertanyaan_id) {
		return $this->db->query("
			SELECT x2.jawaban
				, COUNT(*) AS jumlah
			FROM view_polling x1
			LEFT JOIN jawaban x2 ON x1.jawaban_id = x2.jawaban_id
			WHERE x2.pertanyaan_id = '$pertanyaan_id'
			GROUP BY x1.jawaban_id
		");
	}

	/**
	 * Set Captcha
	 * @return String
	 */
	public function set_captcha() {
		create_dir('./assets/captcha/');
		$vals = [
			'word' => random_string('numeric', 5),
			'img_path' => './assets/captcha/',
			'img_url' => base_url() . 'assets/captcha/',
			'img_width' => 180,
			'img_height' => 60,
			'expiration' => 7200,
			'colors' => [
				'background' => [255, 255, 255],
				'border' => [0, 0, 0],
				'text' => [0, 0, 0],
				'grid' => [255, 255, 255],
			],
		];
		$cap = create_captcha($vals);
		$data = [
			'captcha_time' => $cap['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $cap['word'],
		];
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		return $cap;
	}

	public function is_valid_captcha($str) {
		$expiration = time() - 7200; // Two hour limit
		$this->db->where('captcha_time < ', $expiration)->delete('captcha');
		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		return $row->count > 0;
	}

	public function is_mail_exist($email, $table) {
		return $this->db->where('email', $email)->count_all_results($table) == 0;
	}

	public function no_daftar($year) {
		$query = $this->db->query("
				SELECT MAX(RIGHT(no_daftar, 5)) AS max_number
				FROM siswa
				WHERE status_siswa = 'baru'
				AND left(no_daftar, 4) = '$year'
			");

		$no_daftar = "";
		if ($query->num_rows() == 1) {
			$data = $query->row();
			$number = ((int) $data->max_number) + 1;
			$no_daftar = sprintf("%05s", $number);
		} else {
			$no_daftar = "00001";
		}
		return $year . $no_daftar;
	}

   public function get_options() {
      $query = $this->db->select('variable, value')->get('options');
      $options = [];
      foreach($query->result() as $row) {
      	$options[$row->variable] = $row->value;
      }
      return $options;
   }
}