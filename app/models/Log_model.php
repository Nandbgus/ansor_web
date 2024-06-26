<?php

class Log_model extends Controller
{
    private $table = 'log_aktivitas';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function report_all()
    {
        $this->db->query('
            SELECT lg.aktivitas, lg.timestamp, m.nama_a 
            FROM ' . $this->table . ' lg 
            JOIN members m ON lg.id_user = m.id');
        return $this->db->resultSet();
    }
}
