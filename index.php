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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }
        h1 {
            color: #1a1a2e;
            font-size: 28px;
            margin-bottom: 8px;
        }
        .title {
            color: #4a5568;
            font-size: 16px;
            margin-bottom: 24px;
        }
        .bio {
            color: #2d3748;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .section-title {
            color: #1a1a2e;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }
        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }
        .skills-category {
            margin-bottom: 20px;
        }
        .category-title {
            color: #4a5568;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .skill-tag {
            background: #e2e8f0;
            color: #4a5568;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }
        .form-section {
            border-top: 1px solid #e2e8f0;
            padding-top: 24px;
        }
        .form-title {
            color: #1a1a2e;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .form-desc {
            color: #718096;
            font-size: 14px;
            margin-bottom: 16px;
        }
        .form-group {
            display: flex;
            gap: 10px;
        }
        input[type="email"] {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        input[type="email"]:focus {
            border-color: #4a5568;
        }
        button {
            background: #1a1a2e;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #2d3748;
        }
        button:disabled {
            background: #a0aec0;
            cursor: not-allowed;
        }
        .message {
            margin-top: 16px;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            display: none;
        }
        .message.success {
            background: #16a34a;
            color: white;
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .message.error {
            background: #dc2626;
            color: white;
            display: block;
            animation: shake 0.3s ease-in-out;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .privacy-note {
            margin-top: 16px;
            font-size: 12px;
            color: #718096;
            text-align: center;
        }
        .privacy-note a {
            color: #4a5568;
            text-decoration: underline;
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 24px 20px;
            }
            h1 {
                font-size: 24px;
            }
            .form-group {
                flex-direction: column;
            }
            .form-group input,
            .form-group button {
                width: 100%;
            }
            .form-group button {
                margin-top: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hi, I'm Gabriele 👋</h1>
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
        
        <p class="section-title">Skills</p>
        
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
                🔒 <a href="https://github.com/snarpeppo/QRCV" target="_blank">Open source</a> - no data collected
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
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'email=' + encodeURIComponent(email) + '&csrf_token=' + encodeURIComponent(csrfToken)
                });
                
                const result = await response.json();
                console.log('Debug info:', result);
                
                if (result.success) {
                    messageEl.textContent = 'Thanks! Check your inbox for my CV! (Check spam as well).';
                    messageEl.className = 'message success';
                    document.getElementById('email').value = '';
                } else {
                    messageEl.textContent = 'Error: ' + result.message;
                    messageEl.className = 'message error';
                }
            } catch (err) {
                messageEl.textContent = 'Something went wrong. Please try again.';
                messageEl.className = 'message error';
            }
            
            btn.disabled = false;
            btn.textContent = 'Send';
        });
    </script>
</body>
</html>
