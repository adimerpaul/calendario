<?php
class Economico extends CI_Controller{
    function index(){
        if (!isset($_SESSION['username'])){
            header('Location: '.base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('economico');
        $this->load->view('templates/footer');
    }
    public function consulta(){
        $dat1=$_POST['dat1'];
        $dat2=$_POST['dat2'];
        $query=$this->db->query("SELECT * FROM events WHERE date(created_at)<=date('$dat2') AND date(created_at)>=date('$dat1') AND idusuario='".$_SESSION['idusuario']."'");
        echo json_encode($query->result_array());
    }
}
