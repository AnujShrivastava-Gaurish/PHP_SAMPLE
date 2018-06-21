<?php
	require_once("ClassPdo.php");
	$conn=new ClassPdo();
	extract($_REQUEST); //it will extract all the value of query string
	
	//This will execute when $email,$Blur is set and $Blur=="sblur" (submit blur).
	if((isset($email)) && (isset($Blur) && $Blur=='sblur'))
	{
		sleep(1);  // This is used to delay 1 sec because of loader in ajax.
		
		/* 	This function return the "true" when email is found
			in database and "false" value when email is not found
			in database at the time of insertion.
		*/ 
		
		$r=$conn->checkEmail($email);
		
		if($r=="true")
		{
			return $r;
		}
		
	}
	
	//This will execute when $email,$Blur,$id is set and $Blur=="ublur" (update blur).
	if((isset($email)) && (isset($Blur) && $Blur=="ublur") && isset($id))
	{
		sleep(1);  // This is used to delay 1 sec because of loader in ajax.
		
		/* 	This function return the "true" when email is found
			in database and "false" value when email is not found
			in database at the time of update.
		*/ 
		$r=$conn->checkEmailUpdate($email,$id); 
		
		if($r=="true")
		{
			return $r;
		}
	}
	
	//This will execute when $email,$click is set and $click=="DELETE".
	if((isset($email)) && (isset($click) && $click=="DELETE"))
	{
		/* 	This function return the true(1) when record is deleted
			in database and false(0) value when record is not deleted
			in database at the time of deletion.
		*/ 
		 $r1=$conn->delete($email);
		if($r1)
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	
	//This will execute when $hobby,$submit is set $hobby is a array and $submit=="CLICK TO SUBMIT".
	if(((isset($hobby)) && is_array($hobby)) && (isset($submit) && $submit=="CLICK TO SUBMIT"))
	{
		$r2=implode(',', $hobby); // This divide the array value in string by (,) .
		
		/* 	This function return the true(1) when insertion is successful
			in database and false(0) value when insertion is not successful 
			in database at the time of deletion.
		*/ 
		
		$r=$conn->insert($fname,$lname,$date,$password,$cpassword,$email,$city,$address,$gender,$r2);
		
		if($r)
		{
			header("location: PdoTable.php");
		}
		else
		{
			header("location: PdoCommonSubmitUpdatePage.php?error=SUBMITION IS FAILED PLEASE FILLED THE FORM AGAIN");
		}
	}
	
	//This will execute when $hobby,$update is set $hobby is a array and $update=="SVAE TO CHANGE".
	if(((isset($hobby)) && is_array($hobby)) && (isset($update) && $update=="SAVE TO CHANGE"))
	{
		$r2=implode(',', $hobby); // This divide the array value in string by (,) .
		
		/* 	This function return the true(1) when update is successful
			in database and false(0) value when update is not successful 
			in database at the time of deletion.
		*/ 
		$r=$conn->update($id,$fname,$lname,$date,$password,$cpassword,$email,$city,$address,$gender,$r2);
		if($r)
		{
			header("location: PdoTable.php"); // At success it's redirect index.php.
		}
		else
		{
			header("location: PdoCommonSubmitUpdatePage?error=UPDATION IS FAILED PLEASE TRY AGAIN&id=".$id);
			// At failed it's redirect updatePage.php with error in query string.
		}
	}
	
?>