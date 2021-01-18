<?php session_start(); ?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    </head>
<body>
<form action="app/http/membership/apply.php" method="post" enctype="application/x-www-form-urlencoded">
    <div class="mb-3" style="padding: 20px;">
        <label for="membershipType">Membership Type</label>
        <select class="form-select" id="membershipType" name="membershipType" aria-label="Membership Type Select">
            <option value="1">Family - $50</option>
            <option value="2">Individual - $25</option>
            <option value="3">Student - $10</option>
        </select>

        <div>
            <h3>Primary Member</h3>
            <div class="row">
                <div class="col-sm-6">
                    <label for="firstName1" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName1" name="firstName1" value="<?php echo $_SESSION['membership_data']['firstName1']; ?>">
                    <label for="lastName1" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName1" name="lastName1" value="<?php echo $_SESSION['membership_data']['lastName1']; ?>">
                </div>
                <div class="col-sm-6">
                    <label for="phone1" class="form-label">Phone</label>
                    <input type="phone1" class="form-control" id="phone1" name="phone1" value="<?php echo $_SESSION['membership_data']['phone1']; ?>">
                    <label for="email1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email1" name="email1" aria-describedby="emailHelp" value="<?php echo $_SESSION['membership_data']['email1']; ?>">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <label for="street1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" id="street1" name="street1" value="<?php echo $_SESSION['membership_data']['street1']; ?>">
                </div>
                <div class="col-sm-12">
                    <label for="street2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="street2" name="street2" value="<?php echo $_SESSION['membership_data']['street2']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $_SESSION['membership_data']['city']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" value="<?php echo $_SESSION['membership_data']['state']; ?>">
                </div>
                <div class="col-sm-4">
                    <label for="zip" class="form-label">Zip Code</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $_SESSION['membership_data']['zip']; ?>">
                </div>
            </div>
        </div>
        <br>
        <div>
            <h3>Family Membership Only</h3>
            <h3>Secondary Adult</h3>
            <div class="row">
                <div class="col-sm-6">
                    <label for="firstName2" class="form-label">First Name</label>
                    <input type="text" class="form-control family" id="firstName2" name="firstName2" value="<?php echo $_SESSION['membership_data']['firstName2']; ?>">
                    <label for="lastName2" class="form-label">Last Name</label>
                    <input type="text" class="form-control family" id="lastName2" name="lastName2" value="<?php echo $_SESSION['membership_data']['lastName2']; ?>">
                </div>
                <div class="col-sm-6">
                    <label for="phone2" class="form-label">Phone</label>
                    <input type="phone" class="form-control family" id="phone2" name="phone2" value="<?php echo $_SESSION['membership_data']['phone2']; ?>">
                    <label for="email2" class="form-label">Email address</label>
                    <input type="email" class="form-control family" id="email2" name="email2" aria-describedby="emailHelp" value="<?php echo $_SESSION['membership_data']['email2']; ?>">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
            </div>

            <h3>Children</h3>
                <div class="row">
                    <div class="col-sm">
                        <label for="firstName3" class="form-label">First Name</label>
                        <input type="text" class="form-control family" id="firstName3" name="firstName3" value="<?php echo $_SESSION['membership_data']['firstName3']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="lastName3" class="form-label">Last Name</label>
                        <input type="text" class="form-control family" id="lastName3" name="lastName3" value="<?php echo $_SESSION['membership_data']['lastName3']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="age3" class="form-label">Age</label>
                        <input type="text" class="form-control family" id="age3" name="age3" value="<?php echo $_SESSION['membership_data']['age3']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label for="firstName4" class="form-label">First Name</label>
                        <input type="text" class="form-control family" id="firstName4" name="firstName4" value="<?php echo $_SESSION['membership_data']['firstName4']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="lastName4" class="form-label">Last Name</label>
                        <input type="text" class="form-control family" id="lastName4" name="lastName4" value="<?php echo $_SESSION['membership_data']['lastName4']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="age4" class="form-label">Age</label>
                        <input type="text" class="form-control family" id="age4" name="age4" value="<?php echo $_SESSION['membership_data']['age4']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label for="firstName5" class="form-label">First Name</label>
                        <input type="text" class="form-control family" id="firstName5" name="firstName5" value="<?php echo $_SESSION['membership_data']['firstName5']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="lastName5" class="form-label">Last Name</label>
                        <input type="text" class="form-control family" id="lastName5" name="lastName5" value="<?php echo $_SESSION['membership_data']['lastName5']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="age5" class="form-label">Age</label>
                        <input type="text" class="form-control family" id="age5" name="age5" value="<?php echo $_SESSION['membership_data']['age5']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <label for="firstName6" class="form-label">First Name</label>
                        <input type="text" class="form-control family" id="firstName6" name="firstName6" value="<?php echo $_SESSION['membership_data']['firstName6']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="lastName6" class="form-label">Last Name</label>
                        <input type="text" class="form-control family" id="lastName6" name="lastName6" value="<?php echo $_SESSION['membership_data']['lastName6']; ?>">
                    </div>
                    <div class="col-sm">
                        <label for="age6" class="form-label">Age</label>
                        <input type="text" class="form-control family" id="age6" name="age6" value="<?php echo $_SESSION['membership_data']['age6']; ?>">
                    </div>
                </div>
                <h3>Interests</h3>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="checkbox" name="check_advertising" id="check_advertising" value="1"<?php echo $_SESSION['membership_data']['check_advertising'] ? ' checked' : ''; ?>>
                        <label for="check_advertising" class="form-label">Advertising</label>
                        <br>
                        <input type="checkbox" name="check_lighting" id="check_lighting" value="2"<?php echo $_SESSION['membership_data']['check_lighting'] ? ' checked' : ''; ?>>
                        <label for="check_lighting" class="form-label">Lighting</label>
                        <br>
                        <input type="checkbox" name="check_performance" id="check_performance" value="3"<?php echo $_SESSION['membership_data']['check_performance'] ? ' checked' : ''; ?>>
                        <label for="check_performance" class="form-label">Performance</label>
                        <br>
                        <input type="checkbox" name="check_bo" id="check_bo" value="4"<?php echo $_SESSION['membership_data']['check_bo'] ? ' checked' : ''; ?>>
                        <label for="check_bo" class="form-label">Box Office</label>
                        <br>
                        <input type="checkbox" name="check_maintenance" id="check_maintenance" value="5"<?php echo $_SESSION['membership_data']['check_maintenance'] ? ' checked' : ''; ?>>
                        <label for="check_maintenance" class="form-label">Maintenance</label>
                        <br>
                        <input type="checkbox" name="props_check" id="props_check" value="6"<?php echo $_SESSION['membership_data']['props_check'] ? ' checked' : ''; ?>>
                        <label for="props_check" class="form-label">Props</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="checkbox" name="check_costumes" id="check_costumes" value="7"<?php echo $_SESSION['membership_data']['check_costumes'] ? ' checked' : ''; ?>>
                        <label for="check_costumes" class="form-label">Costumes</label>
                        <br>
                        <input type="checkbox" name="check_makeup" id="check_makeup" value="8"<?php echo $_SESSION['membership_data']['check_makeup'] ? ' checked' : ''; ?>>
                        <label for="check_makeup" class="form-label">Make-up</label>
                        <br>
                        <input type="checkbox" name="check_set_building" id="check_set_building" value="9"<?php echo $_SESSION['membership_data']['check_set_building'] ? ' checked' : ''; ?>>
                        <label for="check_set_building" class="form-label">Set Building</label>
                        <br>
                        <input type="checkbox" name="check_design" id="check_design" value="10"<?php echo $_SESSION['membership_data']['check_design'] ? ' checked' : ''; ?>>
                        <label for="check_design" class="form-label">Design</label>
                        <br>
                        <input type="checkbox" name="check_marketing" id="check_marketing" value="11"<?php echo $_SESSION['membership_data']['check_marketing'] ? ' checked' : ''; ?>>
                        <label for="check_marketing" class="form-label">Marketing</label>
                        <br>
                        <input type="checkbox" name="check_stage_crew" id="check_stage_crew" value="12"<?php echo $_SESSION['membership_data']['check_stage_crew'] ? ' checked' : ''; ?>>
                        <label for="check_stage_crew" class="form-label">Stage Crew</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="checkbox" name="check_directing" id="check_directing" value="13"<?php echo $_SESSION['membership_data']['check_directing'] ? ' checked' : ''; ?>>
                        <label for="check_directing" class="form-label">Directing</label>
                        <br>
                        <input type="checkbox" name="check_membership" id="check_membership" value="14"<?php echo $_SESSION['membership_data']['check_membership'] ? ' checked' : ''; ?>>
                        <label for="check_membership" class="form-label">Membership</label>
                        <br>
                        <input type="checkbox" name="check_sound" id="check_sound" value="15"<?php echo $_SESSION['membership_data']['check_sound'] ? ' checked' : ''; ?>>
                        <label for="check_sound" class="form-label">Sound</label>
                        <br>
                        <input type="checkbox" name="check_hair" id="check_hair" value="16"<?php echo $_SESSION['membership_data']['check_hair'] ? ' checked' : ''; ?>>
                        <label for="check_hair" class="form-label">Hair</label>
                        <br>
                        <input type="checkbox" name="check_painting" id="check_painting" value="17"<?php echo $_SESSION['membership_data']['check_painting'] ? ' checked' : ''; ?>>
                        <label for="check_painting" class="form-label">Painting</label>
                        <br>
                        <input type="checkbox" name="check_usher" id="check_usher" value="18"<?php echo $_SESSION['membership_data']['check_usher'] ? ' checked' : ''; ?>>
                        <label for="check_usher" class="form-label">Ushering</label>
                    </div>
                </div>
            <br>
                <div class="row">
                    <div class="col-sm-12"><button type="submit" class="btn btn-primary">Submit</button></div>
                </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $("#membershipType").click(function() {
        if ($("#membershipType").val() == 1) {
            $(".family").attr('disabled', false);
        } else {
            $(".family").attr('disabled', true);
        }
    });
</script>
</body>
</html>
