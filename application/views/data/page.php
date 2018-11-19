<script type="text/javascript" src="<?php echo base_url();?>asset/dist/jquery/jquery.maskMoney.js"></script>
<style type="text/css">
	@media (min-width: 768px) {
	  .thumbnail {
	    height: : 250px;
	  }
	}

	@media (min-width: 992px) {
	  .thumbnail {
	    height: : 150px;
	  }
	}
</style>
<div class="row">
	<div class="col-xs-12" >
		<div class="panel panel-primary">
	        <div class="panel-heading clearfix">
	            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Data</h4>
	        </div>
	        <div class="panel-body">
	        	<div class="tabbable tabbable-custom tabbable-full-width btn-read setUserRole">
	        	    <ul class="nav nav-tabs">
	        	        <li class="active">
	        	            <a href="javascript:void(0)" class="pageAnchorUserRole" page = "Data">Data</a>
	        	        </li>
	        	        <li class="">
	        	            <a href="javascript:void(0)" class="pageAnchorUserRole" page = "Report">Report</a>
	        	        </li>
	        	        <li class="">
	        	            <a href="javascript:void(0)" class="pageAnchorUserRole" page = "FileDownload">File Download</a>
	        	        </li>
	        	    </ul>
	        	    <div style="padding-top: 30px;border-top: 1px solid #cccccc">
	        	        <div id = "pageSetRule">
	        	           
	        	        </div>
	        	    </div>
	        	</div> 
	        </div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    LoadPage('Data');
    $(".pageAnchorUserRole").click(function(){
        var Page = $(this).attr('page');
        $(".setUserRole li").removeClass('active');
        $(this).parent().addClass('active');
        LoadPage(Page);
    });
}); // exit document Function

function LoadPage(Page)
{
    $("#pageSetRule").empty();
    loading_page("#pageSetRule");
    var url = base_url_js+'data/'+Page;
    $.post(url,function (resultJson) {
        var response = jQuery.parseJSON(resultJson);
        var html = response.html;
        var jsonPass = response.jsonPass;
        $("#pageSetRule").html(html);
    }); // exit spost
}
</script>
