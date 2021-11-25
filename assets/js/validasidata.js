$('#sssproject').change(function (){

    $('#loadingDiv').show();

  var id=$(this).val();
  $('#sscabang').empty();
  console.log(id);
  console.log('OKAY');
  $.ajax({
      url : "getcabang",
      method : "POST",
      data : {id: id},
      dataType : 'json',
      success: function(hasil){
        var cetak =``;
        for (var i = 0; i < hasil.length; i++) {
              var cetak =`<select class="form-control" name="scabang" id="scabang">
                        <option value=""> Pilih Cabang</option>`;
              for (var i = 0; i < hasil.length; i++) {
                cetak += `<option value="`+hasil[i].kode+`"> (`+hasil[i].kode+`) `+hasil[i].nama+`</option>`;
                // console.log(hasil[i]['kode']);
              } 

              cetak += `</select>`;
        }
        $("#sscabang").append(cetak);
        $('#scabang').selectpicker({
          liveSearch:true,
          maxOptions:1
        });

        $('#loadingDiv').hide();

      }
  });
});
  
  
$('#tampilkanvalidasidataRA').click(function (){

    $('#loadingDiv').show();
    $('#tabledatavalidasi').empty();
    
    var pro = $('#sssproject').val();
    var cbg = $('#scabang').val();
    var akses = $('#akses').val();
  
    if (cbg == '' || cbg == null) {
      var urlnya = 'getquestdata2';
      var datanya = {pro:pro};
    }else{
      var urlnya = 'getquestdata';
      var datanya = {pro:pro, cbg:cbg};
    }
  
  
    $.ajax({
      url:urlnya,
      type:"POST",
      dataType: 'json',
      data:datanya,
      success:function(result){
  
      var ht =`<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project</th>
                      <th>Kunjungan</th>
                      <th>Skenario</th>
                      <th>Cabang</th>
                      <th>Shopper</th>
                      <th>Aktual</th>
                      <th>Upload Dialog</th>
                      <th>Upload Rekaman</th>
                      <th>Dialog</th>
                      <th>Rekaman</th>
                      <th>Layout</th>
                      <th>Equest</th>
                      <th>Slip</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>`
  
                  for (let i = 0; i < result.length; i++) {
                    var j = i +1;
                    
              ht +=`<tr>
                      <td>`+j+`</td>
                      <td>`+result[i].nama_project+`</td>
                      <td>`+result[i].kunjunganx+`</td>
                      <td>`+result[i].skenariox+`</td>
                      <td>`+result[i].cabang+` - `+result[i].cabangx+`</td>
                      <td>`+result[i].shp+` - `+result[i].nama_user+`</td>`
                   if (result[i].waktu_assign == null) {
                     ht +=`<td></td>`
                   }else{
                     ht +=`<td>`+result[i].waktu_assign+`</td>`
                   }
                   if (result[i].waktu_upload == null) {
                     ht +=`<td></td>`
                   }else{
                     ht +=`<td>`+result[i].waktu_upload+`</td>`
                   }
                   if (result[i].tglrekaman == null) {
                     ht +=`<td>
                     <section id="tgl`+j+`">
                     </section>
                     </td>`
                   }else{
                     ht +=`<td>`+result[i].tglrekaman+`</td>`
                   }
  
                   if (result[i].r_sts_dialog == null) {
                      ht +=`<td style="background-color:#ffc107;">`
                   }else if(result[i].r_sts_dialog == 0){
                      ht +=`<td style="background-color:#dc3545;">`
                   }else{
                      ht +=`<td style="background-color:#337ab7;">`
                   }
  
                   if (result[i].upload_dialog == null || result[i].upload_dialog == '' ) {
                      ht +=``
                   }else{
                       ht +=`<center><i class="fa fa-check"></i><center>`
                   }
                      ht +=`</td>`
  
                  if (result[i].rekaman_status == 0 || result[i].rekaman_status == 1 || result[i].rekaman_status == 4 ) {
                      ht +=`<td style="background-color:#ffc107;">`
                  }else if(result[i].rekaman_status == 2){
                      ht +=`<td style="background-color:#dc3545;">`
                  }else{
                      ht +=`<td style="background-color:#337ab7;">`
                  }
  
                  if (result[i].rekaman_status != 0 ) {
                      ht +=`<center><i class="fa fa-check"></i><center>`
                  }else{
                      
                  } 
                      ht +=`</td>`
  
                  if (result[i].r_sts_upload_layout == null) {
                     ht +=`<td style="background-color:#ffc107;">`
                  }else if(result[i].r_sts_upload_layout == 0){
                     ht +=`<td style="background-color:#dc3545;">`
                  }else{
                     ht +=`<td style="background-color:#337ab7;">`
                  }
                  if (result[i].upload_layout == null || result[i].upload_layout == '' ) {
                    ht +=``
                 }else{
                     ht +=`<center><i class="fa fa-check"></i><center>`
                 }
                     ht +=`</td>`
  
                  if (result[i].r_sts_upload_ss == null) {
                     ht +=`<td style="background-color:#ffc107;">`
                  }else if(result[i].r_sts_upload_ss == 0){
                     ht +=`<td style="background-color:#dc3545;">`
                  }else{
                     ht +=`<td style="background-color:#337ab7;">`
                  }
                  if (result[i].upload_ss == null || result[i].upload_ss == '' ) {
                    ht +=``
                 }else{
                     ht +=`<center><i class="fa fa-check"></i><center>`
                 }
                     ht +=`</td>`
  
                  if (result[i].r_sts_upload_slip_transaksi == null) {
                     ht +=`<td style="background-color:#ffc107;">`
                  }else if(result[i].r_sts_upload_slip_transaksi == 0){
                     ht +=`<td style="background-color:#dc3545;">`
                  }else{
                     ht +=`<td style="background-color:#337ab7;">`
                  }
                  if (result[i].upload_slip_transaksi == null || result[i].upload_slip_transaksi == '' ) {
                     ht +=``
                  }else{
                      ht +=`<center><i class="fa fa-check"></i><center>`
                  }
                     ht +=`</td>`
  
            ht +=`<td>
                    <a target="_blank" href="lihatdata/`+result[i].num+`" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-eye fa-fw"></span> Lihat </a>
                  </td>`         
  
            ht +=`</tr>`                    
                }
  
            ht +=`</tbody>
                </table>`

        $('#tabledatavalidasi').append(ht);

        if (document.getElementById('dataTables-example')) {
    
            $('#dataTables-example').DataTable({
                "responsive": true,
                "paging":   true,
                "searching": true,
                "ordering": true,
                "info":     true,
                "scrollY": "600px",
                "scrollCollapse": true,
                } );
    
        }

        $('#loadingDiv').hide();

    }
  });

});

