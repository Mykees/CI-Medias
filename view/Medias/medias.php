<div class="file">
	<div class="line">
		<span class="image">
			<?php echo img($media['path'],array('alt'=>$media['name'])); ?>
		</span>
		<span class="filename">
			<?php echo $media['name']; ?>
		</span>
		<div class="actions">

			<?php if (isset($thumbID) && $thumbID['media_id'] !== false && $media['id'] !== $thumbID['media_id']): ?>
				<a href="<?php echo site_url('admin/medias/mainthumb'); ?>" data-model="<?php echo $model; ?>" data-mid="<?php echo $media['id']; ?>" class="action main">Image à la une</a>
			<?php endif ?>
			<a href="<?php echo site_url('admin/medias'); ?>" class="action insert">Afficher</a>
			<a href="<?php echo site_url('admin/medias/delete'); ?>" data-mid="<?php echo $media['id']; ?>" class="action delete">Delete</a>
		</div>
	</div>
	<div class="details">
		<div class="image">
			<?php echo img($media['path']); ?>
			<div class="filename"><strong>Nom du fichier :</strong> <?php echo $media['name']; ?></div>
			<div class="filesize"><strong>taille de l'image :</strong> ...</div>
			<div class="cb"></div>
		</div>
		<?php echo form_open('admin/medias/view/'.$model.'/'.$media['id'],array('id'=>'form-details','class'=>'form-details')); ?>
			<?php echo form_label("Titre de l'image : ",'input_alt'); ?>
			<?php echo form_input(array(
				'name'=>'alt',
				'id'=>'input_alt',
				'class'=>'input_alt',
				'value'=>$media['name']
			)); ?><br><br>

			<?php echo form_label("Cible : ",'input_src'); ?>
			<?php echo form_input(array(
				'name'=>'src',
				'id'=>'input_src',
				'class'=>'input_src',
				'value'=> site_url($media['path'])
			)); ?><br><br>

			<?php echo form_label("Alignement : ",'input_select'); ?>
			<?php
			 $options = array(
                  'alignLeft'  => 'Aligner à gauche',
                  'alignCenter'    => 'Aligner au centre',
                  'alignRight'   => 'Aligner à droite',
                );
			 $attr = 'id="input_select" class="input_select"';
            ?>
			<?php echo form_dropdown('align', $options, 'large',$attr); ?><br><br>

    		<?php echo form_submit(array('name'=>'submit','value'=>"Insérer dans l'article","class"=>"input_submit")); ?>

		<?php echo form_close(); ?>

	</div>
</div>