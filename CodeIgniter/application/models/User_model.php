<?php

class User_model extends CI_model
{
	function create($formArray)
	{
		$this->db->insert('crud',$formArray);
		//INSERT INTO crud (name,email) values (? ,?);
	}

	function all()
	{
		return $users= $this->db->get('crud')->result_array();
		// SELECT *  from crud
	}

	function getUser($userId)
	{
		$this->db->where('user_id',$userId);
		return $user= $this->db->get('crud')->row_array();

		//Select * from users;
	}


	function updateUser($userId,$formArray)
	{
		# code...
		$this->db->where('user_id',$userId);
		$this->db->update('crud',$formArray);

		//Update users SET name=?, email=? where user_id=?
	}

	function deleteUser($userId)
	{
		$this->db->where('user_id',$userId);
		$this->db->delete('crud');
		// DELETE FROM crud where user_id = ?

	}



}


?>