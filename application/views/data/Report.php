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
						</div>
						<div class="row">
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
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Pencipta</label>
									<input type="text" name="Pencipta" class="form-control" placeholder="Input Pencipta">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Partner</label>
									<input type="text" name="Partner" class="form-control" placeholder="Input Partner">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Artis</label>
									<input type="text" name="Artis" class="form-control" placeholder="Input Artis">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label">Nama Chanel Marketing</label>
									<input type="text" name="NmChanel" class="form-control" placeholder="Input NmChanel">
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
			if ($('input[name="co_sing"]').val() == "" && $('input[name="Partner"]').val() == "") {toastr.error('Singer or Partner Required','!Failed');return;}
			var url = base_url_js+'datadata/excel';
			FormSubmitAuto(url, 'POST', [
			    { name: 'co_sing', value: $('input[name="co_sing"]').val() },
			    { name: 'co_title', value: $('input[name="co_title"]').val() },
			    { name: 'Pencipta', value: $('input[name="Pencipta"]').val() },
			    { name: 'Partner', value: $('input[name="Partner"]').val() },
			    { name: 'Artis', value: $('input[name="Artis"]').val() },
			    { name: 'NmChanel', value: $('input[name="NmChanel"]').val() },
			    { name: 'TypeTelcoExport', value: $("#TypeTelcoData").val() },
			]);
		})
		
		Autocomplete('input[name="co_sing"]');
		Autocomplete_search('input[name="co_title"]');
		Autocomplete_search('input[name="Pencipta"]');
		Autocomplete_search('input[name="Partner"]');
		Autocomplete_search('input[name="Artis"]');
		Autocomplete_search('input[name="NmChanel"]');
	}); // exit document Function

	function Autocomplete(element)
	{
		$(element).autocomplete({
          minLength: 3,
          select: function (event, ui) {
            event.preventDefault();
            var selectedObj = ui.item;
            var getco_title = selectedObj.label;
            $('input[name="co_sing"]').val(selectedObj.value); 
            //$('input[name="co_title"]').val(getco_title[1]); 
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

	function Autocomplete_search(element)
	{
		$(element).autocomplete({
          minLength: 1,
          select: function (event, ui) {
            event.preventDefault();
            var selectedObj = ui.item;
            var getco_title = selectedObj.label;
            $(element).val(selectedObj.value);
          },
          source:
          function(req, add)
          {
            var url = base_url_js+'Autocomplete_search';
            var Nama = $(element).val();
            var postdata = {};
            var attrname = $(element).attr('name');
	            $('input').each(function(){
	            	if(typeof $(this).attr('name') !== "undefined")
	            	{
	            	  var valuee = $(this).val();
	            	  var field = $(this).attr('name');
	            	  postdata[field] = valuee;
	            	} 
	            	
	            })
            $.post(url,{attrname:attrname,postdata:postdata,Nama:Nama,TypeTelcoExport : $("#TypeTelcoData").val()},function (data_json) {
                var obj = JSON.parse(data_json);
                add(obj.message) 
            })
          } 
        })
	}
</script>