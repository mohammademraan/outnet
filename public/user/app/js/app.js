// TaskHive Theme JS

// ─── SIDEBAR TOGGLE ───
const sidebar = document.querySelector('.sidebar');
const overlay = document.querySelector('.sidebar-overlay');
const hamburger = document.querySelector('.hamburger');

function openSidebar() {
  sidebar?.classList.add('open');
  overlay?.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeSidebar() {
  sidebar?.classList.remove('open');
  overlay?.classList.remove('open');
  document.body.style.overflow = '';
}
hamburger?.addEventListener('click', openSidebar);
overlay?.addEventListener('click', closeSidebar);

// ─── NAV ITEMS (SPA-like page switching) ───
const navItems = document.querySelectorAll('.nav-item[data-page]');
const pageSections = document.querySelectorAll('.page-section');
const pageTitle = document.querySelector('.page-title');

navItems.forEach(item => {
  item.addEventListener('click', () => {
    navItems.forEach(n => n.classList.remove('active'));
    item.classList.add('active');
    const target = item.dataset.page;
    pageSections.forEach(s => {
      s.classList.toggle('active', s.id === target);
    });
    if (pageTitle) pageTitle.textContent = item.querySelector('.nav-label')?.textContent || '';
    if (window.innerWidth < 768) closeSidebar();
    // Animate chart bars when earnings page shown
    if (target === 'earnings') animateBars();
  });
});

// ─── PILL TABS ───
document.querySelectorAll('.pill-tabs').forEach(tabGroup => {
  tabGroup.querySelectorAll('.pill-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      tabGroup.querySelectorAll('.pill-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const target = tab.dataset.tab;
      const container = tab.closest('.card') || document;
      container.querySelectorAll('.tab-content').forEach(c => {
        c.style.display = (c.dataset.tabContent === target) ? 'block' : 'none';
      });
    });
  });
});

// ─── CHART BARS ANIMATION ───
function animateBars() {
  const bars = document.querySelectorAll('.bar');
  bars.forEach((bar, i) => {
    const h = bar.dataset.height || '50';
    bar.style.height = '0';
    setTimeout(() => { bar.style.height = h + '%'; }, i * 60);
  });
}

// ─── COPY REFERRAL LINK ───
document.querySelectorAll('.copy-ref').forEach(btn => {
  btn.addEventListener('click', () => {
    const text = btn.closest('.ref-link')?.querySelector('span')?.textContent || '';
    navigator.clipboard.writeText(text).then(() => {
      const orig = btn.textContent;
      btn.textContent = '✅';
      setTimeout(() => btn.textContent = orig, 1500);
    });
  });
});

// ─── TOAST NOTIFICATION ───
function showToast(msg, type = 'success') {
  const t = document.createElement('div');
  t.style.cssText = `
    position:fixed;bottom:24px;right:24px;z-index:9999;
    background:${type === 'success' ? 'var(--success)' : type === 'error' ? 'var(--danger)' : 'var(--primary)'};
    color:#fff;padding:12px 20px;border-radius:10px;font-size:13px;font-weight:600;
    box-shadow:0 8px 24px rgba(0,0,0,0.3);transform:translateY(80px);opacity:0;
    transition:all .3s cubic-bezier(.4,0,.2,1);font-family:'Sora',sans-serif;
    display:flex;align-items:center;gap:8px;max-width:320px;
  `;
  t.innerHTML = (type === 'success' ? '✅ ' : type === 'error' ? '❌ ' : 'ℹ️ ') + msg;
  document.body.appendChild(t);
  requestAnimationFrame(() => { t.style.transform = 'translateY(0)'; t.style.opacity = '1'; });
  setTimeout(() => {
    t.style.transform = 'translateY(80px)'; t.style.opacity = '0';
    setTimeout(() => t.remove(), 300);
  }, 3200);
}

// ─── WITHDRAW FORM SUBMIT ───
document.querySelector('#withdrawForm')?.addEventListener('submit', e => {
  e.preventDefault();
  showToast('Withdrawal request submitted!');
});

// ─── DEPOSIT FORM SUBMIT ───
document.querySelector('#depositForm')?.addEventListener('submit', e => {
  e.preventDefault();
  showToast('Deposit initiated successfully!');
});

// ─── TASK COMPLETE BUTTON ───
document.querySelectorAll('.complete-task-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const taskItem = btn.closest('.task-item-detail');
    const price = taskItem?.dataset.price || '0';
    const comm = taskItem?.dataset.comm || '0';
    showToast(`Task completed! You earned $${comm} commission.`);
    btn.textContent = '✅ Completed';
    btn.disabled = true;
    btn.style.opacity = '0.6';
  });
});

// ─── ON LOAD ───
document.addEventListener('DOMContentLoaded', () => {
  // Show first page-section by default
  const firstSection = document.querySelector('.page-section');
  firstSection?.classList.add('active');
  // Animate dashboard chart bars on load
  setTimeout(animateBars, 300);
});
