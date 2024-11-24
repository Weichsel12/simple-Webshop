<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zur Kasse</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .checkout-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .checkout-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="email"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .submit-button {
            background-color: #2a9d8f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .submit-button:hover {
            background-color: #21867a;
        }
    </style>
</head>
<body>
    <div class="checkout-container">
        <h2>Checkout</h2>
        <form action="checkout.php" method="post">
            <div class="form-group">
                <label for="billing_address">Rechnungsadresse</label>
                <input type="text" id="billing_address" name="billing_address" required>
            </div>

            <div class="form-group">
                <label for="shipping_address">Lieferadresse</label>
                <input type="text" id="shipping_address" name="shipping_address" required>
            </div>

            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Zahlungsmethode</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="rechnung">Rechnung</option>
                    <option value="kreditkarte">Kreditkarte</option>
                </select>
            </div>

            <!-- Submit button to finalize the order -->
            <button type="submit" class="submit-button">Bestellung abschließen</button>
        </form>
    </div>
</body>
</html>
