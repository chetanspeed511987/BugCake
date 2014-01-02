
<?php echo $this->Form->create('Issue'); ?>
<?php if ($post['Issue']['commentid'] == 0) { ?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('title', array('label' => false, 'value'=>$post['Issue']['title'])); ?>
  </div>
</div>

<?php } ?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('body', array('label' => false, 'value'=>$post['Issue']['body'])); ?>
  </div>
</div>

<div class="ui field">
    <input type="submit" value="Save Issue" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>