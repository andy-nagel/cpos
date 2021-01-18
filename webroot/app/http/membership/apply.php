<?php

namespace app\http\membership;

use app\Db;
use app\models\Address;
use app\models\Membership;
use app\models\MembershipType;
use app\models\Person;
use Exception;

try {
    session_start();
    $_SESSION['membership_data'] = $_POST;

    if (empty($_POST['firstName1']) || empty($_POST['lastName1']) || empty($_POST['phone1']) || empty($_POST['email1'])
        || empty($_POST['street1']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['zip']) || empty($_POST['membershipType'])
    ) {
        header("HTTP/1.0 400 Invalid request");
        header('Location: /');
        exit();
    }

    spl_autoload_register(function($className) {
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
        echo $className . '<br>';
        include_once $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $className . '.php';
    });
} catch (Exception $e) {
    exit($e->getMessage());
}

?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="mb-3" style="padding: 20px;">
            <h3><?php echo $_SESSION['membership_data']['membershipType'] == 1 ? 'Family' : ($_SESSION['membership_data']['membershipType'] == 2 ? 'Individual' : 'Student') ?> Membership</h3>


            <div>
                <?php if ($_SESSION['membership_data']['membershipType'] == 1) { ?><h4>Primary Member</h4><? } ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo $_SESSION['membership_data']['firstName1']; ?> <?php echo $_SESSION['membership_data']['lastName1']; ?><br>
                        <?php echo $_SESSION['membership_data']['street1']; ?><br>
                        <?php echo $_SESSION['membership_data']['street2']; ?><br>
                        <?php echo $_SESSION['membership_data']['city']; ?><br>
                        <?php echo $_SESSION['membership_data']['state']; ?><br>
                        <?php echo $_SESSION['membership_data']['zip']; ?><br>
                    </div>
                    <div class="col-sm-6">
                        Phone: <?php echo $_SESSION['membership_data']['phone1']; ?><br>
                        Email: <?php echo $_SESSION['membership_data']['email1']; ?>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['membership_data']['membershipType'] == 1) { ?>
            <br>
            <div>
                <h4>Secondary Adult</h4>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo $_SESSION['membership_data']['firstName2']; ?> <?php echo $_SESSION['membership_data']['lastName2']; ?>
                    </div>
                    <div class="col-sm-6">
                        Phone: <?php echo $_SESSION['membership_data']['phone2']; ?><br>
                        Email: <?php echo $_SESSION['membership_data']['email2']; ?>
                    </div>
                </div>

                <h4>Children</h4>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if ($_SESSION['membership_data']['firstName3']) { echo $_SESSION['membership_data']['firstName3'] . ' ' . $_SESSION['membership_data']['lastName3'] . ', age ' . $_SESSION['membership_data']['age3'] . '<br>'; } ?>
                        <?php if ($_SESSION['membership_data']['firstName4']) { echo $_SESSION['membership_data']['firstName4'] . ' ' . $_SESSION['membership_data']['lastName4'] . ', age ' . $_SESSION['membership_data']['age4'] . '<br>'; } ?>
                        <?php if ($_SESSION['membership_data']['firstName5']) { echo $_SESSION['membership_data']['firstName5'] . ' ' . $_SESSION['membership_data']['lastName5'] . ', age ' . $_SESSION['membership_data']['age5'] . '<br>'; } ?>
                        <?php if ($_SESSION['membership_data']['firstName6']) { echo $_SESSION['membership_data']['firstName6'] . ' ' . $_SESSION['membership_data']['lastName6'] . ', age ' . $_SESSION['membership_data']['age6'] . '<br>'; } ?>
                    </div>
                </div>
                <?php } ?>
                <h3>Interests</h3>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="checkbox" name="check_advertising" id="check_advertising" value="1"<?php echo $_SESSION['membership_data']['check_advertising'] ? ' checked' : ''; ?> disabled>
                        <label for="check_advertising" class="form-label">Advertising</label>
                        <br>
                        <input type="checkbox" name="check_lighting" id="check_lighting" value="2"<?php echo $_SESSION['membership_data']['check_lighting'] ? ' checked' : ''; ?> disabled>
                        <label for="check_lighting" class="form-label">Lighting</label>
                        <br>
                        <input type="checkbox" name="check_performance" id="check_performance" value="3"<?php echo $_SESSION['membership_data']['check_performance'] ? ' checked' : ''; ?> disabled>
                        <label for="check_performance" class="form-label">Performance</label>

                        <br>
                        <input type="checkbox" name="check_bo" id="check_bo" value="4"<?php echo $_SESSION['membership_data']['check_bo'] ? ' checked' : ''; ?> disabled>
                        <label for="check_bo" class="form-label">Box Office</label>
                        <br>
                        <input type="checkbox" name="check_maintenance" id="check_maintenance" value="5"<?php echo $_SESSION['membership_data']['check_maintenance'] ? ' checked' : ''; ?> disabled>
                        <label for="check_maintenance" class="form-label">Maintenance</label>
                        <br>
                        <input type="checkbox" name="props_check" id="props_check" value="6"<?php echo $_SESSION['membership_data']['props_check'] ? ' checked' : ''; ?> disabled>
                        <label for="props_check" class="form-label">Props</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="checkbox" name="check_costumes" id="check_costumes" value="7"<?php echo $_SESSION['membership_data']['check_costumes'] ? ' checked' : ''; ?> disabled>
                        <label for="check_costumes" class="form-label">Costumes</label>
                        <br>
                        <input type="checkbox" name="check_makeup" id="check_makeup" value="8"<?php echo $_SESSION['membership_data']['check_makeup'] ? ' checked' : ''; ?> disabled>
                        <label for="check_makeup" class="form-label">Make-up</label>
                        <br>
                        <input type="checkbox" name="check_set_building" id="check_set_building" value="9"<?php echo $_SESSION['membership_data']['check_set_building'] ? ' checked' : ''; ?> disabled>
                        <label for="check_set_building" class="form-label">Set Building</label>

                        <br>
                        <input type="checkbox" name="check_design" id="check_design" value="10"<?php echo $_SESSION['membership_data']['check_design'] ? ' checked' : ''; ?> disabled>
                        <label for="check_design" class="form-label">Design</label>
                        <br>
                        <input type="checkbox" name="check_marketing" id="check_marketing" value="11"<?php echo $_SESSION['membership_data']['check_marketing'] ? ' checked' : ''; ?> disabled>
                        <label for="check_marketing" class="form-label">Marketing</label>
                        <br>
                        <input type="checkbox" name="check_stage_crew" id="check_stage_crew" value="12"<?php echo $_SESSION['membership_data']['check_stage_crew'] ? ' checked' : ''; ?> disabled>
                        <label for="check_stage_crew" class="form-label">Stage Crew</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="checkbox" name="check_directing" id="check_directing" value="13"<?php echo $_SESSION['membership_data']['check_directing'] ? ' checked' : ''; ?> disabled>
                        <label for="check_directing" class="form-label">Directing</label>
                        <br>
                        <input type="checkbox" name="check_membership" id="check_membership" value="14"<?php echo $_SESSION['membership_data']['check_membership'] ? ' checked' : ''; ?> disabled>
                        <label for="check_membership" class="form-label">Membership</label>
                        <br>
                        <input type="checkbox" name="check_sound" id="check_sound" value="15"<?php echo $_SESSION['membership_data']['check_sound'] ? ' checked' : ''; ?> disabled>
                        <label for="check_sound" class="form-label">Sound</label>

                        <br>
                        <input type="checkbox" name="check_hair" id="check_hair" value="16"<?php echo $_SESSION['membership_data']['check_hair'] ? ' checked' : ''; ?> disabled>
                        <label for="check_hair" class="form-label">Hair</label>
                        <br>
                        <input type="checkbox" name="check_painting" id="check_painting" value="17"<?php echo $_SESSION['membership_data']['check_painting'] ? ' checked' : ''; ?> disabled>
                        <label for="check_painting" class="form-label">Painting</label>
                        <br>
                        <input type="checkbox" name="check_usher" id="check_usher" value="18"<?php echo $_SESSION['membership_data']['check_usher'] ? ' checked' : ''; ?> disabled>
                        <label for="check_usher" class="form-label">Ushering</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12"><button type="button" class="btn btn-danger" onclick="location.href='/'">I need to fix something</button><button type="submit" class="btn btn-primary" onclick="location.href='/app/http/membership/confirmation.php'">Submit</button></div>
                </div>
            </div>
        </div>
    </body>
</html>
