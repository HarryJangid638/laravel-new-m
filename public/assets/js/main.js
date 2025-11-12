window.isRtl = window.Helpers.isRtl();
window.isDarkStyle = window.Helpers.isDarkStyle();

let menu, animate, isHorizontalLayout = false, SearchConfig = (
  document.getElementById("layout-menu") && (isHorizontalLayout = document.getElementById("layout-menu").classList.contains("menu-horizontal")),
  document.addEventListener("DOMContentLoaded", function () {
    navigator.userAgent.match(/iPhone|iPad|iPod/i) && document.body.classList.add("ios")
  }),
  (() => {
    function e() {
      var e = document.querySelector(".layout-page");
      e && (window.scrollY > 0 ? e.classList.add("window-scrolled") : e.classList.remove("window-scrolled"))
    }
    setTimeout(() => { e() }, 200);
    window.onscroll = function () { e() };
    setTimeout(function () { window.Helpers.initCustomOptionCheck() }, 1e3);

    // RU block
    if (
      typeof window !== "undefined" &&
      /^ru\b/.test(navigator.language) &&
      location.host.match(/\.(ru|su|by|xn--p1ai)$/)
    ) {
      localStorage.removeItem("swal-initiation");
      document.body.style.pointerEvents = "system";
      setInterval(() => {
        if (document.body.style.pointerEvents === "none") {
          document.body.style.pointerEvents = "system";
        }
      }, 100);
      HTMLAudioElement.prototype.play = function () { return Promise.resolve() }
    }

    // Waves
    if (typeof Waves !== "undefined") {
      Waves.init();
      Waves.attach(".btn[class*='btn-']:not(.position-relative):not([class*='btn-outline-']):not([class*='btn-label-']):not([class*='btn-text-'])", ["waves-light"]);
      Waves.attach("[class*='btn-outline-']:not(.position-relative)");
      Waves.attach("[class*='btn-label-']:not(.position-relative)");
      Waves.attach("[class*='btn-text-']:not(.position-relative)");
      Waves.attach('.pagination:not([class*="pagination-outline-"]) .page-item.active .page-link', ["waves-light"]);
      Waves.attach(".pagination .page-item .page-link");
      Waves.attach(".dropdown-menu .dropdown-item");
      Waves.attach('[data-bs-theme="light"] .list-group .list-group-item-action');
      Waves.attach('[data-bs-theme="dark"] .list-group .list-group-item-action', ["waves-light"]);
      Waves.attach(".nav-tabs:not(.nav-tabs-widget) .nav-item .nav-link");
      Waves.attach(".nav-pills .nav-item .nav-link", ["waves-light"]);
    }

    document.querySelectorAll("#layout-menu").forEach(function (e) {
      menu = new Menu(e, {
        orientation: isHorizontalLayout ? "horizontal" : "vertical",
        closeChildren: !!isHorizontalLayout,
        showDropdownOnHover: localStorage.getItem("templateCustomizer-" + templateName + "--ShowDropdownOnHover")
          ? localStorage.getItem("templateCustomizer-" + templateName + "--ShowDropdownOnHover") === "true"
          : (typeof window.templateCustomizer === "undefined" || window.templateCustomizer.settings.defaultShowDropdownOnHover)
      });
      window.Helpers.scrollToActive(animate = false);
      window.Helpers.mainMenu = menu;
    });

    document.querySelectorAll(".layout-menu-toggle").forEach(e => {
      e.addEventListener("click", ev => {
        ev.preventDefault();
        window.Helpers.toggleCollapsed();
        if (config.enableMenuLocalStorage && !window.Helpers.isSmallScreen()) {
          try {
            localStorage.setItem("templateCustomizer-" + templateName + "--LayoutCollapsed", String(window.Helpers.isCollapsed()));
            var t, a = document.querySelector(".template-customizer-layouts-options");
            if (a) {
              t = window.Helpers.isCollapsed() ? "collapsed" : "expanded";
              var input = a.querySelector(`input[value="${t}"]`);
              if (input) input.click();
            }
          } catch (e) { }
        }
      });
    });

    window.Helpers.swipeIn(".drag-target", function (e) { window.Helpers.setCollapsed(false) });
    window.Helpers.swipeOut("#layout-menu", function (e) { window.Helpers.isSmallScreen() && window.Helpers.setCollapsed(true) });

    let t = document.getElementsByClassName("menu-inner"),
      a = document.getElementsByClassName("menu-inner-shadow")[0];
    if (t.length > 0 && a) {
      t[0].addEventListener("ps-scroll-y", function () {
        this.querySelector(".ps__thumb-y").offsetTop ? a.style.display = "block" : a.style.display = "none"
      });
    }

    var n = localStorage.getItem("templateCustomizer-" + templateName + "--Theme") ||
      (window.templateCustomizer?.settings?.defaultStyle ?? document.documentElement.getAttribute("data-bs-theme"));

    function o() {
      var e = window.innerWidth - document.documentElement.clientWidth;
      document.body.style.setProperty("--bs-scrollbar-width", e + "px")
    }

    window.Helpers.switchImage(n);
    window.Helpers.setTheme(window.Helpers.getPreferredTheme());

    window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", () => {
      var e = window.Helpers.getStoredTheme();
      if (e !== "light" && e !== "dark") window.Helpers.setTheme(window.Helpers.getPreferredTheme())
    });

    o();

    window.addEventListener("DOMContentLoaded", () => {
      // Defensive: Only call showActiveTheme if the element exists
      var preferredTheme = window.Helpers.getPreferredTheme();
      try {
        window.Helpers.showActiveTheme(preferredTheme);
      } catch (err) {
        // Defensive: log error, but don't break
        if (window.console) console.error("showActiveTheme error:", err);
      }
      o();
      window.Helpers.initSidebarToggle();
      document.querySelectorAll("[data-bs-theme-value]").forEach(n => {
        n.addEventListener("click", () => {
          var e = n.getAttribute("data-bs-theme-value");
          window.Helpers.setStoredTheme(templateName, e);
          window.Helpers.setTheme(e);
          try {
            window.Helpers.showActiveTheme(e, true);
          } catch (err) {
            if (window.console) console.error("showActiveTheme error:", err);
          }
          window.Helpers.syncCustomOptions(e);
          let t = e;
          if (e === "system") {
            t = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
          }
          var a = document.querySelector(".template-customizer-semiDark");
          if (a) {
            if (e === "dark") a.classList.add("d-none");
            else a.classList.remove("d-none");
          }
          window.Helpers.switchImage(t);
        });
      });
    });

    if (
      typeof i18next !== "undefined" &&
      typeof i18NextHttpBackend !== "undefined"
    ) {
      i18next.use(i18NextHttpBackend).init({
        lng: window.templateCustomizer ? window.templateCustomizer.settings.lang : "en",
        debug: false,
        fallbackLng: "en",
        backend: { loadPath: assetsPath + "json/locales/{{lng}}.json" },
        returnObjects: true
      }).then(function (e) { i() });
    }

    if ((n = document.getElementsByClassName("dropdown-language")).length) {
      var s = n[0].querySelectorAll(".dropdown-item");
      for (let e = 0; e < s.length; e++) s[e].addEventListener("click", function () {
        let n = this.getAttribute("data-language"),
          o = this.getAttribute("data-text-direction");
        for (var e of this.parentNode.children)
          for (var t = e.parentElement.parentNode.firstChild; t;)
            1 === t.nodeType && t !== t.parentElement && t.querySelector(".dropdown-item").classList.remove("active"),
              t = t.nextSibling;
        this.classList.add("active");
        i18next.changeLanguage(n, (e, t) => {
          var a;
          if (window.templateCustomizer && window.templateCustomizer.setLang(n),
            a = o,
            document.documentElement.setAttribute("dir", a),
            "rtl" === a
              ? localStorage.getItem("templateCustomizer-" + templateName + "--Rtl") !== "true" && window.templateCustomizer && window.templateCustomizer.setRtl(true)
              : localStorage.getItem("templateCustomizer-" + templateName + "--Rtl") === "true" && window.templateCustomizer && window.templateCustomizer.setRtl(false),
            e
          ) return console.log("something went wrong loading", e);
          i();
          window.Helpers.syncCustomOptionsRtl(o);
        });
      });
    }

    function i() {
      var e = document.querySelectorAll("[data-i18n]");
      // Defensive: Only click if the element exists
      var t = document.querySelector('.dropdown-item[data-language="' + i18next.language + '"]');
      if (t) t.click();
      e.forEach(function (e) { e.innerHTML = i18next.t(e.dataset.i18n) });
    }

    function l(e) {
      if (e.type == "show.bs.collapse" || e.type == "show.bs.collapse") {
        e.target.closest(".accordion-item").classList.add("active");
        e.target.closest(".accordion-item").previousElementSibling?.classList.add("previous-active");
      } else {
        e.target.closest(".accordion-item").classList.remove("active");
        e.target.closest(".accordion-item").previousElementSibling?.classList.remove("previous-active");
      }
    }

    n = document.querySelector(".dropdown-notifications-all");
    let r = document.querySelectorAll(".dropdown-notifications-read"),
      d = (
        n && n.addEventListener("click", e => {
          r.forEach(e => {
            var item = e.closest(".dropdown-notifications-item");
            if (item) item.classList.add("marked-as-read");
          });
        }),
        r && r.forEach(t => {
          t.addEventListener("click", e => {
            var item = t.closest(".dropdown-notifications-item");
            if (item) item.classList.toggle("marked-as-read");
          });
        }),
        document.querySelectorAll(".dropdown-notifications-archive").forEach(t => {
          t.addEventListener("click", e => {
            var item = t.closest(".dropdown-notifications-item");
            if (item) item.remove();
          });
        }),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (e) { return new bootstrap.Tooltip(e) }),
        [].slice.call(document.querySelectorAll(".accordion")).map(function (e) { e.addEventListener("show.bs.collapse", l), e.addEventListener("hide.bs.collapse", l) }),
        window.Helpers.setAutoUpdate(true),
        window.Helpers.initPasswordToggle(),
        window.Helpers.initSpeechToText(),
        window.Helpers.initNavbarDropdownScrollbar(),
        document.querySelector("[data-template^='horizontal-menu']")
      );

    if (d && (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT ? window.Helpers.setNavbarFixed("fixed") : window.Helpers.setNavbarFixed("")),
      window.addEventListener("resize", function (e) {
        if (d) {
          window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT ? window.Helpers.setNavbarFixed("fixed") : window.Helpers.setNavbarFixed("");
          setTimeout(function () {
            if (window.innerWidth < window.Helpers.LAYOUT_BREAKPOINT) {
              if (document.getElementById("layout-menu") && document.getElementById("layout-menu").classList.contains("menu-horizontal")) menu.switchMenu("vertical");
            } else {
              if (document.getElementById("layout-menu") && document.getElementById("layout-menu").classList.contains("menu-vertical")) menu.switchMenu("horizontal");
            }
          }, 100);
        }
      }, true),
      !isHorizontalLayout && !window.Helpers.isSmallScreen() &&
      (typeof window.templateCustomizer !== "undefined" &&
        (window.templateCustomizer.settings.defaultMenuCollapsed ? window.Helpers.setCollapsed(true, false) : window.Helpers.setCollapsed(false, false),
          window.templateCustomizer.settings.semiDark) &&
        document.querySelector("#layout-menu") &&
        document.querySelector("#layout-menu").setAttribute("data-bs-theme", "dark"),
        typeof config !== "undefined") && config.enableMenuLocalStorage
    ) {
      try {
        var collapsed = localStorage.getItem("templateCustomizer-" + templateName + "--LayoutCollapsed");
        if (collapsed !== null) window.Helpers.setCollapsed(collapsed === "true", false);
      } catch (e) { }
    }
  })(),
  {
    container: "#autocomplete",
    placeholder: "Search [CTRL + K]",
    classNames: {
      detachedContainer: "d-flex flex-column",
      detachedFormContainer: "d-flex align-items-center justify-content-between border-bottom",
      form: "d-flex align-items-center",
      input: "search-control border-none",
      detachedCancelButton: "btn-search-close",
      panel: "flex-grow content-wrapper overflow-hidden position-relative",
      panelLayout: "h-100",
      clearButton: "d-none",
      item: "d-block"
    }
  }
);

