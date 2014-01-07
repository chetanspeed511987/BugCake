<div class="ui two column relaxed grid">
  <div class="column">
    <div class="ui fluid form segment">
        <div class="ui icon input 4">
            <?php echo $this->Form->create('Issue'); ?>
            <?php echo $this->Form->input('search', array('label' => false,
                                                          'placeholder' => 'Search...',
                                                          'div'=>false)); ?>
            
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
  </div>
</div>
<?php if (isset($posts)) { ?>
<table class="ui table segment">
      <thead>
        <tr>
            <th>Actions</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
      </thead>
      <tbody>
            <?php foreach ($posts as $post):
            if ($post['Issue']['state'] == 0) {
                echo '<tr class="negative">';
              } else {
                echo '<tr class="positive">';
              }
            ?>
            <td><a href="<?php echo $this->Html->url(array('action'=> 'view', $post['Issue']['id']));  ?>"><div class="small circular ui button">View</div></a></td>
            <td><?php echo h($post['Issue']['title']); ?></td>
            <td><?php echo h(substr($post['Issue']['body'], 0, 41)); ?></td>
            <td><?php echo $post['Issue']['created']; ?></td>

            </tr>
            <?php endforeach; ?>
      </tbody>
    </table>
<?php } ?>