$('#tampilkanvalidasidataTEST').click(function (){

  $('#loadingDiv').show();
  $('#tabledatavalidasi').empty();
  
  var pro = $('#sssproject').val();
  var cbg = $('#scabang').val();
  var akses = $('#akses').val();

  if (cbg == '' || cbg == null) {
    var urlnya = 'getquestdata2';
    var datanya = {pro:pro};
  }else{
    var urlnya = 'getquestdata';
    var datanya = {pro:pro, cbg:cbg};
  }


  $.ajax({
    url:urlnya,
    type:"POST",
    dataType: 'json',
    data:datanya,
    success:function(result){

    var ht =`<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Project</th>
                    <th>Kunjungan</th>
                    <th>Skenario</th>
                    <th>Cabang</th>
                    <th>Shopper</th>
                    <th>Aktual</th>
                    <th>Upload Dialog</th>
                    <th>Upload Rekaman</th>
                    <th>Dialog</th>
                    <th>Rekaman</th>
                    <th>Layout</th>
                    <th>Equest</th>
                    <th>Slip</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>`

                for (let i = 0; i < result.length; i++) {
                  var j = i +1;
                  
            ht +=`<tr>
                    <td>`+j+`</td>
                    <td>`+result[i].nama_project+`</td>
                    <td>`+result[i].kunjunganx+`</td>
                    <td>`+result[i].skenariox+`</td>
                    <td>`+result[i].cabang+` - `+result[i].cabangx+`</td>
                    <td>`+result[i].shp+` - `+result[i].nama_user+`</td>`
                 if (result[i].waktu_assign == null) {
                   ht +=`<td></td>`
                 }else{
                   ht +=`<td>`+result[i].waktu_assign+`</td>`
                 }
                 if (result[i].waktu_upload == null) {
                   ht +=`<td></td>`
                 }else{
                   ht +=`<td>`+result[i].waktu_upload+`</td>`
                 }
                 if (result[i].tglrekaman == null) {
                   ht +=`<td>
                   <section id="tgl`+j+`">
                   </section>
                   </td>`
                 }else{
                   ht +=`<td>`+result[i].tglrekaman+`</td>`
                 }

                 if (result[i].r_sts_dialog == null) {
                    ht +=`<td style="background-color:#ffc107;">`
                 }else if(result[i].r_sts_dialog == 0){
                    ht +=`<td style="background-color:#dc3545;">`
                 }else{
                    ht +=`<td style="background-color:#337ab7;">`
                 }

                 if (result[i].upload_dialog == null || result[i].upload_dialog == '' ) {
                    ht +=``
                 }else{
                     ht +=`<center><i class="fa fa-check"></i><center>`
                 }
                    ht +=`</td>`

                if (result[i].rekaman_status == 0 || result[i].rekaman_status == 1 || result[i].rekaman_status == 4 ) {
                    ht +=`<td style="background-color:#ffc107;">`
                }else if(result[i].rekaman_status == 2){
                    ht +=`<td style="background-color:#dc3545;">`
                }else{
                    ht +=`<td style="background-color:#337ab7;">`
                }

                if (result[i].rekaman_status != 0 ) {
                    ht +=`<center><i class="fa fa-check"></i><center>`
                }else{
                    ht +=`<section id="rek`+j+`"><center><a data-toggle="modal" data-target="#modalinputrekaman" id="inputrekaman`+j+`" data-pro="`+result[i].nama_project+`" data-kpro="`+result[i].project+`" data-cab="`+result[i].cabangx+`" data-kcab="`+result[i].cabang+`" data-sken="`+result[i].skenariox+`" data-ksken="`+result[i].kunjungan+`" data-urutan="`+j+`"
                             class="btn btn-round btn-warning btn-xs inputrekaman"><span class="fa fa-plus fa-fw"></span></a></center>
                             </section>`
                } 
                    ht +=`</td>`

                if (result[i].r_sts_upload_layout == null) {
                   ht +=`<td style="background-color:#ffc107;">`
                }else if(result[i].r_sts_upload_layout == 0){
                   ht +=`<td style="background-color:#dc3545;">`
                }else{
                   ht +=`<td style="background-color:#337ab7;">`
                }
                if (result[i].upload_layout == null || result[i].upload_layout == '' ) {
                  ht +=``
               }else{
                   ht +=`<center><i class="fa fa-check"></i><center>`
               }
                   ht +=`</td>`

                if (result[i].r_sts_upload_ss == null) {
                   ht +=`<td style="background-color:#ffc107;">`
                }else if(result[i].r_sts_upload_ss == 0){
                   ht +=`<td style="background-color:#dc3545;">`
                }else{
                   ht +=`<td style="background-color:#337ab7;">`
                }
                if (result[i].upload_ss == null || result[i].upload_ss == '' ) {
                  ht +=``
               }else{
                   ht +=`<center><i class="fa fa-check"></i><center>`
               }
                   ht +=`</td>`

                if (result[i].r_sts_upload_slip_transaksi == null) {
                   ht +=`<td style="background-color:#ffc107;">`
                }else if(result[i].r_sts_upload_slip_transaksi == 0){
                   ht +=`<td style="background-color:#dc3545;">`
                }else{
                   ht +=`<td style="background-color:#337ab7;">`
                }
                if (result[i].upload_slip_transaksi == null || result[i].upload_slip_transaksi == '' ) {
                   ht +=``
                }else{
                    ht +=`<center><i class="fa fa-check"></i><center>`
                }
                   ht +=`</td>`

          ht +=`<td>`
          if (result[i].project == 'AND1') {
                      
            ht +=`<a target="_blank" href="lihatvalidasi2/`+result[i].num+`" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-eye fa-fw"></span> Lihat </a>`
            
                }else{

            ht +=`<a target="_blank" href="lihatvalidasi/`+result[i].num+`" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-eye fa-fw"></span> Lihat </a>`

                }
        ht +=`</td>         

          </tr>` 

              }

          ht +=`</tbody>
              </table>`

        $('#tabledatavalidasi').append(ht);

        if (document.getElementById('dataTables-example')) {
    
            $('#dataTables-example').DataTable({
                "responsive": true,
                "paging":   true,
                "searching": true,
                "ordering": true,
                "info":     true,
                "scrollY": "600px",
                "scrollCollapse": true,
                } );
    
              }

          $('#loadingDiv').hide();

    }
  });

});

