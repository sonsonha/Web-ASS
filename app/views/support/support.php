<?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5">
    <h1 class="text-center text-white">Support</h1>
    <p class="text-center text-white">How can we help you? Please find below some common issues or contact us directly.</p>

    <!-- FAQ Section -->
    <div class="mt-5">
        <h2 class="text-white">Frequently Asked Questions (FAQs)</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        How do I download my purchased games?
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can download your purchased games from your account page under the "My Games" section. Click the "Download" button next to the game you wish to install.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq2">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        How can I reset my password?
                    </button>
                </h2>
                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To reset your password, go to the login page and click "Forgot Password". Follow the instructions sent to your email.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq3">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        How do I contact customer support?
                    </button>
                </h2>
                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        You can contact customer support by filling out the form below or emailing us at <a href="mailto:support@gamestore.com">support@gamestore.com</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="mt-5">
        <h2 class="text-white">Contact Us</h2>
        <form action="/../api/send_support_request.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label text-white">Your Name</label>
                <input type="text" class="form-controler" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label text-white">Your Email</label>
                <input type="email" class="form-controler" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="issue" class="form-label text-white">Issue</label>
                <select class="form-select" id="issue" name="issue" required>
                    <option value="" disabled selected>Select your issue</option>
                    <option value="login">Login Issues</option>
                    <option value="payment">Payment Problems</option>
                    <option value="download">Download Issues</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label text-white">Message</label>
                <textarea class="form-controler" id="message" name="message" rows="5" placeholder="Describe your issue in detail" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-custom">Submit</button>
        </form>
    </div>
</div>

<style>
    body {
        background-color: #1b2838;
        color: white;
    }

    .accordion-button {
        background-color: #343a40;
        color: white;
        border: none;
    }

    .accordion-button:focus {
        box-shadow: none;
    }

    .accordion-button:not(.collapsed) {
        background-color: #495057;
    }

    .accordion-body {
        background-color: #495057;
        color: white;
    }

    .form-controler,
    .form-select {
        background-color: #343a40;
        color: white;
        border: 1px solid #495057;
    }

    .form-controlerfocus,
    .form-select:focus {
        background-color: #495057;
        border-color: #007bff;
        color: white;
    }

    .btn-custom {
        background-color: #007bff;
        border: none;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }
</style>

<?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->
