<?php
    include 'connection.php';
    // include 'logic.php';
    

    $conn = connect();
    $_SESSION['username'] = "martin";
    $full_name = "Vu Minh Ha";
    $email = "123@gmail.com";
    $address = "2240 Uxbridge Dr NW";
    $city = "Calgary";
    $state = "AB";
    $zip = "T2N3Z4";
    $card_name = "Vu Minh Ha";
    $card_number = "1111-2222-3333-4444";
    saveUserPaymentInfo($conn, $_SESSION['username'], $full_name, $email, $address, $city, $state, $zip, $card_name, $card_number);
    // increaseArtistRate($conn, 'Travis Scott');
        
        


    // echo json_encode($output, JSON_PRETTY_PRINT);
    closeCon($conn);
?>