$(document).ready(function () {
	$('#modalinputrekaman').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#pro').attr("value", div.data('pro'));
		modal.find('#kpro').attr("value", div.data('kpro'));
		modal.find('#cab').attr("value", div.data('cab'));
		modal.find('#kcab').attr("value", div.data('kcab'));
		modal.find('#sken').attr("value", div.data('sken'));
		modal.find('#ksken').attr("value", div.data('ksken'));
		modal.find('#urutan').attr("value", div.data('urutan'));
	});
});

$('#saverekaman').click(function (){
    var kpro = $('#kpro').val();
    var kcab = $('#kcab').val();
    var ksken = $('#ksken').val();
    var datemasukrekaman = $('#datemasukrekaman').val();
    var urutan = $('#urutan').val();

    console.log(kpro);
    console.log(kcab);
    console.log(ksken);
    console.log(datemasukrekaman);

    $.ajax({
        url:'updatetglrekaman',
        type:"POST",
        dataType: 'json',
        data:{kpro:kpro, kcab:kcab, ksken:ksken, datemasukrekaman:datemasukrekaman },
        success:function(result){

                var jt =``+datemasukrekaman+``
                $('#tgl'+urutan).empty();
                $('#tgl'+urutan).append(jt);

                var ht =`<center><i class="fa fa-check"></i><center>`
                $('#rek'+urutan).empty();
                $('#rek'+urutan).append(ht);
    
        }
    })

});