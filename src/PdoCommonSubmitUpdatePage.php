<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html" charset="UTF-8" />
		<title>Registration Form</title>
		<link rel="stylesheet" href="formcss.css" />
	</head>
	<body>
		<?php
			extract($_REQUEST);
			if(isset($id))
			{
				require_once("ClassPdo.php");
				$cn=new ClassPdo();
			
				$rs=$cn->showSpecific($id);
				$hobby=explode(",",$rs->hobby);
		?>
		<!-- This For Update Page -->
		<div class="container">
			<form id="Form" method="GET" action="PdoCheck.php" autocomplete="off" onPaste="return false">
				<div class="row">
					<div class="col">
					</div>
					<div class="col" id="heading">
						<b>REGISTRATION FORM</b>
					</div>
					<div class="col">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">FIRST NAME</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="fname" class="input removeBorder" name="fname" value="<?php echo $rs->first_name; ?>" placeholder="ENTER YOUR FIRST NAME HERE" />
					</div>
					<div class="col">
						<div id="error_fname" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">LAST NAME</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="lname" class="input removeBorder" name="lname" value="<?php echo $rs->last_name; ?>" placeholder="ENTER YOUR LAST NAME HERE" />
					</div>
					<div class="col">
						<div id="error_lname" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">DATE OF BIRTH</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="date" class="input removeBorder" name="date" value="<?php echo $rs->dob; ?>" placeholder="YYYY-MM-DD" />
					</div>
					<div class="col">
						<div id="error_date" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">PASSWORD</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="password" id="pass" class="input removeBorder" value="<?php echo $rs->pwd; ?>" id="pass" name="password" placeholder="ENTER YOUR PASSWORD HERE"  />
					</div>
					<div class="col">
						<div id="error_password" class="error">
							<span> </span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">CONFIRM PASSWORD</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="password" id="cpass" class="input removeBorder" name="cpassword" value="<?php echo $rs->confirm_pwd; ?>" placeholder="ENTER YOUR PASSWORD HERE" />
					</div>
					<div class="col">
						<div id="error_cpassword" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">EMAIL ID</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="uemail" class="removeBorder email" name="email" value="<?php echo $rs->email; ?>" placeholder="ENTER YOUR EMAIL ID HERE" />
					</div>
					<div class="col">
						<div id="error_email" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">CITY</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<select id="city" name="city" class="removeBorder" >
							<option <?php if (!empty($rs->city) && $rs->city == '0')  echo 'selected = "selected"'; ?>>--SELECT--</option>
							<option  <?php if (!empty($rs->city) && $rs->city == 'GWALIOR')  echo 'selected = "selected"'; ?>>GWALIOR</option>
							<option  <?php if (!empty($rs->city) && $rs->city == 'PUNE')  echo 'selected = "selected"'; ?>>PUNE</option>
							<option  <?php if (!empty($rs->city) && $rs->city == 'MUMBAI')  echo 'selected = "selected"'; ?>>MUMBAI</option>
							<option  <?php if (!empty($rs->city) && $rs->city == 'DEHLI')  echo 'selected = "selected"'; ?>>DEHLI</option>
							<option  <?php if (!empty($rs->city) && $rs->city == 'PUNJAB')  echo 'selected = "selected"'; ?>>PUNJAB</option>
						</select>
					</div>
					<div class="col">
						<div id="error_city" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">ADDRESS</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<textarea id="add" rows="3" cols="72" class="removeBorder"  name="address" placeholder="START WRITING YOUR ADDRESS FROM HERE" ><?php echo $rs->address; ?></textarea>
					</div>
					<div class="col">
						<div id="error_address" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">GENDER</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<label><input type="radio" name="gender" class="radio" id="male" <?php echo ($rs->gender=='male')?"checked":"" ;?> value="male" />MALE</label>
						<label><input type="radio" name="gender" class="radio" id="female" <?php echo ($rs->gender=='female')?"checked":"" ;?> value="female" />FEMALE</label>
						<label><input type="radio" name="gender" class="radio" id="other" <?php echo ($rs->gender=='other')?"checked":"" ;?> value="other" />OTHER</label>
					</div>
					<div class="col">
						<div id="error_gender" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">HOBBIES</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<label class="check"><input type="checkbox" id="cricket" class="checkBox" name="hobby[]" <?php echo (in_array("cricket",$hobby)) ? 'checked = "checked"' : '';?> value="cricket" /> CRICKET</label>
						<label class="check"><input type="checkbox" id="football" class="checkBox" name="hobby[]" <?php echo (in_array("football",$hobby)) ? 'checked = "checked"' : '';?> value="football" /> FOOTBALL</label>
						<label class="check"><input type="checkbox" id="dance" class="checkBox" name="hobby[]" <?php echo (in_array("dance",$hobby)) ? 'checked = "checked"' : '';?> value="dancing" />DANCING</label><br>&nbsp;
						<label class="check"><input type="checkbox" id="chess" class="checkBox" name="hobby[]" <?php echo (in_array("chess",$hobby)) ? 'checked = "checked"' : '';?> value="chess"  />CHESS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="check"><input type="checkbox" id="otherhobby" class="checkBox" name="hobby[]" <?php echo (in_array("other",$hobby)) ? 'checked = "checked"' : '';?> value="other"/>OTHER</label>
					</div>
					<div class="col">
						<div id="error_hobby" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col"></div>
					<div class="col" style="text-align:right;">
						<div class="innerCol"></div>
						<input type="hidden" name="id" value="<?php echo $rs->id; ?>" id="id" />
						<input type="submit" value="SAVE TO CHANGE" name="update" id="Update" class="submit" />
					</div>
					<div class="col">
						<div id="error_submition" class="error">
							<?php if(isset($_REQUEST['error'])){ echo $_REQUEST['error'];} ?>
						</div>
					</div>
				</div>
			</form>
		</div>
			<?php }  else {?>
			
			<!-- This For submit Page -->
			
				<div class="container">
			<div class="row" >
				
			</div>
			<form id="Form" method="POST" action="PdoCheck.php" autocomplete="off" onPaste="return false">
				<div class="row">
					<div class="col">
					</div>
					<div class="col" id="heading">
						<b>REGISTRATION FORM</b>
					</div>
					<div class="col">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">FIRST NAME</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="fname" class="input removeBorder" name="fname" placeholder="ENTER YOUR FIRST NAME HERE" />
					</div>
					<div class="col">
						<div id="error_fname" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">LAST NAME</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="lname" class="input removeBorder" name="lname" placeholder="ENTER YOUR LAST NAME HERE" />
					</div>
					<div class="col">
						<div id="error_lname" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">DATE OF BIRTH</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="date" class="input removeBorder" name="date" placeholder="YYYY-MM-DD" />
					</div>
					<div class="col">
						<div id="error_date" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">PASSWORD</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="password" id="pass" class="input removeBorder" id="pass" name="password" placeholder="ENTER YOUR PASSWORD HERE"  />
					</div>
					<div class="col">
						<div id="error_password" class="error">
							<span> </span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">CONFIRM PASSWORD</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="password" id="cpass" class="input removeBorder" name="cpassword" placeholder="ENTER YOUR PASSWORD HERE" />
					</div>
					<div class="col">
						<div id="error_cpassword" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">EMAIL ID</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<input type="text" id="email" class="removeBorder email" name="email" placeholder="ENTER YOUR EMAIL ID HERE" />
					</div>
					<div class="col">
						<div id="error_email" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">CITY</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<select id="city" name="city" class="removeBorder" >
							<option>--SELECT--</option>
							<option>GWALIOR</option>
							<option>PUNE</option>
							<option>MUMBAI</option>
							<option>DEHLI</option>
							<option>PUNJAB</option>
						</select>
					</div>
					<div class="col">
						<div id="error_city" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">ADDRESS</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<textarea id="add" rows="3" cols="72" class="removeBorder"  name="address" placeholder="START WRITING YOUR ADDRESS FROM HERE" ></textarea>
					</div>
					<div class="col">
						<div id="error_address" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">GENDER</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<label><input type="radio" name="gender" class="radio" id="male" value="male" />MALE</label>
						<label><input type="radio" name="gender" class="radio" id="female" value="female" />FEMALE</label>
						<label><input type="radio" name="gender" class="radio" id="other" value="other" />OTHER</label>
					</div>
					<div class="col">
						<div id="error_gender" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label class="">HOBBIES</label>
						<span class="asterisk">*</span>
					</div>
					<div class="col">
						<div class="innerCol">
							<label>:</label>
						</div>
						<label class="check"><input type="checkbox" id="cricket" class="checkBox" name="hobby[]" value="cricket" /> CRICKET</label>
						<label class="check"><input type="checkbox" id="football" class="checkBox" name="hobby[]" value="football" /> FOOTBALL</label>
						<label class="check"><input type="checkbox" id="dance" class="checkBox" name="hobby[]" value="dancing" />DANCING</label><br>&nbsp;
						<label class="check"><input type="checkbox" id="chess" class="checkBox" name="hobby[]" value="chess"  />CHESS</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="check"><input type="checkbox" id="otherhobby" class="checkBox" name="hobby[]" value="other"/>OTHER</label>
					</div>
					<div class="col">
						<div id="error_hobby" class="error">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col"></div>
					<div class="col" style="text-align:right;">
						<div class="innerCol"></div>
						<input type="button" value="CLICK TO SUBMIT" name="submit" id="Submit" class="submit" />
						<input type="reset" value="START ALL OVER" name="reset" id="Reset"  />
					</div>
					<div class="col">
						<div id="error_submition" class="error">
							<?php if(isset($_REQUEST['error'])){ echo $_REQUEST['error'];} ?>
						</div>
					</div>
				</div>
			</form>
		</div>
			
			<?php } ?>	
		
		<!-- <script type="text/javascript" src="formscript.js" ></script> -->
		<script type="text/javascript" src="jquery.js" ></script>
		<script type="text/javascript" src="PdoCommonScript.js" ></script>
		<!--<script type="text/javascript" src="commonScript.js" ></script>-->
		<!--<script type="text/javascript" src="updateFormScript.js" ></script>-->
		<!--<script type="text/javascript" src="form_jquery_script.js" ></script> -->
	</body>
</html>