/**
 * TaskHive — pages.js
 * Supplemental JS for all inner pages
 * Include AFTER app.js
 */

/* ═══════════════════════════════════════
   TOAST NOTIFICATION
═══════════════════════════════════════ */
function showToast(msg, type = 'success') {
  const colors = { success: 'var(--success)', error: 'var(--danger)', info: 'var(--primary)' };
  const icons  = { success: '✅', error: '❌', info: 'ℹ️' };
  const t = document.createElement('div');
  t.style.cssText = [
    'position:fixed', 'bottom:24px', 'right:24px', 'z-index:9999',
    'background:' + (colors[type] || colors.info),
    'color:#fff', 'padding:12px 20px', 'border-radius:10px',
    'font-size:13px', 'font-weight:600',
    'box-shadow:0 8px 24px rgba(0,0,0,0.35)',
    'transform:translateY(80px)', 'opacity:0',
    'transition:all .3s cubic-bezier(.4,0,.2,1)',
    'font-family:Sora,sans-serif',
    'display:flex', 'align-items:center', 'gap:8px',
    'max-width:340px', 'pointer-events:none'
  ].join(';');
  t.innerHTML = (icons[type] || icons.info) + ' ' + msg;
  document.body.appendChild(t);
  requestAnimationFrame(() => {
    t.style.transform = 'translateY(0)';
    t.style.opacity = '1';
  });
  setTimeout(() => {
    t.style.transform = 'translateY(80px)';
    t.style.opacity = '0';
    setTimeout(() => t.remove(), 320);
  }, 3400);
}

/* ═══════════════════════════════════════
   FAQ ACCORDION
═══════════════════════════════════════ */
function initFaq() {
  document.querySelectorAll('.faq-q').forEach(q => {
    q.addEventListener('click', () => {
      const item = q.closest('.faq-item');
      const isOpen = item.classList.contains('open');
      // close all
      document.querySelectorAll('.faq-item.open').forEach(f => f.classList.remove('open'));
      // open clicked if it was closed
      if (!isOpen) item.classList.add('open');
    });
  });
}

