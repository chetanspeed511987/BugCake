
    
    
<div class="main container">
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
</div>