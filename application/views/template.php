<?php 
/* Deklarasi*/
$cd_akses = $this->session->userdata('Auth');
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Apps</title>
  <link rel="shortcut icon" type="image/ico" href="<?php echo base_url(); ?>asset/favicon.ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/bootsrap/css/bootstrap.min.css"/>

  <!-- Font Awesome -->
  <link href="<?php echo base_url();?>asset/dist/css/font-awesome-4.4.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <!-- Morris charts -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/morris/morris.css">
  <!-- Theme style -->
  <link href="<?php echo base_url();?>asset/bootsrap/css/AdminLTE.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/skins/_all-skins.min.css">

   <!-- jQuery -->
    <script src="<?php echo base_url();?>asset/bootsrap/js/jquery.js"></script>

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/datatable/jquery.dataTables.min.css">
    
    <!-- <script type="text/javascript" language="javascript" src="/datatable/jquery.js"></script> -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>asset/datatable/jquery.dataTables.js"></script>
    <!--<script type="text/javascript" language="javascript" src="<?php echo base_url();?>asset/datatable/sum().js"></script>-->

  <!-- sweet alert -->
  <script src="<?php echo base_url();?>asset/sweetalert/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/sweetalert/sweetalert.css">

  <!-- Modal style -->
  <link href="<?php echo base_url();?>asset/modal.css" rel="stylesheet" type="text/css" />
  <!-- Select2 -->
  <link href="<?php echo base_url();?>asset/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
  <!-- Select2 -->
  <script src="<?php echo base_url();?>asset/plugins/select2/select2.full.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url();?>asset/datepicker/bootstrap-datepicker.js"></script>
  <link href="<?php echo base_url();?>asset/datepicker/datepicker.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo base_url('asset/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo base_url('asset'); ?>/plugins/toastr/toastr.min.js"></script>

  <script type="text/javascript" language="javascript" src="<?php echo base_url();?>asset/dttable.js"></script>
  <style type="text/css">
  .black_font{
    color: black;    
  }
  body {
 
    font-family: "Roboto", helvetica, arial, sans-serif;
    font-size: 14px;
    font-weight: 400;
    text-rendering: optimizeLegibility;
  }

  body.modal-open {
  overflow-y: auto !important;
  padding-right: 0 !important;
  }

  .modal-scrollbar-measure {

  overflow: hidden;
  }
  </style>

  <style type="text/css">
    .tableData thead th,.tableData tfoot td {

        text-align: center;
        background: #20485A;
        color: #FFFFFF;

    }

    .tableData>thead>tr>th, .tableData>tbody>tr>th, .tableData>tfoot>tr>th, .tableData>thead>tr>td, .tableData>tbody>tr>td, .tableData>tfoot>tr>td {
        border: 1px solid #b7b7b7
    }
  </style>
</head>
<body class="hold-transition skin-black sidebar-mini fixed" style="font-family: calibri;">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Apps</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Apps<font style="font-size: 12px;"></font></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i>
              <span class="hidden-xs"><?php echo $this->session->userdata('NamaAuth').'-'.$this->session->userdata('Username') ?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview <?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
          <a href="<?php echo base_url();?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
          </a>
        </li>
        <?php if (in_array($cd_akses, array('SuperAdmin'))): ?>
        <li class="treeview <?php echo ($this->uri->segment(1) == 'master') ? 'active' : '' ?>">
          <a href="<?php echo base_url();?>master">
            <i class="fa fa-folder"></i> <span>Master</span></i>
          </a>
        </li>
        <?php endif ?>
        <li class="treeview <?php echo ($this->uri->segment(1)== 'data') ? 'active' : '' ?>">
          <a href="<?php echo base_url();?>data">
            <i class="fa fa-folder-open"></i> <span>Data</span></i>
          </a>
        </li>
        <?php if (in_array($cd_akses, array('SuperAdmin'))): ?>
        <li class="treeview <?php echo ($this->uri->segment(1)== 'config') ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-map"></i>
            <span>Config</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo ($this->uri->segment(2)== 'usermanagement') ? 'active' : '' ?>"><a href="<?php echo base_url();?>config/usermanagement"><i class="fa fa-circle-o"></i> User Management</a></li>
            <li><a href="javascript:void(0);" class="clearDataProses"><i class="fa fa-circle-o"></i> Clear Data</a></li>
          </ul>
        </li>
        <?php endif ?>
        <li class="treeview">
          <a href="#" class ="logout">
            <i class="fa fa-sign-out"></i> <span>Log Out</span></i>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row" style="margin-left: 5px;margin-right: 5px">
        <?php $this->load->view($main_view);  ?> 
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer footer">
        <div class="pull-right hidden-xs">
        </div>
        <font size="2px"><strong> 
          Copyright @ 2018 Apps, All right reserved.  </strong></font>
  </footer>
