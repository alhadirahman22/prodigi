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
	            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Master</h4>
	        </div>
	        <div class="panel-body">
	            <div class="tabbable tabbable-custom tabbable-full-width btn-read setRule">
	                <ul class="nav nav-tabs">
	                    <li class="active">
	                        <a href="javascript:void(0)" class="pageRule" page = "Data">Data</a>
	                    </li>
	                </ul>
	                <div style="padding-top: 30px;border-top: 1px solid #cccccc">
	                    <div class="row" id = "pageSetRule" style="margin-left: 0px;margin-right: 0px">
	                       
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
    $(".pageRule").click(function(){
        var Page = $(this).attr('page');
        $(".setRule li").removeClass('active');
        $(this).parent().addClass('active');
        LoadPage(Page)
    })

}); // exit document Function

function LoadPage(Page)
{
    $("#pageSetRule").empty();
    loading_page("#pageSetRule");
    var url = base_url_js+'master/'+Page;
    $.post(url,function (resultJson) {
        var response = jQuery.parseJSON(resultJson);
        var html = response.html;
        var jsonPass = response.jsonPass;
        $("#pageSetRule").html(html);
    }); // exit spost
}
</script>
