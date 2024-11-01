<?php
/*
Plugin Name: Small Business Loan Calculator
Plugin URI: http://bestbusinessoptions.com/
Description: Small business loan calculator calculates the estimated loan amount that you can qualify for by entering the total annual revenue that your business generates.This tool allows business owners that are looking to borrow money, to get an idea on how much they would qualify to borrow.  It is a great tool for a business loans company to publish on their website. If you have any questions in regards to this calculator or if you have any special requests then please contact Golden Financial Services by emailing paul@goldenfs.org
Version: 1.2
Author: Paul Paquin
Author URI: http://bestbusinessoptions.com/
License: GPLv2 or later
*/

/*  Copyright 2013  Paul Paquin  (email : paul@goldenfs.org)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if (!defined('WP_CONTENT_DIR'))
define( 'WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WC_SMALL_M_DIR'))
define('WC_SMALL_M_DIR', '/wp-content/plugins/small-business-loan-calculator');

 //adding style to theme front end,.
function sb_theme_styles() {
	wp_register_style('sm-style', plugins_url( 'style.css', __FILE__ ), array());
	wp_enqueue_style('sm-style');
	//adding JavaScript
}
	add_action('wp_enqueue_scripts', 'sb_theme_styles');

//function to display calculator
function business_calculator() {
	$content .= '<script type="text/javascript">';
	 $content .= 'function calculate_func(){';
	 $content .= "revenue = document.getElementById('revenue').value;";
	 $content .= "if(revenue == '') {"; 
	  $content .= 'alert("Please enter your total annual revenue");';
	$content .= 	'exit();
			} else {	
			if (isNaN(revenue)) {
				alert("Please enter a number");
				exit();
				} else {
			total = parseFloat(revenue)*((7.5)/100);
			total = total.toFixed(3);
			 str2 = "$";
				total = total.concat(str2);'; 
	$content .=	"document.getElementById('loan').value = total;
		}
		}
	}
</script>";
	$content .= '<div class="wc_b_calc" id="mainWrapper">';
	$content .= '<h1 id="mainHeadingCal">Small Business Loan Calculator</h1>';
	$content .='<form>';
    $content .= '<table align="left" cellpadding="1px" id="business_calculator">
	<tr>
	<td width="355">Enter total annual revenue your business generates</td>
	<td width="167"><strong>$</strong>&nbsp;<input type="text" id="revenue" onChange="calculate_func();" value="00.00" onclick=this.value="">
	</td></tr>';
	$content .='<tr>
		<td>&nbsp;</td>
		<td><a href="#mainWrapper" onClick="calculate_func();"><img src="'.plugins_url('/images/btn.png', __FILE__ ).'"/></a></td>
	</tr>';
	$content .='<tr>
	<td>Estimated loan amount that you qualify for</td>
	<td><input type="text" id="loan" value="$00.00" readonly/></td>
	</tr>
	</table>
	<p class="powered">Powered by <a href="http://bestbusinessoptions.com/" id="last" target="_blank">
	bestbusinessoptions.com</a>				
	</p>
	<div class="clearit"></div>
	</form>
	</div>
	';
	
	echo $content;
	}
	//Adding shortcode
	add_shortcode('business_calculator', 'business_calculator');

function small_biz_page_fn() {
	echo '<br><center><a href="http://nomorecreditcards.com/" target="_blank"><img src="'.plugins_url('/images/main_banner.png', __FILE__ ).'"/></a></center>';
	echo '<h3>Usage</h3>';
	echo '<p>You can use shortcode in any page or post or widget [business_calculator]</p>';
	echo '<p>To call calculator in template file use php function &lt;?php business_calculator(); ?&gt;</p>';
	echo '<h3>Support</h3>';
	echo '<p>We are always available to help you for this plugin questions. We also appriciate your suggestions and feedback. Please email at paul@goldenfs.org</p>';
}

function small_biz_add_page_fn(){
    add_options_page('Small Business Loan Calculator '.__('options page','small-biz'), 'Small Business Loan Calculator ', 'manage_options', __FILE__, 'small_biz_page_fn');
    add_filter('plugin_action_links', 'quick_chat_action_links', 10, 2);
}
add_action('admin_menu', 'small_biz_add_page_fn');