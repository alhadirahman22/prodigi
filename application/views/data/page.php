<script type="text/javascript" src="<?php echo base_url();?>asset/dist/jquery/jquery.maskMoney.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/jquery/jquery-ui.min.js"></script>
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

	.ui-autocomplete {
	    display: block;
	    position: absolute;
	    z-index: 1000;
	    cursor: default;
	    padding: 0;
	    margin-top: 2px;
	    list-style: none;
	    background-color: #ffffff;
	    border: 1px solid #ccc;
	    -webkit-border-radius: 5px;
	    -moz-border-radius: 5px;
	    border-radius: 5px;
	    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);

	    width: auto !important;
	    min-width: 115px !important;
	}
	.ui-autocomplete > li {
	    padding: 3px 10px;
	}
	.ui-autocomplete > li.ui-menu-item a {
	    /*font-weight: bold;*/
	    color:#333;
	    text-decoration: none;
	}

	.ui-autocomplete > li.ui-menu-item:hover {
	    background: #083f88;
	    color: #FFFFFF;
	}
	.ui-autocomplete > li.ui-menu-item:hover a {
	    color: #FFFFFF;
	}



	.ui-helper-hidden-accessible {
	    display: block;
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
