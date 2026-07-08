/* ═══════════════════════════════════════════════════════════════════
   THE OUTNET — User Panel JS
   • Mobile drawer toggle
   • Account dropdown toggle
   • Scroll-triggered header shadow
   • Button ripple effect
   • Auto-dismiss non-error alerts after 6 s
   • Active nav-link highlighting
   ═══════════════════════════════════════════════════════════════════ */

(function () {
  'use strict';

  var header     = document.getElementById('on-header');
  var menuToggle = document.getElementById('on-menu-toggle');
  var drawer     = document.getElementById('on-drawer');
  var drawerClose = document.getElementById('on-drawer-close');
  var overlay    = document.getElementById('on-overlay');
  var avatarBtn  = document.getElementById('on-avatar-btn');
  var accountDd  = document.getElementById('on-account-dropdown');

  /* ─── Overlay ────────────────────────────────────────────────── */
  function showOverlay() {
    if (overlay) overlay.classList.add('visible');
  }
  function hideOverlay() {
    if (overlay) overlay.classList.remove('visible');
  }

  /* ─── Mobile drawer ──────────────────────────────────────────── */
  function openDrawer() {
    if (!drawer) return;
    drawer.classList.add('open');
    drawer.setAttribute('aria-hidden', 'false');
    if (menuToggle) {
      menuToggle.classList.add('open');
      menuToggle.setAttribute('aria-expanded', 'true');
    }
    showOverlay();
  }

  function closeDrawer() {
    if (!drawer) return;
    drawer.classList.remove('open');
    drawer.setAttribute('aria-hidden', 'true');
    if (menuToggle) {
      menuToggle.classList.remove('open');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  }

  /* ─── Account dropdown ───────────────────────────────────────── */
  function openAccountDd() {
    if (!accountDd) return;
    accountDd.classList.add('open');
    accountDd.setAttribute('aria-hidden', 'false');
    if (avatarBtn) avatarBtn.setAttribute('aria-expanded', 'true');
    showOverlay();
  }

  function closeAccountDd() {
    if (!accountDd) return;
    accountDd.classList.remove('open');
    accountDd.setAttribute('aria-hidden', 'true');
    if (avatarBtn) avatarBtn.setAttribute('aria-expanded', 'false');
  }

  /* ─── Event listeners ────────────────────────────────────────── */
  if (menuToggle) {
    menuToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      if (drawer && drawer.classList.contains('open')) {
        closeDrawer();
        hideOverlay();
      } else {
        openDrawer();
      }
    });
  }

  if (drawerClose) {
    drawerClose.addEventListener('click', function (e) {
      e.stopPropagation();
      closeDrawer();
      hideOverlay();
    });
  }

  if (avatarBtn) {
    avatarBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      if (accountDd && accountDd.classList.contains('open')) {
        closeAccountDd();
        hideOverlay();
      } else {
        openAccountDd();
      }
    });
  }

  /* Close drawer when clicking outside */
  document.addEventListener('click', function (e) {
    if (!drawer || !drawer.classList.contains('open')) return;
    if (drawer.contains(e.target)) return;
    closeDrawer();
    hideOverlay();
  });

  /* Close drawer after clicking a link inside it */
  var drawerLinks = document.querySelectorAll('.on-drawer-nav a');
  drawerLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      closeDrawer();
      hideOverlay();
    });
  });

  /* Close account dropdown when clicking outside */
  document.addEventListener('click', function (e) {
    if (!accountDd || !accountDd.classList.contains('open')) return;
    var accountEl = document.getElementById('on-account');
    if (accountEl && !accountEl.contains(e.target)) {
      closeAccountDd();
      hideOverlay();
    }
  });

  /* Close drawer on ESC */
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    if (drawer && drawer.classList.contains('open')) { closeDrawer(); hideOverlay(); }
    if (accountDd && accountDd.classList.contains('open')) { closeAccountDd(); hideOverlay(); }
  });

  /* Close account dropdown after clicking a link inside it */
  var accountLinks = document.querySelectorAll('.on-account-dropdown a');
  accountLinks.forEach(function (link) {
    link.addEventListener('click', function () {
      closeAccountDd();
      hideOverlay();
    });
  });

  /* ─── Preloader dismiss ─────────────────────────────────────── */
  function dismissPreloader() {
    var preloader = document.getElementById('preloader');
    if (!preloader) return;
    preloader.classList.add('hidden');
    setTimeout(function () { preloader.style.display = 'none'; }, 420);
  }
  if (document.readyState === 'complete') {
    dismissPreloader();
  } else {
    window.addEventListener('load', dismissPreloader);
  }

  /* ─── Header scroll shadow ───────────────────────────────────── */
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', (window.scrollY || window.pageYOffset) > 8);
    }, { passive: true });
  }

  /* ─── Button ripple ──────────────────────────────────────────── */
  document.addEventListener('click', function (e) {
    var btn = e.target.closest('.btn-dark, .btn-outline-dark');
    if (!btn || btn.disabled) return;

    var rect = btn.getBoundingClientRect();
    var size = Math.max(rect.width, rect.height) * 1.6;
    var x    = e.clientX - rect.left - size / 2;
    var y    = e.clientY - rect.top  - size / 2;

    var ripple = document.createElement('span');
    ripple.style.cssText = [
      'position:absolute',
      'pointer-events:none',
      'border-radius:50%',
      'background:rgba(255,255,255,0.22)',
      'width:'  + size + 'px',
      'height:' + size + 'px',
      'left:'   + x    + 'px',
      'top:'    + y    + 'px',
      'transform:scale(0)',
      'animation:onRipple 0.5s ease-out forwards'
    ].join(';');

    btn.appendChild(ripple);
    setTimeout(function () {
      if (ripple.parentNode) ripple.parentNode.removeChild(ripple);
    }, 550);
  });

  /* ─── Auto-dismiss non-danger alerts ─────────────────────────── */
  document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.alert:not(.alert-danger)').forEach(function (el) {
      setTimeout(function () {
        el.style.transition = 'opacity 0.4s ease, max-height 0.4s ease, padding 0.4s ease, margin 0.4s ease';
        el.style.opacity    = '0';
        setTimeout(function () {
          el.style.maxHeight     = '0';
          el.style.paddingTop    = '0';
          el.style.paddingBottom = '0';
          el.style.marginBottom  = '0';
          setTimeout(function () {
            if (el.parentNode) el.parentNode.removeChild(el);
          }, 420);
        }, 400);
      }, 6000);
    });

    /* Mark active nav links based on current path */
    var path = window.location.pathname;
    document.querySelectorAll(
      '.on-nav-list a, .on-drawer-nav a'
    ).forEach(function (a) {
      try {
        var href = new URL(a.href).pathname;
        if (href === path) a.classList.add('on-active');
      } catch (err) {
        /* skip non-parseable hrefs */
      }
    });

  });

})();
