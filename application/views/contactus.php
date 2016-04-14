<div class="container">
<span>
	<?php echo $this->session->flashdata('success'); ?>
	
</span>
	<form action="<?php echo base_url().'contactus/postContactus' ?>" enctype="multipart/form-data" method="post">
		<input type="text" value="<?php echo set_value('name') ?>" placeholder="Name" name="name">
		<?php echo form_error('name','<span>','</span>'); ?>
		<br><br>
		<input type="text" value="<?php echo set_value('email'); ?>" placeholder="Email" name="email">
		<?php echo form_error('email','<span>','</span>'); ?>
		<br><br>
		<input type="text" value="<?php echo set_value('mobile'); ?>" placeholder="Mobile" name="mobile">
		<?php echo form_error('mobile','<span>','</span>'); ?>
		<br><br>
		<?php echo $captcha; ?><br><br>
		<input type="text" autocomplete="off" placeholder="Enter captcha here" name="captcha" >
		<?php echo form_error('captcha','<span>','</span>'); ?>
		<br><br>
		<input type="file" name="userfile" />
			<?php if(!empty($errors)){ ?>
				<?php
					
						echo $errors.'<br>';
					
				 ?>
			<?php	} ?>
		<br /><br />
		
		
		
		<input type="submit" value="Submit" >
	</form>
</div>