<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Slots</title>
    <link rel="stylesheet" href="park_slot.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function reserveSlot(slotNumber) {
            $.ajax({
                url: 'save_slot.php',
                type: 'POST',
                data: { slot_number: slotNumber },
                success: function(response) {
                    alert(response);
                    window.location.href = 'slot.php?slot_number=' + slotNumber;
                },
                error: function() {
                    alert('Error in reserving the slot.');
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Parking Slots</h1>

        <div class="parking-grid">
            <?php for ($i = 1; $i <= 15; $i++) : ?>
                <div class="slot" onclick="reserveSlot(<?= $i ?>)">Slot <?= $i ?></div>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
