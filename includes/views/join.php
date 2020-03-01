<?php
//require ('../includes/models/register.php');
?>


                            <div class="modal fade" id="PrivillagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                            <h4 class="modal-title" id="myModalLabel">Terms And Conditions</h4>
                                        </div>
                                        <div class="modal-body">
                                          <?php include ('../includes/views/termsnconditions.html'); ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                 </div>
                                <!-- /.modal-dialog -->
                             </div>



                             <div class="container">

<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            <p class="text-center">Fill all Feild Before clicking SignUp</p>
            <hr class="clean">
          </div>
          <form class="user" method="post" class="validator-form" action="#create">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="firstNames">
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lastNames">
              </div>
            </div>
            <div class="form-group">
              <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="exampleInputUname" placeholder="Username" name="userNames">
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
              </div>
              <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password2">
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input  id="phone" type="tel" class="form-control" name="phone">
              </div>
              <div class="col-sm-6">
                <select class="form-control" id="address-country" name="country"></select>
              </div>
              <div class="col-sm-12">
                <span id="valid-msg" class="hide"></span>
                <span id="error-msg" class="hide"></span>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="exampleInputreferer" placeholder="Referer`s ID" name="ref">
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="exampleInputPromo" placeholder="Promo Code" name = "promo">
            </div>
            <div class="form-group">
                                     <label class="cr-styled">
                                    <input type="checkbox" required>

                                </label>
                                I have read and I agree with all <a class="" data-toggle="modal" data-target="#PrivillagesModal"> <i class="fa fa-link"></i>
                                Terms &amp; Conditions</a>
                                </div>




                            <hr class="dotted">

            <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account" name="signup"/>
            <hr>
            <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
              <i class="fab fa-google fa-fw"></i> Register with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
              <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
            </a> -->
          </form>
          <hr>
          <!-- <div class="text-center">
            <a class="small" href="recover">Forgot Password?</a>
          </div> -->
          <div class="text-center">
            <a class="small" href="login">Already have an account? Login!</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
