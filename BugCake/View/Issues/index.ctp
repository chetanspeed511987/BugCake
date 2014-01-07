<div class="main container">
    <div class="three fluid ui buttons">
        <?php echo $this->Paginator->prev('<i class="double angle left icon"></i>',array('tag' => 'div', 'escape' => false, 'class' => 'ui active button'));?>
        <?php echo '<div class="ui active button">'.$this->Paginator->counter().'</div>'; ?>
        <?php echo $this->Paginator->next('<i class="double angle right icon"></i>',array('tag' => 'div', 'escape' => false, 'class' => 'ui active button'));?>
    </div>
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
    <div class="three fluid ui buttons">
        <?php echo $this->Paginator->prev('<i class="double angle left icon"></i>',array('tag' => 'div', 'escape' => false, 'class' => 'ui active button'));?>
        <?php echo '<div class="ui active button">'.$this->Paginator->counter().'</div>'; ?>
        <?php echo $this->Paginator->next('<i class="double angle right icon"></i>',array('tag' => 'div', 'escape' => false, 'class' => 'ui active button'));?>
    </div>
</div>