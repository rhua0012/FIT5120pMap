<?php
global $wpdb;
$table_name = $wpdb->prefix . 'est_cta_settings';
//get all the row from the database
$est_lists = $wpdb->get_row("SELECT * FROM $table_name ORDER BY ID ASC");
$plugin_settings = maybe_unserialize( $est_lists->plugin_settings, ARRAY_A);
?>
<div class="wrap est-wrap">
  <div class="est-header-wrap">
      <h3><span class="est-admin-title"><?php esc_attr_e( 'All Tabs', 'easy-side-tab' ); ?></span></h3>
      <div class="logo">
          <img src="<?php echo EST_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('AccessPress Social Icons', 'easy-side-tab'); ?>">
      </div>
  </div>

  <table class="widefat est-tab-list-table" style="margin-top:12px;">
    <thead>
    <tr>
      <th><?php _e( 'S.N', 'easy-side-tab' ); ?></th>
      <th class="row-title"><?php esc_attr_e( 'Side Tab Name', 'easy-side-tab' ); ?></th>
      <th><?php _e('Tab Type', 'easy-side-tab'); ?></th>
      <th><?php _e( 'Template', 'easy-side-tab' ); ?></th>
      <th><?php esc_attr_e( 'Action', 'easy-side-tab' ); ?></th>
    </tr>
    </thead>

    <tbody>
    <?php $count = 1; ?>
    <?php //foreach ($est_lists as $est_list) { ?>
    <tr class="alternate">
      <td><?php echo $count; ?></td>
      <td class="row-title">
        <label for="tablecell">
          <a href="<?php echo admin_url().'admin.php?page=est-admin&action=edit-tab&id='.$est_lists->id; ?>"><?php echo esc_attr_e($est_lists->name); ?></a> 
        </label>
      </td>
      <td><?php esc_attr_e( $plugin_settings['tab']['tab_settings']['tab_content']['type'], 'easy-side-tab' ); ?></td>
      <td><?php esc_attr_e( $plugin_settings['tab']['layout_settings']['template'], 'easy-side-tab' ); ?></td>
      <td>
          <div class="est-action-btn-wrap">
              <a href="<?php echo admin_url().'admin.php?page=est-admin&action=edit-tab&id='.$est_lists->id; ?>" class="button-secondary est-button-secondary" title="Edit Tab"></a>
          </div> 
      </td>
    </tr>
    <?php //$count++; } ?>
    </tbody>
    <tfoot>
    <tr>
      <th><?php _e('S.N','easy-side-tab'); ?></th>
      <th class="row-title"><?php esc_attr_e( 'Side Tab Name', 'easy-side-tab' ); ?></th>
      <th><?php _e('Tab Type', 'easy-side-tab'); ?></th>
      <th><?php _e( 'Template', 'easy-side-tab' ); ?></th>
      <th><?php esc_attr_e( 'Action', 'easy-side-tab' ); ?></th>
    </tr>
    </tfoot>
  </table>
</div>
