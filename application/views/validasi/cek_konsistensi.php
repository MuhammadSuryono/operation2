
<?php $akses = $this->session->userdata('id_divisi')?>

<section id="main-content">
      <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Cek Data Konsistensi Non Skill</h3>
        
        <!-- <h5><strong>Demi meningkatkan kecepatan loading page, maka ada perubahan filter untuk validasi yang sebelumnya filter dengan PROJECT dan KUNJUNGAN sekarang berubah PROJECT dan CABANG. <br>

         Anda bisa menampilkan data dengan memilih salah satu filter - Terima kasih </strong></h5> -->                                             
        <div class="row mt">
          <div class="col-lg-12">

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Cek Data Konsistensi Non Skill</strong></h4>
              
                <input type="hidden" id="akses" value="<?php echo $akses?>">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="selectpicker form-control" name="konsistensi_project" id="konsistensi_project" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <option value="<?=$pr['project_name']?>"> <?=$pr['project_name']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control selectpicker" name="konsistensi_kategori" id="konsistensi_kategori" data-live-search="true">
                        <option value=""> Pilih Kategori</option>
                        <option value="CS"> CS</option>
                        <option value="Teller"> Teller</option>

                    </select>
                </div>

                <div class="col-md-2">
                    <select class="form-control selectpicker" name="konsistensi_variable" id="konsistensi_variable" data-live-search="true">
                        <option value=""> Pilih Variable</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control selectpicker" name="konsistensi_status" id="konsistensi_status" data-live-search="true">
                        <option value=""> Pilih Status</option>
                        <option value="All Data"> All Data</option>
                        <option value="Sudah Validasi"> Sudah Cek Validasi</option>
                        <option value="Belum Validasi"> Belum Cek Validasi</option>

                    </select>
                </div>

                <div class="col-md-2">
                <button type="button" id ="viewdata_konsistensi" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
                </div>


                </div>
                <!-- </form> -->
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
             
                </div>
                
                <section id="unseen">
                <!-- <div class="table table-responsive"> -->



              </section>
            </div>
           </div>
           <div class="col-lg-12">
           	<div class="form-panel">
           		<form action="<?= base_url('validasi/verifikasi_konsistensi') ?>" method="POST">
           		<section id="div_datakonsistensi">
                  	
                 </section>
             </form>
           	</div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

<!--     <script>
    	var fixmeTop = $('.fixme').offset().top;       // get initial position of the element

	$(window).scroll(function() { 
	console.log('TEST');                 // assign scroll event listener

	    var currentScroll = $(window).scrollTop(); // get current position

	    if (currentScroll >= fixmeTop) {           // apply position: fixed if you
	        $('.fixme').css({                      // scroll to that element or below it
	            position: 'fixed',
	            top: '0',
	            left: '0'
	        });
	    } else {                                   // apply position: static
	        $('.fixme').css({                      // if you scroll above it
	            position: 'static'
	        });
	    }

	});
    </script>
 -->