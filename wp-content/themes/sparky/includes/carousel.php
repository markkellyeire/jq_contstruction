<?php if (count($slides)) {  ?>
<div class="rslides_container">
	<ul class="rslides" id="slider4">

            <?php foreach($slides as $i => $slide) { ?>
				<li>
					<?php echo $slide['large']; ?>
					<p class="caption">This is a caption</p>
				</li>
			<?php
		}
		?>
	</ul>
</div>
<?php } ?>