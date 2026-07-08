/* Estatein Dark — lightweight front-end interactions (no dependencies). */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {

    /* Mobile navigation toggle */
    var toggle = document.getElementById('nav-toggle');
    var nav = document.getElementById('primary-nav');
    if (toggle && nav) {
      toggle.addEventListener('click', function () {
        var open = nav.classList.toggle('is-open');
        document.body.classList.toggle('nav-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
      // Close when a link is tapped or when tapping the dimmed backdrop.
      nav.addEventListener('click', function (e) {
        if (e.target.tagName === 'A') {
          nav.classList.remove('is-open');
          document.body.classList.remove('nav-open');
          toggle.setAttribute('aria-expanded', 'false');
        }
      });
    }

    /* Dismissible announcement bar (remembers choice for the session) */
    var announce = document.getElementById('announce');
    var announceClose = document.getElementById('announce-close');
    if (announce && sessionStorage.getItem('estatein_announce') === 'closed') {
      announce.classList.add('is-hidden');
    }
    if (announceClose && announce) {
      announceClose.addEventListener('click', function () {
        announce.classList.add('is-hidden');
        try { sessionStorage.setItem('estatein_announce', 'closed'); } catch (e) {}
      });
    }

    /* Tab groups (e.g. Contact office locations) */
    document.querySelectorAll('[data-tabs]').forEach(function (group) {
      var buttons = group.querySelectorAll('.tabs button');
      var panels = group.querySelectorAll('[data-tab-panel]');
      buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
          buttons.forEach(function (b) { b.classList.remove('is-active'); });
          btn.classList.add('is-active');
          var target = btn.getAttribute('data-tab');
          panels.forEach(function (p) {
            p.hidden = (target !== 'all' && p.getAttribute('data-tab-panel') !== target);
          });
        });
      });
    });

  });
})();
