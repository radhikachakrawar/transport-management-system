<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root"; // Change to your database username
$password = ""; // Change to your database password
$dbname = "transportation_ms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    error_log("Invalid input data");
    die(json_encode(['success' => false, 'message' => 'Invalid input data']));
}

$bus_id = $data['bus_id'];
$seats_selected = $data['seats_selected'];

if (empty($bus_id) || empty($seats_selected)) {
    error_log("Missing bus_id or seats_selected");
    die(json_encode(['success' => false, 'message' => 'Missing bus_id or seats_selected']));
}

$bus_query = $conn->prepare("SELECT * FROM buses WHERE bus_id = ?");
if (!$bus_query) {
    error_log("Prepare failed: " . $conn->error);
    die(json_encode(['success' => false, 'message' => 'Database query failed.']));
}
$bus_query->bind_param("i", $bus_id);
$bus_query->execute();
$bus_result = $bus_query->get_result();

if ($bus_result->num_rows > 0) {
    $bus_details = $bus_result->fetch_assoc();

    $stmt = $conn->prepare("INSERT INTO bookings (bus_id, seats_selected) VALUES (?, ?)");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        die(json_encode(['success' => false, 'message' => 'Database query failed.']));
    }
    $stmt->bind_param("is", $bus_id, $seats_selected);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Booking confirmed.',
            'booking_details' => [
                'bus_id' => $bus_id,
                'bus_name' => $bus_details['bus_name'],
                'departure_city' => $bus_details['departure_city'],
                'arrival_city' => $bus_details['arrival_city'],
                'departing_date' => $bus_details['departing_date'],
                'returning_date' => isset($bus_details['returning_date']) ? $bus_details['returning_date'] : 'N/A',
                'bus_type' => $bus_details['bus_type'],
                'seats_selected' => $seats_selected
            ]
        ]);
    } else {
        error_log("Execute failed: " . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Booking failed.']);
    }

    $stmt->close();
} else {
    error_log("Bus not found with bus_id: " . $bus_id);
    echo json_encode(['success' => false, 'message' => 'Bus not found.']);
}

$bus_query->close();
$conn->close();
?>
