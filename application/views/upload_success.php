<html>
	<head>
		<title>Upload Form</title>
	</head>
	<body>
		<h3>File berhasil diupload</h3>

		
			<?php 
			//bukan array nih
			if(is_array($upload_data)){
				echo 'masuk <br>';
				$count = 1;
				foreach ($upload_data as $item) {
				echo $count.' ' . $item;
				echo '<br>';
				$count++;
				}		
				echo 'ada ';
				echo $count-1;
			} else {
				
				echo $upload_data;
				//$sql= mysql_connect("localhost", "root", "");
				//mysql_select_db("latihanci");
				$this->load->database();
				//memasukkan data ke table
				$query = $this->db->query("LOAD DATA INFILE '$upload_data'"." INTO TABLE hobi FIELDS TERMINATED BY '|' IGNORE 1 LINES 
					(`nama`, `jenis kelamin`, `umur`, `hobi`)");		  
				//constraint: file yang dimasukkan akhirnya ada 000nya
				$query = $this->db->query("DELETE FROM hobi order by id desc limit 1");		  
				
			}
			 ?>
			
		
		<p><?php echo anchor('/upload/do_upload', 'Upload Lagi'); ?></p>	
	</body>
</html>