/* ═══════════════════════════════════════
   FAQ CATEGORY FILTER
═══════════════════════════════════════ */
function initFaqFilter() {
  document.querySelectorAll('.faq-filter-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.faq-filter-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const cat = tab.dataset.cat;
      document.querySelectorAll('.faq-item').forEach(item => {
        if (cat === 'all' || item.dataset.cat === cat) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
}

/* ═══════════════════════════════════════
   PAYMENT METHOD SELECTION
═══════════════════════════════════════ */
function initPaymentMethods() {
  document.querySelectorAll('.payment-methods').forEach(group => {
    group.querySelectorAll('.pay-method').forEach(btn => {
      btn.addEventListener('click', () => {
        group.querySelectorAll('.pay-method').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        // show relevant account fields
        const method = btn.dataset.method;
        document.querySelectorAll('.account-fields').forEach(f => f.style.display = 'none');
        const target = document.querySelector('.account-fields[data-method="' + method + '"]');
        if (target) target.style.display = 'block';
      });
    });
  });
}

/* ═══════════════════════════════════════
   AMOUNT PRESET BUTTONS
═══════════════════════════════════════ */
function initAmountPresets() {
  document.querySelectorAll('.amount-presets').forEach(group => {
    group.querySelectorAll('.amount-preset').forEach(btn => {
      btn.addEventListener('click', () => {
        group.querySelectorAll('.amount-preset').forEach(b => b.classList.remove('sel'));
        btn.classList.add('sel');
        const val = btn.dataset.val || btn.textContent.replace(/[^0-9.]/g, '');
        // find nearest amount input
        const form = btn.closest('form') || btn.closest('.card') || document;
        const input = form.querySelector('input[type="number"], input[data-amount], #amountInput');
        if (input) {
          input.value = val;
          input.dispatchEvent(new Event('input'));
        }
      });
    });
  });
}

/* ═══════════════════════════════════════
   WITHDRAWAL FEE CALCULATOR
═══════════════════════════════════════ */
function initFeeCalculator() {
  const amountInput = document.querySelector('#withdrawAmount');
  if (!amountInput) return;
  amountInput.addEventListener('input', () => {
    const amount  = parseFloat(amountInput.value) || 0;
    const feeRate = 0.02; // 2%
    const fee     = +(amount * feeRate).toFixed(2);
    const net     = +(amount - fee).toFixed(2);
    const elAmount = document.querySelector('#feeAmount');
    const elFee    = document.querySelector('#feeCharge');
    const elNet    = document.querySelector('#feeNet');
    const box      = document.querySelector('.fee-breakdown');
    if (box) box.style.display = amount > 0 ? 'block' : 'none';
    if (elAmount) elAmount.textContent = '$' + amount.toFixed(2);
    if (elFee)    elFee.textContent    = '$' + fee;
    if (elNet)    elNet.textContent    = '$' + (net > 0 ? net : '0.00');
  });
}

/* ═══════════════════════════════════════
   OPTIMIZE BUTTON
═══════════════════════════════════════ */
function initOptimizeButton() {
  const btn = document.querySelector('.btn-optimize');
  if (!btn) return;
  btn.addEventListener('click', () => {
    if (btn.classList.contains('running')) return;
    btn.classList.add('running');
    btn.innerHTML = '⚙️ Optimizing...';
    btn.disabled = true;
    let dots = 1;
    const iv = setInterval(() => {
      dots = (dots % 3) + 1;
      btn.innerHTML = '⚙️ Optimizing' + '.'.repeat(dots);
    }, 450);
    setTimeout(() => {
      clearInterval(iv);
      btn.classList.remove('running');
      btn.innerHTML = '🚀 Start Optimization';
      btn.disabled = false;
      showToast('Optimization complete! Tasks refreshed.', 'success');
    }, 3200);
  });
}

/* ═══════════════════════════════════════
   PASSWORD STRENGTH METER
═══════════════════════════════════════ */
function initPasswordStrength() {
  const input = document.querySelector('#newPasswordInput');
  if (!input) return;

  input.addEventListener('input', () => {
    const val = input.value;
    const bars = document.querySelectorAll('.pwd-bar');
    const label = document.querySelector('.pwd-text');

    // score
    let score = 0;
    if (val.length >= 8)  score++;
    if (val.length >= 12) score++;
    if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    // clamp 0-4
    score = Math.min(score, 4);

    const levels = ['', 'Weak', 'Medium', 'Strong', 'Very Strong'];
    const cls    = ['', 'weak', 'medium', 'strong', 'very-strong'];

    bars.forEach((bar, i) => {
      bar.className = 'pwd-bar';
      if (i < score) bar.classList.add(cls[score]);
    });
    if (label) label.textContent = score > 0 ? 'Password strength: ' + levels[score] : '';

    // requirements checklist
    updateReqChecklist(val);
  });
}

function updateReqChecklist(val) {
  const checks = {
    'req-length':  val.length >= 8,
    'req-upper':   /[A-Z]/.test(val),
    'req-number':  /[0-9]/.test(val),
    'req-special': /[^A-Za-z0-9]/.test(val),
  };
  Object.entries(checks).forEach(([id, pass]) => {
    const el = document.querySelector('#' + id);
    if (!el) return;
    el.classList.toggle('req-pass', pass);
    el.classList.toggle('req-fail', !pass);
    const icon = el.querySelector('.req-icon');
    if (icon) icon.textContent = pass ? '✓' : '○';
  });
}

/* ═══════════════════════════════════════
   PASSWORD SHOW / HIDE TOGGLE
═══════════════════════════════════════ */
function initPasswordToggle() {
  document.querySelectorAll('.pwd-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      const input = btn.previousElementSibling || btn.closest('.input-wrap')?.querySelector('input');
      if (!input) return;
      const isText = input.type === 'text';
      input.type = isText ? 'password' : 'text';
      btn.textContent = isText ? '👁' : '🙈';
    });
  });
}

/* ═══════════════════════════════════════
   CONFIRM PASSWORD MATCH
═══════════════════════════════════════ */
function initConfirmPassword() {
  const pwd     = document.querySelector('#newPasswordInput');
  const confirm = document.querySelector('#confirmPasswordInput');
  if (!pwd || !confirm) return;
  const check = () => {
    if (!confirm.value) { confirm.style.borderColor = ''; return; }
    const match = pwd.value === confirm.value;
    confirm.style.borderColor = match ? 'var(--success)' : 'var(--danger)';
  };
  confirm.addEventListener('input', check);
  pwd.addEventListener('input', check);
}

/* ═══════════════════════════════════════
   HISTORY FILTER TABS
═══════════════════════════════════════ */
function initHistoryFilter() {
  document.querySelectorAll('.history-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.history-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const filter = tab.dataset.filter;
      document.querySelectorAll('tr[data-status]').forEach(row => {
        row.style.display = (filter === 'all' || row.dataset.status === filter) ? '' : 'none';
      });
      // update visible count
      const visible = document.querySelectorAll('tr[data-status]:not([style*="none"])').length;
      const countEl = document.querySelector('.history-count');
      if (countEl) countEl.textContent = visible + ' records';
    });
  });
}

