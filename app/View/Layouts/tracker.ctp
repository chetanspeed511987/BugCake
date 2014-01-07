<!DOCTYPE html>
<head>
  <!-- Standard Meta -->
  <?php echo $this->Html->charset(); ?>
  <title>
        Bug - Cake
  </title>
  <style>
      .bgj {
          background: url('/img/bg.jpg') repeat scroll 0 0 #FCFCFC;
      }
      a {
          text-decoration: none;  
      }
  </style>
  
  <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
  <?php
  echo $this->Html->css('semantic');
  echo $this->fetch('css');
  echo $this->Html->script('semantic');
  echo $this->fetch('script')
  ?>
  <!-- Site Properities -->
  
</head>
<body class="index bgj">

      <div class="ui menu">

        <?php echo $this->Html->link('<i class="warning icon"></i> Create an issue', array('action' => 'add'), array('class' => 'active green item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="bug icon"></i> All', array('action' => 'index'), array('class' => 'active purple item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="empty checkbox icon"></i> Open', array('action' => 'index', 0), array('class' => 'active red item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="checked checkbox icon"></i> Close', array('action' => 'index', 1), array('class' => 'active blue item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="search icon"></i> Search', array('action' => 'search'), array('class' => 'active teal item', 'escape' => false)); ?>

      </div>

      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
</body>

</html>