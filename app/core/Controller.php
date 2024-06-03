<?php

class Controller
{
    protected $database;
    public function __construct()
    {
        // Inisialisasi koneksi database
        $this->database = new Database();
    }
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}
