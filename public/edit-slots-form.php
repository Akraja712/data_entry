<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php

if (isset($_GET['id'])) {
	$ID = $db->escapeString($_GET['id']);
} else {
	// $ID = "";
	return false;
	exit(0);
}
if (isset($_POST['btnEdit'])) {

    $total_income = $db->escapeString(($_POST['total_income']));
    $plan_id = $db->escapeString(($_POST['plan_id']));
    $total_ratings = $db->escapeString(($_POST['total_ratings']));
	$error = array();

		$sql_query = "UPDATE slots SET total_income='$total_income',total_ratings='$total_ratings',plan_id='$plan_id' WHERE id =  $ID";
		$db->sql($sql_query);
		$update_result = $db->getResult();
		if (!empty($update_result)) {
			$update_result = 0;
		} else {
			$update_result = 1;
		}

		// check update result
		if ($update_result == 1) {
			$error['update_languages'] = " <section class='content-header'><span class='label label-success'>Slots updated Successfully</span></section>";
		} else {
			$error['update_languages'] = " <span class='label label-danger'>Failed to Update</span>";
		}
	}


// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM slots WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();

if (isset($_POST['btnCancel'])) { ?>
	<script>
		window.location.href = "slots.php";
	</script>
<?php } ?>
<section class="content-header">
	<h1>
		Edit Slots<small><a href='slots.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Slots</a></small></h1>
	<small><?php echo isset($error['update_languages']) ? $error['update_languages'] : ''; ?></small>
	<ol class="breadcrumb">
		<li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
	</ol>
</section>
<section class="content">
	<!-- Main row -->

	<div class="row">
		<div class="col-md-10">

			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				</div><!-- /.box-header -->
				<!-- form start -->
				<form id="edit_languages_form" method="post" enctype="multipart/form-data">
					<div class="box-body">
					   <div class="row">
						    <div class="form-group">
                            <div class="col-md-6">
                                    <label for="exampleInputEmail1">Select Plan</label> <i class="text-danger asterik">*</i>
                                    <select id='plan_id' name="plan_id" class='form-control'>
                                           <option value="">--Select--</option>
                                                <?php
                                                  $sql = "SELECT id, products FROM `plan`";
                                                $db->sql($sql);

                                                $result = $db->getResult();
                                                foreach ($result as $value) {
                                                ?>
                                                    <option value='<?= $value['id'] ?>' <?= $value['id']==$res[0]['plan_id'] ? 'selected="selected"' : '';?>><?= $value['products'] ?></option>
                                                    
                                                <?php } ?>
                                    </select>
                                  </div>
                                <div class="col-md-6">
									<label for="exampleInputEmail1">Total Income</label><i class="text-danger asterik">*</i>
									<input type="number" class="form-control" name="total_income" value="<?php echo $res[0]['total_income']; ?>">
                                 </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
						    <div class="form-group">
                                <div class="col-md-6">
									<label for="exampleInputEmail1">Total Ratings</label><i class="text-danger asterik">*</i>
									<input type="number" class="form-control" name="total_ratings" value="<?php echo $res[0]['total_ratings']; ?>">
								</div>
                            </div>
                        </div>
                    </div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary" name="btnEdit">Update</button>

					</div>
				</form>
			</div><!-- /.box -->
		</div>
	</div>
</section>

<div class="separator"> </div>
<?php $db->disconnect(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>