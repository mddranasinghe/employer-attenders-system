
<?php
include ("../db_connection.php");
session_start();
$employername=$_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
    $date = $_POST['date'];

  
    $check_query = "SELECT * FROM availability WHERE date='$date' and username='$employername'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        $delete_query = "DELETE FROM availability WHERE date='$date' and username='$employername'";
        if ($conn->query($delete_query) === TRUE) {
            echo "Date deleted successfully";
        } else {
            echo "Error deleting date: " . $conn->error;
        }
    } else {
        $insert_query = "INSERT INTO availability (username,date) VALUES ('$employername','$date')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Date inserted successfully";
        } else {
            echo "Error inserting date: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Availability Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:  #e0dbdf;
        }

        .calendar {
            max-width: 800px;
            height: 450px;
            margin: 40px auto;

            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .calendar h2 {
            text-align: center;
        }

        .calendar .month {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .calendar .month select {
            font-size: 16px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .calendar .weekdays {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .calendar .weekdays div {
            flex: 1;
            text-align: center;
            font-weight: bold;
        }

        .calendar .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .calendar .days div {
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }

        .calendar .days div.available {
            background-color: #4caf50;
            color: #fff;
        }

        .calendar .days div:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4b0150;">
<p style="color:yellow;margin-left:10px;">Employer Name :-<?php echo $_SESSION['username']; ?></p>
        <P class="navbar-brand mx-auto" style="text-align:center;">EMPLOYER  AVAILABILITY  CHECKING  SYSTEM</P>
        <a class="nav-link active " id="main-nav-a" aria-current="page" href="../logout.php" style="margin-left:50px; color:yellow">LOGOUT</a>

    </nav>

    <div class="calendar" id="calendar">
        <h2>Availability Calendar</h2>
        <div class="month">
            <select id="month">
                <option value="0">January</option>
                <option value="1">February</option>
                <option value="2">March</option>
                <option value="3">April</option>
                <option value="4">May</option>
                <option value="5">June</option>
                <option value="6">July</option>
                <option value="7">August</option>
                <option value="8">September</option>
                <option value="9">October</option>
                <option value="10">November</option>
                <option value="11">December</option>
            </select>
            <input type="number" id="year" placeholder="Year">
        </div>
        <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div class="days" id="days"></div>
    </div>
    
 <div> </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendar = document.getElementById('calendar');
            const monthSelect = document.getElementById('month');
            const yearInput = document.getElementById('year');
            const daysContainer = document.getElementById('days');
            const selectedDatesList = document.getElementById('selectedDatesList');
            let selectedDates = [];

           
            function updateCalendar() {
                const month = parseInt(monthSelect.value);
                const year = parseInt(yearInput.value);

        
                daysContainer.innerHTML = '';

                const firstDay = new Date(year, month, 1).getDay();

             
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                for (let i = 0; i < firstDay; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.classList.add('empty');
                    daysContainer.appendChild(dayElement);
                }

                for (let i = 1; i <= daysInMonth; i++) {
                    const dayElement = document.createElement('div');
                    dayElement.textContent = i;
                    dayElement.dataset.date = `${year}-${month + 1}-${i}`;
                    dayElement.addEventListener('click', toggleAvailability);
                    daysContainer.appendChild(dayElement);
                }
            }

     
            function toggleAvailability(event) {
                const day = event.target;
                day.classList.toggle('available');
                const date = day.dataset.date;

         
                if (selectedDates.includes(date)) {
                    selectedDates = selectedDates.filter(d => d !== date);
                } else {
                    selectedDates.push(date);
                }

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); 
                    }
                };
                xhr.send('date=' + date);
            }

            const currentDate = new Date();
            monthSelect.value = currentDate.getMonth();
            yearInput.value = currentDate.getFullYear();
            updateCalendar();

            monthSelect.addEventListener('change', updateCalendar);
            yearInput.addEventListener('input', updateCalendar);
        });
    </script>
</body>
</html>
