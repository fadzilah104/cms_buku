<?php
class m_buku extends CI_Model {

    var $tabel = 'buku';

    function __construct() {
        parent::__construct();
    }
    
    //fungsi untuk menampilkan semua data dari tabel database
	function get_buku() {
        $this->db->from($this->tabel);
		$query = $this->db->get();
        return $query->result();

	}

    //fungsi insert ke database
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }

    public function delete($table, $par, $var){
            $this->db->where($par,$var);
            $this->db->delete($table);
    }

    function select_by_id($id_buku) {
        $this->db->select('*');
        $this->db->from($this->tabel);
        $this->db->where('id_buku', $id_buku);

        return $this->db->get();
    }

    function update_buku($id_buku, $data) {
        $this->db->where('id_buku', $id_buku);
        $this->db->update($this->tabel, $data);     
    }

}

?>