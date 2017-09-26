
			<?php
				$id =$this->session->userdata('id');
				$firma = $this->User_model->firma($id);
					echo $firma;
			  ?>
