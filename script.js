// ===== STATE =====
    let currentUser = null;
    let isSignUp = false;

    // ===== NAVIGATION =====
    function showPage(pageId) {
        document.querySelectorAll('.page-content > div').forEach(el => {
            el.classList.remove('active-page');
            el.classList.add('hidden-page');
        });
        const target = document.getElementById('page-' + pageId);
        if (target) {
            target.classList.remove('hidden-page');
            target.classList.add('active-page');
        }
        document.querySelectorAll('.nav-links a').forEach(a => {
            a.classList.remove('active');
            if (a.dataset.page === pageId) a.classList.add('active');
        });
        document.getElementById('navLinks').classList.remove('open');
        document.querySelector('.nav-toggle i').className = 'fas fa-bars';
    }

    // nav clicks
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = this.dataset.page;
            if (page) showPage(page);
        });
    });

    // mobile toggle
    document.getElementById('navToggle').addEventListener('click', function(e) {
        e.stopPropagation();
        const links = document.getElementById('navLinks');
        links.classList.toggle('open');
        const icon = this.querySelector('i');
        icon.className = links.classList.contains('open') ? 'fas fa-times' : 'fas fa-bars';
    });

    // ===== AUTH =====
    function toggleAuth() {
        if (currentUser) {
            if (confirm('Logout ' + currentUser.name + '?')) {
                currentUser = null;
                updateUI();
                showPage('home');
            }
            return;
        }
        showPage('auth');
        isSignUp = false;
        updateAuthUI();
    }

    function switchAuthMode() {
        isSignUp = !isSignUp;
        updateAuthUI();
    }

    function updateAuthUI() {
        const title = document.getElementById('authTitle');
        const submitText = document.getElementById('authSubmitText');
        const switchText = document.getElementById('authSwitchText');
        const switchLink = document.getElementById('authSwitchLink');
        const nameField = document.getElementById('authName');
        if (isSignUp) {
            title.innerHTML = '<i class="fas fa-user-plus" style="color: #b78338;"></i> Sign Up';
            submitText.textContent = 'Sign Up';
            switchText.textContent = 'Already have an account?';
            switchLink.textContent = 'Sign In';
            nameField.style.display = 'block';
        } else {
            title.innerHTML = '<i class="fas fa-sign-in-alt" style="color: #b78338;"></i> Sign In';
            submitText.textContent = 'Sign In';
            switchText.textContent = "Don't have an account?";
            switchLink.textContent = 'Sign Up';
            nameField.style.display = 'none';
        }
        document.getElementById('authStatus').textContent = '';
    }

    function handleAuth() {
        const email = document.getElementById('authEmail').value.trim();
        const password = document.getElementById('authPassword').value.trim();
        const name = document.getElementById('authName').value.trim();
        if (!email || !password) {
            document.getElementById('authStatus').textContent = 'Please fill in all fields.';
            return;
        }
        if (isSignUp && !name) {
            document.getElementById('authStatus').textContent = 'Please enter your full name.';
            return;
        }
        if (isSignUp) {
            currentUser = { name: name, email: email };
            document.getElementById('authStatus').textContent = '✅ Account created! Welcome ' + name + '.';
        } else {
            const displayName = email.split('@')[0];
            currentUser = { name: displayName, email: email };
            document.getElementById('authStatus').textContent = '✅ Welcome back, ' + displayName + '!';
        }
        updateUI();
        setTimeout(() => {
            showPage('home');
            document.getElementById('authStatus').textContent = '';
            document.getElementById('authPassword').value = '';
            document.getElementById('authEmail').value = '';
            document.getElementById('authName').value = '';
        }, 1200);
    }

    function updateUI() {
        const badge = document.getElementById('userNameDisplay');
        const btn = document.getElementById('authBtn');
        const btnText = document.getElementById('authBtnText');
        if (currentUser) {
            badge.textContent = currentUser.name;
            btnText.textContent = 'Logout';
            btn.innerHTML = '<i class="fas fa-sign-out-alt"></i> <span id="authBtnText">Logout</span>';
            // update AI welcome if on appoint page
            const aiMsg = document.getElementById('aiMessage');
            if (aiMsg && document.getElementById('page-appoint').classList.contains('active-page')) {
                aiMsg.innerHTML = `<i class="fas fa-hand-peace"></i> Hello, ${currentUser.name}! I'm Sayam. How can I help?`;
            }
        } else {
            badge.textContent = 'Guest';
            btnText.textContent = 'Sign In';
            btn.innerHTML = '<i class="fas fa-sign-in-alt"></i> <span id="authBtnText">Sign In</span>';
            const aiMsg = document.getElementById('aiMessage');
            if (aiMsg && document.getElementById('page-appoint').classList.contains('active-page')) {
                aiMsg.innerHTML = `<i class="fas fa-hand-peace"></i> Hello, I'm Sayam. Please sign in to access all features.`;
            }
        }
    }

    // ===== APPOINTMENT =====
    function bookSlot(time) {
        if (!currentUser) {
            document.getElementById('bookingMsg').innerHTML = '<i class="fas fa-exclamation-circle" style="color: #915c4c;"></i> Please sign in to book.';
            return;
        }
        document.getElementById('bookingMsg').innerHTML = `<i class="fas fa-check-circle" style="color: #40686a;"></i> ✅ Booked: ${time} for ${currentUser.name}.`;
        const aiMsg = document.getElementById('aiMessage');
        if (aiMsg) {
            aiMsg.innerHTML = `<i class="fas fa-calendar-check" style="color: #b78338;"></i> Sayam: ${time} booked for ${currentUser.name}. See you soon!`;
        }
    }

    // ===== AI ASSISTANT (only for registered users) =====
    function aiRespond(action) {
        const msg = document.getElementById('aiMessage');
        const feedback = document.getElementById('aiFeedback');
        if (!currentUser) {
            msg.innerHTML = `<i class="fas fa-exclamation-circle" style="color: #915c4c;"></i> Sayam: Please sign in first to use this feature.`;
            feedback.textContent = '';
            return;
        }
        const name = currentUser.name;
        let response = '';
        switch(action) {
            case 'doctor':
                response = `Sayam: Sure ${name}! I can book you with Dr. Ade, Dr. Bello, or Dr. Chi. Choose a time above.`;
                break;
            case 'conditions':
                response = `Sayam: ${name}, please describe your symptoms and I'll guide you to the right specialist.`;
                break;
            case 'pricing':
                response = `Sayam: ${name}, our consultation fee is ₦25,000. Insurance accepted. Ask for details.`;
                break;
            case 'review':
                response = `Sayam: Thank you ${name}! You can leave a review on our website or social media. We value your feedback.`;
                break;
            default:
                response = `Sayam: How can I assist you today, ${name}?`;
        }
        msg.innerHTML = `<i class="fas fa-comment-dots" style="color: #b78338;"></i> ${response}`;
        feedback.textContent = 'Sayam: Anything else?';
    }

    // ===== FOOTER =====
    function subscribeNewsletter(e) {
        e.preventDefault();
        const email = document.getElementById('newsletterEmail').value.trim();
        const msg = document.getElementById('newsletterMsg');
        if (!email) {
            msg.textContent = 'Please enter an email address.';
            msg.style.color = '#d18a8a';
            return false;
        }
        msg.innerHTML = '<i class="fas fa-check-circle"></i> Thanks! Check your inbox to confirm.';
        msg.style.color = '#7fb8a0';
        document.getElementById('newsletterEmail').value = '';
        return false;
    }
    document.getElementById('footerYear').textContent = new Date().getFullYear();

    // ===== INIT =====
    updateUI();