<?php
require_once "classes/parking.class.php";
require_once "classes/function.class.php";

$parkingObj = new Parking;
$search_plate = '';
$search_results = [];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])) {
    $search_plate = clean_input($_POST['search_plate']);
    $search_results = $parkingObj->searchParkingTransactions($search_plate);
} else {
    $search_results = $parkingObj->viewParkingTransactions();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['exit'])) {
    $transaction_id = clean_input($_POST['transaction_id']);
    if ($parkingObj->exitVehicle($transaction_id)) {
        header("Location: parkingLot.php?success=1");
        exit();
    } else {
        echo "Error exiting vehicle.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Lot</title>
    <style>
        .error {
            color: red;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Parking Transactions</h1>
    <a href="parkVehicle.php">PARK VEHICLE</a>

    <form action="parkingLot.php" method="POST">
        <label for="search_plate">Search by Vehicle Plate:</label>
        <input type="text" name="search_plate" id="search_plate" value="<?php echo htmlspecialchars($search_plate); ?>">
        <input type="submit" name="search" value="Search">
    </form>

    <table>
        <thead>
            <tr>
                <th>Vehicle Plate</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
                <th>Parking Slot</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($search_results as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction['vehicle_plate']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['entry_time']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['exit_time']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['slot_number']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['status']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['remarks']); ?></td>
                    <td>
                        <?php if ($transaction['status'] == 'Parked'): ?>
                            <form action="parkingLot.php" method="POST">
                                <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                                <input type="submit" name="exit" value="Exit Vehicle">
                            </form>
                        <?php else: ?>
                            <span>Exited</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
