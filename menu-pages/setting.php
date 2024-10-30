<br/>
<style>
.alert{ 
  padding: 8px 35px 8px 14px;
  margin-bottom: 20px;
  color: #c09853;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
  background-color: #fcf8e3;
  border: 1px solid #fbeed5;
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  
  color: #3a87ad;
  background-color: #d9edf7;
  border-color: #bce8f1;}
</style>
<?php
if(isset($_POST['savesettings']))
{
	if(isset($_POST['show_ip']))
	{
		update_option('lordlinus_show_ip','1');
	}
	else
	{
		update_option('lordlinus_show_ip','0');
	}
	if(isset($_POST['show_total']))
	{
		update_option('lordlinus_show_total','1');
	}
	else
	{
		update_option('lordlinus_show_total','0');
	}
	echo "<div class='alert'>";
	_e("Setting Updated Successfully","lord-linus-online-visitor");
	echo "</div>";
}
$lordlinus_show_ip_val = get_option('lordlinus_show_ip');
$lordlinus_show_total_val = get_option('lordlinus_show_total');
?>
<center><h2><?php __("Settings for Online Visitors","lord-linus-online-visitor"); ?></h2></center>
<hr/>
<form method="post" action="#">
<table>
<tr><td>
<input type="checkbox" name="show_ip" <?php if($lordlinus_show_ip_val == 1) echo "checked=checked"; ?> /></td><td><h4><?php _e("Show IP Address of the User ?","lord-linus-online-visitor");?></h4></td></tr>
<tr>
<td colspan="2"><?php _e("(Check this if you want to show the IP address of the user. This Will show the user's IP Address in the widget)","lord-linus-online-visitor");?></td></tr>
<tr>
<td colspan="2"><hr/></td>
</tr>
<tr><td>
<input type="checkbox" name="show_total" <?php if($lordlinus_show_total_val == 1) echo "checked=checked"; ?> /></td>
<td><h4><?php _e("Show Total Visitor on user dashboard ?","lord-linus-online-visitor");?></h4></td></tr>
<tr>
<td colspan="2"><?php _e("(Check this if you want to show the total number of visitors on users dashboard.)","lord-linus-online-visitor");?></td></tr>
<tr>
<td colspan="2"><hr/></td>
</tr>
<tr>
<td colspan="2"><input type="submit" class="button" value="<?php _e("Save Settings","lord-linus-online-visitor"); ?>" name="savesettings"></td>
</tr>
</table>
</form>