
<?php foreach($site->getPosts() as $post) { ?>
  <div class="col-md box-1">
    <h3 style="background: linear-gradient(0deg, rgb(66 66 66 / 30%), rgb(0 0 0 / 30%)), url('<?php echo $post['slika']; ?>');" class="news-title font-weight-light"><?php echo $post['naslov']; ?></h3>
    <p><?php echo $post['tekst']; ?></p>
  </div>
<?php } ?>