/* ═══════════════════════════════════════
   COPY TO CLIPBOARD
═══════════════════════════════════════ */
function initCopyButtons() {
  document.querySelectorAll('[data-copy]').forEach(btn => {
    btn.addEventListener('click', () => {
      const text = btn.dataset.copy;
      navigator.clipboard.writeText(text).then(() => {
        const orig = btn.innerHTML;
        btn.innerHTML = '✅ Copied!';
        setTimeout(() => { btn.innerHTML = orig; }, 1600);
      }).catch(() => {
        // fallback
        const ta = document.createElement('textarea');
        ta.value = text; ta.style.position = 'fixed'; ta.style.opacity = '0';
        document.body.appendChild(ta); ta.select();
        document.execCommand('copy'); ta.remove();
        const orig = btn.innerHTML;
        btn.innerHTML = '✅ Copied!';
        setTimeout(() => { btn.innerHTML = orig; }, 1600);
      });
    });
  });
}

/* ═══════════════════════════════════════
   TASK SUBMIT BUTTON
═══════════════════════════════════════ */
function initTaskSubmit() {
  document.querySelectorAll('.btn-submit-task').forEach(btn => {
    btn.addEventListener('click', () => {
      const card  = btn.closest('.task-detail-card');
      const comm  = card?.dataset.comm  || '0.00';
      const title = card?.querySelector('.task-card-title')?.textContent?.slice(0, 32) || 'Task';
      showToast('"' + title + '" submitted! +$' + comm + ' commission.', 'success');
      btn.innerHTML = '✅ Submitted';
      btn.disabled = true;
      btn.style.opacity = '0.65';
    });
  });
}

/* ═══════════════════════════════════════
   DRAG & DROP UPLOAD ZONE
═══════════════════════════════════════ */
function initUploadZone() {
  document.querySelectorAll('.upload-zone').forEach(zone => {
    const input = zone.querySelector('input[type="file"]');

    zone.addEventListener('dragover', e => {
      e.preventDefault();
      zone.classList.add('drag-over');
    });
    zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', e => {
      e.preventDefault();
      zone.classList.remove('drag-over');
      const file = e.dataTransfer.files[0];
      if (file) handleFileSelect(zone, file);
    });
    zone.addEventListener('click', () => input?.click());
    input?.addEventListener('change', () => {
      if (input.files[0]) handleFileSelect(zone, input.files[0]);
    });
  });
}

function handleFileSelect(zone, file) {
  const label = zone.querySelector('.upload-label');
  if (label) label.textContent = '📎 ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
  zone.classList.add('has-file');
  showToast('File "' + file.name + '" selected.', 'info');
}

/* ═══════════════════════════════════════
   FORM LOADING STATE
═══════════════════════════════════════ */
function initFormLoading() {
  document.querySelectorAll('form[data-loading]').forEach(form => {
    form.addEventListener('submit', () => {
      const btn = form.querySelector('button[type="submit"], input[type="submit"]');
      if (!btn) return;
      btn.disabled = true;
      btn.dataset.orig = btn.innerHTML;
      btn.innerHTML = '⏳ Processing...';
    });
  });
}

/* ═══════════════════════════════════════
   SESSION FLASH MESSAGES (Laravel)
═══════════════════════════════════════ */
function initFlashMessages() {
  // Blade should render hidden divs with data-flash-type and data-flash-msg
  document.querySelectorAll('[data-flash]').forEach(el => {
    const type = el.dataset.flash;
    const msg  = el.dataset.msg || el.textContent;
    if (msg) showToast(msg, type);
    el.remove();
  });
}

/* ═══════════════════════════════════════
   BAR CHART ANIMATION
═══════════════════════════════════════ */
function animateBars() {
  document.querySelectorAll('.bar').forEach((bar, i) => {
    const h = bar.dataset.height || '50';
    bar.style.height = '0';
    bar.style.transition = 'height 0.5s cubic-bezier(.4,0,.2,1)';
    setTimeout(() => { bar.style.height = h + '%'; }, i * 70 + 200);
  });
}

/* ═══════════════════════════════════════
   SIDEBAR ACTIVE STATE (multi-page mode)
═══════════════════════════════════════ */
function initSidebarActive() {
  const path = window.location.pathname;
  document.querySelectorAll('.nav-item[data-route]').forEach(item => {
    if (path.includes(item.dataset.route)) {
      item.classList.add('active');
    }
  });
}

/* ═══════════════════════════════════════
   NOTIFICATION BELL DROPDOWN
═══════════════════════════════════════ */
function initNotificationBell() {
  const bell    = document.querySelector('.notif-bell');
  const dropdown = document.querySelector('.notif-dropdown');
  if (!bell || !dropdown) return;
  bell.addEventListener('click', e => {
    e.stopPropagation();
    dropdown.classList.toggle('open');
  });
  document.addEventListener('click', () => dropdown.classList.remove('open'));
}

