<html>
	<head>
		<meta content="text/html" charset="UTF-8" />
		<title>Show</title>
		<link rel="stylesheet" href="formcss.css" />
	</head>
	<body>
		<?php
			require_once("ClassPdo.php");
			$cn=new ClassPdo();
			$result=$cn->show();
		?>
		<div id="top" >
			<!--<a href="registrationForm.php" ><input type="button" value="ADD" /></a> This Is Old -->
			<a href="PdoCommonSubmitUpdatePage.php" ><input type="button" value="ADD" /></a>
		</div>
		<br/>
		<table>
			<tr>
				<th>ID</th>
				<th>FIRST NAME</th>
				<th>LAST NAME</th>
				<th>DATE OF BIRTH</th>
				<th>EMAIL</th>
				<th>ADDRESS</th>	
				<th></th>
			</tr>
			<?php foreach($result as $r){ ?>
			<tr>
				<td><?php echo $r->id; ?></td>
				<td><?php echo $r->first_name; ?></td>
				<td><?php echo $r->last_name; ?></td>
				<td><?php echo $r->dob; ?></td>
				<td class="email"><?php echo $r->email; ?></td>
				<td><?php echo $r->address; ?></td>
				<td>
					<!--<a href="updatePage.php?id=<?php //echo $resultSet["id"]; ?>" ><input type="button" value="UPDATE" class="update" /></a> This has Old page-->
					<a href="PdoCommonSubmitUpdatePage.php?id=<?php echo $r->id; ?>" ><input type="button" value="UPDATE" class="update" /></a>
					<input type="button" value="DELETE" class="delete" />
				
				</td>
			</tr>
			<?php } ?>
		</table>
		<script type="text/javascript" src="jquery.js" ></script>
		<script type="text/javascript" src="PdoCommonScript.js"></script>
	</body>
</html>