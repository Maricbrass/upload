<?php echo $header; ?>
<?php echo $column_left; ?>
<head>
</head>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-employee" data-toggle="tooltip" title="<?php echo $button_save; ?>"
          class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
          class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1>
        <?php echo $heading_title; ?>
      </h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>
        <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i>
          <?php echo $text_form; ?>
        </h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-employee"
          class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">
              <?php echo $emp_name; ?>
            </label>
            <div class="col-sm-10">
              <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $emp_name; ?>"
                id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
                <div class="text-danger">
                  <?php echo $error_name; ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">
              <?php echo $emp_email; ?>
            </label>
            <div class="col-sm-10">
              <input type="email" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $emp_email; ?>"
                id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
                <div class="text-danger">
                  <?php echo $error_name; ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">
              <?php echo $emp_password; ?>
            </label>
            <div class="col-sm-10">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $emp_password; ?>"
                id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
                <div class="text-danger">
                  <?php echo $error_name; ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">
              <?php echo $emp_address; ?>
            </label>
            <div class="col-sm-10">
              <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo $emp_address; ?>"
                id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
                <div class="text-danger">
                  <?php echo $error_name; ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name">
              <?php echo $emp_gender;
              //$sel = $emp_gender;
            ?>
            </label>
            <select name="gender" id="gender" >
              <!-- <option value="male" <?php if($gender==='male') "selected";?>>Male</option>
              <option value="female" <?php if($gender==='female') "selected";?>>Female</option>
              <option value="other" <?php if($gender==='other') "selected";?>>Other</option> -->

              <option value="male" >Male</option>
              <option value="female" >Female</option>
              <option value="other" >Other</option>
              <option value="<?php echo $gender; ?>" selected hidden="hidden"><?php echo $gender; ?></option>
            </select>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<?php echo $footer; ?>