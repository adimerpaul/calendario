<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}
	public function events(){
        $query=$this->db->query('SELECT * FROM events WHERE  date(start)>=date(now())');
        echo json_encode($query->result_array());
    }
    public function insert(){
	    $title=$_POST['title'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $idusuario= $_SESSION['idusuario'];
//        $idusuario=1;
        $monto=$_POST['monto'];
        $query=$this->db->query("SELECT * FROM usuario WHERE idusuario='$idusuario'");
        $carrera=$query->row()->carrera;
        $this->db->query("INSERT INTO events SET title='$title', start='$start', end='$end',monto='$monto',idusuario='$idusuario',carrera='$carrera'");
        echo "1";
    }
    public function update($id){
        $title=$_POST['title'];
        $monto=$_POST['monto'];
        $this->db->query("UPDATE events SET title='$title',monto='$monto' WHERE id='$id'");
        echo "1";
    }
    public function login(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query=$this->db->query("SELECT * FROM usuario WHERE username='$username' AND password='$password'");
        if ($query->num_rows()==1){
            header('Location: '.base_url().'Main');
            $_SESSION['username']=$query->row()->username;
            $_SESSION['idusuario']=$query->row()->idusuario;
            $_SESSION['carrera']=$query->row()->carrera;
//            $_SESSION['username']=$query->row()->username;
        }else{
            header('Location: '.base_url());
        }
    }
    public function logout(){
	    session_destroy();
        header('Location: '.base_url());
    }
    public function delete($id){
        $this->db->query("DELETE FROM events WHERE id='$id'");
        echo "1";
	}


}
