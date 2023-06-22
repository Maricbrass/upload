<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default" onclick="$('#form-product').attr('action', '<?php echo $copy; ?>').submit()"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-employee').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-name"><?php echo $column_name; ?></label>
                <input type="text" name="name" value="<?php echo $name;?>"  placeholder="<?php echo $column_name; ?>" id="input-name" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-model"><?php echo $column_address; ?></label>
                <input type="text" name="address" value="<?php echo $address;?>" placeholder="<?php echo $column_address; ?>" id="input-model" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-price"><?php echo $column_email; ?></label>
                <input type="text" name="email" value="<?php echo $email;?>" placeholder="<?php echo $column_email; ?>" id="input-price" class="form-control" />
              </div>
              <!-- <div class="form-group">
                <label class="control-label" for="input-quantity"><?php echo $column_address; ?></label>
                <input type="text" name="filter_quantity"  placeholder="<?php echo $column_address; ?>" id="input-quantity" class="form-control" />
              </div> -->
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-status"><?php echo $column_gender; ?></label>
                <select name="gender" id="input-status" class="form-control" value="<?php echo $gender;?>">
                  <option value="null">Select</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                    <option value="other">Other</option>
   
                </select>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button><br><br><br>
              <button type="button" id="button-clear" class="btn btn-primary pull-right"><i class="fa fa-trash-o"></i> <?php echo $button_clear; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-employee">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 'name') { ?>
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'email') { ?>
                    <a href="<?php echo $sort_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_email; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_email; ?>"><?php echo $column_email; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'address') { ?>
                    <a href="<?php echo $sort_address; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_address; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_address; ?>"><?php echo $column_address; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'gender') { ?>
                    <a href="<?php echo $sort_gender; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_gender; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_gender; ?>"><?php echo $column_gender; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($employees) { ?>
                <?php foreach ($employees as $employee) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($employee['employee_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $employee['employee_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $employee['employee_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $employee['name']; ?></td>
                  <td class="text-left"><?php echo $employee['email']; ?></td>
                  <td class="text-left"><?php echo $employee['address']; ?></td>
                  <td class="text-left"><?php echo $employee['gender']; ?></td>
                  <td class="text-left"><a href="<?php echo $employee['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
$('#button-filter').on('click', function() {
	var url = 'index.php?route=catalog/employee&token=<?php echo $token; ?>';

	var name = $('input[name=\'name\']').val();

	if (name) {
		url += '&name=' + encodeURIComponent(name);
	}

	var email = $('input[name=\'email\']').val();

	if (email) {
		url += '&email=' + encodeURIComponent(email);
	}

	var address = $('input[name=\'address\']').val();

	if (address) {
		url += '&address=' + encodeURIComponent(address);
	}

	var gender = $('select[name=\'gender\']').val();

	if (gender != 'null') {
   // document.write("ywegfyugwuigfyuwgfuygwyfgvywgfygeygaweufyguirfgeruigfuig")
		url += '&gender=' + encodeURIComponent(gender);
    if(url == 'index.php?route=catalog/employee&token=<?php echo $token; ?>&gender=null'){
      url = 'index.php?route=catalog/employee&token=<?php echo $token; ?>';
    }
	}


	// var filter_status = $('select[name=\'filter_status\']').val();

	// if (filter_status != '*') {
	// 	url += '&filter_status=' + encodeURIComponent(filter_status);
	// }
	location = url;
});
</script>
  <script type="text/javascript"><!--
$('input[name=\'name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/employee/autocomplete&token=<?php echo $token; ?>&name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['name']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'name\']').val(item['label']);
	}
});

$('input[name=\'email\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/employee/autocomplete&token=<?php echo $token; ?>&email=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['email'],
						value: item['email']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'email\']').val(item['label']);
	}
});

$('input[name=\'address\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/employee/autocomplete&token=<?php echo $token; ?>&address=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['address'],
						value: item['address']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'address\']').val(item['label']);
	}
});
//--></script>

<script type="text/javascript">
$('#button-clear').on('click', function() {
	var url = 'index.php?route=catalog/employee&token=<?php echo $token; ?>';
  location = url;
});
</script>

</div>
<?php echo $footer; ?>