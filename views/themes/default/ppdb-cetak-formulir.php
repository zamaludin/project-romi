<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'third_party/tcpdf/tcpdf.php';
class pdf extends tcpdf {
    public function Header(){}
    public function Footer(){}
}

$pdf = new pdf('P', 'Cm', 'A4', true, 'UTF-8', false);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, 1);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetTitle('PENERIMAAN PESERTA DIDIK BARU TAHUN '.$this->setting['ppdb_tahun']);
$pdf->SetAuthor('http://facebook.com/antonsofyan');
$pdf->SetSubject($this->setting['nama_sekolah']);
$pdf->SetKeywords($this->setting['nama_sekolah']);
$pdf->SetCreator('http://facebook.com/antonsofyan');
$pdf->AddPage();
$pdf->SetFont('freesans', '', 10);

if (file_exists('.assets/'.$this->setting['logo']))
{
  $pdf->Image('./assets/'.$this->setting['logo'], 2, '', 2.5, 2.5);
}
else
{
  $pdf->Image('./assets/logo-sekolah.jpg', 2, '', 2.5, 2.5);
}


if (file_exists('.assets/siswa/'.$query['photo']))
{
  $pdf->Image('./assets/siswa/'.$query['photo'], 17, 4.5, 3, '');
}
else
{
  $pdf->Image('./assets/user.jpg', 17, 4.5, 3, '');
}

