<?php

class Daerah_model extends Controller
{
    private $table = 'dusun';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function dusun_all()
    {
        $this->db->query('
            SELECT ds.id_dusun, ds.nama as nama_dusun, dsa.id as id_desa, dsa.nama as nama_desa
            FROM ' . $this->table . ' as ds
            JOIN desa dsa ON ds.id_desa = dsa.id');
        return $this->db->resultSet();
    }
   
}
