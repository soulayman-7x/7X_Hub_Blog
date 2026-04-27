<?php
session_start();
require_once 'core/config.php';
require_once 'core/Database.php';
require_once 'core/Admin.php';

if (isset($_SESSION['user_id'])) {
    $isLoggedIn = true;
    $username = htmlspecialchars($_SESSION['username']);
} else {
    $isLoggedIn = false;
    $username = 'Guest';
}

$database = new Database();
$db = $database->getConnection();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7X Hub - Contact</title>
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="assets/CSS/contact.css">
    <link rel="icon" href="assets/images/logo/X-Core-V1-Wh.png">

</head>

<body>
    <!-- Header -->
    <?php include 'includes/header.php' ?>

    <main>
        <section class="contact-section">
            <div class="container">

                <!-- Section Header -->
                <div style="margin-bottom:4rem;">
                    <p class="section-label">Open Channel</p>
                    <h1>Get in Touch</h1>
                </div>

                <div class="contact-grid">

                    <!--  CONTACT INFO  -->
                    <aside class="contact-info">

                        <div>
                            <h2 class="contact-info-title" style="font-size:1.4rem;">Establish a<br><span
                                    style="color:var(--color-7x-blue); text-shadow:var(--glow-blue);">Connection</span>
                            </h2>
                            <p>
                                Whether you have a story tip, a collaboration proposal, a correction, or simply want to
                                join the signal network — we read everything that comes through.
                            </p>
                        </div>

                        <div class="neon-line" style="margin:0;"></div>

                        <div class="contact-channels">

                            <div class="contact-channel glass-card">
                                <div class="channel-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <p class="channel-label">Email</p>
                                    <a class="channel-value" href="mailto:soulaymanidbaha444@gmail.com">soulaymanidbaha444@gmail.com</a>
                                </div>
                            </div>

                            <div class="contact-channel glass-card">
                                <div class="channel-icon">
                                    <i class="fa-solid fa-globe"></i>
                                </div>
                                <div>
                                    <p class="channel-label">Location</p>
                                    <p class="channel-value">Distributed. Borderless. Online.</p>
                                </div>
                            </div>

                        </div>

                        <div
                            style="padding:1.5rem; border-left:2px solid rgba(0,212,255,0.3); background:rgba(0,212,255,0.03);">
                            <p class="section-label" style="margin-bottom:0.5rem;">Response Time</p>
                            <p style="font-family:var(--font-mono); font-size:0.85rem; color:var(--text-secondary);">
                                We aim to respond to all messages within <span style="color:var(--color-7x-cyan);">48
                                    hours</span>. For sensitive tips, use an encrypted channel.
                            </p>
                        </div>

                    </aside>

                    <!--  CONTACT FORM -->
                    <div class="contact-form-wrap glass-card">

                        <h3 class="form-title">Send a Transmission</h3>
                        <p class="form-subtitle">// All fields marked with * are required</p>

                        <form id="contactForm" novalidate>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="firstName">First Name <span
                                            class="req">*</span></label>
                                    <input class="form-input" type="text" id="firstName" name="firstName"
                                        placeholder="e.g. SOULAYMAN" autocomplete="given-name" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="lastName">Last Name <span
                                            class="req">*</span></label>
                                    <input class="form-input" type="text" id="lastName" name="lastName"
                                        placeholder="e.g. ID BAHA" autocomplete="family-name" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Email Address <span class="req">*</span></label>
                                <input class="form-input" type="email" id="email" name="email"
                                    placeholder="your@signal.net" autocomplete="email" required />
                            </div>



                            <div class="form-group">
                                <label class="form-label" for="message">Message <span class="req">*</span></label>
                                <textarea class="form-textarea" id="message" name="message"
                                    placeholder="Your message enters the signal stream here…" required></textarea>
                            </div>

                            <div class="form-footer">
                                <p class="form-note">Encrypted in transit. We never sell your data.</p>
                                <button type="submit" class="btn-submit">Transmit Message</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <?php include 'includes/footer.php' ?>
</body>

</html>