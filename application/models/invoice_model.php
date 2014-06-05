<?php
class invoice_model extends CI_Model {
	public function get_rows()
		{
			$this->db->select('*');
			$query = $this->db->get('tbl_invoice_pdf');
			return  $query->result_array();
		}
	public function get_row_by_id($id)	{
		$this->db->select('*');
		$this->db->where( "id",$id);
		$query = $this->db->get('tbl_invoice_pdf');
		return $query->row();
	}	
}



