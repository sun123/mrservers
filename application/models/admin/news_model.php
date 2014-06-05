<?php
class News_Model extends CI_Model {		
		public function get_news() 
		{	
				$this->db->select('*');
				$this->db->order_by('id');			
				$result = $this->db->get('tbl_news');
				return $result->result();
		}		
		public function save_news($news_data){
				$sql =$this->db->insert('tbl_news' ,$news_data);
				return true;
		}
		public function edit_news($news_id){
				$this->db->select('*');
				$this->db->where('id',$news_id);
				$result = $this->db->get('tbl_news');
				return $result->row();
		}
		public function update_news($news_id ,$news_data){
				$this->db->where("id", $news_id);
				$sql =$this->db->update('tbl_news' ,$news_data);
				return true;
		}
		public function delete_news($news_id){
				$query = $this->db->where('id', $news_id);
				$query = $this->db->delete('tbl_news');
				return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
		}
}
