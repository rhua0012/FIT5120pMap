<button title="<?php _e('Edit', GMP_LANG_CODE)?>" type="button" data-shape_id="<?php echo $this->shape['id']; ?>" class="button button-small egm-shape-edit" style="margin-right: 5px;" onclick="gmpShapeEditBtnClick(this); return false;"><i class="fa fa-fw fa-pencil"></i></button><button title="<?php _e('Delete', GMP_LANG_CODE)?>" type="button" data-shape_id="<?php echo $this->shape['id']; ?>" class="button button-small egm-shape-remove" onclick="gmpShapeDelBtnClick(this); return false;"><i class="fa fa-fw fa-trash-o"></i></button>