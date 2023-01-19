<!DOCTYPE html>

<html lang="en-US">
    <?php
     include("php/session.inc.php");
    
    if (!isset($_SESSION["userfname"])) {
    header("Location:index.php?msg=cartlogin");
}
include("php/header.inc.php");
    ?>
    <section class="topsection">
        <div class="container mb-4">
            <div class="row">
                <div class="col-12">
                    <form class="form border-class" role="form"  name="chgpwd" onsubmit="return pwdchg();"  action="php/changepassword.inc.php" method="post">
                        <div class="text-center">
                            <h2>Change Password</h2>
                        </div>
                        <div class="form-group">
                            <label for="oldpwd">Current Password</label>
                            <input type="password" class="form-control" id="oldpwd" name="oldpwd" placeholder="Old Password" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="newpwd">New Password</label>
                                <input type="password" class="form-control" id="newpwd" name="newpwd" placeholder="New Password" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="connewpwd">Confirm New Password</label>
                                <input type="password" class="form-control" id="connewpwd" name="connewpwd" placeholder="Confirm New Password"  onchange="pwdchgcheck()"required>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="row">
                                <div class="col-sm-12  col-md-6"></div>
                                <div class="col-sm-12 col-md-6">
                                    <button  class="btn btn-lg btn-block btn-success"  type="submit" id="chgpwd" name ="chgpwd-submit"> Change Password</button>
                                </div>
                            </div>
                        </div>
                        
                        <span id='chgpwdmismatchpassword'></span> 
                    </form>
                    
                    <form class="form border-class" role="form"  name="chgpwd" action="php/changeemail.inc.php"   method="post">
                        <div class="text-center">
                            <h2>Change Email</h2>
                        </div>
                         <div class="form-group">
                              <label for="curemail">Current Email</label>
                         <input type="email" class="form-control" id="curemail" name="curemail" value="<?php echo $_SESSION["useremail"]?>"  readonly>
                         </div>
                        <div class="form-group">
                            <label for="curpwd">Current Password</label>
                            <input type="password" class="form-control" id="curpwd" name="curpwd" placeholder="Current Password" required>
                        </div>
                          <div class="form-group">
                              
                            <label for="newemail">New Email</label>
                            <input type="email" class="form-control" id="newemail" name="newemail" placeholder="New Email" required>
                        </div>
                    

                        <div class="col mb-2">
                            <div class="row">
                                <div class="col-sm-12  col-md-6"></div>
                                <div class="col-sm-12 col-md-6">
                                    <button  class="btn btn-lg btn-block btn-success"  type="submit" id="chgemail" name ="chgemail-submit"> Change Email</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

<?php
include("php/footer.inc.php");
?>
</body>
</html>
