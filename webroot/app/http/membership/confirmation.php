<?php

namespace app\http\membership;

use app\Db;
use app\models\Address;
use app\models\Interest;
use app\models\Membership;
use app\models\MembershipType;
use app\models\Person;
use Exception;

spl_autoload_register(function($className) {
        $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
        include_once  $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $className . '.php';
    });

    session_start();

    $db = new Db();

    $membershipType = MembershipType::find($db, $_SESSION['membership_data']['membershipType']);

    $membership = new Membership();
    $membership->setType($membershipType);
    $membership->setStart(new \DateTime());
    $membership->save($db);

    $address = new Address($_SESSION['membership_data']['street1'], $_SESSION['membership_data']['street2'], $_SESSION['membership_data']['city'], $_SESSION['membership_data']['state'], $_SESSION['membership_data']['zip']);
    $address->save($db);

    $primaryMember = new Person($_SESSION['membership_data']['firstName1'], $_SESSION['membership_data']['lastName1'], $_SESSION['membership_data']['phone1'], $_SESSION['membership_data']['email1'], $address);
    $primaryMember->save($db);

    $membership->addMember($db, $primaryMember, 'primary');

    if ($membershipType->getId() === 1) {
        if (!empty($_SESSION['membership_data']['firstName2']) && !empty($_SESSION['membership_data']['lastName2'])) {
            $secondaryMember = new Person($_SESSION['membership_data']['firstName2'], $_SESSION['membership_data']['lastName2'], $_SESSION['membership_data']['phone2'], $_SESSION['membership_data']['email2'], $address);
            $secondaryMember->save($db);
            $membership->addMember($db, $secondaryMember, 'secondary');
        }
        if (!empty($_SESSION['membership_data']['firstName3']) && !empty($_SESSION['membership_data']['lastName3'])) {
            $child1 = new Person($_SESSION['membership_data']['firstName3'], $_SESSION['membership_data']['lastName3'], null, null, $address, $_SESSION['membership_data']['age3']);
            $child1->save($db);
            $membership->addMember($db, $child1, 'child');
        }
        if (!empty($_SESSION['membership_data']['firstName4']) && !empty($_SESSION['membership_data']['lastName4'])) {
            $child2 = new Person($_SESSION['membership_data']['firstName4'], $_SESSION['membership_data']['lastName4'], null, null, $address, $_SESSION['membership_data']['age4']);
            $child2->save($db);
            $membership->addMember($db, $child2, 'child');
        }
        if (!empty($_SESSION['membership_data']['firstName5']) && !empty($_SESSION['membership_data']['lastName5'])) {
            $child3 = new Person($_SESSION['membership_data']['firstName5'], $_SESSION['membership_data']['lastName5'], null, null, $address, $_SESSION['membership_data']['age5']);
            $child3->save($db);
            $membership->addMember($db, $child3, 'child');
        }
        if (!empty($_SESSION['membership_data']['firstName6']) && !empty($_SESSION['membership_data']['lastName6'])) {
            $child4 = new Person($_SESSION['membership_data']['firstName6'], $_SESSION['membership_data']['lastName6'], null, null, $address, $_SESSION['membership_data']['age6']);
            $child4->save($db);
            $membership->addMember($db, $child4, 'child');
        }
    }

    foreach ($_SESSION['membership_data'] as $key => $value) {
        if (substr($key, 0, 6)  == 'check_') {
            $membership->addInterest($db, Interest::find($db, $value));
        }
    }

    mail( 'andynagel2000@gmail.com', 'New CPOS Member Sign-up confirmed', $membership->toEmailString());

    if (!$db->finish()) {
        exit('Error: data not saved');
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </head>
    <body>

        <div id="smart-button-container">
            <div style="text-align: center;">
                <div id="paypal-button-container"></div>
            </div>
        </div>
        <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=USD" data-sdk-integration-source="button-factory"></script>
        <script>
            function initPayPalButton() {
                paypal.Buttons({
                    style: {
                        shape: 'rect',
                        color: 'gold',
                        layout: 'vertical',
                        label: 'paypal',

                    },

                    createOrder: function(data, actions) {
                        return actions.order.create({
                            payer: {
                                name: {
                                    given_name: "PayPal",
                                    surname: "Customer"
                                },
                                address: {
                                    address_line_1: '123 ABC Street',
                                    address_line_2: 'Apt 2',
                                    admin_area_2: 'San Jose',
                                    admin_area_1: 'CA',
                                    postal_code: '95121',
                                    country_code: 'US'
                                },
                                email_address: "customer@domain.com",
                                phone: {
                                    phone_type: "MOBILE",
                                    phone_number: {
                                        national_number: "14082508100"
                                    }
                                }
                            },
                            purchase_units: [{"description":"Test Membership","amount":{"currency_code":"USD","value":2}}]
                        });
                    },

                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            alert('Transaction completed by ' + details.payer.name.given_name + '!');
                        });
                    },

                    onError: function(err) {
                        console.log(err);
                    }
                }).render('#paypal-button-container');
            }
            initPayPalButton();
        </script>

    </body>
</html>
