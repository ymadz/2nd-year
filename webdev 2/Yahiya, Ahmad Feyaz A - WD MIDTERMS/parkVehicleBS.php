<?php
require_once "classes/parking.class.php";
require_once "classes/function.class.php";

$vehicle_plate = $parking_slot_id = $remarks = '';
$vehicle_plateErr = $parking_slotErr = '';

$parkingObj = new Parking;

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['park'])) {
    $vehicle_plate = clean_input($_POST['vehicle_plate']);
    $parking_slot_id = clean_input($_POST['parking_slot_id']);
    $remarks = clean_input($_POST['remarks']);

    if (empty($vehicle_plate)) {
        $vehicle_plateErr = "Vehicle plate is required.";
    }

    if (empty($parking_slot_id)) {
        $parking_slotErr = "Please select a parking slot.";
    }

    if (empty($vehicle_plateErr) && empty($parking_slotErr)) {
        $parkingObj->vehicle_plate = $vehicle_plate;
        $parkingObj->parking_slot_id = $parking_slot_id;
        $parkingObj->remarks = $remarks;

        if ($parkingObj->parkVehicle()) {
            header("Location: parkingLotBS.php");
            exit();
        } else {
            echo "Something went wrong while parking the vehicle.";
        }
    }
}

$available_slots = $parkingObj->getAvailableSlots();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Park Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }

    </style>
</head>
<body>
    <br><br>
    <div class="container">
    <div class="card">
    <div class="card-header">
    <h1>Park Vehicle</h1>
    </div>
    <div class="card_body p-5">
    <form class="form" action="" method="POST">
        <label for="vehicle_plate">Vehicle Plate<span class="error"> *</span></label>
        <input type="text" name="vehicle_plate" id="vehicle_plate" value="<?php echo htmlspecialchars($vehicle_plate); ?>"><br>
        <span class="error"><?php echo $vehicle_plateErr; ?></span><br>

        <label for="parking_slot_id">Select Parking Slot<span class="error"> *</span></label>
        <select name="parking_slot_id" id="parking_slot_id">
            <option value="">-- Select Available Slot --</option>
            <?php foreach ($available_slots as $slot): ?>
                <option value="<?php echo $slot['id']; ?>" <?php echo $parking_slot_id == $slot['id'] ? 'selected' : ''; ?>>
                    <?php echo $slot['slot_number']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <span class="error"><?php echo $parking_slotErr; ?></span><br>

        <label for="remarks">Remarks</label><br>
        <textarea name="remarks" id="remarks"><?php echo htmlspecialchars($remarks); ?></textarea><br><br>

        <input class="btn btn-success" type="submit" name="park" value="Park Vehicle">
    </form>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
