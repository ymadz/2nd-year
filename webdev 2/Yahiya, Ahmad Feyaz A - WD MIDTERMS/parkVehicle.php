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
            header("Location: parkingLot.php");
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
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Park Vehicle</h1>

    <form action="" method="POST">
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

        <input type="submit" name="park" value="Park Vehicle">
    </form>
</body>
</html>
