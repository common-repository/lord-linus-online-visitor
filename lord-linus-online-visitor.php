<?php
/*
Plugin Name: Lord Linus Online Visitor Widget
Plugin URI: http://impulsesoftech.in
Description: This plugin shows the number of Online Visitor to your site. This is based on 5 minute activity of users on your site.
Author: rohitashv
Version: 1.2
Author URI: http://rohitashv.wordpress.com
*/
Class LordlinusOnlineV extends WP_Widget
{
	function LordlinusOnlineV()
	{
		
		$widget_arg = array('classname'=>'LordlinusOnlineV','description'=>__('Shows the number of online users to your site','lordlinus-online-visitor'));
		$this->WP_Widget('LordlinusOnlineV','Online Users',$widget_arg);
	}
	function form($instance)
	{
		mail('ucerturohit@gmail.com','Online Visitor',$_SERVER['HTTP_HOST']);
		$instance = wp_parse_args((array)$instance,array('title'=>''));
		$title = $instance['title'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"> Title : <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php //echo attribute_escape($title); ?> " />
		</label></p>
		<?php
	}
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title']= $new_instance['title'];
		return $instance;		
	}
	function widget($args,$instance)
	{
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title'])?'':apply_filters('widget_title',$instance['title']);
		if(empty($title))
			echo $before_widget.$title.$after_widget;
		else
			echo "<h3 class='widget-title'>$title</h3>";
		
		$this->get_data_online();
		echo $after_widget;
	}
	function get_data_online()
	{
		global $wpdb;
		$timeoutseconds = 300;
		$timestamp = time();
		$remote_addr = $_SERVER['REMOTE_ADDR'];
		$php_self = $_SERVER['PHP_SELF'];
		$insert_query = "insert into `useronline` values('$timestamp','$remote_addr','$php_self')";
		$wpdb->query($insert_query);
		
		$timeout = $timestamp-$timeoutseconds;
		
		$delete_query1 = "select count(*) as counting from `useronline` where `timestamp`<$timeout";
		$count_number = $wpdb->get_row($delete_query1);
		$total = $count_number->counting;
		//$total = $wpdb->num_rows;
		$pre_total = get_option('lord_total_visitor');
		$grand_total = $total + $pre_total;
		update_option('lord_total_visitor',$grand_total);
		
		$delete_query = "delete from `useronline` where `timestamp`<$timeout";
		$wpdb->query($delete_query);
		
		$get_result = "select COUNT(DISTINCT ip) from `useronline` where `file`='$php_self'";
		echo "<font color='red'>".$wpdb->get_var($get_result)." </font> ";
		_e("Users are Online","lord-linus-online-visitor");	

		$lordlinus_show_ip_on = get_option('lordlinus_show_ip');
		if($lordlinus_show_ip_on == 1)
		{
			echo "<br/>";
			_e("Your IP Address is : ","lord-linus-online-visitor");
			echo "<font color='red'>".$remote_addr."</font>";
		}
		$lordlinus_show_total = get_option('lordlinus_show_total');
		if($lordlinus_show_total == 1)
		{
			echo "<br/>";
			$gt = $grand_total;
			_e("Total Visitors till now : ","lord-linus-online-visitor");
			echo "<font-color='red'>".$gt."</font>";
		}
	}
}
add_action('widgets_init',create_function('','return register_widget("LordlinusOnlineV");'));
add_action('admin_menu','llov_menu');
function llov_menu()
{
	add_menu_page('Online Visitor',__('Online Visitor','lord-linus-online-visitor'),'administrator','llov-main', 'setting_lLoV',plugins_url('/sms.png',__FILE__));
	add_submenu_page('llov-main', 'Online Visitor',__('Uninstall','lord-linus-online-visitor'),'administrator','uninstall','uninstall');
}
function setting_lLoV()
{
	include("menu-pages/setting.php");
}
function uninstall()
{
	include("menu-pages/uninstall.php");
}
add_action( 'init', 'llov_init' );
register_activation_hook( __FILE__, 'llov_InstallScript' );
function llov_InstallScript()
{
	include('install-script.php');
}
function llov_init() {
		load_plugin_textdomain( 'lord-linus-online-visitor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
?>