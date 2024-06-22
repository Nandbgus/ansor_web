<?php
class Home extends Controller
{
    public function index()
    {
        $data['head'] = "Home Page";
        $data['current_page'] = "Home";
        if (isset($_SESSION['user_id'])) {
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        } else {
            // Handle case when user is not logged in
            // Misalnya, atur $data['foto'] ke nilai default atau kosong
            $data['foto'] = ''; // Atur ke nilai default atau kosong
        }
        $data['blogs'] = $this->model('Blog_model')->getLatestBlogs();
        $data['author'] = $this->model('Blog_model')->getAuthorMostBlogs();


        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
