<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pw extends CI_Controller {
    
    public function index(){
        // $pwhash = '2y$10$i2vk0ihGnLk6KoGcNShp9ujY13Y0Q.ZIvf7NuSx9CwhasIDC3mzkS';
        // if(password_verify('iwayriway', $pwhash)){
        //     var_dump("MASUK");
        // } else {
        //     var_dump("GAGAL WAY");
        // }
        $array = [];

        $jmlsoal = $this->db->query("SELECT kode_soal from data_soal_equest where id_pembuat_equest = '220' order by kode_soal ASC")->result_array();
        //  var_dump($jmlsoal); //die;
         echo '<br>';
         foreach($jmlsoal as $jb => $dr){
            //  var_dump($dr['kode_soal']);
            Array_push($array, $dr['kode_soal']);
         }
        // echo $array;
        var_dump(count($array));
        $cr = "R06";
        var_dump(array_search($cr, $array)); die;

        // $kendaraan 	= ['Mobil', 'Motor', 'Sepeda', 'Truk', 'Bus'];
        // $mobil 		= ['merk' => 'Toyota', 'type' => 'Vios', 'year' => 2016];
        // $key = array_search('Vios', $mobil); // type
        // // $key = array_search('Sepeda', $kendaraan);
        // var_dump($key);

    }

    public function array1(){
        $soal = "R03";
        $array = [];
        $array1 = [];
        $jmlsoal = $this->db->query("SELECT ket_soal from data_pg_equest where id_soal_equest = 67 order by id_pg_equest ASC")->result_array();

        foreach($jmlsoal as $jb => $dr){
            if($dr['ket_soal']!=""){
                Array_push($array, $dr['ket_soal']);
            }
        }

        $tampil = count($array);
        
        // var_dump($tampil);
        // echo "<br>";
        // echo "<br>";
        // var_dump($array[$tampil-1]);
        // echo "<br>";
        // echo "<br>";
        if($tampil != 0){
            $arrayt = $array[$tampil-1];
            $query = "SELECT * FROM `data_soal_equest` WHERE kode_soal BETWEEN '$soal' AND '$arrayt' and kode_soal != '$soal'";
            for($i = 0; $i<$tampil; $i++){
                $query .= " AND kode_soal != '$array[$i]'";
            }
            // var_dump($query);
            $coba = $this->db->query($query)->row_array();
        } else {
            $coba = $this->db->query("SELECT * from data_soal_equest where kode_soal = (select min(kode_soal) from data_soal_equest where kode_soal > '$soal')")->row_array();
        }
        echo "<br>";
        echo "<br>";
        var_dump($coba['kode_soal']);
        echo "<br>";
        echo "<br>";

         $jmlsoal1 = $this->db->query("SELECT kode_soal from data_soal_equest where id_pembuat_equest = 220 order by kode_soal ASC")->result_array();

        foreach($jmlsoal1 as $jb => $dr){
            Array_push($array1, $dr['kode_soal']);
        }
        $r = array_search($coba['kode_soal'], $array1) + 1;
        var_dump($r);
    }

    public function testarray(){

        // $kalimat = ",R01,R07,";
 
        // $data = explode("," , $kalimat);
        // $warning = array_search("R01",$data);
        // if($warning == true){
            // var_dump(array_search("R01",$data));
            // var_dump("MASUK");
        // }
    }

    public function string(){
        // $num ="1menit  22 ";
        // $num1=str_replace("menit",":",$num);
        // $num2=str_replace(" ","",$num1);
        // var_dump(str_replace(" detik","",$num2));
        // var_dump((int)$num);
        // var_dump((float)$num);
        // $num = "2.59";
        // var_dump((float)$num);
        // $this->db->query($query);
        $koneksi = mysqli_connect("localhost","root","","mri_operation");
        $query = "UPDATE data_jawaban_equest SET sts = 1 where id_pembuat_equest = 220 and id_project = 13 and id_skenario = 6 and id_user = 201908001; UPDATE data_jawaban_equest SET sts = 2 where id_pembuat_equest = 220 and id_project = 13 and id_skenario = 6 and id_user = 201907001;";
        // mysqli_query($koneksi, $query);
        mysqli_query($koneksi, "UPDATE data_jawaban_equest SET sts = 1 where id_pembuat_equest = 220 and id_project = 13 and id_skenario = 6 and id_user = 201908001;UPDATE data_jawaban_equest SET sts = 2 where id_pembuat_equest = 220 and id_project = 13 and id_skenario = 6 and id_user = 201907001;");
    //    $data = mysqli_query($koneksi, "SELECT * FROM data_user");
        // $no = 0;
        // while($d = mysqli_fetch_array($data)){
		//      echo $no++;
		// }
    }

    public function explode(){
        $riway = "1 2 3";

        $data = explode(" ", $riway);
        var_dump($data);
        // if("2.00" >= "0."){
        //     var_dump("false");
        // }
        // for($i=0; $i<0; $i++){
        //     var_dump("IWAYRIWAY");
        // }
    }

    public function checkbox(){
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/cekbok'); //cek2=antar kunjungan; cek3=antar soal; cek4=cek konsistensi dari database;
        $this->load->view('templates/footer'); 
    }

    public function ambil(){
        var_dump($this->input->post('bok'));
        echo "<br>";
        $sring= "1|1|2|";
        $c = $sring.implode(" ",$this->input->post('bok'));
        // $c = $sring.$this->input->post('bok');
        var_dump($c);
        redirect('pw/checkbox');
    }

    public function kolom(){
        $query = "ALTER TABLE data_kolom ";
        for($i=0; $i<=15; $i++){
            $query .= "ADD ABC$i varchar(2)";
            if($i<15){
                $query .= ", ";
            } else {
                $query .= ";";
            }
        }

        $this->db->query($query);
    }
    public function tabel(){
        $arrayjbkode2 = "1 2 3";
        $cari21 = '2';
         if(preg_match("/\b$cari21\b/", $arrayjbkode2)){
                    var_dump("TIDAK KONSISTEN");
                    echo "<br>";
                }
    }

    public function substr(){
        $foo = [1,2,3,4];
        $string = ["50-TEST IWAYRIWAY |", "lorem"];
        echo str_replace("50", "X3", $string[0]);
        // echo substr("$string",0,stripos("$string", "-"));
        // unset($foo[0]); // remove item at index 0
        // $foo2 = array_values($foo);
        // print_r($foo2);
    }

    public function img(){
        $this->load->view('templates/img');
    }
}