</div>
<!-- ./wrapper -->
</body>
</html>
<div class="modal fade" id ="modal3">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Title</h4>
      </div>
      <div class="modal-body">
          
      </div>
    </div><!-- /.modal-content -->
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Notification -->
<div class="modal fade" id="NotificationModal" role="dialog" style="top: 100px;">
    <div class="modal-dialog" style="width: 400px;" role="document">
        <div class="modal-content animated flipInX">
<!--            <div class="modal-header"></div>-->
            <div class="modal-body"></div>
<!--            <div class="modal-footer"></div>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal2"><!-- Place at bottom of page --></div>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>asset/bootsrap/js/bootstrap.min.js" type="text/javascript"></script>
     <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>asset/dist/js/app.js" type="text/javascript"></script>
    <script type="text/javascript">
    window.base_url_js = "<?php echo base_url(); ?>";
    $(".logout").click(function(){
      swal({
      title: "Leave this site?", 
      text: "If you click 'OK', you will be redirected to " + "Login again", 
      type: "warning",
      showCancelButton: true
    }, // exit swal
      function(){
         //Logic to delete the item
              $.ajax({
                  url :"<?php echo base_url();?>logout",
                  type:"GET",
              success : function(data){
                  window.location.replace("<?php echo base_url();?>login");
              } 

              }) // exit ajax 
        
      }); // exit function
    })

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function loadingStart()
    {
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
    }

    function loadingEnd(timeout)
    {
        setTimeout(function () {
            $('#NotificationModal').modal('hide');
        },timeout);
    }

    function LoaddataTableStandard2(element) {
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $(element).DataTable({
            'iDisplayLength' : 50,
            'ordering' : true,
            // "sDom": "<'row'<'dataTables_header clearfix'<'col-md-3'l><'col-md-9'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>", // T is new
        });
    }

    function loading_button(element) {
        $(''+element).html('<i class="fa fa-refresh fa-spin fa-fw right-margin"></i> Loading...');
        $(''+element).prop('disabled',true);
    }

    // BY ADHI
    function Validation_leastCharacter(leastNumber,string,theName) {
        var result = {status:1, messages:""};
        var stringLenght =  string.length;
        if (stringLenght < leastNumber) {
            result = {status : 0,messages: theName + " at least " + leastNumber + " character"};
        }
        return result;
    }

    function Validation_email(string,theName)
    {
        var result = {status:1, messages:""};
        var regexx =  /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (!string.match(regexx)) {
            result = {status : 0,messages: theName + " an invalid email address! "};
        }
        return result;
    }

    function Validation_email_gmail(string,theName)
    {
        var result = {status:1, messages:""};
        var regexx =  /^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/;
        if (!string.match(regexx)) {
            result = {status : 0,messages: theName + " only gmail allowed to register! "};
        }
        return result;
    }

    function Validation_required(string,theName)
    {
        var result = {status:1, messages:""};
        if (string == "" || string == null) {
            result = {status : 0,messages: theName + " is required! "};
        }
        return result;
    }

    function Validation_numeric(string,theName)
    {
        var result = {status:1, messages:""};
        var regexx =  /^\d+$/;;
        if (!string.match(regexx)) {
            result = {status : 0,messages: theName + " only numeric! "};
        }
        return result;
    }

    function loading_page(element) {
        $(element).html('<div class="row">' +
            '<div class="col-md-12" style="text-align: center;">' +
            '<h3 class="animated flipInX"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i> <span>Loading page . . .</span></h3>' +
            '</div>' +
            '</div>');
    }

    function formatRupiah(bilangan) {
        var number_string = bilangan.toString(),
            sisa    = number_string.length % 3,
            rupiah  = number_string.substr(0, sisa),
            ribuan  = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return 'Rp. '+rupiah+',-';
    }

    function findAndReplace(string, target, replacement) {
     
     var i = 0, length = string.length;
     
     for (i; i < length; i++) {
     
       string = string.replace(target, replacement);
     
     }
     
     return string;
     
    }

    function FormSubmitAuto(action, method, values) {
        var form = $('<form/>', {
            action: action,
            method: method
        });
        $.each(values, function() {
            form.append($('<input/>', {
                type: 'hidden',
                name: this.name,
                value: this.value
            }));    
        });
        // form.attr('target', '_blank');
        form.appendTo('body').submit();
    } 

    function LoadDataDownloadInTable(element)
    {
      $(element).empty();
      var url = base_url_js+'getAllFile';
        $.post(url,function (data_json) {
          var response = jQuery.parseJSON(data_json);
          if (response.length == 0) {$(element).html('File tidak ada');return;}
          // console.log(response);
          var splitBagi = 5;
              var split = parseInt(response.length / splitBagi);
              var sisa = response.length % splitBagi;
            
            if (sisa > 0) {
                  split++;
            }
            var getRow = 0;
          
        for (var i = 0; i < split; i++) {
                 if ((sisa > 0) && ((i + 1) == split) ) {
                                     splitBagi = sisa;    
                 }
                 var br = (i > 1) ? 'style = "margin-top : 20px"'  : '';
                 var html = '<div class = "col-md-6" '+br+'><div class="table-responsive">'+
                '<table class="table table-bordered tableData" id ="tableData'+i+'">'+
                '<thead>'+
                  '<tr>'+
                    '<th>No</th>'+        
                    '<th>File</th>'+
                    // '<th>Delete</th>'+
                  '</tr>'+
                '</thead>'+
                '<tbody>'+
                '</tbody>'+
                '</table>'+
              '</div></div>';
            $(element).append(html);  
                 for (var k = 0; k < splitBagi; k++) {
            $("#tableData"+i+" tbody").append(
                     '<tr>'+
                         '<td>'+response[getRow]['No']+'</td>'+
                         '<td>'+response[getRow]['File']+'</td>'+
                         // '<td>'+response[getRow]['Delete']+'</td>'+
                     '</tr>' 
                     );
                     getRow++;
                 }
                 LoaddataTableStandard2("#tableData"+i);
            }     

        }).done(function() {
             
          })        
    }

    $(document).on('click','.btn-delete-file', function () {
      var dir = $(this).attr('dir');
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
       var url = base_url_js+'delete-file';
       $.post(url,{dir:dir},function (data_json) {
           setTimeout(function () {
              toastr.options.fadeOut = 10000;
              toastr.success('Data berhasil disimpan', 'Success!');
              LoadDataDownloadInTable("#FileDownload_Data");
              $('#NotificationModal').modal('hide');
           },500);
       });
      })
    });

    $(document).on('click','.clearDataProses', function () {
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
       var url = base_url_js+'clear-data-proses';
       $.post(url,{auth:'admin'},function (data_json) {
           setTimeout(function () {
              toastr.options.fadeOut = 10000;
              toastr.success('Data berhasil disimpan', 'Success!');
              $('#NotificationModal').modal('hide');
           },500);
       });
      })
    });
    </script>
<style type="text/css">
  .table2 {
    border-collapse: collapse;
}

.table2 th td {
    border: 1px solid black;
}

.table2 th {
    height: 40px;
    text-align: center;
}

.table2 td {
    height: 30px;
    vertical-align: bottom;
    
}
.stylebox
{
  width: 20%;
}

.font_validation
{
  font-size: 20px;
}
#refresh_box
{
  margin-top: 10px;
  color: white;
}

</style>
