<?php
if(isset($_POST['uninstallovll']))
{
	global $wpdb;
	$query = "DROP table `useronline`";
	$wpdb->query($query);
	
	delete_option('lordlinus_show_ip');
	$plugin = "lord-linus-online-visitor/lord-linus-online-visitor.php";
	deactivate_plugins($plugin);
	?>
	<div class="alert" style="width:95%; margin-top:10px;">
			<p><strong> <?php _e("Plugin has been successfully removed.","lord-linus-online-visitor"); ?><?php _e(" It can be re-activated from the","lord-linus-online-visitor"); ?>
			<a href="plugins.php">Plugins Page</a></strong>.</p>
		</div>
		<?php
		return;
}
?>
<?php
if(isset($_GET['page']) == 'uninstall')
{
?>

<div style="background:#C3D9FF; margin-bottom:10px; padding-left:10px;">
  <h3><?php _e("Remove Plugin","lord-linus-online-visitor"); ?></h3> 
</div>

<div class="alert alert-error" style="width:95%;">
	<form method="post">
	<h3><?php _e("Remove Lord Linus Online Visitor Plugin","lord-linus-online-visitor"); ?></h3>
	<p> <?php _e("This operation wiil delete all data & settings.","lord-linus-online-visitor"); _e("If you continue, You will not be able to retrieve or restore your entries.","lord-linus-online-visitor")?>;</p>
	<p><button class="button" id="uninstallovll" type="submit" class="btn btn-danger" name="uninstallovll" value="" onclick="return confirm('Warning! data & settings, including appointment entries will be deleted. This cannot be undone. OK to delete, CANCEL to stop')"><?php _e("Remove Plugin","lord-linus-online-visitor"); ?></button></p>
	
	</form>
</div>

<?php

	}
?>