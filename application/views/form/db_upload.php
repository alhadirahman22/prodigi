<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>PRODIGI BA</title>
  </head>
  <body>
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			<?php echo $this->session->flashdata('msg'); ?> 
    			<form action="<?php echo base_url("impdata/upload"); ?>" enctype="multipart/form-data" method="post">
    			<input name="file" type="file" />
    			<input type="submit" value="Import File" />
    			</form>
    		</div>	
    	</div>
    	<div class="row" style="margin-top: 10px">
    		<div class="col-md-12">
    			<form action="<?php echo base_url("expExcel"); ?>" enctype="multipart/form-data" method="post">
    			<div class="form-group">
    				<div class="row">
    					<div class="col-xs-3">
    						<input type="text" name="co_sing" class="form-control" placeholder="Input Singer">
    					</div>
    				</div>
    			</div>
    			<div class="form-group">
    				<div class="row">
    					<div class="col-xs-3">
    						<input type="text" name="co_title" class="form-control" placeholder="Input Title">
    					</div>
    				</div>
    			</div>
    			<div class="form-group">
    				<div class="row">
    					<div class="col-xs-3">
    						<input type="submit" value="Export Excel" />
    					</div>
    				</div>
    			</div>
    		</form>
    		</div>
    	</div>
    	
    	
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
<!-- <div style="margin-top: 20px;"> -->





