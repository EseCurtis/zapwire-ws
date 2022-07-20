<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="form-horizontal form-material mx-2" action="amvc.api" api-key="channel/create.php" callback="formHandler" method="post" async="true">
					<div class="form-group">
						<label class="col-md-12">Path</label>
						<div class="col-md-12">
						<input type="text" placeholder="https://domain.com" class="form-control form-control-line" name="path"> </div>
					</div>
					<br>
					<div class="form-group">
						<label class="col-md-12">Authorized Hostnames</label>
						<small>please seperate with commas</small>
						<div class="col-md-12">
							<input type="text" placeholder="https://domain.com" class="form-control form-control-line" name="authorized_hostnames"> 
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="col-md-12">Headers</label>
						<small>use the format (header_parameter = header_value)</small>
						<small>seperate with commas</small>
						<div class="col-md-12">
						<div class="col-md-12">
							<input type="text" placeholder='origin-x = website.com, origin-y ...' class="form-control form-control-line" name="headers" value="<?=$_data['headers']?>"/>
						</div>
						</div>
					</div>
					<br>
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-success text-white">Create Channel</button>
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