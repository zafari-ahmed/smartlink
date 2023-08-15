
    </div>
 <footer class="text-muted fixed-bottom text-center text-small">
  <div class="row">
  <div class="col-3"><a href=""><i class="icon-plus-square" ></i></a></div>
  <div class="col-3"><a href=""><i class="icon-upload" ></i></a></div>
  <div class="col-3"><a href=""><i class="icon-edit" ></i></a></div>
  <div class="col-3"><a href=""><i class="icon-trash-2" ></i></a></div>
  </div>
  </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script src="assets/js/jquery.js"></script>
    
    <script src="assets/bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/assets/js/vendor/holder.min.js"></script>
    <script src="assets/js/nav.js"></script>

    <script src="assets/js/alert/messenger.min.js"></script>
    <script src="assets/js/alert/messenger-theme-future.js"></script>

    
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);

        $('#help').click(function(){
          $('#player_audio').get(0).play();
        });

        $('.numbersOnly').keyup(function (e) {
            var max = $(this).attr('maxlength');
            this.value = this.value.replace(/[^0-9]/g,'');
            if (this.value.length == max) {
                e.preventDefault();
            } else if (this.value.length > max) {
                // Maximum exceeded
                this.value = this.value.substring(0, max);
            }
        });
      })();


          Messenger.options = {
              extraClasses: 'messenger-fixed messenger-on-top',
              theme: 'block'
          }


          function displayAlert(message, type){
              //type could be error, success, warning, message
              Messenger().hideAll();
              Messenger().post({
                  message: message,
                  type:type,
                  showCloseButton: false
              });
          }

          
    </script>
    
    
  </body>
</html>
