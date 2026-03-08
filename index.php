<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullstack Developer - CV</title>
    <style>
        :root {
            --primary: #1a1a2e;
            --secondary: #16213e;
            --text: #4a5568;
            --text-dark: #2d3748;
            --light: #e2e8f0;
            --success: #16a34a;
            --error: #dc2626;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        .container {
            background: #fff;
            border-radius: 12px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        h1 {
            color: var(--primary);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .title {
            color: var(--text);
            font-size: 14px;
            margin-bottom: 32px;
        }
        .bio {
            color: var(--text-dark);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 16px;
        }
        .skills-section {
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid var(--light);
        }
        .skills-title {
            color: var(--primary);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
        }
        .skills-category {
            margin-bottom: 16px;
        }
        .category-title {
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 8px;
        }
        .skill-tag {
            background: #f7fafc;
            color: var(--text);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            border: 1px solid var(--light);
            transition: all 0.2s ease;
        }
        .skill-tag:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }
        .form-section {
            margin-top: 40px;
            padding-top: 32px;
            border-top: 1px solid var(--light);
        }
        .form-title {
            color: var(--primary);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .form-desc {
            color: var(--text);
            font-size: 14px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            gap: 12px;
        }
        input[type="email"] {
            flex: 1;
            padding: 14px 16px;
            border: 1px solid var(--light);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input[type="email"]:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 26, 46, 0.1);
        }
        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        button:hover {
            background: #2d3748;
        }
        button:active {
            transform: scale(0.98);
        }
        button:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
        }
        .message {
            margin-top: 16px;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            display: none;
        }
        .message.success {
            background: #f0fff4;
            color: var(--success);
            border: 1px solid #9ae6b4;
            display: block;
        }
        .message.error {
            background: #fff5f5;
            color: var(--error);
            border: 1px solid #feb2b2;
            display: block;
        }
        .privacy-note {
            margin-top: 20px;
            font-size: 12px;
            color: var(--text);
            text-align: center;
        }
        .privacy-note a {
            color: var(--text-dark);
            text-decoration: none;
            border-bottom: 1px solid var(--text-dark);
        }
        
        @media (max-width: 520px) {
            .container {
                padding: 32px 24px;
            }
            .form-group {
                flex-direction: column;
            }
            .form-group input,
            .form-group button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hi, I'm Gabriele</h1>
        <p class="title">Fullstack Developer</p>
        
        <p class="bio">
            I know this is pretty random, but hear me out.
            I wanted to create a simple and interactive way for recruiters/(anyone honestly) to request my CV without sharing it publicly.
        </p>

        <p class="bio">
            Just like the sticker says, I'm a DEVeloper looking for new opportunities here in Berlin, having experience in a broad range of technologies
            suits me for different projects, you can check them below... Or you could take a look at my CV by leaving your preferred email in the form below, and it will be sent to you right away!
        </p>


        <p class="bio">
            I know this is a bit uncoventional, but I've grown tired of receving so many "Unfortunately we have to inform you that..." emails, so here we are.
        </p>
        
        <div class="skills-section">
            <p class="skills-title">Skills</p>
            
            <div class="skills-category">
                <p class="category-title">Frontend</p>
                <div class="skills">
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">TypeScript</span>
                    <span class="skill-tag">Angular</span>
                    <span class="skill-tag">Vue 3 (Self taught)</span>
                    <span class="skill-tag">JQuery + AJAX</span>
                </div>
            </div>
            
            <div class="skills-category">
                <p class="category-title">Backend</p>
                <div class="skills">
                    <span class="skill-tag">C#</span>
                    <span class="skill-tag">Node.js</span>
                    <span class="skill-tag">Nest.js (Currently learning)</span>
                    <span class="skill-tag">SQL</span>
                    <span class="skill-tag">MicroPython</span>
                </div>
            </div>
            
            <div class="skills-category">
                <p class="category-title">Tools & Cloud</p>
                <div class="skills">
                    <span class="skill-tag">Playwright</span>
                    <span class="skill-tag">Azure</span>
                    <span class="skill-tag">Git</span>
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <p class="form-title">Get My CV</p>
            <p class="form-desc">Leave your email and I'll send you my full CV.</p>
            <form id="cvForm">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="your@email.com" required>
                    <button type="submit">Send</button>
                </div>
                <div id="message" class="message"></div>
            </form>
            <p class="privacy-note">
                <a href="https://github.com/snarpeppo/QRCV" target="_blank">Open source</a> — no data collected
            </p>
        </div>
    </div>

    <script>
        document.getElementById('cvForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const email = formData.get('email');
            const csrfToken = formData.get('csrf_token');
            const messageEl = document.getElementById('message');
            const btn = this.querySelector('button');
            
            btn.disabled = true;
            btn.textContent = 'Sending...';
            
            try {
                const response = await fetch('submit.php', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'email=' + encodeURIComponent(email) + '&csrf_token=' + encodeURIComponent(csrfToken)
                });
                
                console.log('Response status:', response.status);
                const result = await response.json();
                console.log('Debug info:', result);
                
                if (result.success) {
                    messageEl.textContent = 'Thanks! Check your inbox for my CV! (Check spam as well).';
                    messageEl.className = 'message success';
                    document.getElementById('email').value = '';
                } else {
                    messageEl.textContent = result.message;
                    messageEl.className = 'message error';
                }
            } catch (err) {
                console.log('Fetch error:', err);
                messageEl.textContent = 'Something went wrong. Please try again.';
                messageEl.className = 'message error';
            }
            
            btn.disabled = false;
            btn.textContent = 'Send';
        });
    </script>
</body>
</html>