/* ═══════════════════════════════════════
   USER AVATAR DROPDOWN
═══════════════════════════════════════ */
function initAvatarDropdown() {
  const avatar   = document.querySelector('.topbar-avatar');
  const dropdown = document.querySelector('.avatar-dropdown');
  if (!avatar || !dropdown) return;
  avatar.addEventListener('click', e => {
    e.stopPropagation();
    dropdown.classList.toggle('open');
  });
  document.addEventListener('click', () => dropdown.classList.remove('open'));
}

/* ═══════════════════════════════════════
   SUPPORT TICKET FORM
═══════════════════════════════════════ */
function initSupportForm() {
  document.querySelector('#supportForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    if (btn) { btn.disabled = true; btn.innerHTML = '⏳ Sending...'; }
    setTimeout(() => {
      showToast('Ticket submitted! We will respond within 24 hours.', 'success');
      e.target.reset();
      if (btn) { btn.disabled = false; btn.innerHTML = '📨 Send Ticket →'; }
    }, 1200);
  });
}

/* ═══════════════════════════════════════
   PROFILE FORM
═══════════════════════════════════════ */
function initProfileForm() {
  document.querySelector('#profileForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    if (btn) { btn.disabled = true; btn.innerHTML = '⏳ Saving...'; }
    setTimeout(() => {
      showToast('Profile updated successfully.', 'success');
      if (btn) { btn.disabled = false; btn.innerHTML = '💾 Save Changes'; }
    }, 1000);
  });
}

/* ═══════════════════════════════════════
   PASSWORD CHANGE FORM
═══════════════════════════════════════ */
function initPasswordForm() {
  document.querySelector('#passwordForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const pwd     = document.querySelector('#newPasswordInput')?.value;
    const confirm = document.querySelector('#confirmPasswordInput')?.value;
    if (pwd !== confirm) {
      showToast('Passwords do not match.', 'error');
      return;
    }
    if (!pwd || pwd.length < 8) {
      showToast('Password must be at least 8 characters.', 'error');
      return;
    }
    const btn = e.target.querySelector('button[type="submit"]');
    if (btn) { btn.disabled = true; btn.innerHTML = '⏳ Updating...'; }
    setTimeout(() => {
      showToast('Password updated successfully.', 'success');
      e.target.reset();
      document.querySelectorAll('.pwd-bar').forEach(b => { b.className = 'pwd-bar'; });
      const txt = document.querySelector('.pwd-text');
      if (txt) txt.textContent = '';
      if (btn) { btn.disabled = false; btn.innerHTML = '🔑 Update Password →'; }
    }, 1000);
  });
}

/* ═══════════════════════════════════════
   RECHARGE FORM
═══════════════════════════════════════ */
function initRechargeForm() {
  document.querySelector('#rechargeForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    if (btn) { btn.disabled = true; btn.innerHTML = '⏳ Submitting...'; }
    setTimeout(() => {
      showToast('Recharge request submitted! Pending confirmation.', 'info');
      if (btn) { btn.disabled = false; btn.innerHTML = '📥 Submit Recharge Request →'; }
    }, 1200);
  });
}

/* ═══════════════════════════════════════
   REDEMPTION FORM
═══════════════════════════════════════ */
function initRedemptionForm() {
  document.querySelector('#redemptionForm')?.addEventListener('submit', e => {
    e.preventDefault();
    const btn = e.target.querySelector('button[type="submit"]');
    if (btn) { btn.disabled = true; btn.innerHTML = '⏳ Processing...'; }
    setTimeout(() => {
      showToast('Withdrawal request submitted! Processing within 24 hours.', 'success');
      if (btn) { btn.disabled = false; btn.innerHTML = '📤 Request Withdrawal →'; }
    }, 1200);
  });
}

/* ═══════════════════════════════════════
   TERMS TOC SMOOTH SCROLL
═══════════════════════════════════════ */
function initTermsToc() {
  document.querySelectorAll('.terms-toc-link').forEach(link => {
    link.addEventListener('click', () => {
      const target = document.querySelector(link.dataset.target);
      if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
}

/* ═══════════════════════════════════════
   INIT ALL ON DOM READY
═══════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  initFaq();
  initFaqFilter();
  initPaymentMethods();
  initAmountPresets();
  initFeeCalculator();
  initOptimizeButton();
  initPasswordStrength();
  initPasswordToggle();
  initConfirmPassword();
  initHistoryFilter();
  initCopyButtons();
  initTaskSubmit();
  initUploadZone();
  initFormLoading();
  initFlashMessages();
  initSidebarActive();
  initNotificationBell();
  initAvatarDropdown();
  initSupportForm();
  initProfileForm();
  initPasswordForm();
  initRechargeForm();
  initRedemptionForm();
  initTermsToc();
  // chart bars (dashboard)
  setTimeout(animateBars, 300);
});
