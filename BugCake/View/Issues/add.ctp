<?php echo $this->Form->create('Issue'); ?>
<div class="ui form">
  <div class="field">
    <h4>Give a title</h4>
    <?php echo $this->Form->input('title', array('label' => false)); ?>
  </div>
</div>

<div class="ui form">
  <div class="field">
    <h4>Describe the issue</h4>
    <?php echo $this->Form->input('body', array('label' => false)); ?>
  </div>
</div>

<div class="ui field">
    <input type="submit" value="Save Issue" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>
