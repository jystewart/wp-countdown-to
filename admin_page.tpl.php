<div class="wrap">
  <h2><em>Countdown To</em> Options</h2>
  <div style="float: left; width: 660px; margin: 5px;"> 
    <form method="post" action="">
      <p>
        <label style="font-weight: bold" for="countdown_date"><?php echo __('Date to countdown to') ?></label>
        <input id="countdown_date" name="countdown_date" type="text" value="<?php echo date('d M Y', $options['countdown_date']) ?>">
      </p>
      
      <p>
        <label style="font-weight: bold" for="countdown_close_comments"><?php echo __('Close comments after date?') ?></label>
        <input id="countdown_close_comments" name="countdown_close_comments" type="checkbox" value="1"
          <?php if ($options['countdown_close_comments'] == 1) { echo 'checked="checked"'; } ?>
        >
      </p>

      <p>
        <label style="font-weight: bold" for="countdown_message"><?php echo __('Message to show during countdown') ?></label><br />
        <input id="countdown_message" name="countdown_message" size="50" type="text" value="<?php echo $options['countdown_message'] ?>">
        <br /><small>Will be followed by X day(s). eg. <em>Ends in 5 days</em></small>
      </p>
            
      <p>
        <label style="font-weight: bold" for="countdown_ended_message"><?php echo __('Message to show when date reached') ?></label><br />
        <input id="countdown_ended_message" name="countdown_ended_message" size="50" type="text" value="<?php echo $options['countdown_ended_message'] ?>">
      </p>

      <p><input type="submit" name="update_options" value="Update"  style="font-weight:bold;" /></p>
    </form>
  </div>
</div>

