<?php
/**
 * Mediclinic Lite About Theme
 *
 * @package Mediclinic Lite
 */

//about theme info
add_action( 'admin_menu', 'mediclinic_lite_abouttheme' );
function mediclinic_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'mediclinic-lite'), __('About Theme Info', 'mediclinic-lite'), 'edit_theme_options', 'mediclinic_lite_guide', 'mediclinic_lite_mostrar_guide');   
} 

//Info of the theme
function mediclinic_lite_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		<div class="heading-gt">
		 <h3><?php esc_html_e('About Theme Info', 'mediclinic-lite'); ?></h3>
		</div>
       <p><?php esc_html_e('Mediclinic Lite is a free healthcare WordPress theme that is fully responsive and SEO friendly. It is specially designed to create websites for doctors, hospitals, therapists, surgeons, medical facilities, clinics, dentists, pharmacies and other such audience. With its beautiful design and easy to use structure, you can quickly develop a professional website for your medical organization. This theme is comes with attractive homepage layout so you dont need to perform much customization works.', 'mediclinic-lite'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'mediclinic-lite'); ?></div>
 

<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'mediclinic-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'mediclinic-lite'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'mediclinic-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'mediclinic-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'mediclinic-lite'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'mediclinic-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'mediclinic-lite'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'mediclinic-lite'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
<div class="gt-right">    
     <a href="http://www.gracethemesdemo.com/mediclinic/" target="_blank"><?php esc_html_e('Live Demo', 'mediclinic-lite'); ?></a> | 
     <a href="http://www.gracethemesdemo.com/documentation/mediclinic/#homepage-lite" target="_blank"><?php esc_html_e('Documentation', 'mediclinic-lite'); ?></a>    
</div><!-- .gt-right-->
<div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>