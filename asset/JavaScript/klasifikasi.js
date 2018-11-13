$(function () {
    clearMsg();
    $("#btnAddData").click(function(){
        $("#modal2").modal("show");
        clearMsg();
    });

    $( "#frmTbh" ).submit(function( event ) {
    event.preventDefault();
    $.post("../ref/klasifikasi/smtaddklasifikasi", $("#frmTbh").serialize(), function(data){ // ajax post
            var data = eval('('+ data + ')');
            if(data.status == "success") {
               window.location.reload(true);
            }
            else if(data.status == "error") {
                $('.notification').show();
                $('.error_msg').html(data.msg);
            }
        });
    });

    $( "#frmedt" ).submit(function( event ) {
    event.preventDefault();
    $.post("../ref/klasifikasi/edtaddklasifikasi", $("#frmedt").serialize(), function(data){ // ajax post
            var data = eval('('+ data + ')');
            if(data.status == "success") {
               window.location.reload(true);
            }
            else if(data.status == "error") {
                $('.notification').show();
                $('.error_msg').html(data.msg);
            }
        });
    });


    function clearMsg(){
        $(".notification").hide();
        $('.nama').val("");
        $('.email').val("");
    }
});

function clearMsg(){
      $(".notification").hide();
      $('.nama').val("");
      $('.email').val("");
}

function getstatus(cd,status)
  {
     $.ajax({
      type:"GET",
      url:"../ref/klasifikasi/status_klasifikasi",
      data:"cd="+ cd +"&status=" + status,
      success:function(data)
      {       
         window.location.reload(true);
      },
      error: function (data) {
          alert("gagal");
      }
    })
  }

function edit(cd)
  {
     $.ajax({
      type:"GET",
      url:"../ref/klasifikasi/edit_klasifikasi",
      data:"cd="+ cd,
      dataType: 'json',
      success:function(data)
      {       
         $("#modal3").modal("show");
         clearMsg()
         $('.nama').val(data['nama']);
      },
      error: function (data) {
          alert("gagal");
      }
    })
  }  