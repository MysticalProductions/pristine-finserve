/* ========================================================================
   PRISTINE FINSERVE - Main JavaScript
   All interactive features, animations, and utilities
   ======================================================================== */

(function() {
  'use strict';

  // ======================================================================
  // DOM Ready
  // ======================================================================
  document.addEventListener('DOMContentLoaded', function() {

    initMobileNav();
    initNavbarScroll();
    initBackToTop();
    initCounters();
    initFaqToggles();
    initSmoothScroll();
    initScrollAnimations();
    initDropdownTouch();

  });

  // ======================================================================
  // 1. Mobile Navigation Toggle
  // ======================================================================
  function initMobileNav() {
    const toggle = document.getElementById('navToggle');
    const menu = document.getElementById('navMenu');

    if (!toggle || !menu) return;

    toggle.addEventListener('click', function() {
      this.classList.toggle('active');
      menu.classList.toggle('open');
      document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : '';
    });

    // Close menu on real link click (mobile) - skip dropdown parents (href="#")
    menu.querySelectorAll('.nav-link, .nav-dropdown-link').forEach(function(link) {
      link.addEventListener('click', function() {
        if (window.innerWidth <= 992 && this.getAttribute('href') !== '#') {
          toggle.classList.remove('active');
          menu.classList.remove('open');
          document.body.style.overflow = '';
        }
      });
    });

    // Close menu on outside click
    document.addEventListener('click', function(e) {
      if (window.innerWidth <= 992 && menu.classList.contains('open')) {
        if (!e.target.closest('.navbar')) {
          toggle.classList.remove('active');
          menu.classList.remove('open');
          document.body.style.overflow = '';
        }
      }
    });
  }

  // ======================================================================
  // 2. Navbar Scroll Effect
  // ======================================================================
  function initNavbarScroll() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    }, { passive: true });
  }

  // ======================================================================
  // 3. Back to Top Button
  // ======================================================================
  function initBackToTop() {
    const btn = document.getElementById('backToTop');
    if (!btn) return;

    window.addEventListener('scroll', function() {
      if (window.scrollY > 400) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    }, { passive: true });

    btn.addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ======================================================================
  // 4. Animated Counters
  // ======================================================================
  function initCounters() {
    var counters = document.querySelectorAll('.counter');
    if (!counters.length) return;

    var countersAnimated = false;

    function animateCounters() {
      if (countersAnimated) return;
      
      var scrollY = window.scrollY;
      var triggerPoint = window.innerHeight * 0.85;

      counters.forEach(function(counter) {
        var rect = counter.getBoundingClientRect();
        var offset = rect.top + window.scrollY;

        if (scrollY + triggerPoint > offset) {
          countersAnimated = true;
          var target = parseInt(counter.getAttribute('data-target')) || 0;
          var duration = 2000;
          var startTime = null;

          function easeOutQuad(t) {
            return t * (2 - t);
          }

          function updateCount(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var easedProgress = easeOutQuad(progress);
            var current = Math.round(easedProgress * target);
            counter.textContent = current.toLocaleString('en-IN');
            if (progress < 1) {
              requestAnimationFrame(updateCount);
            } else {
              counter.textContent = target.toLocaleString('en-IN');
            }
          }

          requestAnimationFrame(updateCount);
        }
      });
    }

    // Check on scroll
    window.addEventListener('scroll', animateCounters, { passive: true });
    // Check on load
    animateCounters();
    // Also check after AOS animations
    setTimeout(animateCounters, 1500);
  }

  // ======================================================================
  // 5. FAQ Accordion Toggle
  // ======================================================================
  function initFaqToggles() {
    // Make toggleFaq globally accessible for inline onclick usage
    window.toggleFaq = function(element) {
      var parent = element.closest('.faq-item');
      if (!parent) return;

      var isActive = parent.classList.contains('active');

      // Close all FAQs in the same container
      var container = parent.closest('[data-aos]') || parent.parentElement;
      if (container) {
        container.querySelectorAll('.faq-item.active').forEach(function(item) {
          if (item !== parent) {
            item.classList.remove('active');
          }
        });
      }

      // Toggle current
      parent.classList.toggle('active');
    };
  }

  // ======================================================================
  // 6. Smooth Scroll for Anchor Links
  // ======================================================================
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
      anchor.addEventListener('click', function(e) {
        var targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        var target = document.querySelector(targetId);
        if (target) {
          e.preventDefault();
          var navbarHeight = 80;
          var targetPosition = target.getBoundingClientRect().top + window.scrollY - navbarHeight;
          window.scrollTo({ top: targetPosition, behavior: 'smooth' });
        }
      });
    });
  }

  // ======================================================================
  // 7. Scroll Animation Helper (for animated elements not using AOS)
  // ======================================================================
  function initScrollAnimations() {
    // AOS is initialized in each page's inline script
    // This provides fallback animation support
    var animatedElements = document.querySelectorAll('.animate-on-scroll');
    if (!animatedElements.length) return;

    var observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('animated');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    animatedElements.forEach(function(el) {
      observer.observe(el);
    });
  }

  // ======================================================================
  // 8. Touch Support for Dropdowns on Desktop (touch laptops)
  // ======================================================================
  function initDropdownTouch() {
    document.querySelectorAll('.nav-dropdown > .nav-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
        var parent = this.closest('.nav-dropdown');
        if (!parent) return;

        var menu = parent.querySelector('.nav-dropdown-menu');
        if (!menu) return;

        var isOpen = menu.classList.contains('open');

        // Close all dropdowns first
        document.querySelectorAll('.nav-dropdown').forEach(function(d) {
          d.classList.remove('open');
          var m = d.querySelector('.nav-dropdown-menu');
          if (m) m.classList.remove('open', 'open-upward');
        });

        if (!isOpen) {
          e.preventDefault();

          // Check if dropdown extends below viewport
          var parentRect = parent.getBoundingClientRect();
          var menuHeight = menu.offsetHeight;
          var spaceBelow = window.innerHeight - parentRect.bottom;

          if (spaceBelow < menuHeight) {
            menu.classList.add('open-upward');
          }

          menu.classList.add('open');
          parent.classList.add('open');
        }
      });
    });

    // Close dropdowns on outside click
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.nav-dropdown')) {
        document.querySelectorAll('.nav-dropdown').forEach(function(d) {
          d.classList.remove('open');
          var m = d.querySelector('.nav-dropdown-menu');
          if (m) m.classList.remove('open', 'open-upward');
        });
      }
    });
  }

  // ======================================================================
  // 9. Global Form Submit Handler
  // ======================================================================
  window.handleFormSubmit = function(event, form) {
    event.preventDefault();

    // Get submit button
    var btn = form.querySelector('[type="submit"]');
    if (btn) {
      btn.disabled = true;
      // Store original button text
      if (!btn.getAttribute('data-original-text')) {
        btn.setAttribute('data-original-text', btn.innerHTML);
      }
      btn.innerHTML = '<span class="loading-spinner" style="width:20px;height:20px;margin:0;"></span> Processing...';
    }

    // Collect form data
    var formData = new FormData(form);

    // Determine action URL (from form action or data attribute)
    var actionUrl = form.getAttribute('action') || '';
    var method = form.getAttribute('method') || 'POST';

    // Send data via fetch
    fetch(actionUrl || window.location.href, {
      method: method.toUpperCase(),
      body: formData,
      headers: actionUrl ? {} : {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(function(response) {
      return response.json().catch(function() {
        return { success: false, message: 'Unexpected server response.' };
      });
    })
    .then(function(data) {
      if (data.success) {
        showToast(data.message || 'Thank you! Your submission has been received.', 'success');
        form.reset();
      } else {
        showToast(data.message || 'Submission failed. Please try again.', 'error');
      }
    })
    .catch(function() {
      showToast('Network error. Please check your connection and try again.', 'error');
    })
    .finally(function() {
      // Re-enable button
      if (btn) {
        btn.disabled = false;
        btn.innerHTML = btn.getAttribute('data-original-text') || 'Submit';
      }
    });
  };

  // ======================================================================
  // 10. Toast Notification System
  // ======================================================================
  function showToast(message, type) {
    type = type || 'info';

    // Create toast container if it doesn't exist
    var container = document.querySelector('.toast-container');
    if (!container) {
      container = document.createElement('div');
      container.className = 'toast-container';
      document.body.appendChild(container);
    }

    // Create toast element
    var toast = document.createElement('div');
    toast.className = 'toast ' + type;

    var iconMap = {
      success: 'bi-check-circle-fill',
      error: 'bi-x-circle-fill',
      warning: 'bi-exclamation-circle-fill',
      info: 'bi-info-circle-fill'
    };
    var icon = iconMap[type] || iconMap.info;

    toast.innerHTML = '<i class="bi ' + icon + '" style="font-size:1.25rem;"></i> ' + message;

    container.appendChild(toast);

    // Auto remove after 5 seconds
    setTimeout(function() {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100px)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(function() {
        if (toast.parentElement) {
          toast.remove();
        }
      }, 300);
    }, 5000);
  }

  // Make showToast globally available
  window.showToast = showToast;

  // ======================================================================
  // 11. Calculator Helpers (EMI calculation)
  // ======================================================================
  window.calculateEMI = function(P, R, N) {
    var r = R / (12 * 100);
    var n = N * 12;
    if (r === 0) return P / n;
    return P * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
  };

  window.formatCurrency = function(num) {
    return '₹' + Number(num).toLocaleString('en-IN');
  };

  // ======================================================================
  // 12. Window Load - Additional Initializations
  // ======================================================================
  window.addEventListener('load', function() {
    // Refresh AOS after all content loaded
    if (typeof AOS !== 'undefined') {
      AOS.refresh();
    }

    // Re-check counters after images load
    setTimeout(function() {
      var event = new Event('scroll');
      window.dispatchEvent(event);
    }, 1000);
  });

})();
