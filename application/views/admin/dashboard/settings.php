   <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Settings
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Settings</li>
          </ol>
        </section>
		<!-- Main content -->
       
          
		 <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-6">
              <div class="box">
                <div class="box-header">
				<?php if($this->session->flashdata('msg')):?>
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <?php echo $this->session->flashdata('msg'); ?>
					</div>
				<?php endif; ?>
				<?php if($this->session->flashdata('error')):?>
					<div class="alert alert-danger alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>
                </div><!-- /.box-header -->
                <div class="box-body">
					<form role="form" action="" method="POST">
					  <div class="box-body">
						<div class="form-group">
                                                    <input name="fake1" type="email" value="" class="hidden" />
                                                  <input name="fake2" type="password" value="" class="hidden" />
						  <label for="old_password">Old Password</label>
						  <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password">
						  <span style="color:red;"><?php echo form_error('old_password'); ?></span>
						</div>
						<div class="form-group">
						  <label for="new_password">New Password</label>
						  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
						  <span style="color:red;"><?php echo form_error('new_password'); ?></span>
						</div>
						<div class="form-group">
						  <label for="confirm_new_password">Confirm New Password</label>
						  <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Enter New Password Again">
						  <span style="color:red;"><?php echo form_error('confirm_new_password'); ?></span>
						</div>
					  </div>
					  <!-- /.box-body -->

					  <div class="box-footer1">
						<button type="submit" class="btn btn-primary">Submit</button>
					  </div>
					</form>
				</div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      