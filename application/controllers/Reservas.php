<?php


class Reservas extends CI_Controller{
    function index(){
        if (!isset($_SESSION['username'])){
            header('Location: '.base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('reservas');
        $this->load->view('templates/footer');
    }
}
