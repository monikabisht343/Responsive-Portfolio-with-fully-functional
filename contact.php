<?php

// Include the database connection file
require 'config/database.php';

// Define a variable to hold the message
$message = "";

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $messageText = $_POST['message'];

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($messageText)) {
        try {
            // Prepare an SQL statement to insert form data into the database
            $sql = "INSERT INTO portfolio_db.contacts (name, email, subject, message)
                    VALUES (:name, :email, :subject, :message)";

            $stmt = $pdo->prepare($sql);

            // Bind the form data to the SQL query parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':message', $messageText);

            // Execute the query
            if ($stmt->execute()) {
                // Success message
                $message = "<div class='alert alert-success' id='successMessage' role='alert'>
                                Your message has been successfully sent.
                            </div>";
            } else {
                // Error message for failure
                $message = "<div class='alert alert-danger' role='alert'>
                                Failed to send your message. Please try again later.
                            </div>";
            }
        } catch (PDOException $e) {
            // Error message for database issues
            $message = "<div class='alert alert-danger' role='alert'>
                            Error: " . $e->getMessage() . "
                        </div>";
        }
    } else {
        // Error message for incomplete fields
        $message = "<div class='alert alert-warning' role='alert'>
                        All fields are required. Please fill out all fields.
                    </div>";
    }
}

?>

<?php include 'includes/header.php' ?>

<!-- Show the message above the form -->
<?php if (!empty($message)) { echo $message; } ?>

<section class="section-padding section-bg">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <h3 class="mb-4 pb-2">We'd love to hear from you</h3>
            </div>

            <div class="col-lg-6 col-12">
                <form action="contact.php" method="post" class="custom-form contact-form" role="form">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-floating">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required="">
                                <label for="floatingInput">Name</label>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12"> 
                            <div class="form-floating">
                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required="">
                                <label for="floatingInput">Email address</label>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-floating">
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required="">
                                <label for="floatingInput">Subject</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" id="message" name="message" placeholder="Tell me about the project" required></textarea>
                                <label for="floatingTextarea">Tell me about the project</label>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12 ms-auto">
                            <button type="submit" class="form-control">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- Google map section -->
            <div class="col-lg-5 col-12 mx-auto mt-5 mt-lg-0">
                <!-- Your Google map code -->
            </div>

        </div>
    </div>
</section>



<script>
    $(document).ready(function() {
    // If the success message is present, fade it out after 1 second
    setTimeout(function() {
        $('#successMessage').fadeOut('slow');
    }, 1000); // 1000 milliseconds = 1 second
});
</script>

<?php include 'includes/footer.php' ?>
</body>
</html>