 **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->

  <?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
}
?>
<style type="text/css">
 
.step {
  display: none;
}
.step.active {
  display: block;

</style>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> E-Banking </h3>
        <div class="row mt">
          <div class="col-lg-12">

            <section>
                <div class="container">
                  <form>

                    <div class="step step-1 active">
                      <div class="card" style="width: 18rem;">
                        <div class="card-header bg-danger">
                          Nama Shopper
                        </div>
                        <div class="card-body bg-warning">
                          
                        </div>
                      </div>
                     
                      <button type="button" class="next-btn">Next</button>
                    </div>

                    <div class="step step-2">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email">
                      </div>
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone-number">
                      </div>
                      <button type="button" class="previous-btn">Prev</button>
                      <button type="button" class="next-btn">Next</button>
                    </div>

                    <div class="step step-3">
                      <div class="form-group">
                        <label for="country">country</label>
                        <input type="text" id="country" name="country">
                      </div>
                      <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city">
                      </div>
                      <div class="form-group">
                        <label for="postCode">Post Code</label>
                        <input type="text" id="postCode" name="post-code">
                      </div>
                      <button type="button" class="previous-btn">Prev</button>
                      <button type="submit" class="submit-btn">Submit</button>
                    </div>

                  </form>
                </div>
              </section>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>





    <!-- /MAIN CONTENT -->
    <!--main content end -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }

    const steps = Array.from(document.querySelectorAll("form .step"));
    const nextBtn = document.querySelectorAll("form .next-btn");
    const prevBtn = document.querySelectorAll("form .previous-btn");
    const form = document.querySelector("form");

    nextBtn.forEach((button) => {
      button.addEventListener("click", () => {
        changeStep("next");
      });
    });
    prevBtn.forEach((button) => {
      button.addEventListener("click", () => {
        changeStep("prev");
      });
    });

    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const inputs = [];
      form.querySelectorAll("input").forEach((input) => {
        const { name, value } = input;
        inputs.push({ name, value });
      });
      console.log(inputs);
      form.reset();
    });

    function changeStep(btn) {
      let index = 0;
      const active = document.querySelector(".active");
      index = steps.indexOf(active);
      steps[index].classList.remove("active");
      if (btn === "next") {
        index++;
      } else if (btn === "prev") {
        index--;
      }
      steps[index].classList.add("active");
    }

  </script>
