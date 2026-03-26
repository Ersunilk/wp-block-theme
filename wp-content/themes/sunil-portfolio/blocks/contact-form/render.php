<?php
$heading         = $attributes['heading']        ?? "Let's build extraordinary together.";
$subheading      = $attributes['subheading']     ?? 'Have a groundbreaking project in mind?';
$email           = $attributes['email']          ?? 'hello@sunilkumar.dev';
$phone           = $attributes['phone']          ?? '+49 000 000 0000';
$location        = $attributes['location']       ?? 'Berlin, Germany';
$button_text     = $attributes['buttonText']     ?? 'Start a Project';
$linkedin_url    = $attributes['linkedinUrl']    ?? '#';
$github_url      = $attributes['githubUrl']      ?? '#';
$success_message = $attributes['successMessage'] ?? 'Thank you! I will get back to you shortly.';

// Handle form submission
$form_submitted = false;
$form_error     = false;

if (
    isset( $_POST['sunil_contact_nonce'] ) &&
    wp_verify_nonce( $_POST['sunil_contact_nonce'], 'sunil_contact_form' ) &&
    isset( $_POST['contact_email'] )
) {
    $name    = sanitize_text_field( $_POST['contact_name']    ?? '' );
    $email_from = sanitize_email( $_POST['contact_email'] );
    $type    = sanitize_text_field( $_POST['contact_type']    ?? '' );
    $message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

    $to      = get_option( 'admin_email' );
    $subject = "New project inquiry from {$name}";
    $body    = "Name: {$name}\nEmail: {$email_from}\nType: {$type}\n\nMessage:\n{$message}";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', "Reply-To: {$email_from}" ];

    if ( wp_mail( $to, $subject, $body, $headers ) ) {
        $form_submitted = true;
    } else {
        $form_error = true;
    }
}
?>

