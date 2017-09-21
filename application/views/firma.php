<div>
	<p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>______________
		<br>
		<br>
			<?php
				$id =$this->session->userdata('id');
				$firma = $id.".jpg";
					echo "<img width:'500' height='300' src='../uploads/firmas/$firma'>";
			  ?>
	</p>
</div>