 <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Tribuygo 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?= base_url()?>administrator/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url()?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
<script src="<?= base_url()?>assets/js/demo/datatables-demo.js"></script>
<script src="<?= base_url()?>assets/js/jquery.json-view.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?= base_url()?>assets/js/jquery.easy-autocomplete.min.js"></script> 

<script src="<?= base_url()?>assets/js/keys.js"></script> 


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
var whichPage = '<?= $page ?? ''; ?>';
// Getting sugesstion from the server 
  
  window.addEventListener('load', function() {



    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();

        } else {

           event.preventDefault();

          if(whichPage === 'add-key-word') {

            // Give the suggesstion to the page 

            
            var csrfid = $('#csrf_ajax').val();

            // Get the keyworld 

            var keyword = $('#validationCustom03').val();
            // Check if csrf token is changed 

            
           $('#add-key-loader').css('display', 'block');

            $.ajax({
              type: 'POST',
              url: ORIGIN+"/administrator/addkeyword",
              data: {csrf_test_name: csrfid, keyword : keyword},
              dataType: "json",
              success: function(resultData) 
              { 
                // Check if response data 

                console.log(resultData);

                  
                  if(typeof resultData.success !== undefined && resultData.success === true) {

                     $.alert({
                        title: 'Success!',
                        content: 'Keyword sucessfully added!',
                        buttons: {

                            confirm: function () {
                                
                                window.location.reload();
                             },
                        }
                    });

                     // refresh the page 
                     //window.location.reload();
                  } else {

                    $.alert({
                        title: 'Error!',
                        content: JSON.stringify(resultData),
                    });
                  }
                  


              },

              complete: function(){
                  $('#add-key-loader').hide();
               },
                error: function (jqXHR, textStatus, errorThrown) { alert(errorThrown); }
              
              });
                

                }
                  
                }


                form.classList.add('was-validated');

                // Check which page is getting 
                


              }, false);
            });

  }, false);




 



})();



</script>


 

<?php

$data = "<script> $('#element').jsonView($result);</script>";

echo $data;

?>

<script>

</script>



</body>

</html>
