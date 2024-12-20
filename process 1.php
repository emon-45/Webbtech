<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stname = $_POST['stname'];
    $stid = $_POST['stid'];
    $email = $_POST['email'];
    $bt = $_POST['bt'];
    $bd = $_POST['bd'];
    $rn = $_POST['rn'];
    $tn = $_POST['tn'];
    $fees = $_POST['fees'];

    $errors = [];

    if (empty($stname)) {
        $errors[] = 'Student Name is required';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $stname)) {
        $errors[] = 'Student Name must contain only letters and spaces';
    }

    if (empty($stid)) {
        $errors[] = 'Student ID is required';
    } elseif (!preg_match('/^\d{2}-\d{5}-\d{1}$/', $stid)) {
        $errors[] = 'Invalid Student ID format. Format should be XX-XXXXX-X';
    }

    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!preg_match('/^\d{2}-\d{5}-\d@student\.aiub\.edu$/', $email)) {
        $errors[] = 'Invalid email format. Format should be XX-XXXXX-X@student.aiub.edu';
    }

    if (empty($bt)) {
        $errors[] = 'Book Title is required';
    }

    if (empty($bd)) {
        $errors[] = 'Borrow Date is required';
    }

    if (empty($rn)) {
        $errors[] = 'Return Date is required';
    }

    if (empty($tn)) {
        $errors[] = 'Token Number is required';
    } elseif (!ctype_digit($tn)) {
        $errors[] = 'Token Number must contain only numbers';
    }

    if (empty($fees)) {
        $errors[] = 'Fees are required';
    } elseif (!is_numeric($fees) || $fees <= 0) {
        $errors[] = 'Fees must be a positive numeric value only';
    }

    if (!empty($bd) && !empty($rn)) {
        $borrowDate = new DateTime($bd);
        $returnDate = new DateTime($rn);
        if ($returnDate < $borrowDate) {
            $errors[] = "Return date cannot be earlier than borrow date.";
        }
    }

    if (isset($_COOKIE[$bt])) {
        $last_borrow_time = $_COOKIE[$bt];
        if (time() - $last_borrow_time < 25) {
            $errors[] = "This book has already been borrowed within the last 25 seconds. Please wait.";
        }
    }

    if (isset($_COOKIE['borrowed_books'])) {
        $borrowedBooks = json_decode($_COOKIE['borrowed_books'], true);
        if (in_array($stid, $borrowedBooks)) {
            $errors[] = "Student has already borrowed a book within the last 25 seconds.";
        }
    }

    if (empty($errors)) {
        $borrowedBooks = isset($_COOKIE['borrowed_books']) ? json_decode($_COOKIE['borrowed_books'], true) : [];
        $borrowedBooks[] = $stid;
        setcookie('borrowed_books', json_encode($borrowedBooks), time() + 25, "/");

        setcookie($bt, time(), time() + 25, "/");

        echo "<table style='width:60%; border: 1px solid #ddd; border-collapse: collapse; margin: auto;'>";
        echo "<tr><th style='padding: 10px; background-color: #e70da6; color: white;'>Item</th><th style='padding: 10px; background-color: #e70da6; color: white;'>Details</th></tr>";
        echo "<tr><td style='padding: 8px;'>Student Name</td><td style='padding: 8px;'>$stname</td></tr>";
        echo "<tr><td style='padding: 8px;'>Student ID</td><td style='padding: 8px;'>$stid</td></tr>";
        echo "<tr><td style='padding: 8px;'>Email</td><td style='padding: 8px;'>$email</td></tr>";
        echo "<tr><td style='padding: 8px;'>Book Title</td><td style='padding: 8px;'>$bt</td></tr>";
        echo "<tr><td style='padding: 8px;'>Borrow Date</td><td style='padding: 8px;'>$bd</td></tr>";
        echo "<tr><td style='padding: 8px;'>Return Date</td><td style='padding: 8px;'>$rn</td></tr>";
        echo "<tr><td style='padding: 8px;'>Token Number</td><td style='padding: 8px;'>$tn</td></tr>";
        echo "<tr><td style='padding: 8px;'>Fees</td><td style='padding: 8px;'>$fees</td></tr>";
        echo "</table>";

        echo '<div style="text-align: center; margin-top: 20px;">';
        echo '<button onclick="window.print()" style="padding: 10px 20px; background-color:#e70da6 ; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 20px;">Print</button>';

        $qrData = "Student Name: $stname\nStudent ID: $stid\nEmail: $email\nBook Title: $bt\nBorrow Date: $bd\nReturn Date: $rn\nToken Number: $tn\nFees: $fees";
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrData) . "&size=150x150";
        echo "<h3>QR Code for Borrow Information</h3>";
        echo "<img src='$qrUrl' alt='QR Code' style='margin-top: 10px;'>";

        echo '</div>';
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>Error: $error</p>";
        }
    }
} else {
    echo "<p style='color: yellow;'>Error: Invalid request method</p>";
}
?>