$content ='
<table align="left" width="100%" cellpadding="0" style="border-bottom:1px solid black;">
  <tr>
    <td width="20%" rowspan="6" style="color:#fff;">&nbsp;</td>
    <td width="80%" align="center"><h3>FORMULIR PENERIMAAN PESERTA DIDIK BARU</h3></td>
  </tr>
  <tr>
    <td align="center"><h3>'.strtoupper($this->setting['nama_sekolah']).'</h3></td>
  </tr>
  <tr>
    <td align="center"><h3>TAHUN '.strtoupper($this->setting['ppdb_tahun']).'</h3></td>
  </tr>
  <tr>
    <td align="center">Alamat : '.$this->setting['alamat'].' Telp : '.$this->setting['telp'].'</td>
  </tr>
  <tr>
    <td align="center">Email : '.$this->setting['email'].' - Website : '.$this->setting['website'].'</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<table align="left" width="100%" border="0" cellpadding="3">
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td width="30%" align="left">Nomor Pendaftaran</td>
    <td width="3%">:</td>
    <td width="67%" align="left">'.$query['nisn'].'</td>
  </tr>
  <tr>
    <td>Tanggal Pendaftaran</td>
    <td>:</td>
    <td>'.indo_date($query['tanggal_daftar']).'</td>
  </tr>
  <tr>
    <td>Jalur Pendaftaran</td>
    <td>:</td>
    <td>'.$query['jalur_pendaftaran'].'</td>
  </tr>
  <tr>
    <td>Pilihan I</td>
    <td>:</td>
    <td>'.$query['pilihan_satu'].'</td>
  </tr>
  <tr>
    <td>Pilihan II</td>
    <td>:</td>
    <td>'.$query['pilihan_dua'].'</td>
  </tr>
  <tr>
    <td>Tanggal Pendaftaran</td>
    <td>:</td>
    <td>'.indo_date($query['tanggal_daftar']).'</td>
  </tr>
  <tr>
    <td>Nama Peserta Didik</td>
    <td>:</td>
    <td>'.$query['nama'].'</td>
  </tr>
  <tr>
    <td align="left">Tempat, Tanggal Lahir</td>
    <td>:</td>
    <td align="left">'.$query['tempat_lahir'].', '.indo_date($query['tanggal_lahir']).'</td>
  </tr>

  <tr>
    <td align="left">Jenis Kelamin</td>
    <td>:</td>
    <td align="left">'.$query['jenis_kelamin'].'</td>
  </tr>

  <tr>
    <td align="left">Agama</td>
    <td>:</td>
    <td align="left">'.$query['agama'].'</td>
  </tr>

  <tr>
    <td align="left">Status dalam Keluarga</td>
    <td>:</td>
    <td align="left">'.$query['status_anak'].'</td>
  </tr>

  <tr>
    <td align="left">Anak ke</td>
    <td>:</td>
    <td align="left">'.$query['anak_ke'].'</td>
  </tr>

  <tr>
    <td align="left">Alamat</td>
    <td>:</td>
    <td align="left">'.$query['alamat'].'</td>
  </tr>

  <tr>
    <td align="left">Nomor Telepon</td>
    <td>:</td>
    <td align="left">'.$query['telp_rumah'].'</td>
  </tr>

  <tr>
    <td align="left">Sekolah Asal</td>
    <td>:</td>
    <td align="left">'.$query['sekolah_asal'].'</td>
  </tr>

  <tr>
    <td align="left">Nama Ayah</td>
    <td>:</td>
    <td align="left">'.$query['ayah'].'</td>
  </tr>

  <tr>
    <td align="left">Nama Ibu</td>
    <td>:</td>
    <td align="left">'.$query['ibu'].'</td>
  </tr>

  <tr>
    <td align="left">Alamat Orang Tua</td>
    <td>:</td>
    <td align="left">'.$query['alamat_ortu'].'</td>
  </tr>

  <tr>
    <td align="left">Nomor Telepon Orang Tua</td>
    <td>:</td>
    <td align="left">'.$query['telp_ortu'].'</td>
  </tr>

  <tr>
    <td align="left">Pekerjaan Ayah</td>
    <td>:</td>
    <td align="left">'.$query['pekerjaan_ayah'].'</td>
  </tr>

  <tr>
    <td align="left">Pekerjaan Ibu</td>
    <td>:</td>
    <td align="left">'.$query['pekerjaan_ibu'].'</td>
  </tr>

  <tr>
    <td align="left">Nama Wali</td>
    <td>:</td>
    <td align="left">'.$query['nama_wali'].'</td>
  </tr>

  <tr>
    <td align="left">Alamat Wali</td>
    <td>:</td>
    <td align="left">'.$query['alamat_wali'].'</td>
  </tr>

  <tr>
    <td align="left">Nomor Telepon Wali</td>
    <td>:</td>
    <td align="left">'.$query['telp_wali'].'</td>
  </tr>

  <tr>
    <td align="left">Pekerjaan Wali</td>
    <td>:</td>
    <td align="left">'.$query['pekerjaan_wali'].'</td>
  </tr>
</table>';
$pdf->writeHTML($content, true, false, true, false, 'C');
$footer = '
<br><br>
<table border="0" width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td align="center" width="50%">&nbsp;<br>Calon Siswa Baru,</td>
        <td align="center">
            '.$this->setting['kabupaten'].', '.indo_date(date('Y-m-d')).'
            <br>
            Panitia PPDB,
        </td>
    </tr>
    <tr>
        <td align="center"><br><br><br><br>'.$query['nama'].'</td>
        <td align="center"><br><br><br><br>......................................</td>
    </tr>
</table>';
$pdf->writeHTML($footer, true, false, true, false, 'C');
$style = array(
          'position' => '',
          'align' => 'C',
          'stretch' => false,
          'fitwidth' => true,
          'cellfitalign' => '',
          'border' => true,
          'hpadding' => 'auto',
          'vpadding' => 'auto',
          'fgcolor' => array(0,0,0),
          'bgcolor' => false, //array(255,255,255),
          'text' => true,
          'font' => 'helvetica',
          'fontsize' => 8,
          'stretchtext' => 4
        );
$pdf->write1DBarcode($query['nisn'], 'C39', 7.75, 26, 6, 2, 0.4, $style, 'M');
$pdf->Output($query['nisn'].'.pdf', 'I');?>