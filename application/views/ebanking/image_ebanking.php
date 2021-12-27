
<?php $akses = $this->session->userdata('id_divisi')?>

<section id="main-content">
      <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Bukti Transaksi E-Banking</h3>
        
                                                  
        <div class="row mt">
          <div class="col-lg-12">

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Bukti Transaksi E-Banking</strong></h4>
              
                <input type="hidden" id="akses" value="<?php echo $akses?>">
                <div class="row mb">
                <div class="col-md-4">
                    <select class="selectpicker form-control" name="ebanking_project" id="ebanking_project" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <option value="<?=$pr['kode']?>"> <?=$pr['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control selectpicker" name="ebanking_trx" id="ebanking_trx" data-live-search="true">
                        <option value=""> Pilih Transaksi</option>
                        <?php foreach($transaksi as $trx):?>
                        <option value="<?=$trx['kode']?>"> <?=$trx['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-2">
                <button type="button" id ="viewdata_image" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
                </div>


                </div>
                <!-- </form> -->
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
             
                </div>
                
                <section id="unseen">

              </section>
            </div>
           </div>
           <div class="col-lg-12">
           	<div class="form-panel">
           		<!-- <form action="<?= base_url('validasi/verifikasi_konsistensi') ?>" method="POST"> -->
           		<section id="div_dataimage">
                  	
                 </section>
             <!-- </form> -->
           	</div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <script>
      
function downloadAll(){
    // var div = document.getElementById("allImages");
    var table = document.getElementsByTagName("table");

    console.log(table);
    // var images = table.getElementsByTagName("img");
    var images = document.getElementsByClassName("gambarnya");

    var id = document.getElementsByClassName("idnya");

    var project = document.getElementsByClassName("projectnya");
    var bank = document.getElementsByClassName("banknya");
    var channel = document.getElementsByClassName("channelnya");
    var transaksi = document.getElementsByClassName("transaksinya");
    var tanggal = document.getElementsByClassName("tanggalnya");


    console.log(images)

    for(i=0; i<images.length ; i++){
        console.log(images[i]);
        // console.log(project[i].value);
        var nama = project[i].value+"_"+bank[i].value+"_"+channel[i].value+"_"+transaksi[i].value+"_"+tanggal[i].value+"_"+id[i].value;

        // downloadWithName(images[i].src,images[i].src);
        downloadWithName(images[i].src,nama);
    }
}

function downloadWithName(uri, name) {
    function eventFire(el, etype){
        if (el.fireEvent) {
            (el.fireEvent('on' + etype));
        } else {
            var evObj = document.createEvent('MouseEvent');
            evObj.initMouseEvent(etype, true, false, 
                 window, 0, 0, 0, 0, 0,
                 false, false, false, false,
                 0, null);
            el.dispatchEvent(evObj);
        }
    }

    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    console.log("success");
    eventFire(link, "click");
}
</script>
