<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bus Booking Form</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="bookings/css/bootstrap.min.css?v=1" />
    <link type="text/css" rel="stylesheet" href="bookings/css/style.css?v=1" />
    <link rel="stylesheet" href="seat-selection.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .booking-confirmation {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Departure City</span>
                                        <input class="form-control" type="text" name="departure_city"
                                            placeholder="City or bus stop" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="form-label">Arrival City</span>
                                        <input class="form-control" type="text" name="arrival_city"
                                            placeholder="City or bus stop" required>
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
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <span class="form-label">Children (0-17)</span>
                                        <select class="form-control" name="children">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <span class="form-label">Bus Type</span>
                                        <select class="form-control" name="bus_type">
                                            <option value="Standard">Standard</option>
                                            <option value="Deluxe">Deluxe</option>
                                            <option value="Luxury">Luxury</option>
                                        </select>
                                        <span class="select-arrow"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-btn">
                                        <button class="submit-btn" type="submit">Show buses</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="bus_list">
                            <?php
                            // Check if form is submitted
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Get form data
                                $departure_city = $_POST['departure_city'];
                                $arrival_city = $_POST['arrival_city'];
                                $departing_date = $_POST['departing_date'];
                                $returning_date = isset($_POST['returning_date']) ? $_POST['returning_date'] : null;
                                $adults = $_POST['adults'];
                                $children = $_POST['children'];
                                $bus_type = $_POST['bus_type'];

                                // Calculate total passengers
                                $total_passengers = $adults + $children;

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

                                // Prepare the SQL query
                                $sql = "SELECT * FROM buses 
                                        WHERE departure_city = ? 
                                        AND arrival_city = ? 
                                        AND departing_date = ? 
                                        AND bus_type = ?
                                        AND seats_available >= ?";

                                if ($returning_date) {
                                    $sql .= " AND returning_date = ?";
                                }

                                $stmt = $conn->prepare($sql);

                                if ($returning_date) {
                                    $stmt->bind_param("ssssii", $departure_city, $arrival_city, $departing_date, $bus_type, $total_passengers, $returning_date);
                                } else {
                                    $stmt->bind_param("ssssi", $departure_city, $arrival_city, $departing_date, $bus_type, $total_passengers);
                                }

                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    echo "<table class='table'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Bus ID</th>";
                                    echo "<th>Departure City</th>";
                                    echo "<th>Arrival City</th>";
                                    echo "<th>Departing Date</th>";
                                    echo "<th>Returning Date</th>";
                                    echo "<th>Bus Type</th>";
                                    echo "<th>Seats Available</th>";
                                    echo "<th></th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";

                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["bus_id"] . "</td>";
                                        echo "<td>" . $row["departure_city"] . "</td>";
                                        echo "<td>" . $row["arrival_city"] . "</td>";
                                        echo "<td>" . $row["departing_date"] . "</td>";
                                        echo "<td>" . (isset($row["returning_date"]) ? $row["returning_date"] : 'N/A') . "</td>";
                                        echo "<td>" . $row["bus_type"] . "</td>";
                                        echo "<td>" . $row["seats_available"] . "</td>";
                                        echo "<td> <button class='book-btn' type='button' data-bus-id='" . $row["bus_id"] . "'>Book</button> </td>";
                                        echo "</tr>";
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for seat selection -->
    <div id="seatSelectionModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Select Your Seats</h2>
            <div id="seats">
                <div class="legend">
                    <div>
                        <div class="box available"></div>= Available
                    </div>
                    <div>
                        <div class="box selected"></div>= Selected
                    </div>
                    <div>
                        <div class="box occupied"></div>= Occupied
                    </div>
                </div>

                <div class="seat-container">
                    <div class="seat" data-seat="A1"></div>
                    <div class="seat" data-seat="A2"></div>
                    <div class="seat driver"></div>
                    <div class="seat" data-seat="A3"></div>
                    <div class="seat" data-seat="B1"></div>
                    <div class="seat" data-seat="B2"></div>
                    <div class="seat" data-seat="B3"></div>
                    <div class="seat" data-seat="B4"></div>
                    <div class="seat" data-seat="C1"></div>
                    <div class="seat" data-seat="C2"></div>
                    <div class="seat" data-seat="C3"></div>
                    <div class="seat" data-seat="C4"></div>
                    <div class="seat" data-seat="D1"></div>
                    <div class="seat" data-seat="D2"></div>
                    <div class="seat" data-seat="D3"></div>
                    <div class="seat" data-seat="D4"></div>
                    <div class="seat" data-seat="E1"></div>
                    <div class="seat" data-seat="E2"></div>
                    <div class="seat" data-seat="E3"></div>
                    <div class="seat" data-seat="E4"></div>
                    <div class="seat" data-seat="F1"></div>
                    <div class="seat" data-seat="F2"></div>
                    <div class="seat" data-seat="F3"></div>
                    <div class="seat" data-seat="F4"></div>
                </div>
            </div>
            <button id="confirmSeatsBtn">Confirm</button>
            <!-- Booking confirmation details -->
            <div id="bookingConfirmation" style="display:none;">
                <h3>Booking Confirmation</h3>
                <div id="confirmationDetails"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle seat selection and booking confirmation -->
    <script>
        window.onload = function () {
            const modal = document.getElementById('seatSelectionModal');
            const closeBtn = document.getElementsByClassName('close')[0];
            const confirmSeatsBtn = document.getElementById('confirmSeatsBtn');
            const bookingConfirmation = document.getElementById('bookingConfirmation');
            const confirmationDetails = document.getElementById('confirmationDetails');
            let selectedBusId = null;

            document.querySelectorAll('.book-btn').forEach(button => {
                button.addEventListener('click', event => {
                    selectedBusId = event.target.getAttribute('data-bus-id');
                    modal.style.display = 'block';
                    // Add code to display available seats
                });
            });

            closeBtn.onclick = () => {
                modal.style.display = 'none';
            };

            window.onclick = event => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };

            const seats = document.querySelectorAll('.seat-container .seat');
            seats.forEach(seat => {
                seat.addEventListener('click', () => {
                    if (!seat.classList.contains('occupied') && !seat.classList.contains('driver')) {
                        seat.classList.toggle('selected');
                    }
                });
            });

            confirmSeatsBtn.addEventListener('click', () => {
                const selectedSeats = Array.from(seats)
                    .filter(seat => seat.classList.contains('selected'))
                    .map(seat => seat.getAttribute('data-seat'));

                if (selectedSeats.length === 0) {
                    alert('Please select at least one seat.');
                    return;
                }

                const bookingDetails = {
                    bus_id: selectedBusId,
                    seats_selected: selectedSeats.join(',')
                };

                console.log('Booking Details:', bookingDetails);

                fetch('book.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(bookingDetails)
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Server Response:', data);
                        if (data.success) {
                            alert('Booking confirmed!');
                            bookingConfirmation.style.display = 'block';
                            confirmationDetails.innerHTML = `
                        <strong>Bus ID:</strong> ${data.booking_details.bus_id}<br>
                        <strong>Bus Name:</strong> ${data.booking_details.bus_name}<br>
                        <strong>Departure City:</strong> ${data.booking_details.departure_city}<br>
                        <strong>Arrival City:</strong> ${data.booking_details.arrival_city}<br>
                        <strong>Departing Date:</strong> ${data.booking_details.departing_date}<br>
                        <strong>Returning Date:</strong> ${data.booking_details.returning_date}<br>
                        <strong>Bus Type:</strong> ${data.booking_details.bus_type}<br>
                        <strong>Seats Selected:</strong> ${data.booking_details.seats_selected}
                    `;
                            modal.style.display = 'none';
                        } else {
                            alert('Booking failed: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
            });
        };

    </script>
</body>

</html>