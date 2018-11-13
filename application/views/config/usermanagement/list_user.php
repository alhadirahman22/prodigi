<!-- Select2 -->
<link href="<?php echo base_url();?>asset/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<!-- Select2 -->
<script src="<?php echo base_url();?>asset/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<!-- Modal style -->
<link href="<?php echo base_url();?>asset/modal.css" rel="stylesheet" type="text/css" />
<div class="row">
  <div class="col-xs-12" >
    <div class="panel panel-primary">
          <div class="panel-heading clearfix">
              <h4 class="panel-title pull-left" style="padding-top: 7.5px;">User Management</h4>
              <div class="panel-title pull-right">
                  <div class="btn-group">
                    <button type='button' class='btn btn-default' id = 'add'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</button>
                  </div>
              </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered table-striped datatables">
                      <thead style="font-size:13px;">
                        <tr>
                          <th>No</th>
                          <th>Username</th>
                          <th>Name</th>
                          <th>Level</th>
                          <th>Status</th>
                          <th style="width: 356px;">Action</th>
                        </tr>
                      </thead>
                      <tbody id = 'dataRow'>
                      
                      </tbody>
                </table>
              </div>
            </div>
            
          </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  loaddata();
});

$(document).on('click','#add', function () {
  modal_generate('add','Add User',)
});

$(document).on('click','.btn-edit', function () {
  var ID = $(this).attr('data-smt');
   modal_generate('edit','Edit User',ID);
});

$(document).on('click','.btn-delete', function () {
  var ID = $(this).attr('data-smt');
   $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b> <br>' +
       '<button type="button" id="confirmYesDelete" class="btn btn-primary" style="margin-right: 5px;" data-smt = "'+ID+'">Yes</button>' +
       '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
       '</div>');
   $('#NotificationModal').modal('show');
});

$(document).on('click','.btn-Active', function () {
  var ID = $(this).attr('data-smt');
  var Active = $(this).attr('data-active');
   $('#NotificationModal .modal-body').html('<div style="text-align: center;"><b>Apakah anda yakin untuk melakukan request ini ?? </b><br> ' +
       '<button type="button" id="confirmYesActive" class="btn btn-primary" style="margin-right: 5px;" data-smt = "'+ID+'" data-active = "'+Active+'">Yes</button>' +
       '<button type="button" class="btn btn-default" data-dismiss="modal">No</button>' +
       '</div>');
   $('#NotificationModal').modal('show');
});

$(document).on('click','#confirmYesDelete',function () {
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
      var url = base_url_js+'administrator/userdata_action';
      var aksi = "delete";
      var ID = $(this).attr('data-smt');
      var data = {
          Action : aksi,
          CDID : ID,
      };
      
      $.post(url,{data:data},function (data_json) {
          setTimeout(function () {
             toastr.options.fadeOut = 10000;
             toastr.success('Data berhasil disimpan', 'Success!');
             loaddata();
             $('#NotificationModal').modal('hide');
          },500);
      });
});

$(document).on('click','#confirmYesActive',function () {
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
      var url = base_url_js+'administrator/userdata_action';
      var aksi = "getactive";
      var ID = $(this).attr('data-smt');
      var Active = $(this).attr('data-active');
      var data = {
          Action : aksi,
          CDID : ID,
          Active:Active,
      };
      $.post(url,{data:data},function (data_json) {
          setTimeout(function () {
             toastr.options.fadeOut = 10000;
             toastr.success('Data berhasil disimpan', 'Success!');
             loaddata();
             $('#NotificationModal').modal('hide');
          },500);
      });
});

function modal_generate(action,title,ID='',) {
    var url = base_url_js+"config/usermanagement/page_modal_user_data";
    var data = {
        Action : action,
        CDID : ID,
    };
    
    $.post(url,{ data:data }, function (html) {
        $('#modal3 .modal-header').html('<h4 class="modal-title">'+title+'</h4>');
        $('#modal3 .modal-body').html(html);
        // $('#modal3 .modal-footer').append(btnsave);
        $('#modal3').modal({
            'show' : true,
            'backdrop' : 'static'
        });
    })
}

