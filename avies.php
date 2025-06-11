<?php
include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $satisfaction = htmlspecialchars($_POST['satisfaction']);
        $comments = htmlspecialchars(trim($_POST['comments']));
        $improvements = htmlspecialchars(trim($_POST['improvements']));
        $liked_aspects = '';
    if (isset($_POST['liked_aspects'])) {
    if (is_array($_POST['liked_aspects'])) {
        $liked_aspects = implode(', ', $_POST['liked_aspects']);
    } else {
        $liked_aspects = $_POST['liked_aspects']; // si un seul élément envoyé comme string
    }
    }
      
        $sql = "INSERT INTO feedback (name, email, phone, satisfaction, liked_aspects, comments, improvements)
                VALUES (:name, :email, :phone, :satisfaction, :liked_aspects, :comments, :improvements)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':satisfaction' => $satisfaction,
            ':liked_aspects' => $liked_aspects,
            ':comments' => $comments,
            ':improvements' => $improvements
        ]);

        echo "<script>alert('Feedback submitted successfully! 😍');</script>";
        echo "<script>window.location.href = 'avies.php';</script>";
        exit();

}
?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Responsive Admin Dashboard </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="./styles/avies.css">

    </head>

    <body>
        <?php include 'includes/sideclient.php'; ?>


        <div class="container" id="avies">
            <h1>Customer Feedback</h1>
            <p class="subtitle">We value your opinion and strive to improve our service</p>

            <form  method="post" id="feedbackForm">
                <div class="form-group">
                    <label for="name">Full Name <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <label>How satisfied are you with our service? <span class="required">*</span></label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="very_satisfied" name="satisfaction" value="very_satisfied" required>
                            <label for="very_satisfied">Very Satisfied</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="satisfied" name="satisfaction" value="satisfied" required>
                            <label for="satisfied">Satisfied</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="neutral" name="satisfaction" value="neutral" required>
                            <label for="neutral">Neutral</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="dissatisfied" name="satisfaction" value="dissatisfied" required>
                            <label for="dissatisfied">Dissatisfied</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>What aspects of our service did you like? (Select all that apply)</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="speed" name="liked_aspects" value="speed">
                            <label for="speed">Fast Response Time</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="quality" name="liked_aspects" value="quality">
                            <label for="quality">Service Quality</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="staff" name="liked_aspects" value="staff">
                            <label for="staff">Friendly Staff</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="pricing" name="liked_aspects" value="pricing">
                            <label for="pricing">Fair Pricing</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="communication" name="liked_aspects" value="communication">
                            <label for="communication">Clear Communication</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="professionalism" name="liked_aspects" value="professionalism">
                            <label for="professionalism">Professionalism</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comments">Comments & Feedback <span class="required">*</span></label>
                    <textarea id="comments" name="comments" placeholder="Please share your detailed feedback about our service..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="improvements">What can we improve?</label>
                    <textarea id="improvements" name="improvements" placeholder="Your suggestions for improving our service..."></textarea>
                </div>



                <button type="submit" class="submit-btn">
                    Submit Feedback
                </button>
            </form>

            <div id="successMessage" class="success-message">
                <h2>Thank You!</h2>
                <p>Your feedback has been submitted successfully. We appreciate your time and will use your comments to improve our service.</p>
            </div>
        </div>


        <script src="./javascript/admin.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    </body>

    </html>