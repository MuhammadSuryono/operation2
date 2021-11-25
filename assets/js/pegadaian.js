  //Penggadaian

  $('#simpan_gadai').click(function (){

    var td1 = $('#td_1_1').val();
    var td2 = $('#td_1_2').val();
    var td3 = $('#td_1_3').val();
    var td4 = $('#td_2_1').val();
    var td5 = $('#td_2_2').val();
    var td6 = $('#td_2_3').val();
    var td7 = $('#td_3_1').val();
    var td8 = $('#td_3_2').val();
    var td9 = $('#td_3_3').val();
  
  
    if (td1 != "" && td2 != "" && td3 != "" && td4 != "" && td5 != "" && td6 != "" && td7 != "" && td8 != "" && td9 != "" ) {
      
      Swal({
        position: 'center',
        type: 'success',
        title: "Data Tersimpan",
        text: "data berhasil disimpan",
        showConfirmButton: false,
        timer: 2000
      });
    
    }else{
  
      Swal({
        position: 'center',
        type: 'error',
        title: "Data tidak lengkap",
        text: "Gagal menyimpan data",
        showConfirmButton: false,
        timer: 2000
      });
  
    }
  
  });

  $('#skenario_gadai').change(function(){
    var pro = $('#pro_gadai').val();
    var ske = $('#skenario_gadai').val();

    $('#loadingDiv').show();

    $('#dataTables_reporttd').empty();
    $('#progresstd').empty();

    $.ajax({
      url:"get_db_gadai",
      type:"POST",
      dataType: 'json',
      data:{pro:pro, ske:ske},      
      success:function(result){
        console.log(result[0].length);
        console.log(result[1].length);
        console.log(result[2].length);

        if (ske == '001') {

        var ht =`<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr align='center'>
                    	<th rowspan="2"><center>No<center></th> 
                    	<th rowspan="2"><center>Validator<center></th> 
                    	<th rowspan="2"><center>Kode<center></th> 
                    	<th rowspan="2"><center>Cabang<center></th> 
                      <th colspan="4"><center>T1A. TD ANTRI PENAKSIR<center></th>
                      <th colspan="4"><center>T9A. TD PENAKSIR<center></th>
                      <th colspan="4"><center>X1. TD TOTAL GADAI<center></th>
                      <th><center>C01. Apakah staf Kasir = staf Penaksir?<center></th>
                    </tr>
                    	<th><center>Selesai isi slip gadai/ diminta menunggu dipanggil<center></th>
                      <th><center>Dipanggil penaksir<center></th>
                      <th><center>Lama TD<center></th>
                      <th><center>Penyebab  lama (jika lebih dari 10 menit)<center></th>
                    	<th><center>Dipanggil penaksir<center></th>
                      <th><center>Selesai dilayani penaksir<center></th>
                      <th><center>Lama TD<center></th>
                      <th><center>Penyebab  lama (jika lebih dari 10 menit)<center></th>
                    	<th><center>Dipanggil penaksir<center></th>
                      <th><center>Menerima uang dan slip gadai dari kasir<center></th>
                      <th><center>Lama TD<center></th>
                      <th><center>Penyebab  lama (jika lebih dari 15 menit)<center></th>
                      <th><center>1. Ya 2. Tidak <center></th>
                    </tr>
                  </thead>                            
                  <tbody>` 
                          
                    for (let i = 0; i < result[0].length; i++) {
                      var num = i + 1;
                ht +=`<tr>
                      <td>`+num+`</td>`
                      
                      ht +=`<td>`
                      loop0 :
                      for (let z = 0; z < result[1].length; z++) {
                        if (result[0][i].kode == result[1][z].kode_cabang) {
                          ht +=result[1][z].name
                          break loop0;
                        } 
                      }
                      ht +=`</td>`
                      
                ht +=`<td>`+result[0][i].kode+`</td>`
                ht +=`<td>`+result[0][i].nama+`</td>`

                ht +=`<td><center>`
                      loop1 :
                        for (let k = 0; k < result[2].length; k++) {
                          if (result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T1A. TD ANTRI PENAKSIR' && result[2][k].sub_proses == 'Selesai isi slip gadai/ diminta menunggu dipanggil' ) {
                            ht +=result[2][k].td
                            break loop1;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop2 :
                        for (let k = 0; k < result[2].length; k++) {          
                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T1A. TD ANTRI PENAKSIR' && result[2][k].sub_proses == 'Dipanggil penaksir'){
                            ht +=result[2][k].td
                            break loop2;
                          }
                        }
                 ht +=`<center></td>

                      <td><center>`
                      loop3 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T1A. TD ANTRI PENAKSIR' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].td
                            break loop3;
                          }
                        }
                 ht +=`<center></td>

                      <td><center>`
                      loop31 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T1A. TD ANTRI PENAKSIR' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].penyebab_lama
                            break loop31;
                          }
                        }
                ht +=`<center></td>
                
                      <td><center>`
                      loop4 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T9A. TD PENAKSIR' && result[2][k].sub_proses == 'Dipanggil penaksir'){
                            ht +=result[2][k].td
                            break loop4;
                          }
                        }
                ht +=`<center></td>
               
                      <td><center>`
                        loop5 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T9A. TD PENAKSIR' && result[2][k].sub_proses == 'Selesai dilayani penaksir'){
                            ht +=result[2][k].td
                            break loop5;
                          }
                        }
                ht +=`<center></td>
                      
                      <td><center>`
                      loop6 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T9A. TD PENAKSIR' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].td
                            break loop6;
                          }
                        }
                ht +=`<center></td>
                      
                      <td><center>`
                      loop61 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'T9A. TD PENAKSIR' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].penyebab_lama
                            break loop61;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop7 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'X1. TD TOTAL GADAI' && result[2][k].sub_proses == 'Dipanggil penaksir'){
                            ht +=result[2][k].td
                            break loop7;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop8 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'X1. TD TOTAL GADAI' && result[2][k].sub_proses == 'Menerima uang dan slip gadai dari kasir'){
                            ht +=result[2][k].td
                            break loop8;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop9 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'X1. TD TOTAL GADAI' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].td
                            break loop9;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop91 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001' &&  result[2][k].proses == 'X1. TD TOTAL GADAI' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].penyebab_lama
                            break loop91;
                          }
                        }
                ht +=`<center></td>`
                        
                ht +=`<td><center>`
                        loop10 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '001'){
                            if (result[2][k].kasir_penaksir == 1) {
                              ht +=`YA`
                            }else{
                              ht +=`TIDAK`
                            }
                            break loop10;
                          }
                        }
                
                ht +=`<center></td>
                      </tr>`
                    }
            ht +=`</tbody>  
                </table>`

              }else{

        var ht =`<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr align='center'>
                    	<th rowspan="2"><center>No<center></th> 
                    	<th rowspan="2"><center>Validator<center></th> 
                    	<th rowspan="2"><center>Kode<center></th> 
                    	<th rowspan="2"><center>Cabang<center></th> 
                      <th colspan="4"><center>C20A. TD KASIR<center></th>
                      <th colspan="4"><center>G1A. TD PENGELOLA AGUNAN<center></th>
                      <th colspan="4"><center>Y1. TD TOTAL TEBUS<center></th>
                      <th><center>G01. Apakah staf Kasir = staf Pengelola agunan?<center></th>
                    </tr>
                    	<th><center>Shp mengatakan ( ingin tebus )<center></th>
                      <th><center>Shp selesai pelayanan di kasir<center></th>
                      <th><center>Lama TD<center></th>
                      <th><center>Penyebab  lama (jika lebih dari 15 menit)<center></th>
                    	<th><center>Shp selesai pembayaran di kasir<center></th>
                      <th><center>Shp mendapatkan barang gadai<center></th>
                      <th><center>Lama TD<center></th>
                      <th><center>Penyebab  lama (jika lebih dari 10 menit)<center></th>
                    	<th><center>Shp mengatakan ( ingin tebus ) ke kasir<center></th>
                      <th><center>Shp mendapatkan barang gadai<center></th>
                      <th><center>Lama TD<center></th>
                      <th><center>Penyebab  lama (jika lebih dari 15 menit)<center></th>
                      <th><center>1. Ya 2. Tidak <center></th>
                    </tr>
                  </thead>                            
                  <tbody>` 
                    loop99 :                           
                    for (let i = 0; i < result[0].length; i++) {
                      var num = i + 1;
                ht +=`<tr>
                      <td>`+num+`</td>`

                      ht +=`<td>`
                      loop0 :
                      for (let z = 0; z < result[1].length; z++) {
                        if (result[0][i].kode == result[1][z].kode_cabang) {
                          ht +=result[1][z].name
                          break loop0;
                        } 
                      }
                      ht +=`</td>`

                ht +=`<td>`+result[0][i].kode+`</td>
                      <td>`+result[0][i].nama+`</td>`

                ht +=`<td><center>`
                      loop1 :
                        for (let k = 0; k < result[2].length; k++) {
                          if (result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'C20A. TD KASIR' && result[2][k].sub_proses == 'Shp mengatakan ( ingin tebus )' ) {
                            ht +=result[2][k].td
                            break loop1;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop2 :
                        for (let k = 0; k < result[2].length; k++) {          
                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'C20A. TD KASIR' && result[2][k].sub_proses == 'Shp selesai pelayanan di kasir'){
                            ht +=result[2][k].td
                            break loop2;
                          }
                        }
                 ht +=`<center></td>

                      <td><center>`
                      loop3 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'C20A. TD KASIR' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].td
                            break loop3;
                          }
                        }
                 ht +=`<center></td>

                      <td><center>`
                      loop31 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'C20A. TD KASIR' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].penyebab_lama
                            break loop31;
                          }
                        }
                ht +=`<center></td>
                
                      <td><center>`
                      loop4 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'G1A. TD PENGELOLA AGUNAN' && result[2][k].sub_proses == 'Shp selesai pembayaran di kasir'){
                            ht +=result[2][k].td
                            break loop4;
                          }
                        }
                ht +=`<center></td>
               
                      <td><center>`
                        loop5 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'G1A. TD PENGELOLA AGUNAN' && result[2][k].sub_proses == 'Shp mendapatkan barang gadai'){
                            ht +=result[2][k].td
                            break loop5;
                          }
                        }
                ht +=`<center></td>
                      
                      <td><center>`
                      loop6 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'G1A. TD PENGELOLA AGUNAN' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].td
                            break loop6;
                          }
                        }
                ht +=`<center></td>
                      
                      <td><center>`
                      loop61 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'G1A. TD PENGELOLA AGUNAN' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].penyebab_lama
                            break loop61;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop7 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'Y1. TD TOTAL TEBUS' && result[2][k].sub_proses == 'Shp mengatakan ( ingin tebus ) ke kasir'){
                            ht +=result[2][k].td
                            break loop7;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop8 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'Y1. TD TOTAL TEBUS' && result[2][k].sub_proses == 'Shp mendapatkan barang gadai'){
                            ht +=result[2][k].td
                            break loop8;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop9 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'Y1. TD TOTAL TEBUS' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].td
                            break loop9;
                          }
                        }
                ht +=`<center></td>

                      <td><center>`
                      loop91 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002' &&  result[2][k].proses == 'Y1. TD TOTAL TEBUS' && result[2][k].sub_proses == 'Durasi'){
                            ht +=result[2][k].penyebab_lama
                            break loop91;
                          }
                        }
                ht +=`<center></td>`
                        
                ht +=`<td><center>`
                        loop10 :
                        for (let k = 0; k < result[2].length; k++) {  

                          if(result[0][i].kode == result[2][k].kode_cabang && result[2][k].id_skenario == '002'){
                            if (result[2][k].kasir_penaksir == 1) {
                              ht +=`YA`
                            }else{
                              ht +=`TIDAK`
                            }
                            break loop10;
                          }
                        }
                
                ht +=`<center></td>
                      </tr>`
                    }
            ht +=`</tbody>  
                </table>`
        
        }

        $('#dataTables_reporttd').append(ht);

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

        var jt=
              `<h5><strong>PROGRESS : `+result[1].length+`/`+result[0].length+`</strong></h5>`
        $('#progresstd').append(jt);
        $('#loadingDiv').hide();

      }
    });
  });

  $('#exportexcelgd').click(function(){
    var pro = $('#pro_gadai').val();
    var ske = $('#skenario_gadai').val();
    console.log(`test`+pro);
    console.log(`test`+ske);
    if (pro=='' || ske=='') {
      alert('Project dan skenario tidak boleh kosong !')
    }else{
    var table = $('#dataTables-example').DataTable();
    $('<table>')
          .append($(table.table().header()).clone())
          .append(table.$('tr').clone())
          .table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: `Report Time Delivery-`+pro+`-`+ske,
          fileext: ".xls",
          columns: [],
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
        });
      }
    });

    $('#skenario_td_gd_edit').change(function(){
        var pro = $('#project_td_gd_edit').val();
        var ske = $('#skenario_td_gd_edit').val();
        $('#cbg_td_gd_edit').selectpicker('destroy');
        $('#cbg_td_gd_edit').empty();
        $('#kasir_penaksi').empty();
        $('#dataTables_edittd_gd').empty();
        
        $.ajax({
            url:"get_cbg_gd",
            type:"POST",
            dataType: 'json',
            data:{pro:pro, ske:ske},      
            success:function(result){
                console.log(result.length);
                var ht=`<option value="">Pilih Cabang</option>`;
                for (let i = 0; i < result.length; i++) {
                    ht +=`<option value="`+result[i].kode+`">`+result[i].nama+`</option>`
                }
                $('#cbg_td_gd_edit').append(ht);
                
                if ($('#cbg_td_gd_edit')) {
                    $('#cbg_td_gd_edit').selectpicker({
                        liveSearch:true,
                        maxOptions:1
                    } );
                }
            }
        });
    });
    
    $('#cbg_td_gd_edit').change(function(){
        var pro = $('#project_td_gd_edit').val();
        var ske = $('#skenario_td_gd_edit').val();
        var cbg = $('#cbg_td_gd_edit').val();
        $('#kasir_penaksi').empty();
        $('#dataTables_edittd_gd').empty();

        $.ajax({
            url:"get_cbg_db_edit",
            type:"POST",
            dataType: 'json',
            data:{pro:pro, ske:ske, cbg:cbg},
            success:function(result) {
                console.log(result);

     var ctk =`<div class="col-md-4 mb">`
                if (ske == '001') {
                    ctk +=`<input class="form-control" type="text" value="C01. Apakah staf Kasir = staf Penaksir?" readonly>`
                }else{
                    ctk +=`<input class="form-control" type="text" value="G01. Apakah staf Kasir = staf Pengelola agunan?" readonly>`
                }
        ctk +=`</div>
               <div class="col-md-1 mb">`
               if (result[0].kasir_penaksir == '1') {
                   ctk +=`<select name="kasir_penaksir" class="form-control"> 
                    <option selected value="1">YA</option> 
                    <option value="2">TIDAK</option> 
                   </select>`
               }else{
                ctk +=`<select name="kasir_penaksir" class="form-control"> 
                    <option value="1">YA</option> 
                    <option selected value="2">TIDAK</option> 
                </select>`
               }
        ctk +=`</div>`

            $('#kasir_penaksi').append(ctk);
                
      var ht=`<table class="table table-bordered table-condensed table-responsive-sm" id="datatable_gd">
                <thead>
                  <tr align='center'>
                    <th><center>Proses<center></th>
                    <th><center>Sub Proses<center></th>
                    <th><center>TD<center></th>
                    <th><center>Penyebab Lama<center></th>
                    <th><center>Temuan<center></th>
                  </tr>
                </thead>                            
                <tbody>                            
                  <tr>
                    <td rowspan="3">`+result[0].proses+`</td>
                    <td>`+result[0].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num0" value="`+result[0].id_waktu+`">
                    <input class="form-control" type="text" name="td0" value="`+result[0].td+`">
                    </td>
                    <td rowspan="3">
                    <input type="hidden" name="numlama0" value="`+result[0].id_waktu+`">
                    <input class="form-control" type="text" name="penyebab_lama0" value="`+result[0].penyebab_lama+`">
                    </td>
                    <td rowspan="9">
                    <input type="hidden" name="num0" value="`+result[0].id_waktu+`">
                    <input class="form-control" type="text" name="temuan0" value="`+result[0].temuan+`"></td>
                  </tr>
                  <tr>
                    <td>`+result[1].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num1" value="`+result[1].id_waktu+`">
                    <input class="form-control" type="text" name="td1" value="`+result[1].td+`">
                    </td>
                  </tr>
                  <tr>
                    <td>`+result[2].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num2" value="`+result[2].id_waktu+`">
                    <input class="form-control" type="text" name="td2" value="`+result[2].td+`">                                        
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="3">`+result[3].proses+`</td>
                    <td>`+result[3].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num3" value="`+result[3].id_waktu+`">
                    <input class="form-control" type="text" name="td3" value="`+result[3].td+`">
                    </td>
                    <td rowspan="3">
                    <input type="hidden" name="numlama3" value="`+result[3].id_waktu+`">
                    <input class="form-control" type="text" name="penyebab_lama3" value="`+result[3].penyebab_lama+`">
                    </td>
                  </tr>
                  <tr>
                    <td>`+result[4].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num4" value="`+result[4].id_waktu+`">
                    <input class="form-control" type="text" name="td4" value="`+result[4].td+`">
                    </td>
                  </tr>
                  <tr>
                    <td>`+result[5].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num5" value="`+result[5].id_waktu+`">
                    <input class="form-control" type="text" name="td5" value="`+result[5].td+`">
                    </td>
                  </tr>
                  <tr>
                    <td rowspan="3">`+result[6].proses+`</td>
                    <td>`+result[6].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num6" value="`+result[6].id_waktu+`">
                    <input class="form-control" type="text" name="td6" value="`+result[6].td+`">
                    </td>
                    <td rowspan="3">
                    <input type="hidden" name="numlama6" value="`+result[6].id_waktu+`">
                    <input class="form-control" type="text" name="penyebab_lama6" value="`+result[6].penyebab_lama+`">
                    </td>
                  </tr>
                  <tr>
                    <td>`+result[7].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num7" value="`+result[7].id_waktu+`">
                    <input class="form-control" type="text" name="td7" value="`+result[7].td+`">
                    </td>
                  </tr>
                  <tr>
                    <td>`+result[8].sub_proses+`</td>
                    <td>
                    <input type="hidden" name="num8" value="`+result[8].id_waktu+`">
                    <input class="form-control" type="text" name="td8" value="`+result[8].td+`">
                    </td>
                  </tr>
                </tbody>  
              </table>`

              $('#dataTables_edittd_gd').append(ht);
            
            }
        });

    });

    $('#simpan_edit_gd').click(function (){
      
        Swal({
          position: 'center',
          type: 'success',
          title: "Data Tersimpan",
          text: "data berhasil disimpan",
          showConfirmButton: false,
          timer: 2000
        });
      
    });