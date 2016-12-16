<?php
/*
Plugin Name: SMSC
Description: SMS уведомления с использованием шлюза SMSC.RU
Version: 1.0
Author: SMSC.RU
Author URI: http://smsc.ru
Plugin URI: http://smsc.ru/api/code/#woocommerce
*/
if (!class_exists('smsc_woocommerce')) return;
if (in_array('woocommerce/woocommerce.php',apply_filters('active_plugins',get_option('active_plugins')))) 
	add_action('plugins_loaded', 'smsc_woocommerce', 0);
function smsc_woocommerce() { $smsc_woocommerce = new smsc_woocommerce; }

class smsc_woocommerce {

	function __construct() {
		add_action('admin_init',array(&$this,'admin_style'));
		add_action('admin_menu',array(&$this,'admin_menu'));
		add_action('woocommerce_thankyou', array(&$this, 'new_order'));
		add_action('woocommerce_order_status_changed', array(&$this, 'change_status'), 1, 3);
		register_deactivation_hook(__FILE__, array(&$this, 'smsc_woocommerce_deactivation'));
		include('smsc_api.php');
	}
	 
	function smsc_woocommerce_deactivation() {
	    delete_option('smsc_login');
	    delete_option('smsc_psw');
	    delete_option('smsc_sender_name');
	    delete_option('smsc_adm_phone');
	    delete_option('smsc_send_new_adm');
	    delete_option('smsc_send_new_cl');
	    delete_option('smsc_neworder_adm');
	    delete_option('smsc_neworder_cl');
	    delete_option('smsc_send_change_adm');
	    delete_option('smsc_send_change_cl');
	    delete_option('smsc_change_adm');
	    delete_option('smsc_change_cl');
	}
	
	function admin_menu() {
		add_submenu_page('woocommerce', 'Настройка SMS оповещений',  'SMS оповещения' , 'manage_woocommerce', 'smsc_settings', array(&$this,'options_page'));
	}
	
	function admin_style() {
		global $woocommerce;
		wp_enqueue_style('woocommerce_admin_styles', $woocommerce->plugin_url().'/assets/css/admin.css');	
	}
	
	function options_page() {

		if(isset($_GET['action']) && $_GET['action']=='add') {
				update_option('smsc_login', $_POST['smsc_login']);
				update_option('smsc_psw', $_POST['smsc_psw']);
				update_option('smsc_sender_name', $_POST['smsc_sender_name']);
				update_option('smsc_adm_phone', $_POST['smsc_adm_phone']);
				update_option('smsc_send_new_adm', $_POST['smsc_send_new_adm']);
				update_option('smsc_send_new_cl', $_POST['smsc_send_new_cl']);
				update_option('smsc_neworder_adm', $_POST['smsc_neworder_adm']);
				update_option('smsc_neworder_cl', $_POST['smsc_neworder_cl']);
				update_option('smsc_send_change_adm', $_POST['smsc_send_change_adm']);
				update_option('smsc_send_change_cl', $_POST['smsc_send_change_cl']);
				update_option('smsc_change_adm', $_POST['smsc_change_adm']);
				update_option('smsc_change_cl', $_POST['smsc_change_cl']);

				$result = 'Настройки обновлены.';
		}

		$login = get_option('smsc_login');
		$psw = get_option('smsc_psw');
		$sender = get_option('smsc_sender_name');
		$adm_phone = get_option('smsc_adm_phone');
		$smsc_neworder_adm = get_option('smsc_neworder_adm');
		$smsc_neworder_cl = get_option('smsc_neworder_cl');
		$smsc_change_adm = get_option('smsc_change_adm');
		$smsc_change_cl = get_option('smsc_change_cl');
		list($balance) = $login != '' && $psw != ''? _smsc_send_cmd('balance', 'login='.$login.'&psw='.$psw) : '';
		
		?>
		<div class="wrap woocommerce">
			<form method="post" id="mainform" action="<?php echo admin_url('admin.php?page=smsc_settings&action=add'); ?>">
				<div class="icon32 icon32-woocommerce-settings" id="icon-woocommerce"><br /></div>
				<?php if(isset($result)) { echo '<h3>'.$result.'</h3>'; } ?>
				<table class="widefat" style="width:auto; float:left; display:inline; clear:none; margin-bottom:30px;">
					<tr><th colspan='2' style='text-align:center;'><h2>Настройки шлюза</h2>
					<tr><td><label for='smsc_login'>Логин</label><td><input type='text' name='smsc_login' id='smsc_login' value="<?=$login?>">
					<tr><td><label for='smsc_psw'>Пароль</label><td><input type='password' name='smsc_psw' id='smsc_psw' value="<?=$psw?>">
					<tr><td><label for='smsc_sender_name'>Имя отправителя</label><td><input type='text' name='smsc_sender_name' id='smsc_sender_name' value="<?=$sender;?>">
					<tr><td><label for='smsc_adm_phone'>Телефон администратора</label><td><input type='text' name='smsc_adm_phone' id='smsc_adm_phone' value="<?=$adm_phone;?>">
					<tr><td>Ваш баланс<td><?if ($balance) echo '<b>', $balance, '</b>';?>
				</table>
				<table class="widefat" style="width:auto;">
					<tr><th colspan='3' style='text-align:center;'><h2>Шаблоны сообщений</h2>
					<tr><th colspan='2' style='text-align:center;'><b>Шаблоны для события "Новый заказ"</b>
					<tr><td style='padding:0'><td style='padding:0'><td rowspan='4'><br><br><br><br><b>Макросы:</b><br>
						{NUM} - номер заказа<br>{SUM} - сумма заказа<br>{EMAIL} - E-mail клиента<br>{PHONE} - Телефон клиента<br>{FIRSTNAME} - Имя клиента<br>{LASTNAME}
						- Фамилия клиента<br>{CITY} - Город клиента<br>{ADDRESS} - Адрес клиента<br>{BLOGNAME} - Название магазина(блога)<br>{OLD_STATUS} - Старый статус<br>{NEW_STATUS} - Новый статус<br>{ITEMS} - Список товаров в формате "Наименование Количество: Стоимость:"
					<tr><td><label for='smsc_neworder_adm'>Сообщение администратору</label><br><br><textarea cols='20' rows='5' name='smsc_neworder_adm' id='smsc_neworder_adm'><?=$smsc_neworder_adm;?></textarea>
							<br><label for='smsc_send_new_adm'>Отправлять администратору?</label> <input type='checkbox' name='smsc_send_new_adm' id='smsc_send_new_adm' <?=get_option('smsc_send_new_adm') == 'on'? 'checked' : '';?>>
						<td><label for='smsc_neworder_cl'>Сообщение клиенту</label><br><br><textarea cols='20' rows='5' name='smsc_neworder_cl' id='smsc_neworder_cl'><?=$smsc_neworder_cl;?></textarea>
							<br><label for='smsc_send_new_cl'>Отправлять клиенту?</label> <input type='checkbox' name='smsc_send_new_cl' id='smsc_send_new_cl' <?=get_option('smsc_send_new_cl') == 'on'? 'checked' : '';?>>
					<tr><th colspan='2' style='text-align:center;'><br><b>Шаблоны для события "Статус заказа изменен"</b>
					<tr><td><label for='smsc_change_adm'>Сообщение администратору</label><br><br><textarea cols='20' rows='5' name='smsc_change_adm' id='smsc_change_adm'><?=$smsc_change_adm;?></textarea>
							<br><label for='smsc_send_change_adm'>Отправлять администратору?</label> <input type='checkbox' name='smsc_send_change_adm' id='smsc_send_change_adm' <?=get_option('smsc_send_change_adm') == 'on'? 'checked' : '';?>>
						<td><label for='smsc_change_cl'>Сообщение клиенту</label><br><br><textarea cols='20' rows='5' name='smsc_change_cl' id='smsc_change_cl'><?=$smsc_change_cl;?></textarea>
							<br><label for='smsc_send_change_cl'>Отправлять клиенту?</label> <input type='checkbox' name='smsc_send_change_cl' id='smsc_send_change_cl' <?=get_option('smsc_send_change_cl') == 'on'? 'checked' : '';?>>
				</table>
				<br>
				<input type="submit" class="button-primary" value="Сохранить">
			</form>
		</div>
	<?php }



