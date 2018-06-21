<?php

	class ClassPdo
	{
		public $conection;
		
		public function ClassPdo()
		{
			try
			{
				$this->conection=new PDO("mysql:host=localhost; dbname=student","root","");
				return $this->conection;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		
		//show() is used to fetch all the record in the database table using PDO .
		public function show()
		{
			$sql="SELECT * FROM registration";
			$stmt=$this->conection->query($sql);
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		
		//showSpecific($id) is used to fetch single record in the database table by id.
		public function showSpecific($student_id)
		{
			$sql="SELECT * FROM registration WHERE id=?";
			$stmt=$this->conection->prepare($sql);
			$stmt->execute([$student_id]);
			
			if($stmt)
			{
				return $stmt->fetch(PDO::FETCH_OBJ);
			}
		}
		
		//checkEmail($email) is used to check email is exist or not in database at the time of update
		public function checkEmailUpdate($email,$student_id)
		{
			$result='false';
			$sql="SELECT email FROM registration WHERE id!=:id && email=:email";
			$stmt=$this->conection->prepare($sql);
			$stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->execute();
			//var_dump($stmt);
			//echo '<br>'.$stmt->rowCount();
			if($stmt->rowCount()>0)  // rowCount() is used to count the no. of column is fetched. 
			{
				$result='true';				
			}
			echo $result;
			
		}
		
		//checkEmail($email) is used to check email is exist or not in database at the time of submission
		public function checkEmail($email)
		{
			$result='false';
			$sql="SELECT email FROM registration WHERE email=?";
			$stmt=$this->conection->prepare($sql);
			$stmt->execute([$email]);
			//var_dump($stmt);
			if($stmt->rowCount()>0) // rowCount() is used to count the no. of column is fetched. 
			{
				$result="true";		
			}
			echo $result;
			
		}
		
		//update(all extract parameter) is used to update particular record in database table.
		public function update($student_id,$fname,$lname,$date,$password,$cpassword,$email,$city,$address,$gender,$hobby)
		{
			//query of update it return true(1) when record is update and false(0) when record is not update.
			$sql="UPDATE registration SET first_name=?, last_name=?, dob=?, pwd=?, confirm_pwd=?, email=?, city=?, address=?, gender=?, hobby=? WHERE id=? ";
			$stmt=$this->conection->prepare($sql);
			$stmt->execute([$fname,$lname,$date,$password,$cpassword,$email,$city,$address,$gender,$hobby,$student_id]);
			return $stmt;
			
		}
		
		//insert(all extract parameter) is used to insert records in database table.
		public function insert($fname,$lname,$date,$password,$cpassword,$email,$city,$address,$gender,$hobby)
		{
			//query of insert it return true(1) when record is inserted and false(0) when record is not inserted.
			$sql="insert into registration (first_name, last_name, dob, pwd, confirm_pwd, email, city, address, gender, hobby) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt=$this->conection->prepare($sql);
			$stmt->execute([$fname,$lname,$date,$password,$cpassword,$email,$city,$address,$gender,$hobby]);
			if($stmt)
			{
				return true;
			}
			return false;
		}
		
		//delete($email) is used to delete a record in database table by email id
		public function delete($email)
		{
			$sql="DELETE FROM registration WHERE email=?";
			$stmt=$this->conection->prepare($sql);
			$stmt->execute([$email]);
			$count=$stmt->rowCount();
			//var_dump($stmt);
			if($count>0)
				return true;
			
		}
		
	}






?>