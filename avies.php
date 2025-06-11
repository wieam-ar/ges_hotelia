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
    <style>
        #avies {
            max-width: 650px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

       h1{
            text-align: center;
            
            margin-bottom: 10px;
            font-size: 2.5em;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background: linear-gradient(45deg,rgb(0, 0, 0),rgb(0, 0, 0));
            background-clip: text;
        }

        .subtitle {
            text-align: center;
            color:rgb(173, 120, 40);
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1em;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e8ecf4;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4d4e53;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .rating-section {
            background: rgba(102, 126, 234, 0.05);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
        }

        .stars {
            display: flex;
            gap: 8px;
            margin-top: 10px;
            justify-content: center;
        }

        .star {
            font-size: 2.5em;
            color: #ddd;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .star:hover,
        .star.active {
            color: #ffd700;
            transform: scale(1.1);
        }

        .rating-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border: 2px solid #e8ecf4;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.7);
        }

        .checkbox-item:hover {
            border-color: #717172;
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin: 0;
        }

        .radio-group {
            display: flex;
            gap: 15px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            border: 2px solid #e8ecf4;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.7);
        }

        .radio-item:hover {
            border-color: #f0f0f0;
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .radio-item input[type="radio"] {
            width: 16px;
            height: 16px;
            margin: 0;
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background:rgb(184, 160, 56);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.2em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .success-message {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            font-size: 1.2em;
            display: none;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .required {
            color: #e74c3c;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            .radio-group {
                flex-direction: column;
            }

            .checkbox-group {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2em;
            }

            .stars {
                gap: 5px;
            }

            .star {
                font-size: 2em;
            }
        }
    </style>
</head>

<body>
    <?php include 'includes/sideclient.php'; ?>


    <div class="container" id="avies">
        <h1 class="title text-center  " >Customer Feedback</h1>

        <p class="subtitle" >We value your opinion and strive to improve our service</p>
        
        <form method="post" id="feedbackForm">
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