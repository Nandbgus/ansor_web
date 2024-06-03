<?php

class Blog extends Controller
{

    public function index()
    {
        $data['head'] = "Blog";
        $data['isi'] = $this->model('Blog_model')->isiSemua();
        $this->view('templates/header', $data);
        $this->view('blogs/index', $data);
        $this->view('templates/footer');
    }
    
}
