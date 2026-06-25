/**
 * Internal linking helpers: game promo panel and auto-linking game names in blog content.
 */
(function () {
  var inHiFolder = window.location.pathname.indexOf("/hi/") !== -1;
  var root = inHiFolder ? ".." : ".";

  var PROMO_GAMES = [
    {
      title: "Niara: Rebellion Of the King",
      blurb: "Visual novel RPG with turn-based combat.",
      url: root + "/niara_rotk/",
    },
    {
      title: "Kori's Fable",
      blurb: "Fantasy visual novel on Google Play and Steam.",
      url: root + "/korisfable.html",
    },
    {
      title: "Dusk Point R: Miko's Journey",
      blurb: "Free cyberpunk visual novel (English & Hindi).",
      url: root + "/dusk_point_reloaded_mikos_journey.html",
    },
    {
      title: "A Sweet Meeting: Rebirth",
      blurb: "Free school romance visual novel (English & Hindi).",
      url: root + "/a_sweet_meeting_rebirth.html",
    },
  ];

  var LINK_RULES = [
    {
      pattern: /\bNiara(?:\s*:\s*Rebellion\s+Of\s+the\s+King)?\b/gi,
      url: root + "/niara_rotk/",
    },
    {
      pattern: /\bKori(?:'s)?\s+Fable\b/gi,
      url: root + "/korisfable.html",
    },
    {
      pattern: /\bDusk\s+Point(?:\s+R|:|\s+Reloaded)?(?:\s*:\s*Miko(?:'s)?\s+Journey)?\b/gi,
      url: root + "/dusk_point_reloaded_mikos_journey.html",
    },
    {
      pattern: /\bMiko(?:'s)?\s+Journey\b/gi,
      url: root + "/dusk_point_reloaded_mikos_journey.html",
    },
    {
      pattern: /\bA\s+Sweet\s+Meeting(?::\s*Rebirth)?\b/gi,
      url: root + "/a_sweet_meeting_rebirth.html",
    },
    {
      pattern: /\bEk\s+Pyari\s+Mulaqat\b/gi,
      url: root + "/hi/sweet-meeting.html",
    },
    {
      pattern: /डस्क\s*पॉइंट(?:\s*R)?(?:\s*:\s*मीको\s*का\s*सफर)?/g,
      url: root + "/hi/miko.html",
    },
    {
      pattern: /एक\s+प्यारी\s+मुलाक़ात/g,
      url: root + "/hi/sweet-meeting.html",
    },
    {
      pattern: /मीको\s*का\s*सफर/g,
      url: root + "/hi/miko.html",
    },
  ];

  function renderGamesPromo(containerId) {
    var container = document.getElementById(containerId);
    if (!container) return;

    var cards = PROMO_GAMES.map(function (game) {
      return (
        '<div class="col-md-6 mb-3">' +
        '<a href="' +
        game.url +
        '" style="color:#fff;text-decoration:none;">' +
        '<strong style="font-family:binary;color:#dc3545;">' +
        game.title +
        "</strong><br>" +
        '<span style="color:#ccc;font-size:0.95rem;">' +
        game.blurb +
        "</span></a></div>"
      );
    }).join("");

    container.innerHTML =
      '<div class="row" style="margin:0;">' + cards + "</div>";
  }

  function linkTextNode(textNode) {
    var parts = [{ type: "text", value: textNode.textContent }];

    LINK_RULES.forEach(function (rule) {
      var updated = [];

      parts.forEach(function (part) {
        if (part.type !== "text") {
          updated.push(part);
          return;
        }

        var str = part.value;
        var lastIndex = 0;
        var matched = false;
        rule.pattern.lastIndex = 0;
        var match;

        while ((match = rule.pattern.exec(str)) !== null) {
          matched = true;
          if (match.index > lastIndex) {
            updated.push({
              type: "text",
              value: str.slice(lastIndex, match.index),
            });
          }
          updated.push({ type: "link", value: match[0], url: rule.url });
          lastIndex = match.index + match[0].length;
        }

        if (!matched) {
          updated.push(part);
        } else if (lastIndex < str.length) {
          updated.push({ type: "text", value: str.slice(lastIndex) });
        }
      });

      parts = updated;
    });

    if (parts.length === 1 && parts[0].type === "text") {
      return;
    }

    var fragment = document.createDocumentFragment();
    parts.forEach(function (part) {
      if (part.type === "link") {
        var anchor = document.createElement("a");
        anchor.href = part.url;
        anchor.textContent = part.value;
        anchor.style.color = "#dc3545";
        anchor.style.fontWeight = "bold";
        fragment.appendChild(anchor);
      } else {
        fragment.appendChild(document.createTextNode(part.value));
      }
    });

    textNode.parentNode.replaceChild(fragment, textNode);
  }

  function linkGameNamesInElement(element) {
    if (!element) return;

    var walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, {
      acceptNode: function (node) {
        var parent = node.parentElement;
        if (!parent) return NodeFilter.FILTER_REJECT;
        if (parent.closest("a, script, style, noscript")) {
          return NodeFilter.FILTER_REJECT;
        }
        return node.textContent.trim()
          ? NodeFilter.FILTER_ACCEPT
          : NodeFilter.FILTER_REJECT;
      },
    });

    var textNodes = [];
    while (walker.nextNode()) {
      textNodes.push(walker.currentNode);
    }

    textNodes.forEach(linkTextNode);
  }

  window.RedseedGameLinks = {
    renderGamesPromo: renderGamesPromo,
    linkGameNamesInElement: linkGameNamesInElement,
  };
})();