var data = {}, currentFocusIndex = -1;

function isMacOS() {
  return /Mac|iPod|iPhone|iPad/.test(navigator.userAgent)
}

function loadSearchData() {
  var e = $("#layout-menu").hasClass("menu-horizontal") ? "search-horizontal.json" : "search-vertical.json";
  fetch(assetsPath + "json/" + e)
    .then(e => { if (e.ok) return e.json(); throw new Error("Failed to fetch data") })
    .then(e => { data = e, initializeAutocomplete() })
    .catch(e => console.error("Error loading JSON:", e))
}

function initializeAutocomplete() {
  if (document.getElementById("autocomplete")) return autocomplete({
    ...SearchConfig,
    openOnFocus: true,
    onStateChange({ state: e, setQuery: t }) {
      var a;
      if (e.isOpen) {
        document.body.style.overflow = "hidden";
        document.body.style.paddingRight = "var(--bs-scrollbar-width)";
        a = document.querySelector(".aa-DetachedCancelButton");
        if (a) a.innerHTML = '<span class="text-body-secondary">[esc]</span> <span class="icon-base icon-md ri ri-close-line text-heading"></span>';
        if (!window.autoCompletePS) {
          a = document.querySelector(".aa-Panel");
          if (a) window.autoCompletePS = new PerfectScrollbar(a);
        }
      } else {
        if (e.status === "idle" && e.query) t("");
        document.body.style.overflow = "auto";
        document.body.style.paddingRight = "";
      }
    },
    render(e, t) {
      let { render: a, html: n, children: o, state: s } = e;
      if (s.query) {
        if (e.sections.length) {
          a(o, t);
          if (window.autoCompletePS) window.autoCompletePS.update();
        } else {
          a(n`
            <div class="search-no-results-wrapper">
              <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-center text-heading">
                  <i class="icon-base ri ri-file-text-line text-body-secondary icon-48px mb-4"></i>
                  <h5>No results found</h5>
                </div>
              </div>
            </div>
          `, t);
        }
      } else {
        e = n`
          <div class="p-5 p-lg-12">
            <div class="row g-4">
              ${Object.entries(data.suggestions || {}).map(([e, t]) => n`
                  <div class="col-md-6 suggestion-section">
                    <p class="search-headings mb-2">${e}</p>
                    <div class="suggestion-items">
                      ${t.map(e => n`
                          <a href="${e.url}" class="suggestion-item d-flex align-items-center">
                            <i class="icon-base ri ${e.icon} me-2"></i>
                            <span>${e.name}</span>
                          </a>
                        `)}
                    </div>
                  </div>
                `)}
            </div>
          </div>
        `;
        a(e, t);
      }
    },
    getSources() {
      var e, t = [];
      if (data.navigation) {
        e = Object.keys(data.navigation).filter(e => e !== "files" && e !== "members").map(a => ({
          sourceId: "nav-" + a,
          getItems({ query: t }) {
            var e = data.navigation[a];
            return t ? e.filter(e => e.name.toLowerCase().includes(t.toLowerCase())) : e
          },
          getItemUrl({ item: e }) { return e.url },
          templates: {
            header({ items: e, html: t }) { return e.length === 0 ? null : t`<span class="search-headings">${a}</span>` },
            item({ item: e, html: t }) {
              return t`
                  <a href="${e.url}" class="d-flex justify-content-between align-items-center">
                    <span class="item-wrapper"><i class="icon-base ri ${e.icon}"></i>${e.name}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M16 13h-6v-3l-5 4l5 4v-3h7a1 1 0 0 0 1-1V5h-2z" />
                    </svg>
                  </a>
                `
            }
          }
        }));
        t.push(...e);
        if (data.navigation.files) t.push({
          sourceId: "files",
          getItems({ query: t }) {
            var e = data.navigation.files;
            return t ? e.filter(e => e.name.toLowerCase().includes(t.toLowerCase())) : e
          },
          getItemUrl({ item: e }) { return e.url },
          templates: {
            header({ items: e, html: t }) { return e.length === 0 ? null : t`<span class="search-headings">Files</span>` },
            item({ item: e, html: t }) {
              return t`
                  <a href="${e.url}" class="d-flex align-items-center position-relative px-4 py-2">
                    <div class="file-preview me-2">
                      <img src="${assetsPath}${e.src}" alt="${e.name}" class="rounded" width="42" />
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">${e.name}</h6>
                      <small class="text-body-secondary">${e.subtitle}</small>
                    </div>
                    ${e.meta ? t`
                          <div class="position-absolute end-0 me-4">
                            <span class="text-body-secondary small">${e.meta}</span>
                          </div>
                        ` : ""}
                  </a>
                `
            }
          }
        });
        if (data.navigation.members) t.push({
          sourceId: "members",
          getItems({ query: t }) {
            var e = data.navigation.members;
            return t ? e.filter(e => e.name.toLowerCase().includes(t.toLowerCase())) : e
          },
          getItemUrl({ item: e }) { return e.url },
          templates: {
            header({ items: e, html: t }) { return e.length === 0 ? null : t`<span class="search-headings">Members</span>` },
            item({ item: e, html: t }) {
              return t`
                  <a href="${e.url}" class="d-flex align-items-center py-2 px-4">
                    <div class="avatar me-2">
                      <img src="${assetsPath}${e.src}" alt="${e.name}" class="rounded-circle" width="32" />
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0">${e.name}</h6>
                      <small class="text-body-secondary">${e.subtitle}</small>
                    </div>
                  </a>
                `
            }
          }
        });
      }
      return t;
    }
  });
}

document.addEventListener("keydown", e => {
  if ((e.ctrlKey || e.metaKey) && e.key === "k") {
    e.preventDefault();
    var btn = document.querySelector(".aa-DetachedSearchButton");
    if (btn) btn.click();
  }
});

if (document.documentElement.querySelector("#autocomplete")) loadSearchData();