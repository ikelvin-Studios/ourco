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
