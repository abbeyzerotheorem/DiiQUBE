<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/con-style.css">
    <title>Contact - DiiQUBE</title>
</head>
<body>


<section class="contact-page">
    <div class="contact-container">

        <!-- GRID -->
        <div class="contact-grid">

            <!-- LEFT: COMPANY INFO -->
            <div class="contact-info">
                <h2>Contact Us</h2>
                <p>
                    We’d love to hear from you! Reach out with any questions, comments, or partnership inquiries.
                </p>

                <div class="info-item">
                    <h4>Address</h4>
                    <p>Sheggs Nigeria House 47, Adeboye street, Off ILage Road, Bariga, Lagos, Nigeria.</p>
                </div>

                <div class="info-item">
                    <h4>Phone</h4>
                    <p>+2348024307980, </p>
                    <p>+2348134226014</p>
                </div>

                <div class="info-item">
                    <h4>Email</h4>
                    <p>info@yourcompany.com</p>
                </div>
            </div>

            <!-- RIGHT: CONTACT FORM -->
            <div class="contact-form">
                <h4>Send Us a Message</h4>
                <form action="submit_contact.php" method="POST">

                    <div class="form-group">
                        <input type="text" id="fullname" name="fullname" required placeholder=" ">
                        <label for="fullname">Full Name</label>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" name="email" required placeholder=" ">
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-group">
                        <input type="text" id="subject" name="subject" required placeholder=" ">
                        <label for="subject">Subject</label>
                    </div>

                    <div class="form-group">
                        <textarea id="message" name="message" rows="6" required placeholder=" "></textarea>
                        <label for="message">Message</label>
                    </div>

                    <button type="submit" class="contact-btn">Send Message</button>
                </form>
            </div>


        </div>

        </div>

    </div>
</section>


    <!-- Bottom -->
    <div class="footer-bottom">
        <p>© 2026 DiiQUBE Metropolitan. All Rights Reserved.</p>
    </div>
</footer>

<script src="script.js"></script>
</body>
</html>