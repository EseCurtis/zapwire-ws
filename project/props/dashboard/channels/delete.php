<div class="row">
	<div class="col-12">
	<div class="card">
		<div class="card-body">
			<h3>Are you sure you want to delete the channel with path [<?=$_data['path']?>]</h3>
			<form class="form-horizontal form-material mx-2" action="amvc.api" api-key="channel/delete.php" callback="formHandler" method="post" async="true">
					<div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" name="ch_id" value="<?=$_data['ch_id']?>">
                        </div>
                    </div>
					<div class="form-group row">
						<div class="col-sm-2">
							<button class="btn btn-danger text-white">Yes</button>
							<a class="btn btn-success text-white" href="<?=$app->url('dashboard/')?>">Cancel</a>
						</div>
					</div>
				</form>
		</div>
	</div>
	</div>
</div>

<script>
	handlers();
</script>