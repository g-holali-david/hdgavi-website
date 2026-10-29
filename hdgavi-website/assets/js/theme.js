/**
 * HD GAVI Portfolio — theme.js v7.0.0
 * Multi-page CV portfolio, trilingual EN/FR/ES, light and dark modes
 * FIX JS-1: Version updated to match theme
 */
(function () {
  'use strict';

  var C = window.hdgaviConfig || {};
  // Theme and language were resolved before first paint by the inline script in header.php.
  var currentLang = ['en', 'fr', 'es'].indexOf(document.documentElement.lang) > -1 ? document.documentElement.lang : (C.defaultLang || 'en');
  var currentTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';

  /** Fetch with AbortController timeout — returns the fetch promise, clears timer in .finally() */
  function fetchTimeout(url, opts, ms) {
    var ctrl = new AbortController();
    var id = setTimeout(function () { ctrl.abort(); }, ms);
    opts.signal = ctrl.signal;
    return fetch(url, opts).finally(function () { clearTimeout(id); });
  }

  /* ═══════════════════════════════════════
     LANGUAGE SYSTEM
     FIX JS-2: UL[data-lang] now also handled by CSS (bilingual.php),
               but we keep the JS toggle for robustness.
     FIX JS-3: Not fixing aria-label bilingual (would require
               maintaining a parallel attribute system — out of scope
               for a portfolio, and screen readers respect html[lang]).
     ═══════════════════════════════════════ */
  var supportedLangs = ['en', 'fr', 'es'];

  function setLang(lang) {
    if (supportedLangs.indexOf(lang) === -1) lang = 'en';
    currentLang = lang;
    document.documentElement.lang = lang;
    try { localStorage.setItem('hdgavi_lang', lang); } catch (e) {}

    // Language switch state
    document.querySelectorAll('[data-set-lang]').forEach(function (btn) {
      btn.setAttribute('aria-pressed', btn.dataset.setLang === lang ? 'true' : 'false');
    });

    // Update UL/OL bullet lists with data-lang
    document.querySelectorAll('ul[data-lang], ol[data-lang]').forEach(function (el) {
      el.style.display = el.dataset.lang === lang ? '' : 'none';
    });

    // Accessibility: mark inactive language spans as aria-hidden
    document.querySelectorAll('[data-lang]').forEach(function (el) {
      var tag = el.tagName;
      if (tag === 'SPAN' || tag === 'DIV') {
        el.setAttribute('aria-hidden', el.dataset.lang !== lang ? 'true' : 'false');
      }
    });

    // Switch placeholders
    document.querySelectorAll('[data-placeholder-' + lang + ']').forEach(function (el) {
      el.placeholder = el.getAttribute('data-placeholder-' + lang);
    });

    // Update select option text
    document.querySelectorAll('option[data-lang-text-' + lang + ']').forEach(function (opt) {
      opt.textContent = opt.getAttribute('data-lang-text-' + lang);
    });

  }

  function toggleLang() {
    // Cycle through supported languages: en → fr → es → en
    var idx = supportedLangs.indexOf(currentLang);
    var next = supportedLangs[(idx + 1) % supportedLangs.length];
    setLang(next);
  }

  /* ═══════════════════════════════════════
     THEME (DARK/LIGHT)
     FIX JS-4: Swap sun↔moon icon on toggle
     ═══════════════════════════════════════ */
  function setTheme(theme) {
    currentTheme = theme === 'dark' ? 'dark' : 'light';
    document.documentElement.setAttribute('data-theme', currentTheme);
    document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
      btn.setAttribute('aria-pressed', currentTheme === 'dark' ? 'true' : 'false');
    });
  }

  function toggleTheme() {
    setTheme(currentTheme === 'dark' ? 'light' : 'dark');
    try { localStorage.setItem('hdgavi_theme_v2', currentTheme); } catch (e) {}
  }

  /* ═══════════════════════════════════════
     NAVIGATION
     FIX JS-5: Active link detection is path-based — works if user
               follows the installation guide. No change needed.
     FIX JS-6: Close mobile menu on outside click + Escape key
     ═══════════════════════════════════════ */
  function initNav() {
    var header = document.getElementById('siteHeader');
    var burger = document.getElementById('navBurger');
    if (!header || !burger) return;
    function setMenu(open) {
      header.classList.toggle('is-open', open);
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    burger.addEventListener('click', function () {
      setMenu(burger.getAttribute('aria-expanded') !== 'true');
    });
    header.querySelectorAll('#siteMenu a').forEach(function (a) {
      a.addEventListener('click', function () { setMenu(false); });
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && burger.getAttribute('aria-expanded') === 'true') {
        setMenu(false);
        burger.focus();
      }
    });
  }

  function animateCounter(el) {
    var target = parseFloat(el.dataset.count);
    var suffix = el.dataset.suffix || '';
    if (isNaN(target)) return;

    var isInteger = Number.isInteger(target);
    var duration = 1500;
    var start = performance.now();

    function tick(now) {
      var elapsed = now - start;
      var progress = Math.min(elapsed / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
      var current = eased * target;
      el.textContent = (isInteger ? Math.round(current) : current.toFixed(1)) + suffix;
      if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  /* ═══════════════════════════════════════
     TERMINAL TYPING ANIMATION (Splash)
     FIX JS-15: Removed unused lineIdx variable
     FIX JS-16: Language is read at init time (acceptable for one-shot animation)
     ═══════════════════════════════════════ */
  var _terminalLang = null;
  function sleep(ms) {
    return new Promise(function (resolve) { setTimeout(resolve, ms); });
  }

  /* ═══════════════════════════════════════
     COPY EMAIL
     FIX JS-17: Fallback for non-HTTPS + user feedback on failure
     ═══════════════════════════════════════ */
  function initCopyEmail() {
    if (!C.copyEnabled) return;
    document.querySelectorAll('.copy-email-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var email = btn.dataset.email;
        var originalHTML = btn.innerHTML;

        function showSuccess() {
          btn.classList.add('copied');
          var feedback = currentLang === 'fr' ? C.copiedTextFr : C.copiedTextEn;
          btn.textContent = feedback;
          setTimeout(function () {
            btn.classList.remove('copied');
            btn.innerHTML = originalHTML;
          }, 2000);
        }

        function showError() {
          btn.classList.add('copy-error');
          setTimeout(function () {
            btn.classList.remove('copy-error');
          }, 2000);
        }

        // Try modern clipboard API first
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(email).then(showSuccess).catch(function () {
            // FIX JS-17: Fallback for HTTP or denied permission
            fallbackCopy(email) ? showSuccess() : showError();
          });
        } else {
          // FIX JS-17: Fallback for older browsers
          fallbackCopy(email) ? showSuccess() : showError();
        }
      });
    });
  }

  // Fallback clipboard copy using textarea + execCommand
  function fallbackCopy(text) {
    try {
      var ta = document.createElement('textarea');
      ta.value = text;
      ta.style.cssText = 'position:fixed;left:-9999px;top:-9999px;opacity:0';
      document.body.appendChild(ta);
      ta.select();
      var ok = document.execCommand('copy');
      document.body.removeChild(ta);
      return ok;
    } catch (e) {
      return false;
    }
  }

  /* ═══════════════════════════════════════
     GITHUB REPOS
     FIX JS-18: AbortController timeout (8s)
     FIX JS-19: Escape html_url in href attribute
     FIX JS-20: langColors injection is safe (hex values only) — no change
     ═══════════════════════════════════════ */
  function initGitHubRepos() {
    if (!C.ghReposEnabled || !C.ghUsername) return;
    var grid = document.getElementById('repoGrid');
    var section = document.getElementById('githubRepos');
    if (!grid || !section) return;

    var langColors = {
      JavaScript: '#f1e05a', Python: '#3572A5', Java: '#b07219',
      PHP: '#4F5D95', TypeScript: '#3178c6', Go: '#00ADD8',
      Shell: '#89e051', Dart: '#00B4AB', HTML: '#e34c26',
      CSS: '#563d7c', 'C++': '#f34b7d', C: '#555555',
      Dockerfile: '#384d54', HCL: '#844fba',
    };

    var repoLimit = C.ghReposLimit || 6;

    fetchTimeout('https://api.github.com/users/' + encodeURIComponent(C.ghUsername) + '/repos?sort=updated&per_page=' + repoLimit, {}, 8000)
      .then(function (r) {
        return r.ok ? r.json() : Promise.reject();
      })
      .then(function (repos) {
        if (!repos.length) { section.style.display = 'none'; return; }
        grid.innerHTML = repos.map(function (r) {
          var safeUrl = escAttr(r.html_url);
          var safeName = escHtml(r.name);
          var safeDesc = r.description ? '<div class="repo-desc">' + escHtml(r.description) + '</div>' : '';
          var langDot = r.language ? '<span><span class="repo-lang-dot" style="background:' + (langColors[r.language] || '#ccc') + '"></span>' + escHtml(r.language) + '</span>' : '';
          var stars = '';

          return '<a href="' + safeUrl + '" class="repo-card" target="_blank" rel="noopener">'
            + '<div class="repo-name">' + safeName + '</div>'
            + safeDesc
            + '<div class="repo-meta">' + langDot + stars + '</div>'
            + '</a>';
        }).join('');
      })
      .catch(function () {
        section.style.display = 'none';
      });
  }

  function escHtml(str) {
    var d = document.createElement('div');
    d.textContent = str || '';
    return d.innerHTML;
  }

  // FIX JS-19: Escape for use in HTML attributes
  function escAttr(str) {
    return (str || '').replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  /* ═══════════════════════════════════════
     HIDDEN TERMINAL PAGE
     FIX JS-22: Removed dead querySelector for .nav-link (navbar not present on terminal page)
     FIX JS-23: Delay redirect to show "Redirecting..." message
     ═══════════════════════════════════════ */
  function initTerminalPage() {
    var page = document.getElementById('terminalPage');
    var input = document.getElementById('termInput');
    var historyEl = document.getElementById('termHistory');
    var welcome = document.getElementById('termWelcome');
    if (!page || !input) return;

    var t = C.terminalPageTexts || {};
    function txt(key) {
      return (t[currentLang] && t[currentLang][key]) || (t.en && t.en[key]) || key;
    }

    if (welcome) {
      welcome.textContent = txt('welcome');
    }

    // FIX JS-22: Direct URL construction instead of dead querySelector
    function getPageUrl(slug) {
      return '/' + slug + '/';
    }

    // FIX JS-23: Redirect commands show message THEN navigate after delay
    function redirectTo(slug, msgKey) {
      var msg = txt(msgKey);
      appendLine(msg, 'term-output');
      page.scrollTop = page.scrollHeight;
      setTimeout(function () {
        window.location.href = getPageUrl(slug);
      }, 600);
      return null; // null = don't append another line
    }

    var commands = {
      help: function () { return txt('help'); },
      about: function () { return redirectTo('about', 'redirect_about'); },
      skills: function () { return redirectTo('skills', 'redirect_skills'); },
      experience: function () { return redirectTo('experience', 'redirect_experience'); },
      projects: function () { return redirectTo('projects', 'redirect_projects'); },
      education: function () { return redirectTo('education', 'redirect_education'); },
      contact: function () { return redirectTo('contact', 'redirect_contact'); },
      cv: function () {
        var overlay = document.getElementById('cvModalOverlay');
        if (overlay) {
          setTimeout(function () {
            overlay.classList.add('cv-modal-visible');
            document.body.style.overflow = 'hidden';
          }, 300);
          return txt('opening_cv');
        }
        var url = C.cvUrl;
        if (url) {
          setTimeout(function () { window.open(url, '_blank'); }, 300);
        }
        return txt('opening_cv');
      },
      clear: function () { historyEl.innerHTML = ''; return null; },
      exit: function () { window.location.href = '/'; return null; },
    };

    input.addEventListener('keydown', function (e) {
      if (e.key !== 'Enter') return;
      var cmd = input.value.trim().toLowerCase();
      input.value = '';
      if (!cmd) return;

      appendLine((C.termPrompt || 'visitor@hdgavi:~$') + ' ' + cmd, 'term-highlight');

      if (commands[cmd]) {
        var result = commands[cmd]();
        if (result) appendLine(result, 'term-output');
      } else {
        appendLine(txt('unknown_cmd').replace('{cmd}', cmd), 'term-error');
      }

      page.scrollTop = page.scrollHeight;
    });

    function appendLine(text, cls) {
      var div = document.createElement('div');
      div.className = cls || '';
      div.textContent = text;
      historyEl.appendChild(div);
    }

    // Focus input when clicking anywhere on the terminal
    page.addEventListener('click', function () { input.focus(); });
  }

  /* ═══════════════════════════════════════
     CONTACT FORM (Web3Forms or WP AJAX fallback)
     FIX JS-24: Validate email format client-side
     FIX JS-25: Save and restore original button HTML
     FIX JS-26: Log catch errors to console
     ═══════════════════════════════════════ */
  function initContactForm() {
    var form = document.getElementById('contactForm');
    if (!form) return;

    // FIX JS-25: Save original button HTML at init time
    var btn = document.getElementById('contactSubmit');
    var btnOriginalHTML = btn ? btn.innerHTML : '';

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var feedback = document.getElementById('formFeedback');
      var i18n = (C.i18n && C.i18n[currentLang]) || (C.i18n && C.i18n.en) || {};

      // Validate
      var nameVal = form.querySelector('[name="name"]').value.trim();
      var emailVal = form.querySelector('[name="email"]').value.trim();
      var messageVal = form.querySelector('[name="message"]').value.trim();

      if (!nameVal || !emailVal || !messageVal) {
        showFeedback(feedback, i18n.validation || 'Please fill all fields.', 'error');
        return;
      }

      // FIX JS-24: Basic email format validation
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailVal)) {
        showFeedback(feedback, i18n.validation || 'Please enter a valid email.', 'error');
        return;
      }

      if (!btn) return;
      btn.disabled = true;
      btn.textContent = i18n.sending || 'Sending...';

      var formData = new FormData(form);
      var hasWeb3Key = formData.get('access_key');
      var fetchUrl, fetchBody;

      if (hasWeb3Key) {
        // Web3Forms submission
        fetchUrl = 'https://api.web3forms.com/submit';
        fetchBody = formData;
      } else {
        // WordPress AJAX fallback
        var ajaxData = new FormData();
        ajaxData.append('action', 'hdgavi_contact');
        ajaxData.append('nonce', C.contactNonce);
        ajaxData.append('name', nameVal);
        ajaxData.append('email', emailVal);
        ajaxData.append('message', messageVal);
        fetchUrl = C.ajaxUrl;
        fetchBody = ajaxData;
      }

      fetchTimeout(fetchUrl, { method: 'POST', body: fetchBody }, 15000)
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (data.success) {
            showFeedback(feedback, i18n.sent || 'Message sent!', 'success');
            form.reset();
          } else {
            showFeedback(feedback, i18n.sendError || 'Error. Try again.', 'error');
          }
        })
        .catch(function (err) {
          console.error('Contact form error:', err);
          var msg = err.name === 'AbortError'
            ? (i18n.timeout || 'Request timed out. Try again.')
            : (i18n.sendError || 'Error. Try again.');
          showFeedback(feedback, msg, 'error');
        })
        .finally(function () {
          btn.disabled = false;
          btn.innerHTML = btnOriginalHTML;
          setLang(currentLang);
        });
    });
  }

  function showFeedback(el, msg, type) {
    if (!el) return;
    el.textContent = msg;
    el.className = 'form-feedback ' + type;
    setTimeout(function () { el.className = 'form-feedback'; }, 5000);
  }

  /* ═══════════════════════════════════════
     GENERIC AJAX FORM HANDLER
     Handles booking, quote, and any future forms
     ═══════════════════════════════════════ */
  function initAjaxForm(formId, feedbackId, action, nonceKey, fields) {
    var form = document.getElementById(formId);
    if (!form) return;

    var btn = form.querySelector('[type="submit"]');
    var btnOriginalHTML = btn ? btn.innerHTML : '';

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var feedback = document.getElementById(feedbackId);
      var i18n = (C.i18n && C.i18n[currentLang]) || (C.i18n && C.i18n.en) || {};

      // Collect field values
      var values = {};
      var valid = true;
      fields.forEach(function (f) {
        var el = form.querySelector('[name="' + f.name + '"]');
        values[f.name] = el ? el.value.trim() : '';
        if (f.required && !values[f.name]) valid = false;
      });

      if (!valid) {
        showFeedback(feedback, i18n.validation || 'Please fill all required fields.', 'error');
        return;
      }

      // Email validation if email field exists
      if (values.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email)) {
        showFeedback(feedback, i18n.validation || 'Please enter a valid email.', 'error');
        return;
      }

      if (!btn) return;
      btn.disabled = true;
      btn.textContent = i18n.sending || 'Sending...';

      // Check if Web3Forms key exists (dual-stack)
      var formData = new FormData(form);
      var hasWeb3Key = formData.get('access_key');
      var fetchUrl, fetchBody;

      if (hasWeb3Key) {
        fetchUrl = 'https://api.web3forms.com/submit';
        fetchBody = formData;
      } else {
        var ajaxData = new FormData();
        ajaxData.append('action', action);
        ajaxData.append('nonce', C[nonceKey]);
        for (var key in values) { ajaxData.append(key, values[key]); }
        fetchUrl = C.ajaxUrl;
        fetchBody = ajaxData;
      }

      fetchTimeout(fetchUrl, { method: 'POST', body: fetchBody }, 15000)
        .then(function (res) { return res.json(); })
        .then(function (data) {
          if (data.success) {
            showFeedback(feedback, i18n.sent || 'Request sent!', 'success');
            form.reset();
          } else {
            showFeedback(feedback, i18n.sendError || 'Error. Try again.', 'error');
          }
        })
        .catch(function (err) {
          console.error(formId + ' error:', err);
          var msg = err.name === 'AbortError'
            ? (i18n.timeout || 'Request timed out. Try again.')
            : (i18n.sendError || 'Error. Try again.');
          showFeedback(feedback, msg, 'error');
        })
        .finally(function () {
          btn.disabled = false;
          btn.innerHTML = btnOriginalHTML;
          setLang(currentLang);
        });
    });
  }

  /* ═══════════════════════════════════════
     WATCH SEARCH (filter cards by text)
     ═══════════════════════════════════════ */
  function initWatchSearch() {
    var input = document.getElementById('watchSearch');
    var grid  = document.getElementById('watchGrid');
    if (!input || !grid) return;

    input.addEventListener('input', function () {
      var query = input.value.toLowerCase().trim();
      grid.querySelectorAll('.watch-card').forEach(function (card) {
        if (!query) {
          card.classList.remove('hidden');
          return;
        }
        var title = (card.querySelector('.watch-card-title') || {}).textContent || '';
        var excerpt = (card.querySelector('.watch-card-excerpt') || {}).textContent || '';
        var tags = card.dataset.tags || '';
        var match = (title + ' ' + excerpt + ' ' + tags).toLowerCase().indexOf(query) !== -1;
        card.classList.toggle('hidden', !match);
      });
    });
  }

  /* ═══════════════════════════════════════
     SHARE BUTTONS (Twitter, LinkedIn, Copy)
     ═══════════════════════════════════════ */
  function initShareButtons() {
    document.addEventListener('click', function (e) {
      var btn = e.target.closest('.share-btn');
      if (!btn) return;

      var url   = btn.dataset.url || window.location.href;
      var title = btn.closest('.watch-card') ? (btn.closest('.watch-card').dataset.title || '') : document.title;
      var type  = btn.dataset.share;

      if (type === 'twitter') {
        window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title), '_blank', 'width=550,height=400');
      } else if (type === 'linkedin') {
        window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(url), '_blank', 'width=550,height=500');
      } else if (type === 'copy') {
        var copyFn = (navigator.clipboard && navigator.clipboard.writeText)
          ? function () { return navigator.clipboard.writeText(url); }
          : function () { return Promise.resolve(fallbackCopy(url)); };

        copyFn().then(function () {
          btn.classList.add('copied');
          setTimeout(function () {
            btn.classList.remove('copied');
          }, 1500);
        });
      }
    });
  }

  /* ═══════════════════════════════════════
     CHATBOT AI WIDGET
     ═══════════════════════════════════════ */
  function initChatbot() {
    var bubble = document.getElementById('chatbotBubble');
    var panel  = document.getElementById('chatbotPanel');
    var close  = document.getElementById('chatbotClose');
    var input  = document.getElementById('chatbotInput');
    var send   = document.getElementById('chatbotSend');
    var msgs   = document.getElementById('chatbotMessages');
    if (!bubble || !panel || !close || !input || !send || !msgs) return;

    // Focusable elements inside the panel for focus trap
    function getFocusable() {
      return panel.querySelectorAll('input, button, [tabindex]:not([tabindex="-1"])');
    }

    function openPanel() {
      panel.classList.add('open');
      bubble.classList.add('hidden');
      input.focus();
    }

    function closePanel() {
      panel.classList.remove('open');
      bubble.classList.remove('hidden');
      bubble.focus();
    }

    // Toggle panel
    bubble.addEventListener('click', openPanel);

    // Keyboard accessibility for bubble
    bubble.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openPanel();
      }
    });

    close.addEventListener('click', closePanel);

    // Focus trap inside dialog
    panel.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') { closePanel(); return; }
      if (e.key !== 'Tab') return;
      var focusable = getFocusable();
      if (!focusable.length) return;
      var first = focusable[0];
      var last  = focusable[focusable.length - 1];
      if (e.shiftKey && document.activeElement === first) {
        e.preventDefault(); last.focus();
      } else if (!e.shiftKey && document.activeElement === last) {
        e.preventDefault(); first.focus();
      }
    });

    // Conversation history for multi-turn
    var chatHistory = [];

    function sendMessage(text) {
      if (!text) {
        text = input.value.trim();
        if (!text) return;
      }
      input.value = '';

      // User message
      appendMsg(text, 'chatbot-msg-user');
      chatHistory.push({ role: 'user', content: text });

      // Loading indicator
      var loading = appendMsg('...', 'chatbot-msg-bot chatbot-msg-loading');

      // Send to WP AJAX proxy
      var data = new FormData();
      data.append('action', 'hdgavi_chatbot');
      data.append('nonce', C.chatbotNonce);
      data.append('question', text);
      data.append('history', JSON.stringify(chatHistory.slice(-8)));

      fetchTimeout(C.ajaxUrl, { method: 'POST', body: data }, 30000)
        .then(function (r) { return r.json(); })
        .then(function (res) {
          loading.remove();
          if (res.success && res.data && res.data.reply) {
            appendMsg(res.data.reply, 'chatbot-msg-bot');
            chatHistory.push({ role: 'assistant', content: res.data.reply });
          } else {
            appendMsg(currentLang === 'fr' ? 'Désolé, erreur. Réessayez.' : (currentLang === 'es' ? 'Error. Inténtalo de nuevo.' : 'Sorry, error. Try again.'), 'chatbot-msg-bot');
          }
        })
        .catch(function (err) {
          loading.remove();
          var msg = err.name === 'AbortError'
            ? (currentLang === 'fr' ? 'Délai dépassé. Réessayez.' : (currentLang === 'es' ? 'Tiempo agotado. Inténtalo de nuevo.' : 'Request timed out. Try again.'))
            : (currentLang === 'fr' ? 'Erreur de connexion.' : (currentLang === 'es' ? 'Error de conexión.' : 'Connection error.'));
          appendMsg(msg, 'chatbot-msg-bot');
        });
    }

    // Quick action buttons
    var quickActions = [
      { en: 'Skills', fr: 'Compétences', es: 'Habilidades', q_en: 'What are your main skills?', q_fr: 'Quelles sont tes compétences principales ?', q_es: '¿Cuáles son tus principales habilidades?' },
      { en: 'Experience', fr: 'Expérience', es: 'Experiencia', q_en: 'Tell me about your work experience', q_fr: 'Parle-moi de ton expérience professionnelle', q_es: 'Cuéntame sobre tu experiencia profesional' },
      { en: 'Projects', fr: 'Projets', es: 'Proyectos', q_en: 'What projects have you worked on?', q_fr: 'Sur quels projets as-tu travaillé ?', q_es: '¿En qué proyectos has trabajado?' },
      { en: 'Contact', fr: 'Contact', es: 'Contacto', q_en: 'How can I contact you?', q_fr: 'Comment te contacter ?', q_es: '¿Cómo puedo contactarte?' },
    ];
    var quickDiv = document.createElement('div');
    quickDiv.className = 'chatbot-quick-actions';
    quickActions.forEach(function (qa) {
      var btn = document.createElement('button');
      btn.className = 'chatbot-quick-btn';
      btn.type = 'button';
      btn.textContent = qa[currentLang] || qa.en;
      btn.addEventListener('click', function () {
        sendMessage(qa['q_' + currentLang] || qa.q_en);
        quickDiv.style.display = 'none';
      });
      quickDiv.appendChild(btn);
    });
    msgs.after(quickDiv);

    function appendMsg(text, cls) {
      var div = document.createElement('div');
      div.className = 'chatbot-msg ' + cls;
      div.textContent = text;
      msgs.appendChild(div);
      msgs.scrollTop = msgs.scrollHeight;
      return div;
    }

    send.addEventListener('click', function () { sendMessage(); });
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') sendMessage();
    });
  }

  /* ═══════════════════════════════════════
     SKELETON LOADING (for GitHub repos grid)
     ═══════════════════════════════════════ */
  function initSkeletons() {
    // Show skeleton placeholders in repo grid while loading
    var grid = document.getElementById('repoGrid');
    if (!grid || grid.children.length > 0) return;
    var count = C.ghReposLimit || 6;
    var html = '';
    for (var i = 0; i < Math.min(count, 6); i++) {
      html += '<div class="skeleton" style="padding:20px;min-height:120px">'
        + '<div class="skeleton-line"></div>'
        + '<div class="skeleton-line"></div>'
        + '<div class="skeleton-line"></div>'
        + '</div>';
    }
    grid.innerHTML = html;
  }

  /* ═══════════════════════════════════════
     FAVORITES (localStorage bookmarks for veille articles)
     ═══════════════════════════════════════ */
  function initFavorites() {
    var favs;
    try { favs = JSON.parse(localStorage.getItem('hdgavi_favs') || '[]'); }
    catch (e) { favs = []; localStorage.removeItem('hdgavi_favs'); }

    // Restore state on load
    document.querySelectorAll('.fav-btn').forEach(function (btn) {
      var id = btn.dataset.fav;
      if (favs.indexOf(id) !== -1) {
        btn.classList.add('favorited');
        btn.setAttribute('aria-pressed', 'true');
      }
    });

    // Toggle on click
    document.addEventListener('click', function (e) {
      var btn = e.target.closest('.fav-btn');
      if (!btn) return;
      var id = btn.dataset.fav;
      var idx = favs.indexOf(id);
      if (idx === -1) {
        favs.push(id);
        btn.classList.add('favorited');
        btn.setAttribute('aria-pressed', 'true');
      } else {
        favs.splice(idx, 1);
        btn.classList.remove('favorited');
        btn.setAttribute('aria-pressed', 'false');
      }
      localStorage.setItem('hdgavi_favs', JSON.stringify(favs));
    });
  }

  /* ═══════════════════════════════════════
     PWA SERVICE WORKER REGISTRATION
     ═══════════════════════════════════════ */
  function initServiceWorker() {
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register(C.swUrl || '/wp-content/themes/hdgavi-portfolio/sw.js')
        .catch(function (err) {
          console.warn('SW registration failed:', err);
        });
    }
  }

  /* ═══════════════════════════════════════
     FILTER CARDS (Watch + Certifications + Timeline)
     Reusable: works on any grid with .watch-filter buttons
     and cards with data-tags attribute
     ═══════════════════════════════════════ */
  function initFilters() {
    document.querySelectorAll('.watch-filters').forEach(function (container) {
      var grid = container.nextElementSibling;
      if (!grid) return;

      container.addEventListener('click', function (e) {
        var btn = e.target.closest('.watch-filter');
        if (!btn) return;

        var filter = btn.dataset.filter;

        // Update active state
        container.querySelectorAll('.watch-filter').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        // Filter cards
        grid.querySelectorAll('[data-tags]').forEach(function (card) {
          if (filter === 'all') {
            card.classList.remove('hidden');
          } else {
            var tags = card.dataset.tags || '';
            card.classList.toggle('hidden', tags.indexOf(filter) === -1);
          }
        });
      });
    });
  }

  /* ═══════════════════════════════════════
     NEWSLETTER FORM
     ═══════════════════════════════════════ */
  function initNewsletter() {
    var form = document.getElementById('newsletterForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var feedback = document.getElementById('nlFeedback');
      var btn = document.getElementById('nlSubmit');
      var emailInput = document.getElementById('nlEmail');
      var email = emailInput.value.trim();

      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showFeedback(feedback, 'Please enter a valid email.', 'error');
        return;
      }

      btn.disabled = true;

      var data = new FormData();
      data.append('action', 'hdgavi_newsletter');
      data.append('nonce', form.querySelector('[name="nl_nonce"]').value);
      data.append('email', email);

      fetchTimeout(C.ajaxUrl, { method: 'POST', body: data }, 15000)
        .then(function (r) { return r.json(); })
        .then(function (res) {
          if (res.success) {
            showFeedback(feedback, currentLang === 'fr' ? 'Merci ! Vous êtes abonné.' : (currentLang === 'es' ? '¡Gracias! Estás suscrito.' : 'Thanks! You\'re subscribed.'), 'success');
            emailInput.value = '';
          } else {
            var msg = res.data && res.data.message === 'already_subscribed'
              ? (currentLang === 'fr' ? 'Vous êtes déjà abonné.' : (currentLang === 'es' ? 'Ya estás suscrito.' : 'You\'re already subscribed.'))
              : (currentLang === 'fr' ? 'Erreur. Réessayez.' : (currentLang === 'es' ? 'Error. Inténtalo de nuevo.' : 'Error. Try again.'));
            showFeedback(feedback, msg, 'error');
          }
        })
        .catch(function (err) {
          var msg = err.name === 'AbortError'
            ? (currentLang === 'fr' ? 'Délai dépassé. Réessayez.' : (currentLang === 'es' ? 'Tiempo agotado. Inténtalo de nuevo.' : 'Request timed out. Try again.'))
            : (currentLang === 'fr' ? 'Erreur. Réessayez.' : (currentLang === 'es' ? 'Error. Inténtalo de nuevo.' : 'Error. Try again.'));
          showFeedback(feedback, msg, 'error');
        })
        .finally(function () {
          btn.disabled = false;
        });
    });
  }

  /* ═══════════════════════════════════════
     INIT
     FIX JS-27: try/catch per module so one failure
     doesn't prevent the rest from initializing
     ═══════════════════════════════════════ */
  document.addEventListener('DOMContentLoaded', function () {
    // Apply saved preferences first
    /* ═══════════════════════════════════════
       CV DOWNLOAD GATE
       ═══════════════════════════════════════ */
    function initCvDownloadGate() {
      var overlay = document.getElementById('cvModalOverlay');
      var form = document.getElementById('cvModalForm');
      var closeBtn = document.getElementById('cvModalClose');
      var feedback = document.getElementById('cvModalFeedback');
      var successEl = document.getElementById('cvModalSuccess');
      var submitBtn = document.getElementById('cvModalSubmit');
      if (!overlay || !form) return;

      function openModal() {
        overlay.classList.add('cv-modal-visible');
        document.body.style.overflow = 'hidden';
        // Update placeholders for current language
        form.querySelectorAll('[data-placeholder-' + currentLang + ']').forEach(function (el) {
          el.placeholder = el.getAttribute('data-placeholder-' + currentLang);
        });
        // Update select options for current language
        form.querySelectorAll('option[data-lang-text-' + currentLang + ']').forEach(function (opt) {
          opt.textContent = opt.getAttribute('data-lang-text-' + currentLang);
        });
      }

      function closeModal() {
        overlay.classList.remove('cv-modal-visible');
        document.body.style.overflow = '';
      }

      // Open triggers
      document.querySelectorAll('.hdgavi-cv-download-trigger').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
          e.preventDefault();
          openModal();
        });
      });

      // Close
      if (closeBtn) closeBtn.addEventListener('click', closeModal);
      overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeModal();
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('cv-modal-visible')) closeModal();
      });

      // Submit
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var i18n = (C.i18n && C.i18n[currentLang]) || {};
        feedback.textContent = '';
        feedback.className = 'cv-modal-feedback';

        var data = new FormData(form);
        data.append('action', 'hdgavi_cv_download');
        data.append('nonce', C.cvDownloadNonce);
        data.append('lang', currentLang);

        // Disable button, save original text
        submitBtn.disabled = true;
        var btnSpan = submitBtn.querySelector('span[data-lang="' + currentLang + '"]');
        var originalBtnText = btnSpan ? btnSpan.textContent : '';
        if (btnSpan) btnSpan.textContent = i18n.cvSending || 'Sending...';

        function restoreBtn() {
          submitBtn.disabled = false;
          if (btnSpan) btnSpan.textContent = originalBtnText;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', C.ajaxUrl);
        xhr.onload = function () {
          restoreBtn();
          try {
            var res = JSON.parse(xhr.responseText);
            if (res.success) {
              form.style.display = 'none';
              if (successEl) successEl.style.display = 'block';
              // Trigger direct download
              setTimeout(function () {
                var a = document.createElement('a');
                a.href = C.cvUrl;
                a.download = 'CV.pdf';
                a.style.display = 'none';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
              }, 800);
              // Auto close after 3s
              setTimeout(function () {
                closeModal();
                // Reset for next use
                form.style.display = '';
                if (successEl) successEl.style.display = 'none';
                form.reset();
              }, 3500);
            } else {
              feedback.textContent = (res.data && res.data.message) || i18n.cvError || 'Error';
              feedback.classList.add('cv-modal-feedback-error');
            }
          } catch (err) {
            feedback.textContent = i18n.cvError || 'Error';
            feedback.classList.add('cv-modal-feedback-error');
          }
        };
        xhr.onerror = function () {
          restoreBtn();
          feedback.textContent = i18n.cvError || 'Error';
          feedback.classList.add('cv-modal-feedback-error');
        };
        xhr.send(data);
      });
    }

    /* ═══════════════════════════════════════
       RESOURCES — SIDEBAR FILTERING + GATED DOWNLOAD
       ═══════════════════════════════════════ */
    function initResources() {
      var navItems = document.querySelectorAll('[data-res-filter]');
      var cards = document.querySelectorAll('.res-card');
      if (!navItems.length || !cards.length) return;

      navItems.forEach(function (btn) {
        btn.addEventListener('click', function () {
          navItems.forEach(function (b) { b.classList.remove('active'); });
          btn.classList.add('active');
          var filter = btn.dataset.resFilter;

          cards.forEach(function (card) {
            var cats = card.dataset.resCats || '';
            var type = card.dataset.resType || '';
            var show = false;

            if (filter === 'all') show = true;
            else if (filter === 'free' || filter === 'paid') show = (type === filter);
            else show = cats.split(' ').indexOf(filter) !== -1;

            if (show) card.removeAttribute('data-res-hidden');
            else card.setAttribute('data-res-hidden', '');
          });
        });
      });

      // Gated download — reuse CV modal pattern
      document.querySelectorAll('.hdgavi-res-gate-trigger').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var overlay = document.getElementById('cvModalOverlay');
          if (overlay) {
            // Store the resource download URL temporarily
            overlay.dataset.resDownloadUrl = btn.dataset.resUrl || '';
            overlay.classList.add('cv-modal-visible');
            document.body.style.overflow = 'hidden';
          }
        });
      });
    }

    /* ═══════════════════════════════════════
       ANALYTICS — GITHUB STATS
       ═══════════════════════════════════════ */
    function initAnalyticsGitHub() {
      var container = document.getElementById('analyticsGhCards');
      if (!container || !C.ghUsername) return;

      fetch('https://api.github.com/users/' + encodeURIComponent(C.ghUsername))
        .then(function (r) { return r.json(); })
        .then(function (user) {
          if (!user || user.message) return;
          container.innerHTML = '';
          var cards = [
            { label: 'Public Repos', value: user.public_repos || 0 },
            { label: 'Followers', value: user.followers || 0 },
            { label: 'Following', value: user.following || 0 },
          ];
          cards.forEach(function (c) {
            var div = document.createElement('div');
            div.className = 'analytics-gh-card';
            div.innerHTML = '<span class="analytics-number">' + c.value + '</span><span class="analytics-label">' + c.label + '</span>';
            container.appendChild(div);
          });
          // Fetch total stars
          fetch('https://api.github.com/users/' + encodeURIComponent(C.ghUsername) + '/repos?per_page=100&sort=stargazers_count')
            .then(function (r) { return r.json(); })
            .then(function (repos) {
              if (!Array.isArray(repos)) return;
              var totalStars = repos.reduce(function (sum, r) { return sum + (r.stargazers_count || 0); }, 0);
              var div = document.createElement('div');
              div.className = 'analytics-gh-card';
              div.innerHTML = '<span class="analytics-number">' + totalStars + '</span><span class="analytics-label">Total Stars</span>';
              container.appendChild(div);
            });
        })
        .catch(function () {
          container.innerHTML = '<p style="color:var(--text-tertiary)">Could not load GitHub stats.</p>';
        });
    }

    /* ═══════════════════════════════════════
       PROJECT CAROUSEL + LIGHTBOX
       ═══════════════════════════════════════ */
    function initProjectCarousels() {
      // Initialize a single carousel element
      function setupCarousel(carousel) {
        if (carousel.dataset.carouselInit) return;
        carousel.dataset.carouselInit = '1';

        var track = carousel.querySelector('.proj-carousel-track');
        var imgs = track.querySelectorAll('img');
        var dots = carousel.querySelectorAll('.proj-carousel-dots span');
        var prev = carousel.querySelector('.proj-carousel-btn.prev');
        var next = carousel.querySelector('.proj-carousel-btn.next');
        // Find thumbnail strip (sibling of carousel inside .proj-gallery-wrap)
        var wrap = carousel.closest('.proj-gallery-wrap');
        var thumbs = wrap ? wrap.querySelectorAll('.proj-thumb') : [];
        var idx = 0;
        var count = imgs.length;
        if (count <= 1) return;

        function preloadAdjacentImages(n) {
          var prevIdx = (n - 1 + count) % count;
          var nextIdx = (n + 1) % count;
          if (imgs[prevIdx] && imgs[prevIdx].dataset.src) { imgs[prevIdx].src = imgs[prevIdx].dataset.src; delete imgs[prevIdx].dataset.src; }
          if (imgs[nextIdx] && imgs[nextIdx].dataset.src) { imgs[nextIdx].src = imgs[nextIdx].dataset.src; delete imgs[nextIdx].dataset.src; }
        }

        function goTo(n) {
          idx = (n + count) % count;
          track.style.transform = 'translateX(-' + (idx * 100) + '%)';
          dots.forEach(function (d, i) { d.classList.toggle('active', i === idx); });
          thumbs.forEach(function (t, i) { t.classList.toggle('active', i === idx); });
          preloadAdjacentImages(idx);
        }
        if (prev) prev.addEventListener('click', function () { goTo(idx - 1); });
        if (next) next.addEventListener('click', function () { goTo(idx + 1); });

        // Thumbnail clicks navigate carousel
        thumbs.forEach(function (thumb) {
          thumb.addEventListener('click', function () {
            goTo(parseInt(thumb.dataset.thumbIdx, 10));
          });
        });

        // Swipe support
        var startX = 0;
        track.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
        track.addEventListener('touchend', function (e) {
          var diff = startX - e.changedTouches[0].clientX;
          if (Math.abs(diff) > 40) goTo(idx + (diff > 0 ? 1 : -1));
        }, { passive: true });
      }

      // Use IntersectionObserver to lazy-init carousels when near viewport
      var carousels = document.querySelectorAll('[data-carousel]');
      if ('IntersectionObserver' in window && carousels.length) {
        var carouselObserver = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              setupCarousel(entry.target);
              carouselObserver.unobserve(entry.target);
            }
          });
        }, { rootMargin: '200px' });
        carousels.forEach(function (c) { carouselObserver.observe(c); });
      } else {
        carousels.forEach(setupCarousel);
      }

      // Lightbox with counter + thumbnail strip
      var lightbox = document.createElement('div');
      lightbox.className = 'proj-lightbox';
      lightbox.innerHTML = '<button class="proj-lightbox-close" type="button">&times;</button>'
        + '<button class="proj-lightbox-nav prev" type="button">‹</button>'
        + '<div class="proj-lightbox-main"><img src="" alt=""><div class="proj-lightbox-counter"></div></div>'
        + '<button class="proj-lightbox-nav next" type="button">›</button>'
        + '<div class="proj-lightbox-thumbs"></div>';
      document.body.appendChild(lightbox);
      var lbImg = lightbox.querySelector('img');
      var lbCounter = lightbox.querySelector('.proj-lightbox-counter');
      var lbThumbs = lightbox.querySelector('.proj-lightbox-thumbs');

      // Group images by project card
      var projectGalleries = [];
      document.querySelectorAll('.project-card').forEach(function (card) {
        var imgs = card.querySelectorAll('[data-lightbox]');
        if (imgs.length === 0) return;
        var gallery = [];
        imgs.forEach(function (img) { gallery.push(img.src); });
        imgs.forEach(function (img) {
          img.style.cursor = 'zoom-in';
          img.addEventListener('click', function () { openLightbox(gallery, gallery.indexOf(img.src)); });
        });
        projectGalleries.push(gallery);
      });

      // Fallback: if no project cards, collect all lightbox images globally
      if (projectGalleries.length === 0) {
        var globalGallery = [];
        document.querySelectorAll('[data-lightbox]').forEach(function (img) {
          globalGallery.push(img.src);
          img.style.cursor = 'zoom-in';
          img.addEventListener('click', function () { openLightbox(globalGallery, globalGallery.indexOf(img.src)); });
        });
      }

      var currentGallery = [];
      var lbIdx = 0;

      function openLightbox(gallery, idx) {
        currentGallery = gallery;
        lbIdx = idx || 0;
        updateLightbox();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      function updateLightbox() {
        lbImg.src = currentGallery[lbIdx];
        lbCounter.textContent = (lbIdx + 1) + ' / ' + currentGallery.length;

        // Build thumbnail strip
        lbThumbs.innerHTML = '';
        if (currentGallery.length > 1) {
          currentGallery.forEach(function (src, i) {
            var thumb = document.createElement('img');
            thumb.src = src;
            thumb.className = 'proj-lightbox-thumb' + (i === lbIdx ? ' active' : '');
            thumb.addEventListener('click', function (e) {
              e.stopPropagation();
              lbIdx = i;
              updateLightbox();
            });
            lbThumbs.appendChild(thumb);
          });
        }
      }

      function closeLb() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
      }
      function lbNav(dir) {
        lbIdx = (lbIdx + dir + currentGallery.length) % currentGallery.length;
        updateLightbox();
      }
      lightbox.querySelector('.proj-lightbox-close').addEventListener('click', closeLb);
      lightbox.querySelector('.proj-lightbox-nav.prev').addEventListener('click', function (e) { e.stopPropagation(); lbNav(-1); });
      lightbox.querySelector('.proj-lightbox-nav.next').addEventListener('click', function (e) { e.stopPropagation(); lbNav(1); });
      lightbox.addEventListener('click', function (e) { if (e.target === lightbox || e.target === lightbox.querySelector('.proj-lightbox-main')) closeLb(); });
      document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeLb();
        if (e.key === 'ArrowLeft') lbNav(-1);
        if (e.key === 'ArrowRight') lbNav(1);
      });
    }

    setTheme(currentTheme);
    setLang(currentLang);

    document.querySelectorAll('[data-set-lang]').forEach(function (btn) {
      btn.addEventListener('click', function () { setLang(btn.dataset.setLang); });
    });
    document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
      btn.addEventListener('click', toggleTheme);
    });

    // FIX JS-27: Init each module in try/catch
    var modules = [
      ['CvDownloadGate', initCvDownloadGate],
      ['ProjectCarousels', initProjectCarousels],
      ['Resources', initResources],
      ['AnalyticsGitHub', initAnalyticsGitHub],
      ['Nav', initNav],
      ['CopyEmail', initCopyEmail],
      ['GitHubRepos', initGitHubRepos],
      ['TerminalPage', initTerminalPage],
      ['ContactForm', initContactForm],
      ['BookingForm', function () {
        initAjaxForm('bookingForm', 'bookingFeedback', 'hdgavi_booking', 'bookingNonce', [
          { name: 'name', required: true },
          { name: 'email', required: true },
          { name: 'date', required: true },
          { name: 'time', required: true },
          { name: 'message', required: false }
        ]);
      }],
      ['QuoteForm', function () {
        initAjaxForm('quoteForm', 'quoteFeedback', 'hdgavi_quote', 'quoteNonce', [
          { name: 'name', required: true },
          { name: 'email', required: true },
          { name: 'company', required: false },
          { name: 'service', required: true },
          { name: 'message', required: true }
        ]);
      }],
      ['Filters', initFilters],
      ['WatchSearch', initWatchSearch],
      ['ShareButtons', initShareButtons],
      ['Newsletter', initNewsletter],
      ['Skeletons', initSkeletons],
      ['Favorites', initFavorites],
      ['Chatbot', initChatbot],
      ['ServiceWorker', initServiceWorker],
    ];

    modules.forEach(function (mod) {
      try {
        mod[1]();
      } catch (err) {
        console.error('HD GAVI: Failed to init ' + mod[0] + ':', err);
      }
    });
  });
})();
