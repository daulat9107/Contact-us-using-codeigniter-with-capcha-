<?php
$this->load->view('templates/aside')
?>
<section>
	<article>
		<?php if($users): ?>
			<ul>
			<?php foreach ($users as $key => $value): ?>
				<li><?php echo $value->username; ?></li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</article>
</section>