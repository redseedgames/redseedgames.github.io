/**
 * Helpers for Blogger JSON feed excerpts on listing pages.
 */
(function () {
  var DEFAULT_MAX_WORDS = 40;

  function parseContent(html) {
    var parser = new DOMParser();
    var doc = parser.parseFromString(html, "text/html");
    doc.querySelectorAll("img, script, style").forEach(function (el) {
      el.remove();
    });
    return doc;
  }

  function truncateWords(text, maxWords) {
    var words = text.split(/\s+/).filter(Boolean);
    if (words.length <= maxWords) {
      return text;
    }
    return words.slice(0, maxWords).join(" ") + "…";
  }

  function extractExcerpt(html, options) {
    options = options || {};
    var maxWords = options.maxWords || DEFAULT_MAX_WORDS;

    if (!html) {
      return "";
    }

    // Blogger summary (content before <!--more-->) is often plain text.
    if (html.indexOf("<") === -1) {
      return truncateWords(html.replace(/\s+/g, " ").trim(), maxWords);
    }

    var doc = parseContent(html);
    var paragraphs = doc.body.querySelectorAll("p");

    for (var i = 0; i < paragraphs.length; i++) {
      var text = (paragraphs[i].textContent || "").replace(/\s+/g, " ").trim();
      if (text.length >= 20) {
        return truncateWords(text, maxWords);
      }
    }

    var fallback = (doc.body.textContent || "").replace(/\s+/g, " ").trim();
    return fallback ? truncateWords(fallback, maxWords) : "";
  }

  function extractLargeImage(html) {
    var parser = new DOMParser();
    var doc = parser.parseFromString(html, "text/html");
    var imgTag = doc.querySelector("img");
    if (!imgTag) {
      return null;
    }
    return imgTag.src.replace(/s72-c/, "s600");
  }

  window.RedseedBlogFeed = {
    extractExcerpt: extractExcerpt,
    extractLargeImage: extractLargeImage,
  };
})();
