<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Dialog</h3>
        <div class="row mt">
          <div class="col-lg-12">
            
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> DIALOG  </strong></h4>
                <?php if($dialog['r_teks_dialog']==null or $dialog['r_teks_dialog']==''):?>
                <div style="height:1400px;"><embed src="<?= base_url('assets/file/dialog/')?><?=$dialog['upload_dialog']?>" type="application/pdf" width="100%" height="100%"></div>
                <?php else :?>
                <textarea class="form-control" name="dialog" id="dialog" placeholder="Tulis Temuan Disini.." rows="10" style="height:1400px;" readonly><?=str_replace("<br />"," ", $dialog['r_teks_dialog'])?></textarea>
                <?php endif?>
            </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->