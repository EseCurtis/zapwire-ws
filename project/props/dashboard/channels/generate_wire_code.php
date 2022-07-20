<!-- import jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- import prism js and css from their respective cdn -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/themes/prism.min.css">

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form action="#" class="form-horizontal form-material mx-2 row" id="wire_gen_form">
					<div class="form-group col-md-6 mb-3">
						<label class="col-md-12">Channel</label>
						<small>please select your channel</small>
						<div class="col-md-12">
							<select class="form-control form-control-line" name="channel_key">
								<?php
								foreach ($_data['all_channels'] as $channel) {
									$selected = '';

									if ($channel['ch_key'] == $_data['channel_data']['ch_key']) {
										$selected = 'selected';
									}

									echo "<option value='{$channel['ch_key']}' $selected >{$channel['path']}</option>";
								}

								?>
							</select>
						</div>
					</div>
					<br>
					<div class="form-group col-md-6 mb-3">
						<label class="col-md-12">Wire Speed (seconds)</label>
						<small>please select how fast you want your feedback on channel source update</small>
						<div class="col-md-12">
							<input class="form-control form-control-line" type="number" name="_wire_speed" id="_wire_speed" min="0.5" value="0.5">
						</div>
					</div>
					<br>
					<div class="form-group col-md-6 mb-3">
						<label class="col-md-12">Format</label>
						<small>For now we only support Javascript!</small>
						<div class="col-md-12">
							<div class="col-md-12">
								<select class="form-control form-control-line" name="format" id="_format">
									<option value="javascript" selected>Javascript</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group">
						<div class="col-sm-12">
							<button class="btn btn-info text-white">Generate</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card mt-3">
			<div class="card-body">
				<div id="generated-code">
					<div class="col-sm-12">
					<code class="language-javascript">//code will appear here</code>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	//do not usej jquery here
const _wizard = $('#wire_gen_form');

_wizard.on('submit', function(e) {
    e.preventDefault();

    //get all form data and put in their respective variables
    const _channel_key = $('#wire_gen_form select[name="channel_key"]').val();
    const _wire_speed = $('#wire_gen_form input[name="_wire_speed"]').val();
    const _format = $('#wire_gen_form select[name="format"]').val();

	//convert wire_speed to milliseconds
	const _wire_speed_ms = _wire_speed * 1000;

	let _code = ""

    switch (_format) {
        case 'javascript':

            _code = `
			import { Zapwire } from './path/to/zapwire.js'
//also you can use our cdn "<?= $app->project_info['cdn_url'] ?>"

let zw = new Zapwire()

let zw_config = {
	refreshRate : ${_wire_speed_ms}
}

zw.wire( function (response) {
	 //use your response 
	}, '${_channel_key}', zw_config )
		`;

    }

	// Returns a highlighted HTML string
	const _html = Prism.highlight(_code.replace('			', ''), Prism.languages.javascript, 'javascript');

	
	//print to the generated code div and give it functions to copy and clear 
	$('#generated-code').html(`
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<div class="col-sm-12">
										<button class="btn btn-info text-white" onclick="copyText('${escape(_code)}')">Copy</button>
										<button class="btn btn-danger text-white" id="clear-code">Clear</button>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<div class="col-sm-12">
										<pre class="language-javascript"><code class="language-javascript">${_html}</code></pre>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	`);

	//give functionality to clear button
	$('#clear-code').on('click', function() {
		$('#generated-code').html(`<pre class="language-javascript">
							<code class="language-javascript">
								//code will appear here
							</code>
						</pre>`);
	});

})


//create a copy text function and report feedback with sweet alert form at is copyText('text')
function copyText(text) {
	text = unescape(text);
	const el = document.createElement('textarea');
	el.value = text;
	document.body.appendChild(el);
	el.select();
	document.execCommand('copy');
	document.body.removeChild(el);

	Swal.fire({
		icon: 'success',
		title: "Copied!",
		text: "The code has been copied to your clipboard.",
		icon: "success",
	});
}
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/prism.min.js"></script>