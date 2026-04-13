<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_loggedin']) || $_SESSION['user_loggedin'] !== true) {
	// If the user is not logged in, redirect to the login page
	header("Location: login-signup.php");
	exit();
}


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transportation_ms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Train Booking Form</title>
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="bookings/css/bootstrap.min.css" />
	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="bookings/css/style.css" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div id="booking1" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Departure Station</span>
										<input class="form-control" type="text" name="departure_station"
											placeholder="City or station" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Arrival Station</span>
										<input class="form-control" type="text" name="arrival_station"
											placeholder="City or station" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Departing</span>
										<input class="form-control" type="date" name="departing_date" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Returning</span>
										<input class="form-control" type="date" name="returning_date">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Adults (18+)</span>
										<select class="form-control" name="adults">
											<option>1</option>
											<option>2</option>
											<option>3</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<span class="form-label">Children (0-17)</span>
										<select class="form-control" name="children">
											<option>0</option>
											<option>1</option>
											<option>2</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<span class="form-label">Travel class</span>
										<select class="form-control" name="travel_class">
											<option>Economy class</option>
											<option>Business class</option>
											<option>First class</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-btn">
										<button class="submit-btn" type="submit">Show trains</button>
									</div>
								</div>
							</div>
						</form>

						<div class="Train_list">
							<?php
							if ($_SERVER['REQUEST_METHOD'] == 'POST') {
								// Fetch form data safely
								$departure_station = isset($_POST['departure_station']) ? $_POST['departure_station'] : '';
								$arrival_station = isset($_POST['arrival_station']) ? $_POST['arrival_station'] : '';
								$departing_date = isset($_POST['departing_date']) ? $_POST['departing_date'] : '';
								$returning_date = isset($_POST['returning_date']) ? $_POST['returning_date'] : '';
								$adults = isset($_POST['adults']) ? $_POST['adults'] : '';
								$children = isset($_POST['children']) ? $_POST['children'] : '';
								$travel_class = isset($_POST['travel_class']) ? $_POST['travel_class'] : '';

								// Prepare and execute SQL query
								$sql = "SELECT train_number, train_name, departure_time, arrival_time, duration, price 
            FROM trains 
            WHERE departure_station = ? 
            AND arrival_station = ? 
            AND departure_date = ? 
            AND travel_class = ?";

								$stmt = $conn->prepare($sql);
								$stmt->bind_param("ssss", $departure_station, $arrival_station, $departing_date, $travel_class);
								$stmt->execute();
								$result = $stmt->get_result();


								if ($result->num_rows > 0) {
									echo "<table class='table'>";
									echo "<thead>";
									echo "<tr>";
									echo "<th>train_number</th>";
									echo "<th>train_name</th>";
									echo "<th>departure_time</th>";
									echo "<th>arrival_time</th>";
									echo "<th>duration</th>";
									echo "<th>price</th>";
									echo "<th></th>";
									echo "</tr>";
									echo "</thead>";
									echo "<tbody>";

									while ($row = $result->fetch_assoc()) {
										echo "<tr>
                                                    <td>{$train['train_number']}</td>
                                                    <td>{$train['train_name']}</td>
                                                    <td>{$train['departure_time']}</td>
                                                    <td>{$train['arrival_time']}</td>
                                                    <td>{$train['duration']}</td>
                                                    <td>{$train['price']}</td>
                                                </tr>";
									}
									echo "</tbody>";
									echo "</table>";

								} else {
									echo "No results found.";
								}

								$stmt->close();
								$conn->close();
							}
							?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>