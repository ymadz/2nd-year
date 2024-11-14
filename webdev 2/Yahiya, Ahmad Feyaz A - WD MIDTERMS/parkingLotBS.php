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
        header("Location: parkingLotBS.php?success=1");
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
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <br><br>
    <div class="container">
    <div class="card">
    <div class="card-header">
    <h1>Parking Transactions</h1>
    </div>
    <div class="card-body">
    <div class="d-flex justify-content-start align-items-center">
        <form action="parkingLotBS.php" method="POST" class="d-flex">
            <label for="search_plate" class="me-2">Search by Vehicle Plate:</label>
            <input type="text" name="search_plate" id="search_plate" class="form-control me-2" value="<?php echo htmlspecialchars($search_plate); ?>">
            <input type="submit" name="search" class="btn btn-primary" value="Search">
        </form>
        <a class="btn btn-success m-2" href="parkVehicleBS.php">PARK VEHICLE</a>
    </div>
</div>
    <div class="card-body">
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr class="table-secondary">
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
            <?php 
            if(empty($search_results)){?>
            <tr>
                <td style="text-align: center;" colspan="7">No data found.</td>
            </tr>
            <?php
            }
            foreach ($search_results as $transaction): ?>
                <tr>
                    <td><?php echo htmlspecialchars($transaction['vehicle_plate']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['entry_time']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['exit_time']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['slot_number']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['status']); ?></td>
                    <td><?php echo htmlspecialchars($transaction['remarks']); ?></td>
                    <td>
                        <?php if ($transaction['status'] == 'Parked'): ?>
                            <form action="parkingLotBS.php" method="POST">
                                <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                                <input class="btn btn-danger" type="submit" name="exit" value="Exit Vehicle">
                            </form>
                        <?php else: ?>
                            <span>Exited</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </div>
    </table>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