<style>
.contact-input {
    width: 100%;
    background: transparent;
    border: none;
    border-bottom: 2px solid #e2e8f0;
    padding: 0.75rem 0;
    font-size: 1rem;
    font-family: 'Inter', sans-serif;
    outline: none;
    transition: border-color 0.2s;
    color: #0f172a;
}
.contact-input:focus {
    border-bottom-color: #F86CA7;
}
.contact-input::placeholder {
    color: #cbd5e1;
}
.gradient-button {
    background: linear-gradient(90deg, #F6A86E 0%, #F86CA7 100%);
}
.gradient-text {
    background: linear-gradient(90deg, #F6A86E 0%, #F86CA7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.social-link {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #0f172a;
    transition: border-color 0.2s, color 0.2s;
}
.social-link:hover {
    border-color: #F86CA7;
    color: #F86CA7;
}
</style>

<section style="
    max-width: 1280px;
    margin: 0 auto;
    padding: 6rem 1.5rem;
    font-family: 'Inter', sans-serif;
">

    <!-- Hero Text -->
    <div style="max-width:48rem;margin-bottom:4rem">
        <h1 style="
            font-size: clamp(2.5rem, 8vw, 5rem);
            font-weight: 900;
            letter-spacing: -0.05em;
            line-height: 1;
            margin: 0 0 2rem;
            color: #0f172a;
        ">
            <?php
            // Split heading at line breaks for gradient effect
            $parts = explode( 'extraordinary', $heading );
            if ( count( $parts ) === 2 ) {
                echo esc_html( $parts[0] );
                echo '<span class="gradient-text">extraordinary</span>';
                echo esc_html( $parts[1] );
            } else {
                echo esc_html( $heading );
            }
            ?>
        </h1>
        <p style="
            font-size: 1.25rem;
            color: #64748b;
            font-weight: 300;
            line-height: 1.7;
            margin: 0;
        ">
            <?php echo esc_html( $subheading ); ?>
        </p>
    </div>

    <!-- Two Column Grid -->
    <div style="
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: start;
    ">

        <!-- LEFT — Contact Form -->
        <div style="
            background: #ffffff;
            padding: 3rem;
            border-radius: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        ">

            <?php if ( $form_submitted ) : ?>

                <div style="
                    text-align: center;
                    padding: 3rem 1rem;
                ">
                    <div style="
                        width: 4rem;
                        height: 4rem;
                        background: linear-gradient(90deg,#F6A86E,#F86CA7);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 1.5rem;
                        font-size: 1.5rem;
                        color: white;
                    ">✓</div>
                    <h3 style="font-size:1.5rem;font-weight:700;margin:0 0 0.75rem;color:#0f172a">
                        Message Sent!
                    </h3>
                    <p style="color:#64748b;margin:0">
                        <?php echo esc_html( $success_message ); ?>
                    </p>
                </div>

            <?php else : ?>

                <?php if ( $form_error ) : ?>
                    <div style="
                        background: #fef2f2;
                        border: 1px solid #fecaca;
                        padding: 1rem;
                        border-radius: 0.5rem;
                        margin-bottom: 1.5rem;
                        color: #dc2626;
                        font-size: 0.875rem;
                    ">
                        Something went wrong. Please email me directly at
                        <a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:#F86CA7">
                            <?php echo esc_html( $email ); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <form
                    method="POST"
                    action="<?php echo esc_url( get_permalink() ); ?>"
                    style="display:flex;flex-direction:column;gap:2rem"
                >
                    <?php wp_nonce_field( 'sunil_contact_form', 'sunil_contact_nonce' ); ?>

                    <!-- Name + Email row -->
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem">
                        <div>
                            <label style="
                                display: block;
                                font-size: 0.65rem;
                                font-weight: 700;
                                text-transform: uppercase;
                                letter-spacing: 0.15em;
                                color: #94a3b8;
                                margin-bottom: 0.5rem;
                            ">Full Name</label>
                            <input
                                type="text"
                                name="contact_name"
                                class="contact-input"
                                placeholder="Sunil Kumar"
                                required
                            />
                        </div>
                        <div>
                            <label style="
                                display: block;
                                font-size: 0.65rem;
                                font-weight: 700;
                                text-transform: uppercase;
                                letter-spacing: 0.15em;
                                color: #94a3b8;
                                margin-bottom: 0.5rem;
                            ">Email Address</label>
                            <input
                                type="email"
                                name="contact_email"
                                class="contact-input"
                                placeholder="hello@domain.com"
                                required
                            />
                        </div>
                    </div>

                    <!-- Project Type -->
                    <div>
                        <label style="
                            display: block;
                            font-size: 0.65rem;
                            font-weight: 700;
                            text-transform: uppercase;
                            letter-spacing: 0.15em;
                            color: #94a3b8;
                            margin-bottom: 0.5rem;
                        ">Project Type</label>
                        <select
                            name="contact_type"
                            class="contact-input"
                            style="appearance:none;cursor:pointer"
                        >
                            <option value="">Select a service</option>
                            <option value="wordpress">WordPress Development</option>
                            <option value="woocommerce">WooCommerce Store</option>
                            <option value="plugin">Custom Plugin</option>
                            <option value="theme">Block Theme</option>
                            <option value="headless">Headless WordPress</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div>
                        <label style="
                            display: block;
                            font-size: 0.65rem;
                            font-weight: 700;
                            text-transform: uppercase;
                            letter-spacing: 0.15em;
                            color: #94a3b8;
                            margin-bottom: 0.5rem;
                        ">About the Project</label>
                        <textarea
                            name="contact_message"
                            class="contact-input"
                            placeholder="Tell me about your goals..."
                            rows="4"
                            style="resize:none"
                            required
                        ></textarea>
                    </div>

                    <!-- Submit -->
                    <button
                        type="submit"
                        class="gradient-button"
                        style="
                            width: 100%;
                            height: 4rem;
                            border-radius: 0.75rem;
                            border: none;
                            color: #ffffff;
                            font-weight: 700;
                            font-size: 1rem;
                            cursor: pointer;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 0.75rem;
                            font-family: 'Inter', sans-serif;
                            transition: opacity 0.2s;
                        "
                        onmouseover="this.style.opacity='0.9'"
                        onmouseout="this.style.opacity='1'"
                    >
                        <?php echo esc_html( $button_text ); ?>
                        <span style="font-size:1.25rem">→</span>
                    </button>

                </form>

            <?php endif; ?>

        </div>

        <!-- RIGHT — Info & Socials -->
        <div style="
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem 0;
            gap: 3rem;
        ">

            <!-- Contact Details -->
            <div>
                <h3 style="
                    font-size: 0.65rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.15em;
                    color: #F86CA7;
                    margin: 0 0 1rem;
                ">Contact Details</h3>
                <a href="mailto:<?php echo esc_attr( $email ); ?>" style="
                    display: block;
                    font-size: 1.5rem;
                    font-weight: 500;
                    color: #0f172a;
                    text-decoration: none;
                    margin-bottom: 0.5rem;
                    transition: color 0.2s;
                "
                onmouseover="this.style.color='#F86CA7'"
                onmouseout="this.style.color='#0f172a'"
                >
                    <?php echo esc_html( $email ); ?>
                </a>
                <p style="
                    font-size: 1.5rem;
                    font-weight: 500;
                    color: #94a3b8;
                    margin: 0;
                ">
                    <?php echo esc_html( $phone ); ?>
                </p>
            </div>

            <!-- Location -->
            <div>
                <h3 style="
                    font-size: 0.65rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.15em;
                    color: #F86CA7;
                    margin: 0 0 1rem;
                ">Location</h3>
                <p style="
                    font-size: 1.25rem;
                    font-weight: 500;
                    color: #0f172a;
                    margin: 0;
                ">
                    <?php echo esc_html( $location ); ?>
                </p>
                <p style="
                    font-size: 1.25rem;
                    font-weight: 500;
                    color: #94a3b8;
                    margin: 0.25rem 0 0;
                ">
                    Available for remote & on-site
                </p>
            </div>

            <!-- Social Links -->
            <div style="
                padding-top: 2rem;
                border-top: 1px solid #e2e8f0;
            ">
                <h3 style="
                    font-size: 0.65rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.15em;
                    color: #94a3b8;
                    margin: 0 0 1.5rem;
                ">Social Connections</h3>
                <div style="display:flex;gap:1rem">
                    
                       <a href="<?php echo esc_url( $linkedin_url ); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-link"
                        title="LinkedIn"
                    >
                        <span class="material-symbols-outlined">share</span>
                    </a>
                    
                        <a href="<?php echo esc_url( $github_url ); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="social-link"
                        title="GitHub"
                    >
                        <span class="material-symbols-outlined">code</span>
                    </a>
                    
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"
                        class="social-link"
                        title="Email"
                    >
                        <span class="material-symbols-outlined">alternate_email</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>