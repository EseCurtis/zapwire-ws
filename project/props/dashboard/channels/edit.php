<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form-horizontal form-material mx-2" action="amvc.api" api-key="channel/update.php" callback="formHandler" method="post" async="true">
					<div class="form-group">
						<label class="col-md-12">Path</label>
						<div class="col-md-12">
                            <input type="hidden" name="ch_id" value="<?=$_data['id']?>">
						<input type="text" placeholder="https://domain.com" class="form-control form-control-line" name="path" value="<?=$_data['path']?>"> </div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Authorized Hostnames</label>
						<small>please seperate with commas</small>
						<div class="col-md-12">
							<input type="text" placeholder="https://domain.com" class="form-control form-control-line" name="authorized_hostnames" value="<?=$_data['authorized_hostnames']?>"> 
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-12">Headers</label>
						<small>Please seperate with commas. leave blank If you don't need a header.</small>
						<div class="col-md-12">
							<input type="text" placeholder='{"custom-header": "value"}' class="form-control form-control-line" name="headers" value="<?=$_data['headers']?>"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-success text-white">Update Channel</button>
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