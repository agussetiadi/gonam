<?php foreach ($query->result_array() as $key => $value) { ?>
<li>
  <a rel="nofollow" href="<?php echo $value['notif_admin_link'] ?>" class="dropdown-item" target="_blank"> 
    <div class="notification">
      <div class="notification-content"><i class="fa fa-envelope bg-green"></i><?php echo $value['notif_admin_message']; ?></div>
      <div class="notification-time"><small><?php echo class_date::arr_bulan($value['notif_admin_date'])." ".substr($value['notif_admin_time'], 0,5) ?></small></div>
    </div>
    </a>
</li>
<?php } ?>