<?php
session_start();
require_once 'core/config.php';
require_once 'core/Database.php';
require_once 'core/Admin.php';

if (isset($_SESSION['user_id'])) {
    $isLoggedIn = true;
    $username = htmlspecialchars($_SESSION['username']);
    $userId = intval($_SESSION['user_id']);
} else {
    $isLoggedIn = false;
    $username = '';
}

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);

$userEmail = '';

if ($isLoggedIn && $db) {
    $sql = "SELECT email FROM users WHERE id = :id LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $userEmail = $result['email'];
    }
}

$statusMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = htmlspecialchars(trim($_POST['firstName'] ?? ''));
    $lastName = htmlspecialchars(trim($_POST['lastName'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($message)) {
        $insertSql = "INSERT INTO contact_messages (first_name, last_name, email, message) VALUES (:first_name, :last_name, :email, :message)";
        $insertStmt = $db->prepare($insertSql);
        
        $insertStmt->bindParam(':first_name', $firstName);
        $insertStmt->bindParam(':last_name', $lastName);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':message', $message);

        if ($insertStmt->execute()) {
            $statusMessage = "<div style='color: var(--color-7x-cyan); border: 1px solid var(--color-7x-cyan); padding: 15px; margin-bottom: 25px; border-radius: var(--radius); background: rgba(0, 212, 255, 0.05); font-family: var(--font-mono);'>> TRANSMISSION SUCCESSFUL: Signal received by 7X Hub.</div>";
        } else {
            $statusMessage = "<div style='color: #ff4d4d; border: 1px solid #ff4d4d; padding: 15px; margin-bottom: 25px; border-radius: var(--radius); background: rgba(255, 77, 77, 0.05); font-family: var(--font-mono);'>> TRANSMISSION FAILED: Network interference detected.</div>";
        }
    } else {
        $statusMessage = "<div style='color: #ff4d4d; border: 1px solid #ff4d4d; padding: 15px; margin-bottom: 25px; border-radius: var(--radius); background: rgba(255, 77, 77, 0.05); font-family: var(--font-mono);'>> WARNING: All fields are required to establish connection.</div>";
    }
}



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
                        
                        <?= $statusMessage ?>

                        <form id="contactForm" method="POST">

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label" for="firstName">First Name <span
                                            class="req">*</span></label>
                                    <input class="form-input" type="text" id="firstName" name="firstName"
                                        value="<?= htmlspecialchars($username) ?>" placeholder="e.g. soulayman" autocomplete="given-name" required />
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
                                    value="<?= htmlspecialchars($userEmail) ?>" placeholder="7x.hub@gmail.com" autocomplete="email" required />
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