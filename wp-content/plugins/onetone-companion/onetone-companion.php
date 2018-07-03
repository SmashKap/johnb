<?php
/*
	Plugin Name: OneTone Companion
	Description: OneTone theme options.
	Author: MageeWP
	Author URI: https://www.mageewp.com/
	Version: 1.0.5
	Text Domain: onetone-companion
	Domain Path: /languages
	License: GPL v2 or later
*/

if ( !defined('ABSPATH') ) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

require_once "includes/metabox-options.php";

if(!class_exists('OnetoneCompanion')){
	
	class OnetoneCompanion{
	
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'init' ) );
			add_action('admin_menu', array(&$this,'create_menu'));
			add_action( 'wp_enqueue_scripts',  array(&$this , 'front_scripts' ));
			add_action( 'admin_enqueue_scripts', array($this,'admin_scripts' ));
			add_shortcode( 'oc_contact',  array(&$this, 'contact_form') );
			
			add_action('wp_ajax_onetone_contact', array(&$this,'onetone_contact'));
			add_action('wp_ajax_nopriv_onetone_contact', array(&$this,'onetone_contact'));
			
			add_action( 'do_meta_boxes', array(&$this,'remove_theme_metaboxes') );
			add_action('init', array(&$this,'html_tags_code') );
		}
		
		  function remove_theme_metaboxes(){
				  remove_meta_box( 'onetone_page_meta_box', 'page', 'advanced' );
		  }
			
			
		public static function init() {
			load_plugin_textdomain( 'onetone-companion', false,  basename( dirname( __FILE__ ) ) . '/languages' );
		}
		
		function admin_scripts() {

			if(isset($_GET['page']) && $_GET['page']=='onetone-companion/onetone-companion.php' )
				wp_enqueue_style( 'onetone-companion-admin-css',  plugins_url( 'assets/css/admin.css',__FILE__ ), '','', false );
		}
		
		function front_scripts() {
				wp_enqueue_script( 'onetone-companion-front', plugins_url('assets/js/main.js', __FILE__),array('jquery'),'',true);
				
				$i18n = array(
				'i1'=> __('Please fill out all required fields.','onetone-companion' ),
				'i2'=> __('Please enter valid email.','onetone-companion' ),
				'i3'=> __('Please enter your name.','onetone-companion' ),
				'i4'=> __('Message is required.','onetone-companion' ),
				);
				
				wp_localize_script( 'onetone-companion-front', 'oc_params', array(
					'ajaxurl' => admin_url('admin-ajax.php'),
					'plugins_url' => plugins_url('', __FILE__),
					'i18n' => $i18n,
				));	
				wp_enqueue_style( 'onetone-companion-admin-css',  plugins_url( 'assets/css/admin.css',__FILE__ ), '','', false );
		}
		
		function create_menu() {
		
			//create new top-level menu
			add_menu_page( __('OneTone Companion','onetone-companion'), __('OneTone Companion','onetone-companion'), 'administrator', __FILE__, array(&$this,'settings_page'),'dashicons-admin-generic');
		
			//call register settings function
			add_action( 'admin_init', array(&$this,'register_mysettings') );
		}
		
		
	public static function default_options(){

			$return = array(
				'onetone_homepage_sections' => '',
				'onetone_homepage_options' => '',
				'onetone_slideshow' => '',
				'onetone_general_option'  => '',
				'onetone_header' => '',
				'onetone_page_title_bar' => '',
				'onetone_styling' => '',
				'onetone_sidebar' =>'',
				'onetone_footer' => '',

			);
			
			return $return;
			
			}
			
		function text_validate($input)
		{
			
			$default_options = array(
				'onetone_homepage_sections' => '',
				'onetone_homepage_options' => '',
				'onetone_slideshow' => '',
				'onetone_general_option'  => '',
				'onetone_header' => '',
				'onetone_page_title_bar' => '',
				'onetone_styling' => '',
				'onetone_sidebar' =>'',
				'onetone_footer' => '',

			);
			
			$input = wp_parse_args($input,$default_options);
			
			$input['onetone_homepage_sections'] = sanitize_text_field($input['onetone_homepage_sections']);
			$input['onetone_homepage_options'] = sanitize_text_field($input['onetone_homepage_options']);
			$input['onetone_slideshow'] = sanitize_text_field($input['onetone_slideshow']);
			$input['onetone_general_option'] = sanitize_text_field($input['onetone_general_option']);
			$input['onetone_header'] = sanitize_text_field($input['onetone_header']);
			$input['onetone_page_title_bar'] = sanitize_text_field($input['onetone_page_title_bar']);
			$input['onetone_styling'] = sanitize_text_field($input['onetone_styling']);
			$input['onetone_sidebar'] = sanitize_text_field($input['onetone_sidebar']);
			$input['onetone_footer'] = sanitize_text_field($input['onetone_footer']);
			
			return $input;
		}
		
		function register_mysettings() {
			//register settings
			register_setting( 'onetone-settings-group', 'onetone_companion_options', array(&$this,'text_validate') );
		}
		
		function settings_page() {
			
			$tabs = array('customizer-sections'   => esc_html__( 'Customizer Panels', 'onetone-companion' ),);
			$current = 'customizer-sections';
			if(isset($_GET['tab']))
				$current = $_GET['tab'];
				
				$html = '<h2 class="nav-tab-wrapper">';
				foreach( $tabs as $tab => $name ){
					$class = ( $tab == $current ) ? 'nav-tab-active' : '';
					$html .= '<a class="nav-tab ' . $class . '" href="?page=onetone-companion/onetone-companion.php&tab=' . $tab . '">' . $name . '</a>';
				}
				$html .= '</h2>';
				
					?>
					<div class="wrap">
					<?php echo $html;?>
					
					<form method="post" action="options.php">
						<?php
						
						settings_fields( 'onetone-settings-group' );
						$options     = get_option('onetone_companion_options',OnetoneCompanion::default_options());
						$onetone_companion_options = wp_parse_args($options,OnetoneCompanion::default_options());
						?>
						
						<div class="oc-customizer-sections">
						<div class="oc-description"><?php _e('Disable the customizer panels that you do not have or need anymore to load it quickly.Your settings are saved, so do not worry.','onetone-companion');?></div>
		  <div class="row">
			<span><?php _e('Home Page Sections','onetone-companion');?> <input name="onetone_companion_options[onetone_homepage_sections]" type="checkbox"  <?php if($onetone_companion_options['onetone_homepage_sections']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
			<span><?php _e('Home Page Options','onetone-companion');?> <input name="onetone_companion_options[onetone_homepage_options]" type="checkbox"  <?php if($onetone_companion_options['onetone_homepage_options']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
			<span><?php _e('Slideshow','onetone-companion');?> <input name="onetone_companion_options[onetone_slideshow]" type="checkbox"  <?php if($onetone_companion_options['onetone_slideshow']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
		  </div>
		  
		 <div class="row">
			<span><?php _e('General Opions','onetone-companion');?> <input name="onetone_companion_options[onetone_general_option]" type="checkbox"  <?php if($onetone_companion_options['onetone_general_option']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
			<span><?php _e('Header','onetone-companion');?> <input name="onetone_companion_options[onetone_header]" type="checkbox"  <?php if($onetone_companion_options['onetone_header']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
			<span><?php _e('Page Title Bar','onetone-companion');?> <input name="onetone_companion_options[onetone_page_title_bar]" type="checkbox"  <?php if($onetone_companion_options['onetone_page_title_bar']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
		  </div>
		  
		  <div class="row">
			<span><?php _e('Styling','onetone-companion');?> <input name="onetone_companion_options[onetone_styling]" type="checkbox"  <?php if($onetone_companion_options['onetone_styling']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
			<span><?php _e('Sidebar','onetone-companion');?> <input name="onetone_companion_options[onetone_sidebar]" type="checkbox"  <?php if($onetone_companion_options['onetone_sidebar']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
			<span><?php _e('Footer','onetone-companion');?> <input name="onetone_companion_options[onetone_footer]" type="checkbox"  <?php if($onetone_companion_options['onetone_footer']==1 ){ ?>checked="checked"<?php }?> value="1" /></span>
		  </div>
		
			<p class="submit">
						<input type="submit" class="button-primary" value="<?php _e('Save Changes','onetone-companion') ?>" />
						</p>			
		</div>	
						
					
					</form>
					</div>
				<?php
		
		}
		
		
		function contact_form( $atts, $content = "" ) {
			$atts = shortcode_atts( array(
				'receiver' => get_option('admin_email'),
				'button_text' => __( 'Post', 'onetone-companion' ),
				'checkbox' => 0,
				'checkbox_prompt' => __( 'Please check the checkbox.', 'onetone-companion' ),
			), $atts, 'oc_contact' );
			
			extract($atts);

			$html = '<form class="contact-form" action="" method="post">
                      <input id="name" tabindex="1" name="name" size="22" type="text" value="" placeholder="'.esc_attr__('Name', 'onetone-companion').'" />
                      <input id="email" tabindex="2" name="email" size="22" type="text" value="" placeholder="'.esc_attr__('Email', 'onetone-companion').'" />
                      <textarea id="message" tabindex="4" cols="39" name="x-message" rows="7" placeholder="'.esc_attr__('Message', 'onetone-companion').'"></textarea>
					  '.(($checkbox == 1) ?'<div style="display: inline-block;width: 100%;"><input style="float: left; width: auto; margin-left:5px; margin-top: 8px;" type="checkbox" name="contact-form-checkbox" class="contact-form-checkbox" value="1" aria-invalid="false"><span class="onetone-contact-form-checkbox" style="float: left;padding-left: 15px;">'.wp_kses_post($content).'</span><span class="hide checkbox-notice" >'.wp_kses_post($checkbox_prompt).'</span></div>':'').
					  
                     '<input id="sendto" name="sendto" type="hidden" value="'.sanitize_email($receiver).'" />
                      <input id="submit" name="submit" type="button" value="'. esc_attr($button_text).'" />
                      </form>';
			return $html;
		}
		
		
		function onetone_contact(){
			
			if(trim($_POST['Name']) === '') {
				$Error = __('Please enter your name.','onetone-companion');
				$hasError = true;
			} else {
				$name = trim($_POST['Name']);
			}
		
			if(trim($_POST['Email']) === '')  {
				$Error = __('Please enter your email address.','onetone-companion');
				$hasError = true;
			} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['Email']))) {
				$Error = __('You entered an invalid email address.','onetone-companion');
				$hasError = true;
			} else {
				$email = trim($_POST['Email']);
			}
		
			if(trim($_POST['Message']) === '') {
				$Error =  __('Please enter a message.','onetone-companion');
				$hasError = true;
			} else {
				if(function_exists('stripslashes')) {
					$message = stripslashes(trim($_POST['Message']));
				} else {
					$message = trim($_POST['Message']);
				}
			}
		
			if(!isset($hasError)) {
			   if (isset($_POST['sendto']) && preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['sendto']))) {
				 $emailTo = $_POST['sendto'];
			   }
			   else{
				 $emailTo = get_option('admin_email');
				}
				
			   if($emailTo !=""){
					$subject = 'From '.$name;
					$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
					$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
		
					wp_mail($emailTo, $subject, $body, $headers);
					$emailSent = true;
				}
				echo json_encode(array("msg"=>__("Your message has been successfully sent!","onetone-companion"),"error"=>0));
				
			}
			else
			{
				echo json_encode(array("msg"=>$Error,"error"=>1));
			}
			die() ;
		}
		
		
		/*
		  *  Allow tags
		  */
		  
		  function html_tags_code() {
			  
			  global $allowedposttags;
		  
			  $allowed_atts = array(
				  'align'      => array(),
				  'class'      => array(),
				  'type'       => array(),
				  'id'         => array(),
				  'dir'        => array(),
				  'lang'       => array(),
				  'style'      => array(),
				  'xml:lang'   => array(),
				  'src'        => array(),
				  'alt'        => array(),
				  'href'       => array(),
				  'rel'        => array(),
				  'rev'        => array(),
				  'target'     => array(),
				  'novalidate' => array(),
				  'type'       => array(),
				  'value'      => array(),
				  'name'       => array(),
				  'tabindex'   => array(),
				  'action'     => array(),
				  'method'     => array(),
				  'for'        => array(),
				  'width'      => array(),
				  'height'     => array(),
				  'data'       => array(),
				  'title'      => array(),
				  'border'      => true,
				  'frameborder' => true,
				  "allowfullscreen" => array(),
				  "allowscriptaccess" => array(),
			  );
			  $allowedposttags['form']   = $allowed_atts;
			  $allowedposttags["script"] = $allowed_atts;
			  $allowedposttags['iframe'] = $allowed_atts;
			  $allowedposttags["object"] = $allowed_atts;
			  $allowedposttags["param"]  = $allowed_atts;
			  $allowedposttags['i'] = $allowed_atts;
			  $allowedposttags["embed"] = $allowed_atts;
			  $allowedposttags["style"] = $allowed_atts;
			  $allowedposttags["link"] = array("rel" => array(),"href" => array(),"id" => array(),"type" => array(),"media" => array());
			  $allowedposttags["input"] = array("name" => array(),"id" => array(),"value" => array(),"class" => array(),"placeholder" => array(),"required" => array(),"type" => array(),'aria-required' => array());
			  $allowedposttags["select"] = array("name" => array(),"id" => array(),"value" => array(),"class" => array(),"required" => array(),"type" => array(),'aria-required' => array());
			  $allowedposttags["textarea"] = array("name" => array(),"id" => array(),"value" => array(),"class" => array(),"placeholder" => array(),"required" => array(),"type" => array(),'aria-required' => array());
		  }


	  
	  }

}

new OnetoneCompanion();