$(document).on('click','#ModalbtnSaveForm', function () {
    // $.removeCookie('__tawkuuid', { path: '/' });
    loading_button('#ModalbtnSaveForm');
    var url = base_url_js+'config/usermanagement/userdata_action';
    var Username = $("#Username").val().trim();
    var Name = $("#Name").val().trim();
    var Password = $("#Password").val().trim();
    var id = $("#ModalbtnSaveForm").attr('kodeuniq');
    var level = $("#level").val();
    console.log(level);
    var action = $(this).attr('action');
    var data = {
                Username : Username,
                Name : Name,
                Password : Password,
                level : level,
                Action : action,
                CDID : id
                };
    if (validation2(data)) {
        $.post(url,{data:data},function (data_json) {
            // jsonData = data_json;
            // var obj = JSON.parse(data_json); 
            // console.log(obj);
            toastr.options.fadeOut = 10000;
             toastr.success('Data berhasil disimpan', 'Success!');
             $('#modal3').modal('hide');
        }).done(function() {
          loaddata();
        }).fail(function() {
          toastr.error('The Database connection error, please try again', 'Failed!!');
        }).always(function() {
         $('#ModalbtnSaveForm').prop('disabled',false).html('Save');

        });
    }
    else
    {
        $('#ModalbtnSaveForm').prop('disabled',false).html('Save');
    }          
    
});

function validation2(arr)
{
  var toatString = "";
  var result = "";
  for(var key in arr) {
     switch(key)
     {
      default :
      if (key != 'CDID') {
        if (key == 'Action') {
          if (arr[key] == 'edit') {
            if (key != 'Password') {
              result = Validation_required(arr[key],key);
              if (result['status'] == 0) {
                toatString += result['messages'] + "<br>";
              } 
            }
          }
        }
        else
        {
          result = Validation_required(arr[key],key);
          if (result['status'] == 0) {
            toatString += result['messages'] + "<br>";
          }
        }
          
      }
            
     }

  }
  if (toatString != "") {
    // toastr.error(toatString, 'Failed!!');
    $("#msgMENU").html(toatString);
    $("#msgMENU").removeClass("hide");
    return false;
  }

  return true;
}


function loaddata()
{
  $body = $("body");
  $body.addClass("loading"); 
  $('#dataRow').html('');
  var url = base_url_js+'config/usermanagement/user_data';
  $("#loaddata").html('');
  var tableHeader = '<table class="table table-bordered table-striped datatables">'+
        '<thead style="font-size:13px;">'+
          '<tr>'+
            '<th>No</th>'+
            '<th>Username</th>'+
            '<th>Name</th>'+
            '<th>Level</th>'+
            '<th>Status</th>'+
            '<th style="width: 356px;">Action</th>'+
          '</tr>'+
        '</thead>'+
        '<tbody id = "dataRow">'+
        '</tbody>'+
  '</table>';
  $("#loaddata").html(tableHeader);
  $.post(url,function (resultJson) {
     var resultJson = jQuery.parseJSON(resultJson);
     console.log(resultJson);
     var no = 1;
     for(var i=0;i<resultJson.length;i++){
      var status = (resultJson[i]['Active'] == 1) ? 'Active' : 'Not Active';
      var btn_edit = '<span data-smt="'+resultJson[i]['ID']+'" class="btn btn-xs btn-edit"><i class="fa fa-pencil-square-o"></i> Edit</span>';
      var btn_delete = '<span data-smt="'+resultJson[i]['ID']+'"class="btn btn-xs btn-delete"><i class="fa fa-trash"> Delete</i></span>';
      var btn_status = '<span data-smt="'+resultJson[i]['ID']+'" class="btn btn-xs btn-Active" data-active = "'+resultJson[i]['Active']+'"><i class="fa fa-hand-o-right"> Change Active</i></span>';
      // auth change name
      var auth = '';
      if (resultJson[i]['Auth'] == 'SpvOperator') {
        auth = 'Skill Operator';
      }
      else if(resultJson[i]['Auth'] == 'Operator')
      {
        auth = 'Inserting';
      }
      else
      {
        auth = resultJson[i]['Auth'];
      }
        $('#dataRow').append('<tr>' +
             '<td>'+no+'</td>' +
             '<td>'+resultJson[i]['Username']+'</td>' +
             '<td>'+resultJson[i]['Name']+'</td>' +
             '<td>'+auth+'</td>' +
             '<td>'+status+'</td>' +
             '<td>'+btn_edit+btn_delete+btn_status+'</td>' +
             '</tr>');
        no++;
        $body.removeClass("loading"); 
     }

     LoaddataTableStandard2('.datatables');

  }).fail(function() {
    
    toastr.info('No Result Data'); 
    // toastr.error('The Database connection error, please try again', 'Failed!!');
  }).always(function() {
      $body.removeClass("loading"); 
  });
  
}
</script>
