<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Whatsapp.php");

class Callback extends Whatsapp
{
	private $dataInput = [];
	private $dbMri;
	private $dbJay2;
	private $dataTransfer;
	private $dataStkb;
	public function __construct()
	{
		parent::__construct();
		$this->set_data_input_json();
		$this->dbMri = $this->load->database('db_bridge', TRUE);
		$this->dbJay2 = $this->load->database('database_kedua', TRUE);
		$this->load->model('Stkb_model');
	}

	public function callback_transfer_stkb()
	{
		$isSuccessTransfer = $this->is_success_process_transfer();
		if ($isSuccessTransfer) {
			$this->get_data_transfer();
			$this->get_data_stkb($this->dataTransfer->nomor_stkb);
			$this->set_input_post($this->dataTransfer, $this->dataStkb);
			$this->Stkb_model->prosesbayarstkb();
			$this->send_notification_whatsapp();

			echo json_encode("OK");
		}
	}

	private function set_data_input_json()
	{
		$input_data = json_decode($this->input->raw_input_stream, true);
		$this->dataInput = $input_data;
	}

	private function is_success_process_transfer()
	{
		log_message("info", json_encode($this->dataInput));
		return $this->dataInput['response']['TransactionID'] == $this->dataInput['transfer_req_id'];
	}

	private function set_input_post($data, $dataStkb)
	{
		$voucherNumber = $this->generate_voucher_number();
		$this->set_data_post('perdin', $dataStkb->perdin);
		$this->set_data_post('bpjs', $dataStkb->bpjs);
		$this->set_data_post('akomodasi', $dataStkb->akomodasi);
		$this->set_data_post('tanggalbayar', $data->jadwal_transfer);
		$this->set_data_post('pembayar', "MRI PAL");
		$this->set_data_post('total', $data->jumlah);
		$this->set_data_post('statusbayar', "Paid");
		$this->set_data_post('ops', $dataStkb->jumlahops);
		$this->set_data_post('trk', $dataStkb->jumlahtrk);
		$this->set_data_post('term', $dataStkb->term);
		$this->set_data_post('nomorstkb', $data->nomor_stkb);
		$this->set_data_post('tglbayar', $data->jadwal_transfer);
		$this->set_data_post('novoucher', $voucherNumber);
		$this->set_data_post('nomor_voucher', $voucherNumber);
		$this->set_data_post('stkb_voucher', $voucherNumber);
	}

	private function set_data_post($key, $value)
	{
		$_POST[$key] = $value;
	}

	private function get_data_transfer()
	{
		$this->dataTransfer = $this->dbMri->where('transfer_req_id', $this->dataInput['transfer_req_id'])->get('data_transfer')->row();
	}

	private function get_data_stkb($nomorStkb)
	{
		$this->dataStkb = $this->dbJay2->where('nomorstkb', $nomorStkb)->get('stkb_pembayaran')->row();
	}

	private function send_notification_whatsapp()
	{
		$idPic = $this->dataStkb->idpic;
		$user = $this->db->query("SELECT * FROM id_data WHERE id='$idPic'")->row_array();

		$dataNotifikasi = [
			"nomor_stkb" => $this->dataTransfer->nomor_stkb,
			"penerima" => $user['Nama'],
			"msisdn" => $user['HP'],
			"jenis_pembayaran" => "STKB",
			"pemilik_rekening" => $user['Nama'],
			"nomor_rekening" => $this->dataTransfer->norek,
			"bank" => $this->dataTransfer->bank,
			"jumlah" => $this->dataTransfer->jumlah,
			"jadwal_transfer" => $this->dataTransfer->jadwal_transfer,
			"project" => $this->dataTransfer->nm_project,
			"biaya_transfer" => $this->dataTransfer->biaya_trf,
			"term" => $this->dataStkb->term
		];
		
		$messageTransfer = $this->message_success_transfer($dataNotifikasi);
		$this->send_notification($dataNotifikasi['msisdn'], $messageTransfer);
	}

	private function generate_voucher_number()
	{
		$tahun = date('y');
		$bulan = date('m');
		// Mandiri Format KKP12-210001
		// BCA Format KKP12-BCA-210001
		return "KKP" . $bulan . "-" . $tahun . "0001";
	}

	private function lastVoucherId($kodeBank = "BRMIIDJA")
	{
		$date = date('my');
		$dbBridge = $this->load->database('database_ketiga', TRUE);
		$data = $dbBridge->select('novoucher')->where('transfer_req_id LIKE', $date."%")->order_by('transfer_req_id',"desc")->limit(1)->get('data_transfer')->row();
    	$lastId = (int)substr($data->transfer_req_id, -4);

		$formatId = $date . sprintf('%04d', $lastId + 1);
		return $formatId;
	}
}
