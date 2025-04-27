<?php

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];
$people = $_POST['people'];
$message = $_POST['message'];

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "grilli";

// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserting records using prepared statements
$sql = $conn->prepare("INSERT INTO book_table (name, email, phone, date, time, people, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("sssssis", $name, $email, $phone, $date, $time, $people, $message);

if ($sql->execute() === TRUE) {
    echo "<h2>Records inserted successfully</h2>";
} else {
    echo "Error inserting records: " . $conn->error;
}

$sql->close();
$conn->close();
?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', async function() {
    const name = "<?php echo $name; ?>";
    const email = "<?php echo $email; ?>";
    const phone = "<?php echo $phone; ?>";
    const date = "<?php echo $date; ?>";
    const time = "<?php echo $time; ?>";
    const people = "<?php echo $people; ?>";
    const message = "<?php echo $message; ?>";

    const messageTemplate =
        `Name: ${name}\nEmail: ${email}\nPhone: ${phone}\nDate: ${date}\nTime: ${time}\nPeople: ${people}\nMessage: ${message}`;

    try {
        let response = await fetch('http://localhost:8080/ap/email/SECRET_KEY', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                to: email,
                text: "Your booking",
                subject: "Your booking Confirmation",
                message: messageTemplate
            })
        });

        if (response.ok) {
            let result = await response.text();
            console.log("Email sent successfully:", result);
        } else {
            console.error("Error sending email:", response.statusText);
        }
    } catch (error) {
        console.error("Error:", error);
    }
});
</script>