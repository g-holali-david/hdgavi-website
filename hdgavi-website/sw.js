/**
 * HD GAVI Portfolio — Service Worker v6.2.1
 * Optimized cache strategies:
 * - Cache-first for versioned static assets (CSS/JS with ?ver=hash)
 * - Stale-while-revalidate for Google Fonts (long-lived, rarely change)
 * - Network-first for HTML pages (always fresh, cache fallback)
 * - Cache size limits to avoid storage bloat
 * - Offline fallback page when both network and cache fail
 */
var CACHE_STATIC  = 'hdgavi-static-v7.1';
var CACHE_FONTS   = 'hdgavi-fonts-v1';
var CACHE_PAGES   = 'hdgavi-pages-v7.1';
var CACHE_IMAGES  = 'hdgavi-images-v1';
var ALL_CACHES    = [CACHE_STATIC, CACHE_FONTS, CACHE_PAGES, CACHE_IMAGES];
var MAX_PAGES     = 30;
var MAX_IMAGES    = 60;
var OFFLINE_PAGE  = '/offline.html';

var STATIC_ASSETS = [
  '/',
  OFFLINE_PAGE,
  '/wp-content/themes/hdgavi-portfolio/style.min.css',
  '/wp-content/themes/hdgavi-portfolio/assets/js/theme.min.js',
];

// Install: pre-cache critical static assets
self.addEventListener('install', function (e) {
  e.waitUntil(
    caches.open(CACHE_STATIC).then(function (cache) {
      return cache.addAll(STATIC_ASSETS);
    }).then(function () {
      return self.skipWaiting();
    })
  );
});

// Activate: clean old caches
self.addEventListener('activate', function (e) {
  e.waitUntil(
    caches.keys().then(function (names) {
      return Promise.all(
        names.filter(function (n) { return ALL_CACHES.indexOf(n) === -1; })
             .map(function (n) { return caches.delete(n); })
      );
    })
  );
  self.clients.claim();
});

/**
 * Trim a cache to a maximum number of entries (batch delete)
 */
function trimCache(cacheName, maxItems) {
  caches.open(cacheName).then(function (cache) {
    cache.keys().then(function (keys) {
      if (keys.length > maxItems) {
        Promise.all(
          keys.slice(0, keys.length - maxItems).map(function (k) {
            return cache.delete(k);
          })
        );
      }
    });
  });
}

// Fetch handler with per-resource-type strategies
self.addEventListener('fetch', function (e) {
  var url = new URL(e.request.url);

  // Skip non-GET and cross-origin (except Google Fonts)
  if (e.request.method !== 'GET') return;
  var isGoogleFonts = url.hostname === 'fonts.googleapis.com' ||
                      url.hostname === 'fonts.gstatic.com';
  if (url.origin !== self.location.origin && !isGoogleFonts) return;

  // Skip admin, AJAX, and API requests
  if (url.pathname.indexOf('/wp-admin') !== -1 ||
      url.pathname.indexOf('/wp-json') !== -1 ||
      url.pathname.indexOf('admin-ajax') !== -1) return;

  // ── Google Fonts: stale-while-revalidate ──
  if (isGoogleFonts) {
    e.respondWith(
      caches.open(CACHE_FONTS).then(function (cache) {
        return cache.match(e.request).then(function (cached) {
          var fetchPromise = fetch(e.request).then(function (resp) {
            if (resp && resp.ok) {
              cache.put(e.request, resp.clone());
            }
            return resp;
          }).catch(function () {
            return cached || new Response('', { status: 408, statusText: 'Offline' });
          });
          return cached || fetchPromise;
        });
      })
    );
    return;
  }

  // ── Static assets (CSS, JS, woff2): cache-first ──
  if (/\.(css|js|woff2?|ttf)$/i.test(url.pathname) ||
      /\.(css|js)(\?ver=|$)/i.test(url.href)) {
    e.respondWith(
      caches.open(CACHE_STATIC).then(function (cache) {
        return cache.match(e.request).then(function (cached) {
          if (cached) return cached;
          return fetch(e.request).then(function (resp) {
            if (resp && resp.ok) {
              cache.put(e.request, resp.clone());
            }
            return resp;
          });
        });
      })
    );
    return;
  }

  // ── Images: cache-first with size limit ──
  if (/\.(png|jpg|jpeg|gif|svg|webp|avif|ico)$/i.test(url.pathname)) {
    e.respondWith(
      caches.open(CACHE_IMAGES).then(function (cache) {
        return cache.match(e.request).then(function (cached) {
          if (cached) return cached;
          return fetch(e.request).then(function (resp) {
            if (resp && resp.ok) {
              cache.put(e.request, resp.clone());
              trimCache(CACHE_IMAGES, MAX_IMAGES);
            }
            return resp;
          });
        });
      })
    );
    return;
  }

  // ── Pages (HTML): network-first with cache fallback + offline page ──
  if (e.request.headers.get('Accept') &&
      e.request.headers.get('Accept').indexOf('text/html') !== -1) {
    e.respondWith(
      fetch(e.request).then(function (resp) {
        if (resp && resp.ok) {
          var clone = resp.clone();
          caches.open(CACHE_PAGES).then(function (cache) {
            cache.put(e.request, clone);
            trimCache(CACHE_PAGES, MAX_PAGES);
          });
        }
        return resp;
      }).catch(function () {
        return caches.match(e.request).then(function (cached) {
          return cached || caches.match(OFFLINE_PAGE);
        });
      })
    );
    return;
  }

  // ── Everything else: network with cache fallback ──
  e.respondWith(
    fetch(e.request).catch(function () {
      return caches.match(e.request);
    })
  );
});
