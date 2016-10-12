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

class Encrypt_url {

   private $key = 'afe1c513226e0d438f844a65adceaeb3';

   private function safe_base64_encode($string) {
      $data = base64_encode($string);
      $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
      return $data;
   }

   private function safe_base64_decode($string) {
      $data = str_replace(array('-', '_'), array('+', '/'), $string);
      $mod4 = strlen($data) % 4;
      if ($mod4) {
         $data .= substr('====', $mod4);
      }
      return base64_decode($data);
   }

   public function encode($value) {
      if (!$value) {
         return FALSE;
      }
      $text = $value;
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $crypt_text = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $text, MCRYPT_MODE_ECB, $iv);
      return trim($this->safe_base64_encode($crypt_text));
   }

   public function decode($value) {
      if (!$value) {
         return FALSE;
      }
      $crypt_text = $this->safe_base64_decode($value);
      $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
      $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
      $decrypt_text = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $crypt_text, MCRYPT_MODE_ECB, $iv);
      return trim($decrypt_text);
   }
}