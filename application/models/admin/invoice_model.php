<?php
class Invoice_Model extends CI_Model {
	
	
	   public function num_invoice() {
		
		$sql = " SELECT * FROM tbl_invoice_pdf";
		$result = $this->db->query($sql);
		return $result->result();

	}
	
		public function get_all_invoice($limit, $start) {
	
        $query = $this->db->query("Select * from tbl_invoice_pdf LIMIT $start, $limit");
		
		//echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }

   	public function get_info($id)
	{
		$sql = " SELECT * FROM tbl_invoice_pdf WHERE id = '$id' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
		public function delete_invoice($id = 0) {

		$sql = "DELETE FROM tbl_invoice_pdf WHERE id='$id'";

		$result = $this->db->query($sql);

		return (boolean) $result;

	}
	
	public function save_invoice_info( $data ) {

		$this->db->insert('tbl_invoice_pdf',$data);
		
		return $this->db->insert_id();
	}
	
	public function update_invoice_info( $user_id,$data ) {
		
		$this->db->where('id',$user_id);
		$this->db->update('tbl_invoice_pdf',$data);
	//	echo $this->db->last_query();die;
		return true;
	}

}
