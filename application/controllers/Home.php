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

class Home extends MY_Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->data['home'] = true;
      $this->data['pengumuman'] = $this->m_global->posts('pengumuman');
      $this->data['more_post'] = $this->m_global->more_post();
      $this->data['video'] = $this->m_global->get_recent_video();
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/home';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function readmore() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $id = $this->uri->segment(3);
      if ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['query'] = $this->db
            ->where('p.post_id', $id)
            ->join('users u', 'p.user_id = u.id', 'LEFT')
            ->get('posts p')
            ->row_array();
         $this->db->where('post_id', $id)->update('posts', ['counter' => ($this->data['query']['counter'] + 1)]);
         if ($this->data['query']['post_type'] == 'pengumuman') {
            $this->data['home'] = true;
            $this->data['title'] = 'PENGUMUMAN';
            $this->data['indeks'] = site_url('home/pengumuman');
            $this->data['more'] = $this->db
               ->select('post_id, post_title, slug')
               ->where('post_type', 'pengumuman')
               ->where('post_id !=', $id)
               ->order_by('post_date', 'DESC')
               ->limit(10)
               ->get('posts');
         } else if ($this->data['query']['post_type'] == 'page') {
            $this->data['page'] = true;
            $this->data['title'] = 'HALAMAN';
            $this->data['more'] = $this->db
               ->select('post_id, post_title, slug')
               ->where('post_type', 'page')
               ->where('post_id !=', $id)
               ->order_by('post_title', 'ASC')
               ->get('posts');
         } else if ($this->data['query']['post_type'] == 'post') {
            $this->data['home'] = true;
            $this->data['title'] = 'BERITA';
            $this->data['indeks'] = site_url('home/post');
            $this->data['more'] = $this->db
               ->select('post_id, post_title, slug')
               ->where('post_type', 'post')
               ->where('post_id !=', $id)
               ->order_by('post_date', 'DESC')
               ->limit(10)
               ->get('posts');
         } else if ($this->data['query']['post_type'] == 'sekilas_info') {
            $this->data['home'] = true;
            $this->data['title'] = 'SEKILAS INFO';
            $this->data['indeks'] = site_url('home/sekilas_info');
            $this->data['more'] = $this->db
               ->select('post_id, post_title, slug')
               ->where('post_type', 'sekilas_info')
               ->where('post_id !=', $id)
               ->order_by('post_date', 'DESC')
               ->limit(10)
               ->get('posts');
         }

         $this->data['site_title'] = $this->data['query']['post_title'] . ' | ' . $this->data['site_title'];
         $this->data['meta_description'] = $this->data['query']['post_title'];
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/readmore';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect('home');
      }
   }

   public function pengumuman() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/pengumuman');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->where('post_type', 'pengumuman')->count_all_results('posts');
      $config['per_page'] = 10;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'INDEKS PENGUMUMAN';
      $this->data['home'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->select('p.*, u.display_name')
         ->where('post_type', 'pengumuman')
         ->join('users u', 'p.user_id = u.id', 'LEFT')
         ->order_by('p.post_date', 'DESC')
         ->get('posts p', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-post';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function sekilas_info() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/sekilas_info');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->where('post_type', 'sekilas_info')->count_all_results('posts');
      $config['per_page'] = 10;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'INDEKS SEKILAS INFO';
      $this->data['home'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->select('p.*, u.display_name')
         ->where('post_type', 'sekilas_info')
         ->join('users u', 'p.user_id = u.id', 'LEFT')
         ->get('posts p', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-post';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function post() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/post');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->where('post_type', 'post')->count_all_results('posts');
      $config['per_page'] = 5;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'INDEKS BERITA';
      $this->data['home'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->select('p.*, u.display_name')
         ->where('post_type', 'post')
         ->join('users u', 'p.user_id = u.id', 'LEFT')
         ->get('posts p', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-post';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function category() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $category_id = $this->uri->segment(3);
      if($category_id && $category_id != 0 && ctype_digit((string) $category_id)) {
         $this->load->library('pagination');
         $config['base_url'] = site_url('home/category/' . $category_id);
         $config['uri_segment'] = 4;
         $config['total_rows'] = $this->db
            ->where('post_type', 'post')
            ->where('category_id', $category_id)
            ->count_all_results('posts');
         $config['per_page'] = 10;
         $config['prev_link'] = 'Prev';
         $config['next_link'] = 'Next';
         $config['prev_tag_open'] = '<li>';
         $config['prev_tag_close'] = '</li>';
         $config['next_tag_open'] = '<li>';
         $config['next_tag_close'] = '</li>';
         $config['first_link'] = '&laquo;';
         $config['last_link'] = '&raquo;';
         $config['first_tag_open'] = '<li>';
         $config['first_tag_close'] = '</li>';
         $config['last_tag_open'] = '<li>';
         $config['last_tag_close'] = '</li>';
         $config['num_tag_open'] = '<li>';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = '<li class="active"><a>';
         $config['cur_tag_close'] = '</a></li>';
         $this->pagination->initialize($config);
         $this->data['pagination'] = $this->pagination->create_links();
         $this->data['total_rows'] = $config['total_rows'];
         $title = $this->m_global->find('category', 'category_id', $category_id)->row_array();
         $this->data['title'] = strtoupper($title['category']);
         $this->data['home'] = true;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->db
            ->select('p.*, u.display_name')
            ->where('p.post_type', 'post')
            ->where('p.category_id', $category_id)
            ->join('users u', 'p.user_id = u.id', 'LEFT')
            ->order_by('p.post_date', 'DESC')
            ->get('posts p', $config['per_page'], $this->uri->segment(4));
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-post';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         redirect(base_url());
      }         
   }

   public function archive() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $bulan = $this->uri->segment(3);
      $tahun = $this->uri->segment(4);
      $this->load->library('pagination');
      $config['base_url'] = site_url('home/archive/' . $bulan . '/' . $tahun);
      $config['uri_segment'] = 5;
      $config['total_rows'] = $this->db
         ->where('post_type', 'post')
         ->where('SUBSTR(post_date, 1, 7) = ', $tahun . '-' . $bulan)
         ->count_all_results('posts');
      $config['per_page'] = 10;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = strtoupper('ARSIP BULAN ' . bulan($bulan) . ' ' . $tahun);
      $this->data['home'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->select('p.*, u.display_name')
         ->where('p.post_type', 'post')
         ->where('SUBSTR(p.post_date, 1, 7) = ', $tahun . '-' . $bulan)
         ->join('users u', 'p.user_id = u.id', 'LEFT')
         ->order_by('p.post_date', 'DESC')
         ->get('posts p', $config['per_page'], $this->uri->segment(5));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-post';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function video() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/video');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->count_all_results('video');
      $config['per_page'] = 1;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'GALLERY VIDEO';
      $this->data['gallery'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db->get('video', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-video';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function album() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/album');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->query("
      	SELECT p.album_id, a.album, COUNT(*) AS jumlah
		   FROM photo p
		   LEFT JOIN album a ON a.album_id = p.album_id
		   GROUP BY p.album_id
	   ")->num_rows();
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'ALBUM PHOTO';
      $this->data['gallery'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->select('p.album_id, a.album, COUNT(*) AS jumlah')
         ->join('album a', 'p.album_id = a.album_id', 'LEFT')
         ->group_by('p.album_id')
         ->get('photo p', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-album';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function photo() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $album_id = $this->uri->segment(3);
      if ($album_id) {
         $album = $this->m_global->find('album', 'album_id', $album_id)->row_array();
         $this->data['title'] = $album['album'];
         $this->data['gallery'] = true;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->db->where('album_id', $album_id)->get('photo');
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-photo';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect('home');
      }
   }

   public function why_robotic() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->data['home'] = true;
      $this->data['title'] = 'Mengapa Harus Robotic?';
      $ptk_id = $this->setting['ptk_id'];
      $this->data['kepsek'] = $this->db
         ->select('nama, photo')
         ->where('id', $ptk_id)
         ->get('ptk')
         ->row_array();
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/why_robotic';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function files() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $category_id = $this->uri->segment(3);
      if ($category_id) {
         $this->load->library('pagination');
         $config['base_url'] = site_url('home/files/' . $category_id);
         $config['uri_segment'] = 4;
         $config['total_rows'] = $this->db->where('category_id', $category_id)->count_all_results('file');
         $config['per_page'] = 10;
         $config['prev_link'] = 'Prev';
         $config['next_link'] = 'Next';
         $config['prev_tag_open'] = '<li>';
         $config['prev_tag_close'] = '</li>';
         $config['next_tag_open'] = '<li>';
         $config['next_tag_close'] = '</li>';
         $config['first_link'] = '&laquo;';
         $config['last_link'] = '&raquo;';
         $config['first_tag_open'] = '<li>';
         $config['first_tag_close'] = '</li>';
         $config['last_tag_open'] = '<li>';
         $config['last_tag_close'] = '</li>';
         $config['num_tag_open'] = '<li>';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = '<li class="active"><a>';
         $config['cur_tag_close'] = '</a></li>';
         $this->pagination->initialize($config);
         $this->data['pagination'] = $this->pagination->create_links();
         $this->data['total_rows'] = $config['total_rows'];
         $sub_category = $this->m_global->find('file_category', 'category_id', $category_id)->row_array();
         $category = $this->m_global->find('file_category', 'category_id', $sub_category['parent'])->row_array();
         $this->data['title'] = $sub_category['parent'] != 0 ? strtoupper($category['category'] . ' ' . $sub_category['category']) : $sub_category['category'];
         $this->data['berkas'] = true;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->db
            ->where('category_id', $category_id)
            ->get('file', $config['per_page'], $this->uri->segment(4));
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-file';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         redirect(base_url());
      }
   }

   public function download_file() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $id = $this->uri->segment(3);
      if (!$id) {
         redirect(base_url());
      } else {
         $this->load->helper(array('download', 'text'));
         $file = $this->m_global->find('file', 'id', $id)->row_array();
         $data = file_get_contents("./assets/berkas/" . $file['file']);
         $name = url_title($file['title'], '-') . $file['type'];
         $this->db->query("UPDATE file SET counter = counter + 1 WHERE id = '$id'");
         force_download($name, $data);
      }
   }

   public function rss() {
      $this->load->helper(['xml', 'text']);
      $data = [
         'encoding' => 'utf-8',
         'feed_name' => $this->setting['nama_sekolah'],
         'feed_url' => base_url() . 'home/rss',
         'page_description' => 'Website resmi ' . $this->setting['nama_sekolah'],
         'page_language' => 'en-ca',
         'creator_email' => $this->setting['email'],
         'posts' => $this->db
            ->where('post_type', 'post')
            ->limit(10)
            ->order_by('post_date', 'DESC')
            ->get('posts'),
      ];
      header("Content-Type: application/rss+xml");
      $this->load->view('themes/' . $this->setting['themes'] . '/rss', $data);
   }

   public function hubungi_kami() {
      $this->load->helper(['captcha', 'string']);
      if ($_POST) {
         if ($this->validation()) {
            echo $this->db->insert('hubungi_kami', $this->field_data()) ? 1 : 0;
         } else {
            echo 0;
         }
      } else {
         $this->data['title'] = 'HUBUNGI KAMI';
         $this->data['action'] = site_url(uri_string());
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['contact'] = true;
         $this->data['google_map'] = $this->setting['google_map'];
         $this->data['captcha'] = $this->m_global->set_captcha();
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/hubungi_kami';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      }
   }

   public function agenda_sekolah() {
      $this->data['title'] = 'AGENDA SEKOLAH';
      $this->data['action'] = site_url(uri_string());
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['event'] = true;
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/agenda';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function get_agenda_sekolah() {
      $start = $this->input->get("start");
      $end = $this->input->get("end");
      $query = $this->db->query("
         SELECT post_title AS title
            , post_date AS `start`
         FROM posts
         WHERE post_type='agenda'
         AND post_date BETWEEN '$start' AND '$end'
      ");
      $data = [];
      foreach ($query->result() as $row) {
            $data[] = [
               'title' => $row->title,
               'start' => $row->start
            ];
      }
      echo json_encode($data);
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('url', 'URL', 'trim');
      $this->form_validation->set_rules('pertanyaan', 'Pesan', 'trim|required');
      $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
      $this->form_validation->set_message('required', '%s harus diisi');
      $this->form_validation->set_message('valid_email', 'Format email salah');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   /*
    * Direktori PTK
    */
   public function ptk() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/ptk');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->count_all_results('ptk');
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'PENDIDIK DAN TENAGA KEPENDIDIKAN ' . strtoupper($this->setting['nama_sekolah']);
      $this->data['direktori'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db->get('ptk', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-ptk';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   /* fungsi-fungsi direktori alumni mulai dari sini */
   public function alumni() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/alumni');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db
         ->where('status_siswa', 'lulus')
         ->count_all_results('siswa');
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'ALUMNI ' . strtoupper($this->setting['nama_sekolah']);
      $this->data['direktori'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['tahun_lulus'] = $this->db->query("
      	SELECT tahun_lulus
		   FROM siswa
		   WHERE tahun_lulus IS NOT NULL
		   GROUP BY tahun_lulus
		   ORDER BY tahun_lulus DESC
	   ");
      $this->data['query'] = $this->db
         ->where('status_siswa', 'lulus')
         ->get('siswa', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-alumni';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function redirect_tahun_lulus() {
      redirect('home/tahun_lulus/' . $this->input->post('tahun_lulus'));
   }

   public function tahun_lulus() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $tahun_lulus = $this->uri->segment(3);
      if ($tahun_lulus) {
         $this->load->library('pagination');
         $config['base_url'] = site_url('home/tahun_lulus/' . $tahun_lulus);
         $config['uri_segment'] = 4;
         $config['total_rows'] = $this->db
            ->where('status_siswa', 'lulus')
            ->where('tahun_lulus', $tahun_lulus)
            ->count_all_results('siswa');
         $config['per_page'] = 20;
         $config['prev_link'] = 'Prev';
         $config['next_link'] = 'Next';
         $config['prev_tag_open'] = '<li>';
         $config['prev_tag_close'] = '</li>';
         $config['next_tag_open'] = '<li>';
         $config['next_tag_close'] = '</li>';
         $config['first_link'] = '&laquo;';
         $config['last_link'] = '&raquo;';
         $config['first_tag_open'] = '<li>';
         $config['first_tag_close'] = '</li>';
         $config['last_tag_open'] = '<li>';
         $config['last_tag_close'] = '</li>';
         $config['num_tag_open'] = '<li>';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = '<li class="active"><a>';
         $config['cur_tag_close'] = '</a></li>';
         $this->pagination->initialize($config);
         $this->data['pagination'] = $this->pagination->create_links();
         $this->data['total_rows'] = $config['total_rows'];
         $this->data['title'] = 'ALUMNI ' . strtoupper($this->setting['nama_sekolah']) . ' TAHUN ' . $tahun_lulus;
         $this->data['direktori'] = true;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['tahun_lulus'] = $this->db->query("
         	SELECT tahun_lulus
			   FROM siswa
			   WHERE tahun_lulus IS NOT NULL
			   GROUP BY tahun_lulus
			   ORDER BY tahun_lulus DESC
		   ");
         $this->data['query'] = $this->db
            ->where('status_siswa', 'lulus')
            ->where('tahun_lulus', $tahun_lulus)
            ->get('siswa', $config['per_page'], $this->uri->segment(4));
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-alumni';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         redirect('home/alumni');
      }
   }

   /* fungsi-fungsi direktori Alumni selesai disini */

   /* fungsi-fungsi direktori Siswa mulai dari sini */
   public function siswa() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/siswa');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db
         ->where('status_siswa', 'aktif')
         ->count_all_results('siswa');
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'SISWA ' . strtoupper($this->setting['nama_sekolah']);
      $this->data['direktori'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['q_kelas'] = $this->db->get('view_kelas');
      $this->data['query'] = $this->db
         ->where('status_siswa', 'aktif')
         ->get('view_siswa', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-siswa';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function redirect_kelas() {
      redirect('home/kelas/' . $this->input->post('kelas_id'));
   }

   public function kelas() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $kelas_id = $this->uri->segment(3);
      if ($kelas_id) {
         $this->load->library('pagination');
         $config['base_url'] = site_url('home/kelas/' . $kelas_id);
         $config['uri_segment'] = 4;
         $config['total_rows'] = $this->db
            ->where('status_siswa', 'aktif')
            ->where('kelas_id', $kelas_id)
            ->count_all_results('siswa');
         $config['per_page'] = 20;
         $config['prev_link'] = 'Prev';
         $config['next_link'] = 'Next';
         $config['prev_tag_open'] = '<li>';
         $config['prev_tag_close'] = '</li>';
         $config['next_tag_open'] = '<li>';
         $config['next_tag_close'] = '</li>';
         $config['first_link'] = '&laquo;';
         $config['last_link'] = '&raquo;';
         $config['first_tag_open'] = '<li>';
         $config['first_tag_close'] = '</li>';
         $config['last_tag_open'] = '<li>';
         $config['last_tag_close'] = '</li>';
         $config['num_tag_open'] = '<li>';
         $config['num_tag_close'] = '</li>';
         $config['cur_tag_open'] = '<li class="active"><a>';
         $config['cur_tag_close'] = '</a></li>';
         $this->pagination->initialize($config);
         $this->data['pagination'] = $this->pagination->create_links();
         $this->data['total_rows'] = $config['total_rows'];
         $this->data['title'] = 'SISWA KELAS ' . $this->m_global->get_kelas($kelas_id) . ' ' . strtoupper($this->setting['nama_sekolah']);
         $this->data['direktori'] = true;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['q_kelas'] = $this->db->get('view_kelas');
         $this->data['query'] = $this->db
            ->where('status_siswa', 'aktif')
            ->where('kelas_id', $kelas_id)
            ->get('view_siswa', $config['per_page'], $this->uri->segment(4));
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-siswa';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         redirect('home/siswa');
      }
   }

   /* fungsi-fungsi direktori siswa selesai disini */

   /* Direktori Prestasi Sekolah */
   public function prestasi_sekolah() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/prestasi_sekolah');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db
         ->where('post_type', 'prestasi_sekolah')
         ->count_all_results('posts');
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'PRESTASI SEKOLAH';
      $this->data['direktori'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->where('post_type', 'prestasi_sekolah')
         ->get('posts', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-prestasi';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   /* Direktori Prestasi PTK */
   public function prestasi_ptk() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/prestasi_ptk');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->where('post_type', 'prestasi_ptk')->count_all_results('posts');
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'PRESTASI PENDIDIK DAN TENAGA KEPENDIDIKAN';
      $this->data['direktori'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->where('post_type', 'prestasi_ptk')
         ->get('posts', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-prestasi';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   /* Direktori Prestasi Siswa */
   public function prestasi_siswa() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->load->library('pagination');
      $config['base_url'] = site_url('home/prestasi_siswa');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db
         ->where('post_type', 'prestasi_siswa')
         ->count_all_results('posts');
      $config['per_page'] = 20;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'PRESTASI SISWA';
      $this->data['direktori'] = true;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->where('post_type', 'prestasi_siswa')
         ->get('posts', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/loop-prestasi';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function peta_situs() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $this->data['title'] = 'PETA SITUS';
      $this->data['pages'] = $this->db->select('post_id, post_title')->where('post_type', 'page')->get('posts');
      $this->data['files'] = $this->db->where('parent', 0)->get('file_category');
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/peta-situs';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   private function field_data() {
      $this->load->helper('text');
      $disallowed = explode(',', $this->setting['word_filter']);
      return [
         'nama' => $this->input->post('nama', true),
         'email' => $this->input->post('email', true),
         'url' => $this->input->post('url', true),
         'tanggal' => date('Y-m-d H:i:s'),
         'pertanyaan' => word_censor($this->input->post('pertanyaan', true), $disallowed, '##########'),
         'ip_address' => $this->input->ip_address(),
      ];
   }

   /**
    * captcha validation
    * @return boolean
    */
   public function valid_captcha($str) {
      if ($this->m_global->is_valid_captcha($str)) {
         return true;
      }
      $this->form_validation->set_message('valid_captcha', 'Kode Keamanan tidak valid.');
      return false;
   }

   public function polling() {
      $jawaban_id = $this->input->post('jawaban_id');
      $ip_address = $this->input->ip_address();
      $pertanyaan = $this->db->query("
      	SELECT pertanyaan_id FROM jawaban
			WHERE jawaban_id = '$jawaban_id'
			GROUP BY jawaban_id
		")->row_array();
      $check = $this->db
         ->where('pertanyaan_id', $pertanyaan['pertanyaan_id'])
         ->where('ip_address', $ip_address)
         ->where('tanggal', date('Y-m-d'))
         ->count_all_results('view_polling');
      if ($check == 0) {
         $field_data = [
            'jawaban_id' => $jawaban_id,
            'tanggal' => date('Y-m-d'),
            'ip_address' => $ip_address,
         ];
         echo $this->db->insert('polling', $field_data) ? 1 : 0; // 1 : sukses, 0 : gagal
      } else {
         echo 2; // exist
      }
   }

   public function result_polling() {
      if ($this->setting['cache_file'] == 'y') {
         $this->output->cache(5);
      }

      $query = $this->m_global->find('pertanyaan', 'status', 'y')->row_array();
      $this->data['title'] = 'HASIL POLLING';
      $this->data['query'] = $this->m_global->result_polling($query['pertanyaan_id']);
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/result-polling';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */