/* ============================================================
   REALTYMOGUL – pages.js
   Supplemental JS for all authenticated pages
   ============================================================ */

'use strict';

/* ── TOAST ─────────────────────────────────────────────────── */
function showToast(msg, type = 'success', duration = 4000) {
    const icons = { success: '✅', error: '❌', info: 'ℹ️', warning: '⚠️' };
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span class="toast-icon">${icons[type] || 'ℹ️'}</span><span>${msg}</span>`;
    container.appendChild(toast);
    toast.addEventListener('click', () => toast.remove());
    setTimeout(() => {
        toast.style.animation = 'none';
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

/* ── FAQ ACCORDION ─────────────────────────────────────────── */
function initFAQ() {
    document.querySelectorAll('.faq-q').forEach(function(q) {
        q.addEventListener('click', function() {
            const item = this.closest('.faq-item');
            const isOpen = item.classList.contains('open');
            // close all
            document.querySelectorAll('.faq-item.open').forEach(function(el) {
                el.classList.remove('open');
            });
            if (!isOpen) item.classList.add('open');
        });
    });
}

/* ── FAQ CATEGORY FILTER ───────────────────────────────────── */
function initFAQFilter() {
    document.querySelectorAll('.faq-cat-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.faq-cat-tab').forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            const cat = this.dataset.cat;
            document.querySelectorAll('.faq-item').forEach(function(item) {
                if (cat === 'all' || item.dataset.cat === cat) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
}

/* ── PAYMENT METHOD SELECTION ──────────────────────────────── */
function initPaymentMethods() {
    document.querySelectorAll('.pay-method').forEach(function(method) {
        method.addEventListener('click', function() {
            const group = this.closest('.payment-methods');
            group.querySelectorAll('.pay-method').forEach(function(m) { m.classList.remove('selected'); });
            this.classList.add('selected');
            const val = this.dataset.method;
            const hiddenInput = document.getElementById('selectedMethod');
            if (hiddenInput) hiddenInput.value = val;
            // Show/hide account detail fields
            document.querySelectorAll('.method-detail').forEach(function(d) { d.classList.remove('visible'); });
            const detail = document.getElementById('detail-' + val);
            if (detail) detail.classList.add('visible');
        });
    });
}

/* ── AMOUNT PRESET SELECTION ───────────────────────────────── */
function initAmountPresets() {
    document.querySelectorAll('.amount-preset').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const group = this.closest('.amount-presets');
            group.querySelectorAll('.amount-preset').forEach(function(b) { b.classList.remove('selected'); });
            this.classList.add('selected');
            const amountInput = document.getElementById('amountInput') ||
                                this.closest('form')?.querySelector('.amount-input');
            if (amountInput) {
                amountInput.value = this.dataset.amount;
                amountInput.dispatchEvent(new Event('input'));
            }
        });
    });
}

/* ── OPTIMIZE BUTTON ───────────────────────────────────────── */
function initOptimize() {
    const btn = document.getElementById('optimizeBtn');
    if (!btn) return;
    btn.addEventListener('click', function() {
        if (this.classList.contains('running')) return;
        this.classList.add('running');
        this.textContent = '⚙️ Optimizing...';
        this.disabled = true;
        setTimeout(() => {
            this.classList.remove('running');
            this.textContent = '✅ Optimized!';
            showToast('Data optimization complete! Your tasks have been refreshed.', 'success');
            setTimeout(() => {
                this.textContent = '⚡ Start Optimization';
                this.disabled = false;
            }, 2500);
        }, 3000);
    });
}

/* ── PASSWORD STRENGTH METER ───────────────────────────────── */
function initPasswordStrength() {
    const input = document.getElementById('newPasswordInput');
    if (!input) return;
    const bars  = document.querySelectorAll('.pwd-bar');
    const label = document.querySelector('.pwd-strength-label');
    const reqs  = {
        length:  document.getElementById('req-length'),
        upper:   document.getElementById('req-upper'),
        number:  document.getElementById('req-number'),
        special: document.getElementById('req-special'),
    };

    input.addEventListener('input', function() {
        const val = this.value;
        let score = 0;
        const hasLen     = val.length >= 8;
        const hasUpper   = /[A-Z]/.test(val);
        const hasNumber  = /[0-9]/.test(val);
        const hasSpecial = /[^A-Za-z0-9]/.test(val);
        if (hasLen)     score++;
        if (hasUpper)   score++;
        if (hasNumber)  score++;
        if (hasSpecial) score++;

        // Update req items
        if (reqs.length)  reqs.length.classList.toggle('met', hasLen);
        if (reqs.upper)   reqs.upper.classList.toggle('met', hasUpper);
        if (reqs.number)  reqs.number.classList.toggle('met', hasNumber);
        if (reqs.special) reqs.special.classList.toggle('met', hasSpecial);
        if (reqs.length)  reqs.length.querySelector('.pwd-req-dot').textContent = hasLen ? '✓' : '';
        if (reqs.upper)   reqs.upper.querySelector('.pwd-req-dot').textContent = hasUpper ? '✓' : '';
        if (reqs.number)  reqs.number.querySelector('.pwd-req-dot').textContent = hasNumber ? '✓' : '';
        if (reqs.special) reqs.special.querySelector('.pwd-req-dot').textContent = hasSpecial ? '✓' : '';

        const levels = ['', 'weak', 'medium', 'strong', 'v-strong'];
        const labels = ['', 'Weak', 'Medium', 'Strong', 'Very Strong'];
        bars.forEach(function(bar, i) {
            bar.className = 'pwd-bar';
            if (i < score) bar.classList.add(levels[score]);
        });
        if (label) {
            label.textContent = labels[score] || '';
            label.style.color = ['', 'var(--danger)', 'var(--warning)', 'var(--success)', 'var(--accent)'][score] || '';
        }
    });
}

/* ── PASSWORD SHOW/HIDE ────────────────────────────────────── */
function initPasswordToggles() {
    document.querySelectorAll('.eye-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const wrap  = this.closest('.auth-input-wrap') || this.closest('.form-group');
            const input = wrap ? wrap.querySelector('input') : null;
            if (!input) return;
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            this.textContent = isText ? '👁️' : '🙈';
        });
    });
}

/* ── CONFIRM PASSWORD MATCH ────────────────────────────────── */
function initConfirmPassword() {
    const confirmInput = document.getElementById('confirmPassword');
    const newInput = document.getElementById('newPasswordInput') ||
                     document.getElementById('passwordInput');
    if (!confirmInput || !newInput) return;
    confirmInput.addEventListener('input', function() {
        const match = this.value === newInput.value;
        this.style.borderColor = this.value ? (match ? 'var(--success)' : 'var(--danger)') : '';
    });
}

/* ── TASK SUBMIT BUTTONS ───────────────────────────────────── */
function initTaskSubmit() {
    document.querySelectorAll('.btn-submit-task').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.disabled) return;
            const form = this.closest('form');
            if (!form) return;
            const card   = this.closest('.task-detail-card');
            const commEl = card ? card.querySelector('.task-meta-value.comm') : null;
            const comm   = commEl ? commEl.textContent : '';
            this.disabled = true;
            const origText = this.textContent;
            this.textContent = '⏳ Submitting...';
            // Submit the form after showing the UI feedback
            setTimeout(() => {
                form.submit();
            }, 500);
        });
    });
}

/* ── HISTORY FILTER TABS ───────────────────────────────────── */
function initHistoryTabs() {
    document.querySelectorAll('.history-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.history-tab').forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            const filter = this.dataset.status;
            const rows = document.querySelectorAll('table tbody tr[data-status]');
            rows.forEach(function(row) {
                row.style.display = (filter === 'all' || row.dataset.status === filter) ? '' : 'none';
            });
        });
    });
}

/* ── PILL TABS (tasks page) ────────────────────────────────── */
function initPillTabs() {
    document.querySelectorAll('.pill-tab[data-filter]').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.pill-tab[data-filter]').forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.task-detail-card').forEach(function(card) {
                card.style.display = (filter === 'all' || card.dataset.type === filter) ? '' : 'none';
            });
        });
    });
}

/* ── COPY BUTTONS ──────────────────────────────────────────── */
function initCopyButtons() {
    document.querySelectorAll('[data-copy]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const text = this.dataset.copy;
            navigator.clipboard.writeText(text).then(() => {
                const orig = this.textContent;
                this.textContent = '✅ Copied!';
                setTimeout(() => { this.textContent = orig; }, 2000);
            }).catch(() => {
                showToast('Could not copy. Please copy manually.', 'error');
            });
        });
    });
}

/* ── DRAG & DROP UPLOAD ────────────────────────────────────── */
function initUploadZone() {
    document.querySelectorAll('.upload-zone').forEach(function(zone) {
        zone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        zone.addEventListener('dragleave', function() {
            this.classList.remove('dragover');
        });
        zone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                const preview = this.querySelector('.upload-preview');
                if (preview) preview.textContent = '📎 ' + file.name;
                const fileInput = this.querySelector('input[type="file"]');
                if (fileInput) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput.files = dt.files;
                }
            }
        });
        const fileInput = zone.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const preview = zone.querySelector('.upload-preview');
                    if (preview) preview.textContent = '📎 ' + file.name;
                }
            });
        }
    });
}

/* ── WITHDRAWAL FEE CALCULATOR ─────────────────────────────── */
function initFeeCalculator() {
    const input = document.getElementById('withdrawalAmount');
    if (!input) return;
    input.addEventListener('input', function() {
        const amount  = parseFloat(this.value) || 0;
        const feeRate = 0.02;
        const fee     = amount * feeRate;
        const net     = amount - fee;
        const box     = document.querySelector('.fee-breakdown');
        if (!box) return;
        if (amount > 0) {
            box.classList.add('visible');
            const vals = box.querySelectorAll('.fee-val');
            if (vals[0]) vals[0].textContent = '$' + amount.toFixed(2);
            if (vals[1]) vals[1].textContent = '$' + fee.toFixed(2) + ' (2%)';
            if (vals[2]) vals[2].textContent = '$' + net.toFixed(2);
        } else {
            box.classList.remove('visible');
        }
    });
}

/* ── BAR CHART ANIMATION ───────────────────────────────────── */
function initBarChart() {
    const bars = document.querySelectorAll('.bar[data-height]');
    if (!bars.length) return;
    setTimeout(function() {
        bars.forEach(function(bar) {
            bar.style.height = bar.dataset.height + '%';
        });
    }, 120);
}

/* ── FORM LOADING STATE ────────────────────────────────────── */
function initFormLoading() {
    document.querySelectorAll('form[data-loading]').forEach(function(form) {
        form.addEventListener('submit', function() {
            const btn = this.querySelector('[type="submit"]');
            if (!btn) return;
            btn.disabled = true;
            const origText = btn.textContent;
            btn.innerHTML = '<span class="btn-spinner"></span> Processing...';
            // Restore after 8s as safety net
            setTimeout(function() {
                btn.disabled = false;
                btn.textContent = origText;
            }, 8000);
        });
    });
}

/* ── INIT ALL ──────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function() {
    initFAQ();
    initFAQFilter();
    initPaymentMethods();
    initAmountPresets();
    initOptimize();
    initPasswordStrength();
    initPasswordToggles();
    initConfirmPassword();
    initTaskSubmit();
    initHistoryTabs();
    initPillTabs();
    initCopyButtons();
    initUploadZone();
    initFeeCalculator();
    initBarChart();
    initFormLoading();
});
