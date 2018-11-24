<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="thumbnail">
				<div class="row">
					<div class="col-md-12" align="center">
						<h4>Report</h4>
					</div>
				</div>
				<div class="row" style="margin-top: 10px">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Type</label>
								    <select name = "TypeTelcoMaster" class="form-control" id = "TypeTelcoData">
								        <option value="telkom" selected>Telkom Prodigi</option>
								        <option value="telkom_proa">Telkom Proaktif</option>
								        <option value="xl">XL Prodigi</option>
								        <option value="xl_proa">XL Proaktif</option>
								        <option value="isat_proa">Isat Proaktif</option>
								    </select>
								</div>    
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Singer</label>
									<input type="text" name="co_sing" class="form-control" placeholder="Input Singer">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Title</label>
									<input type="text" name="co_title" class="form-control" placeholder="Input Title">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<button class="btn btn-primary" id = "Excel">Excel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#Excel").click(function(){
			if ($('input[name="co_sing"]').val() == "") {toastr.error('Singer Required','!Failed');return;}
			var url = base_url_js+'datadata/excel';
			FormSubmitAuto(url, 'POST', [
			    { name: 'co_sing', value: $('input[name="co_sing"]').val() },
			    { name: 'co_title', value: $('input[name="co_title"]').val() },
			    { name: 'TypeTelcoExport', value: $("#TypeTelcoData").val() },
			]);
		})
		
		Autocomplete('input[name="co_sing"]');
		Autocomplete('input[name="co_title"]');
	}); // exit document Function

	function Autocomplete(element)
	{
		$(element).autocomplete({
          minLength: 3,
          select: function (event, ui) {
            event.preventDefault();
            var selectedObj = ui.item;
            var getco_title = selectedObj.label;
            getco_title = getco_title.split('|');
            $('input[name="co_sing"]').val(selectedObj.value); 
            $('input[name="co_title"]').val(getco_title[1]); 
          },
          source:
          function(req, add)
          {
            var url = base_url_js+'Autocompleteco_sing';
            var Nama = $(element).val();
            $.post(url,{Nama:Nama,TypeTelcoExport : $("#TypeTelcoData").val()},function (data_json) {
                var obj = JSON.parse(data_json);
                add(obj.message) 
            })
          } 
        })
	}
</script>