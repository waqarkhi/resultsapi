<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}
	public function find($tab)
	{
		$roll = @$_GET['r'];
		$year = @$_GET['y'];
		$field = @$_GET['f'];
		$part = @$_GET['p'];
		$type = @$_GET['e'];

		if ($year) {$this->db->where('year', $year);}
		if ($field) {$this->db->where('field', $field);}
		if ($part) {$this->db->where('part', $part);}
		if ($type) {$this->db->where('exam_type', $type);}

		$this->db->where('roll', $roll);



		$result = $this->db->get($tab)->row_array();
		echo $this->json($result);
		
		
	}
	private function json($data)
	{
		header('Content-Type: application/json');
		return json_encode($data, JSON_PRETTY_PRINT);
	}
}
