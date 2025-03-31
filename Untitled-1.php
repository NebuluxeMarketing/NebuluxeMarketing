<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Email configuration
    $to = "contactnebuluxemarketing@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send the message."]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Neubuluxe Marketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            margin-bottom: 30px;
        }

        .contact-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            max-width: 1100px;
            margin: 0 auto;
            gap: 30px;
            padding: 30px 15px;
        }

        .contact-info,
        .contact-form {
            background: #111;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.8);
            flex: 1;
            min-width: 320px;
        }

        .contact-info h3,
        .contact-form h2 {
            margin-bottom: 20px;
        }

        .form-control {
            background: #222;
            color: #fff;
            border: 1px solid #444;
        }

        .form-control:focus {
            box-shadow: 0 0 8px #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        footer {
            background: #111;
            color: #bbb;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">Neubuluxe Marketing</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="clients.html">Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="Our Services.html">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Contact Section -->
    <div class="contact-container">

        <!-- Contact Info -->
        <div class="contact-info">
            <h3>Contact Information</h3>
            <p><strong>Company:</strong> Neubuluxe Marketing</p>
            <p><strong>Address:</strong> 123 Digital Lane, Suite 456, Marketing City, USA</p>
            <p><strong>Phone:</strong> +91 80108 16077 / +91 88307 41446</p>
            <p><strong>Email:</strong> contactnebuluxemarketing@gmail.com</p>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <h2>Get in Touch</h2>
            <form id="contactForm" method="POST" action="contact.php">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your message" required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
            <div id="responseMessage" class="mt-3 text-center"></div>
        </div>

    </div>

    <script>
        document.getElementById("contactForm").addEventListener("submit", function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const responseMessage = document.getElementById("responseMessage");

            fetch("contact.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        responseMessage.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        this.reset();
                    } else {
                        responseMessage.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch((error) => {
                    responseMessage.innerHTML = `<div class="alert alert-danger">An error occurred. Please try again later.</div>`;
                });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>