	function new_order($order_id) {
		$order = new WC_Order($order_id);
		$search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}', '{OLD_STATUS}', '{NEW_STATUS}', '{ITEMS}');
		$replace = array('№'.$order_id, strip_tags($order->get_formatted_order_total()), $order->billing_email, $order->billing_phone, $order->billing_first_name, $order->billing_last_name,
			$order->shipping_city, $order->shipping_address_1.' '.$order->shipping_address_2, get_option('blogname'), __($old_status, 'woocommerce'), __($new_status, 'woocommerce'), str_replace("\n", " ", strip_tags($order->email_order_items_table(0, 0, 0, 0, 0, 1))));
		$sender = get_option('smsc_sender_name');
		$login = get_option('smsc_login');
		$psw = get_option('smsc_psw');
		if (get_option('smsc_send_new_adm') == 'on') {
			$msg = str_replace($search, $replace, get_option('smsc_neworder_adm'));
			send_sms(get_option('smsc_adm_phone'), $msg, 0, 0, 0, 0, $sender, 'login='.$login.'&psw='.$psw.'&charset=utf8');
		}
		if (get_option('smsc_send_new_cl') == 'on') {
			$msg = str_replace($search, $replace, get_option('smsc_neworder_cl'));
			send_sms($order->billing_phone, $msg, 0, 0, 0, 0, $sender, 'login='.$login.'&psw='.$psw.'&charset=utf8');
		}
	}

	function change_status($order_id, $old_status, $new_status) {
		$order = new WC_Order($order_id);
		$search = array('{NUM}', '{SUM}', '{EMAIL}', '{PHONE}', '{FIRSTNAME}', '{LASTNAME}', '{CITY}', '{ADDRESS}', '{BLOGNAME}', '{OLD_STATUS}', '{NEW_STATUS}');
		$replace = array('№'.$order_id, strip_tags($order->get_formatted_order_total()), $order->billing_email, $order->billing_phone, $order->billing_first_name, $order->billing_last_name,
				$order->shipping_city, $order->shipping_address_1.' '.$order->shipping_address_2, get_option('blogname'), __($old_status, 'woocommerce'), __($new_status, 'woocommerce'));
		$sender = get_option('smsc_sender_name');
		$login = get_option('smsc_login');
		$psw = get_option('smsc_psw');
		if (get_option('smsc_send_change_adm') == 'on') {
			$msg = str_replace($search, $replace, get_option('smsc_change_adm'));
			send_sms(get_option('smsc_adm_phone'), $msg, 0, 0, 0, 0, $sender, 'login='.$login.'&psw='.$psw.'&charset=utf8');
		}
		if (get_option('smsc_send_change_cl') == 'on') {
			$msg = str_replace($search, $replace, get_option('smsc_change_cl'));
			send_sms($order->billing_phone, $msg, 0, 0, 0, 0, $sender, 'login='.$login.'&psw='.$psw.'&charset=utf8');
		}
	}

}
