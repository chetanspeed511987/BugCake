<div class="ui raised segment">
<div class="ui ribbon label">
  <i class="code icon"></i> <?php echo h($post['Issue']['author']); ?>
</div>


Status: 
<?php
if ($post['Issue']['state'] == 0) {
  echo $this->Form->postLink("OPEN", array('action' => 'state', $post['Issue']['id']),
                       array('class'=>'ui black label'));
} else {
  echo $this->Form->postLink("CLOSE", array('action' => 'state', $post['Issue']['id']),
                       array('class'=>'ui green label'));
}
if ($post['Issue']['author'] == $this->Session->read('Auth.User.username')) {
  echo $this->Html->link("EDIT", array('action' => 'edit', $post['Issue']['id']), array('class'=>'ui teal label'));
  echo $this->Form->postLink("DELETE", array('action' => 'delete', $post['Issue']['id']),
                         array('confirm' => 'Are you sure?','class'=>'ui red label'));
}
?>
<h4 class="ui header"><?php echo h($post['Issue']['title']); ?></h4>
<p><?php echo h($post['Issue']['body']); ?></p>

</div>


<?php foreach ($comments as $comment): ?>
<div class="ui raised segment">
<div class="ui ribbon label">
  <i class="code icon"></i> <?php echo h($comment['Issue']['author']); ?>
</div>
<?php if ($comment['Issue']['author'] == $this->Session->read('Auth.User.username')) {

echo $this->Html->link("EDIT", array('action' => 'edit', $comment['Issue']['id']), array('class'=>'ui teal label'));
echo $this->Form->postLink("DELETE", array('action' => 'delete', $comment['Issue']['id']),
                       array('confirm' => 'Are you sure?','class'=>'ui red label'));
} ?>
<p><?php echo h($comment['Issue']['body']); ?></p>
</div>
<?php endforeach; ?>

<div class="ui divider"></div>

<h4>Post a Comment</h4>
<?php echo $this->Form->create('Issue', array('url' => array('action'=> 'comment', $post['Issue']['id']), 'novalidate' => true)); ?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('body', array('label' => false)); ?>
  </div>
</div>

<div class="ui field">
    <input type="submit" value="Save Issue" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>
