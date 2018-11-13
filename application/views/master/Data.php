<div class="row">
	<div class="col-md-12">
		<div class="col-md-6 col-md-offset-3">
			<div class="thumbnail">
				<div class="row">
					<div class="col-md-12" align="center">
						<h4>Import Master</h4>
					</div>
				</div>
				<div class="row" style="margin-top: 10px">
					<div class="col-md-8 col-md-offset-2">
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label">Type</label>
							    <select name = "TypeTelcoMaster" class="form-control" id = "TypeTelcoMaster">
							        <option value="telkom" selected>Telkom Prodigi</option>
							        <option value="telkom_proa">Telkom Proaktif</option>
							        <option value="xl">XL Prodigi</option>
							        <option value="xl_proa">XL Proaktif</option>
							        <option value="isat_proa">Isat Proaktif</option>
							    </select>
							</div>    
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label class="control-label">Upload File:</label>
								<input type="file" data-style="fileinput" id="ExFile">
							</div>
						</div>
						<div class="col-md-2">
							<br>
							<button class="btn btn-primary" id="btn-proses">Proses</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#btn-proses").click(function(){
			$body = $("body");
			$body.addClass("loading");
				  if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
			  		toastr.error('The File APIs are not fully supported in this browser.', 'Failed!!');
			  		$body.removeClass("loading");  
			        return;
			      }   

			      input = document.getElementById('ExFile');
			      if (!input) {
			        toastr.error('Um, couldnot find the fileinput element.', 'Failed!!');
			        $body.removeClass("loading");  
			      }
			      else if (!input.files) {
			        toastr.error('This browser doesnot seem to support the `files', 'Failed!!');
			       $body.removeClass("loading");  
			      }
			      else if (!input.files[0]) {
			        toastr.error('Please select a file before clicking Proses', 'Failed!!');
			        $body.removeClass("loading");  
			      }
			      else {
			      	var files = $('#ExFile')[0].files;
			      	var name = files[0].name;
			      	var extension = name.split('.').pop().toLowerCase();
			      	console.log(extension);
			      	if(extension == 'xlsx')
			      	{
			      	 processFile();
			      	}
			      	else
			      	{
			      		toastr.error('Extension file is not support', 'Failed!!');
			      		$body.removeClass("loading");  
			      	}
		          	

			      }
		})
	}); // exit document Function

	function processFile()
	{
		var form_data = new FormData();
		var fileData = document.getElementById("ExFile").files[0];
		var url = base_url_js + "master/upload/data";
		form_data.append('fileMaster',fileData);
		form_data.append('TypeTelcoMaster',$("#TypeTelcoMaster").val());
	  	$.ajax({
	  	  type:"POST",
	  	  url:url,
	  	  data: form_data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
	  	  contentType: false,       // The content type used when sending data to the server.
	  	  cache: false,             // To unable request pages to be cached
	  	  processData:false,
	  	  dataType: "json",
	  	  success:function(data)
	  	  {
	  	    if(data.status == 1) {
	  	    	toastr.options.fadeOut = 100000;
	  	    	toastr.success(data.msg, 'Success!');
	  	    }
	  	    else
	  	    {
	  	    	toastr.options.fadeOut = 100000;
	  	    	toastr.error(data.msg, 'Failed!!');
	  	    }
	    	setTimeout(function () {
	         toastr.clear();
	     	},1000);
	    	$body.removeClass("loading");
	 		
	  	  },
	  	  error: function (data) {
	  	    toastr.error("Format file is not match, Please try again", 'Error!!');
	  	    $body.removeClass("loading");
	  	  }
	  	})
	}	
</script>