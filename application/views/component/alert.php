<main>
    <div class="container-fluid">
<?php if($type == 'name'){?>
<div class="alert alert-danger" role="alert">
  Template name : <?php echo $value; ?> already exist! <a href="<?php echo base_url('Config/template')?>"> << back </a>
</div>
<?php } ?>
</div>
</main>