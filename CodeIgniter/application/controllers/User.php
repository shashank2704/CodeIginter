<?php




class User extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['user_logged']))
		{
			$this->session->set_flashdata("error","Please login first to view this page!!");
			redirect("auth/login");
		}

	}
  
	public function profile()
	{
		$this->load->view('profile');
	}

	public function index()
	{
		$this->load->model('User_model');
		$users= $this->User_model->all();
		$data=array();
		$data['users']=$users;

		$this->load->view('list',$data);
	}

	public function create()
	{
		$this->load->model('User_model');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		if($this->form_validation->run()==false)
		{
			$this->load->view('create');
		}
		else
		{
			$formsArray=array();
			$formsArray['name']=$this->input->post('name');
			$formsArray['email']=$this->input->post('email');
			$formsArray['create_at']=date('Y-m-d');
			$this->User_model->create($formsArray);
			$this->session->set_flashdata('success','Record added successfully');
			redirect(base_url().'index.php/user/index'); 
		}	
	}

	public function edit($userId)
	{
		# code...
		$this->load->model('User_model');
		$user= $this->User_model->getUser($userId);
		$data= array();
		$data['user']=$user;

		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');

		if($this->form_validation->run()==false)
		{
			$this->load->view('edit',$data);
		}

		else
		{
			//update set record
			$formsArray=array();
			$formsArray['name']= $this->input->post('name');
			$formsArray['email']= $this->input->post('email');
			$this->User_model->updateUser($userId,$formsArray);

			$this->session->set_flashdata('success','Record Update successfully');
			redirect(base_url().'index.php/user/index');
		}






		





	}
}

?>
