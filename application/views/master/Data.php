<div class="row">
	<div class="col-md-12">
		<div class="col-md-8 col-md-offset-2">
			<div class="thumbnail">
				<div class="row">
					<div class="col-md-12" align="center">
						<h4>Import Master</h4>
					</div>
				</div>
				<div class="row" style="margin-top: 10px">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
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
				<div class="row" style="margin-top: 10px">
					<div class="col-md-10 col-md-offset-1">
						<a href="<?php echo base_url().'filedownload/template_master.xlsx' ?>">File Template</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12" >
		<div class="panel panel-primary">
	        <div class="panel-heading clearfix">
	            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Data</h4>
	        </div>
	        <div class="panel-body">
	            <div id = "ContentData">
	            	
	            </div>           
	        </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var passElementtbl = '';
	$(document).ready(function() {
		FuncGetTypeDatahtml();
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

	function FuncGetTypeDatahtml()
	{
		var OPdtmastertype = '<div class="form-group">'+
									'<label class="control-label">Type</label>'+
								    '<select name = "TypeTelcoMaster" class="form-control" id = "TypeTelcoMasterSearch">'+
								        '<option value="telkom" selected>Telkom Prodigi</option>'+
								        '<option value="telkom_proa">Telkom Proaktif</option>'+
								        '<option value="xl">XL Prodigi</option>'+
								        '<option value="xl_proa">XL Proaktif</option>'+
								        '<option value="isat_proa">Isat Proaktif</option>'+
								    '</select>'+
							'</div>'
							;	
		// make content
		var html = '<div class = "row">'+
						'<div class="col-md-4 col-md-offset-4">'+
							'<div class="thumbnail">'+
								'<div class = "row">'+
									'<div class = "col-md-12">'+
										OPdtmastertype+
									'</div>'+	
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'				
					;

		html += '<div class = "row" id = "PageTable" style = "margin-top : 15px">' +
						
				'</div>';
			$("#ContentData").empty();
			$("#ContentData").html(html);
			var TypeData = $("#TypeTelcoMasterSearch").val();
			var auth = 'all';
		getDtTableData('#PageTable',TypeData,auth);	
		funcEventTypeTelcoMasterSearch();
		FunctEvdataMaster('#PageTable');							
	}

	function funcEventTypeTelcoMasterSearch()
	{
		$("#TypeTelcoMasterSearch").change(function(){
			var TypeData = $("#TypeTelcoMasterSearch").val();
			var auth = 'all';
			getDtTableData('#PageTable',TypeData,auth);
		})
	}

	function getDtTableData(element,TypeData,auth)
	{
		$(".rowSaveTbl").remove();
		$(element).empty();
		if (auth == 'all') {
			// check button existing
			if (!$(".btn-add").length) {
				var Action = '<div class = "row" style = "margin-top : 10px">'+
								'<div class = "col-xs-2">'+
									'<button type="button" class="btn btn-default btn-add"> <i class="icon-plus"></i> Add</button>'+
								'</div>'+
								'<div class = "col-xs-2">'+
									'<button type="button" class="btn btn-warning btn-edit"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>'+
								'</div>'+
								'<div class = "col-xs-2">'+
									'<button type="button" class="btn btn-danger btn-clear-tbl"> <i class="fa fa-trash" aria-hidden="true"></i> Clear Master</button>'+	
								'</div>'+
							'</div>';
			}
			else
			{
				var Action = '';
			}
			
		}
		else
		{
			var Action = '';
		}
		$(element).before(Action);
		var html = '<div class = "col-md-12">'+
						'<div class="table-responsive">'+
							'<table class="table table-bordered tableData" id ="tableMaster">'+
							'<thead>'+
								'<tr>'+
									'<th>No</th>'+				
									'<th>Co Singer</th>'+
									'<th>Co Title</th>'+
									'<th>Revenue Prodigi</th>'+
									'<th>Share Partner</th>'+
									'<th>Share Prodigi</th>'+
									'<th>Royalti Artis</th>'+
									'<th>Royal Pencipta</th>'+
									'<th>Marketing Chanel</th>'+
									'<th>Nama Pencipta</th>'+
									'<th>Nama Artis</th>'+
									'<th>Nama Partner</th>'+
									'<th>Nama Marketing Chanel</th>'+
									'<th>Action</th>'+
								'</tr>'+
							'</thead>'+
							'<tbody>'+
							'</tbody>'+
							'</table>'+
						'</div>'+
					'</div>';
		$(element).html(html);

		// make datatable server side
		$.fn.dataTable.ext.errMode = 'throw';
		//alert('hsdjad');
		$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
		          {
		              return {
		                  "iStart": oSettings._iDisplayStart,
		                  "iEnd": oSettings.fnDisplayEnd(),
		                  "iLength": oSettings._iDisplayLength,
		                  "iTotal": oSettings.fnRecordsTotal(),
		                  "iFilteredTotal": oSettings.fnRecordsDisplay(),
		                  "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
		                  "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		              };
		          };

		var dataTable = $('#tableMaster').DataTable( {
		    "processing": true,
		    "destroy": true,
		    "serverSide": true,
		    "iDisplayLength" : 5,
		    "ordering" : false,
		    "ajax":{
		        url : base_url_js+"masterdata", // json datasource
		        ordering : false,
		        type: "post",  // method  , by default get
		        data : {TypeData : TypeData,auth : auth},
		        error: function(){  // error handling
		            $(".employee-grid-error").html("");
		            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
		            $("#employee-grid_processing").css("display","none");
		        },
		    },
		    'createdRow': function( row, data, dataIndex ) {
		          $(row).attr('class', 'rowData');
	              $( row ).find('td:eq(1)')
	                          .attr('class', 'Co_singer')	
	                          .attr('fill', data[1])
	                          .attr('IDPri', data[14]);
	              $( row ).find('td:eq(2)')
	                          .attr('class', 'Co_title')            
	                          .attr('fill', data[2]);            
		           $( row ).find('td:eq(3)')
		                       .attr('class', 'RevenueProdigi')            
		                       .attr('fill', data[3].substr(0, data[3].indexOf('%')));
		           $( row ).find('td:eq(4)')
		                       .attr('class', 'SharePartner')            
		                       .attr('fill', data[4].substr(0, data[4].indexOf('%')));
		            $( row ).find('td:eq(5)')
		                        .attr('class', 'ShareProdigi')            
		                        .attr('fill', data[5].substr(0, data[5].indexOf('%'))); 
		            $( row ).find('td:eq(6)')
		                        .attr('class', 'RoyaltiArtis')            
		                        .attr('fill', data[6].substr(0, data[6].indexOf('%')));
		            $( row ).find('td:eq(7)')
		                        .attr('class', 'RoyalPencipta')            
		                        .attr('fill', data[7].substr(0, data[7].indexOf('%')));
		            $( row ).find('td:eq(8)')
		                        .attr('class', 'MarketingChanel')            
		                        .attr('fill', data[8].substr(0, data[8].indexOf('%')));
		            $( row ).find('td:eq(9)')
		                        .attr('class', 'Pencipta')            
		                        .attr('fill', data[9]);
		            $( row ).find('td:eq(10)')
		                        .attr('class', 'Artis')            
		                        .attr('fill', data[10]);  
		            $( row ).find('td:eq(11)')
		                        .attr('class', 'Partner')            
		                        .attr('fill', data[11]);
		            $( row ).find('td:eq(12)')
		                        .attr('class', 'NmChanel')            
		                        .attr('fill', data[12]);                           

		    },
		} );
		passElementtbl = dataTable;

		$('#tableMaster').on('click', '.btn-delete', function(){
          var ID = $(this).attr('code');
           $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Are you sure ? </b><br> ' +
               '<button type="button" id="confirmYesDelete" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
               '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
               '</div>');
           $('#NotificationModal').modal('show');
               $("#confirmYesDelete").click(function(){
                $('#NotificationModal .modal-header').addClass('hide');
                $('#NotificationModal .modal-body').html('<center>' +
                    '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
                    '                    <br/>' +
                    '                    Loading Data . . .' +
                    '                </center>');
                $('#NotificationModal .modal-footer').addClass('hide');
                $('#NotificationModal').modal({
                    'backdrop' : 'static',
                    'show' : true
                });
                var url = base_url_js+'masterdata/submit';
                var aksi = "delete";
                var data = {
                    Action : aksi,
                    CDID : ID,
                    TypeData : $("#TypeTelcoMasterSearch").val(),
                };
                $.post(url,{data:data},function (data_json) {
                    setTimeout(function () {
                       toastr.options.fadeOut = 10000;
                       toastr.success('Data berhasil disimpan', 'Success!');
                       var TypeData = $("#TypeTelcoMasterSearch").val();
                       var auth = 'all';
                       getDtTableData(element,TypeData,auth);
                       $('#NotificationModal').modal('hide');
                    },500);
                });
               })
       });

	}

	function FunctEvdataMaster(element)
	{
		// clear tbl master
			$(".btn-clear-tbl").click(function(){
				$('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Are you sure ? </b><br> ' +
				               '<button type="button" id="confirmYesDelete" class="btn btn-primary" style="margin-right: 5px;">Yes</button>' +
				               '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
				               '</div>');
				           $('#NotificationModal').modal('show');
	               $("#confirmYesDelete").click(function(){
	                $('#NotificationModal .modal-header').addClass('hide');
	                $('#NotificationModal .modal-body').html('<center>' +
	                    '                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>' +
	                    '                    <br/>' +
	                    '                    Loading Data . . .' +
	                    '                </center>');
	                $('#NotificationModal .modal-footer').addClass('hide');
	                $('#NotificationModal').modal({
	                    'backdrop' : 'static',
	                    'show' : true
	                });

    				var Action = 'cleartbl';
                    var url = base_url_js+'masterdata/submit';
                    var data = {
                        Action : Action,
                        TypeData : $("#TypeTelcoMasterSearch").val(),
                    };
                    $.post(url,{data:data},function (resultJson) {
                      var TypeData = $("#TypeTelcoMasterSearch").val();
                      var auth = 'all';
                      getDtTableData(element,TypeData,auth);	 	
                      $('#NotificationModal').modal('hide');
                    }).fail(function() {
                      toastr.info('Error Processing'); 
                      $('#NotificationModal').modal('hide');
                    }).always(function() {
                                    
                    }); 

				}) // confirm yes delete
			})

		// add
			$(".btn-add").click(function(){
				$('#tableMaster > tbody > tr:first').before('<tr>'+
					'<td>-</td>'+
					'<td><input type = "text" class = "txtCo_singer"></td>'+
					'<td><input type = "text" class = "txtCo_title"></td>'+
					'<td align = "center"><input type = "text" class = "txtRevenueProdigi" value = "0" style = "width : 50px"></td>'+
					'<td align = "center"><input type = "text" class = "txtSharePartner" value = "0" style = "width : 50px"></td>'+
					'<td align = "center"><input type = "text" class = "txtShareProdigi" value = "0" style = "width : 50px"></td>'+
					'<td align = "center"><input type = "text" class = "txtRoyaltiArtis" value = "0" style = "width : 50px"></td>'+
					'<td align = "center"><input type = "text" class = "txtRoyalPencipta" value = "0" style = "width : 50px"></td>'+
					'<td align = "center"><input type = "text" class = "txtMarketingChanel" value = "0" style = "width : 50px"></td>'+
					'<td><input type = "text" class = "txtPencipta"></td>'+
					'<td><input type = "text" class = "txtArtis"></td>'+
					'<td><input type = "text" class = "txtPartner"></td>'+
					'<td><input type = "text" class = "txtNmChanel"></td>'+
					'<td align = "center"><button class = "btn btn-danger btn-delete-row"><i class="fa fa-trash" aria-hidden="true"></i> Delete</td>'+
				'</tr>');

				var SaveBtn = '<div class = "row rowSaveTbl" style = "margin-top : 10px"><div class = "col-xs-1 col-md-offset-11"> <button type="button" id="btnSaveTableAdd" class="btn btn-success">Save</button></div></div>';
				$(".rowSaveTbl").remove();
				$(element).after(SaveBtn);

				$(".btn-delete-row").click(function(){
					$( this )
                      .closest( 'tr'  )
                      .remove();
				})

				$("#btnSaveTableAdd").click(function(){
					loading_button('#btnSaveTableAdd');
				 var txtCo_singer = [];
	                $("input.txtCo_singer").each(function(){
	                    txtCo_singer.push($(this).val());
	                })
	             var txtCo_title = [];
	                $("input.txtCo_title").each(function(){
	                    txtCo_title.push($(this).val());
	                })
	             var txtRevenueProdigi = [];
	                $("input.txtRevenueProdigi").each(function(){
	                    txtRevenueProdigi.push($(this).val());
	                })
	             var txtSharePartner = [];
	                $("input.txtSharePartner").each(function(){
	                    txtSharePartner.push($(this).val());
	                })
	             var txtShareProdigi = [];
	                $("input.txtShareProdigi").each(function(){
	                    txtShareProdigi.push($(this).val());
	                })
	             var txtRoyaltiArtis = [];
	                $("input.txtRoyaltiArtis").each(function(){
	                    txtRoyaltiArtis.push($(this).val());
	                })
	             var txtRoyalPencipta = [];
	                $("input.txtRoyalPencipta").each(function(){
	                    txtRoyalPencipta.push($(this).val());
	                })
	             var txtMarketingChanel = [];
	                 $("input.txtMarketingChanel").each(function(){
	                     txtMarketingChanel.push($(this).val());
	                 })
	             var txtPencipta = [];
	                $("input.txtPencipta").each(function(){
	                    txtPencipta.push($(this).val());
	                })
	                var txtArtis = [];
	                $("input.txtArtis").each(function(){
	                    txtArtis.push($(this).val());
	                }) 
	                var txtPartner = [];
	                $("input.txtPartner").each(function(){
	                    txtPartner.push($(this).val());
	                }) 
	                var txtNmChanel = [];
	                $("input.txtNmChanel").each(function(){
	                    txtNmChanel.push($(this).val());
	                })       
	             if (txtCo_singer.length == 0) {
	             	toastr.error('No Data','!Failed');
	             	$('#btnSaveTable').prop('disabled',false).html('Save');
	             }    
	             // get Push array
                    var FormInsert = [];
                    for (var i = 0; i < txtCo_singer.length; i++) {
                        var temp = {
                        	Co_singer:txtCo_singer[i],
                        	Co_title:txtCo_title[i],
                        	RevenueProdigi:txtRevenueProdigi[i],
                        	SharePartner:txtSharePartner[i],
                        	ShareProdigi:txtShareProdigi[i],
                        	RoyaltiArtis:txtRoyaltiArtis[i],
                        	RoyalPencipta:txtRoyalPencipta[i],
                        	MarketingChanel : txtMarketingChanel[i],
                        	Pencipta : txtPencipta[i],
                        	Artis : txtArtis[i],
                        	Partner : txtPartner[i],
                        	NmChanel : txtNmChanel[i],
                        }
                        FormInsert.push(temp);
                    }

                    var Action = 'add';
                    var url = base_url_js+'masterdata/submit';
                    var data = {
                        Action : Action,
                        FormInsert : FormInsert,
                        TypeData : $("#TypeTelcoMasterSearch").val(),
                    };
                    $.post(url,{data:data},function (resultJson) {
                      var response = jQuery.parseJSON(resultJson);
                      if (response == '') {
                        var TypeData = $("#TypeTelcoMasterSearch").val();
                        var auth = 'all';
                        getDtTableData(element,TypeData,auth);
                      }
                      else{
                        toastr.error(response,'!Failed');
                      }
                        $('#btnSaveTable').prop('disabled',false).html('Save');
                    }).fail(function() {
                      toastr.info('Error Processing'); 
                    }).always(function() {
                                    
                    }); 
				}) // exit click save tbladd				
			})
		// edit		
		var editi = 0;
		$(".btn-edit").click(function(){
			// console.log('test');
			editi++;
			if ($('input.txtCo_singer').length) {
				var TypeData = $("#TypeTelcoMasterSearch").val();
				var auth = 'all';
				getDtTableData('#PageTable',TypeData,auth);	
				return;
			}
			else
			{
				var SaveBtn = '<div class = "row rowSaveTbl" style = "margin-top : 10px"><div class = "col-xs-1 col-md-offset-11"> <button type="button" id="btnSaveTable" class="btn btn-success">Save</button></div></div>';
				if(!$(".rowSaveTbl").length)
				{
					$(element).after(SaveBtn);
				}

                $(".Co_singer").each(function(){
                    var val = $(this).attr('fill');
                    var idpri = $(this).attr('idpri');
                    var Input = '<input type = "text" class = "txtCo_singer" value = "'+val+'" idpri = "'+idpri+'">';
                    $(this).html(Input);
                })

                $(".Co_title").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtCo_title" value = "'+val+'">';
                    $(this).html(Input);
                })

                $(".RevenueProdigi").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtRevenueProdigi" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".SharePartner").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtSharePartner" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".ShareProdigi").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtShareProdigi" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".RoyaltiArtis").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtRoyaltiArtis" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".RoyalPencipta").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtRoyalPencipta" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".MarketingChanel").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtMarketingChanel" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".Pencipta").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtPencipta" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".Partner").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtPartner" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".Artis").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtArtis" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

                $(".NmChanel").each(function(){
                    var val = $(this).attr('fill');
                    var Input = '<input type = "text" class = "txtNmChanel" value = "'+val+'" style = "width : 50px">';
                    $(this).html(Input);
                })

			}

			$("#btnSaveTable").click(function(){
				loading_button('#btnSaveTable');
				 var txtCo_singer = [];
				 var IDpri = [];
	                $("input.txtCo_singer").each(function(){
	                    txtCo_singer.push($(this).val());
	                    IDpri.push($(this).attr('idpri'));
	                })
	             var txtCo_title = [];
	                $("input.txtCo_title").each(function(){
	                    txtCo_title.push($(this).val());
	                })
	             var txtRevenueProdigi = [];
	                $("input.txtRevenueProdigi").each(function(){
	                    txtRevenueProdigi.push($(this).val());
	                })
	             var txtSharePartner = [];
	                $("input.txtSharePartner").each(function(){
	                    txtSharePartner.push($(this).val());
	                })
	             var txtShareProdigi = [];
	                $("input.txtShareProdigi").each(function(){
	                    txtShareProdigi.push($(this).val());
	                })
	             var txtRoyaltiArtis = [];
	                $("input.txtRoyaltiArtis").each(function(){
	                    txtRoyaltiArtis.push($(this).val());
	                })
	             var txtRoyalPencipta = [];
	                $("input.txtRoyalPencipta").each(function(){
	                    txtRoyalPencipta.push($(this).val());
	                })
	             var txtMarketingChanel = [];
	                 $("input.txtMarketingChanel").each(function(){
	                     txtMarketingChanel.push($(this).val());
	                 })
	             var txtPencipta = [];
	                $("input.txtPencipta").each(function(){
	                    txtPencipta.push($(this).val());
	                })
	                var txtArtis = [];
	                $("input.txtArtis").each(function(){
	                    txtArtis.push($(this).val());
	                }) 
	                var txtPartner = [];
	                $("input.txtPartner").each(function(){
	                    txtPartner.push($(this).val());
	                }) 
	                var txtNmChanel = [];
	                $("input.txtNmChanel").each(function(){
	                    txtNmChanel.push($(this).val());
	                })   
	             if (txtCo_singer.length == 0) {
	             	toastr.error('No Data','!Failed');
	             	$('#btnSaveTable').prop('disabled',false).html('Save');
	             }    
	             // get Push array
                    var FormUpdate = [];
                    for (var i = 0; i < IDpri.length; i++) {
                        var temp = {
                        	Co_singer:txtCo_singer[i],
                        	Co_title:txtCo_title[i],
                        	RevenueProdigi:txtRevenueProdigi[i],
                        	SharePartner:txtSharePartner[i],
                        	ShareProdigi:txtShareProdigi[i],
                        	RoyaltiArtis:txtRoyaltiArtis[i],
                        	RoyalPencipta:txtRoyalPencipta[i],
                        	MarketingChanel : txtMarketingChanel[i],
                        	Pencipta : txtPencipta[i],
                        	Artis : txtArtis[i],
                        	Partner : txtPartner[i],
                        	NmChanel : txtNmChanel[i],
                            ID : IDpri[i],
                        }
                        FormUpdate.push(temp);
                    }

                    var Action = 'edit';
                    var url = base_url_js+'masterdata/submit';
                    var data = {
                        Action : Action,
                        FormUpdate : FormUpdate,
                        TypeData : $("#TypeTelcoMasterSearch").val(),
                    };
                    $.post(url,{data:data},function (resultJson) {
                      var response = jQuery.parseJSON(resultJson);
                      if (response == '') {
                        var TypeData = $("#TypeTelcoMasterSearch").val();
                        var auth = 'all';
                        getDtTableData(element,TypeData,auth);
                      }
                      else{
                        toastr.error(response,'!Failed');
                      }
                        $('#btnSaveTable').prop('disabled',false).html('Save');
                    }).fail(function() {
                      toastr.info('Error Processing'); 
                    }).always(function() {
                                    
                    });                            
			})

		}) // exit btn edit 
	}	
</script>