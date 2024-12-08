<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);

    $user_id = $input['user_id'] ?? null;
    $desired_coins = $input['desired_coins'] ?? null;

    if (!$user_id || !is_numeric($desired_coins) || $desired_coins < 0 || $desired_coins > 99999) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input.']);
        exit;
    }

    $current_coins = 200; // Example current coins
    $new_coins = $current_coins + $desired_coins;

    $is_vip = $new_coins > 999;

    echo json_encode([
        'success' => true,
        'new_coins' => $new_coins,
        'is_vip' => $is_vip
    ]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b2838 !important;
            color: #d3d3d3;
            font-family: Arial, sans-serif;
            color: white !important;
        }

        .card {
            max-width: 400px;
            margin: 50px auto;
            padding: 1.9rem 1.2rem;
            /* text-align: center; */
            background: #2a2b38;
            border-radius: 10px;
        }

        .field {
            margin-top: 1rem;
            display: flex;
            /* align-items: center;
            justify-content: center; */
            gap: .5em;
            background-color: #1f2029;
            border-radius: 4px;
            padding: .8em 1em;
            color: white !important;
        }

        .input-icon {
            height: 1.5em;
            width: 1.5em;
            fill: #ffeba7;
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: #d3d3d3;
        }

        .btnl {
            margin-top: 1rem;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: .9em;
            text-transform: uppercase;
            padding: 0.7em 1.5em;
            background-color:  #e4ef49 !important;
            color: white !important;
            box-shadow: 0 8px 24px 0 rgb(255 235 167 / 20%);
            transition: all .3s ease-in-out;
        }

        .btnl:hover {
            background-color: #5e6681;
            color: #ffeba7;
            box-shadow: 0 8px 24px 0 rgb(16 39 112 / 20%);
        }

        .details {
            text-align: left;
            margin: 1rem 0;
            background: #1f2029;
            border-radius: 5px;
            padding: 1rem;
            color: white !important;
        }

        .details p {
            margin: 0.5rem 0;
        }

        h4, .title {
            color: yellow;
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <div class="card bg-dark">
        <h4 class="title">Add Coins</h4>
        <form id="add-coins-form">
            <div class="field">
                <input type="radio" id="momo" name="paymentMethod" value="momo" checked>
                <label for="momo">Momo</label>
            </div>
            <div class="field">
                <input type="radio" id="bank" name="paymentMethod" value="bank">
                <label for="bank">Banking</label>
            </div>
            <div id="payment-details" class="details d-none">
                <h4>Payment Details</h4>
                <p id="payment-info"></p>
            </div>
            <div class="field">
                <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5C3.89 3 3 3.9 3 5v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-2.5 9c-.83 0-1.5-.67-1.5-1.5S15.67 9 16.5 9s1.5.67 1.5 1.5S17.33 12 16.5 12zM6 18l3.87-5.16 2.13 2.85 3.13-4.21L18 18H6z"></path></svg>
                <input type="number" id="desired-coins" class="input-field" placeholder="Enter coins to add (0-99999)" min="0" max="99999">
            </div>
            <button type="submit" class="btnl">Add Coins</button>
        </form>
    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const paymentDetails = document.getElementById('payment-details');
            const paymentInfo = document.getElementById('payment-info');
            const desiredCoinsInput = document.getElementById('desired-coins');
            const addCoinsForm = document.getElementById('add-coins-form');

            document.querySelectorAll('input[name="paymentMethod"]').forEach((radio) => {
                radio.addEventListener('change', () => {
                    paymentDetails.classList.remove('d-none');

                    if (radio.value === 'momo') {
                        paymentInfo.innerHTML = `
                            <strong>Name:</strong> Danh Son Ha<br>
                            <strong>Phone Number:</strong> 0123456789
                        `;
                    } else if (radio.value === 'bank') {
                        paymentInfo.innerHTML = `
                            <strong>Owner:</strong> Danh Son Ha<br>
                            <strong>Bank:</strong> OCB<br>
                            <strong>Account Number:</strong> 0123456789123
                        `;
                    }
                });
            });

            // Trigger Momo's change event to set default details
            const momoRadio = document.getElementById('momo');
            momoRadio.checked = true; // Ensure Momo is selected
            momoRadio.dispatchEvent(new Event('change')); // Trigger change event for Momo

            addCoinsForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const desiredCoins = parseInt(desiredCoinsInput.value, 10);
                if (isNaN(desiredCoins) || desiredCoins <= 0 || desiredCoins > 99999) {
                    alert('Please enter a valid number of coins between 1 and 99999.');
                    return;
                }

                fetch('add_coins.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: 1, desired_coins: desiredCoins })
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert(`Coins added successfully! New Balance: ${data.new_coins}${data.is_vip ? ' - VIP Customer!' : ''}`);
                        } else {
                            alert('Failed to add coins. Please try again.');
                        }
                    })
                    .catch((error) => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>
