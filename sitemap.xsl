<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:s="http://www.sitemaps.org/schemas/sitemap/0.9">
  <xsl:output method="html" encoding="UTF-8" indent="yes"/>
  <xsl:template match="/">
    <html lang="en">
      <head>
        <meta charset="UTF-8"/>
        <title>Redseed Game Studio Sitemap</title>
        <style>
          body { font-family: system-ui, sans-serif; margin: 2rem; color: #222; }
          h1 { color: #c00; }
          table { border-collapse: collapse; width: 100%; max-width: 960px; }
          th, td { border: 1px solid #ddd; padding: 0.6rem 0.8rem; text-align: left; }
          th { background: #f5f5f5; }
          tr:nth-child(even) { background: #fafafa; }
          a { color: #c00; }
        </style>
      </head>
      <body>
        <h1>Redseed Game Studio — Sitemap</h1>
        <p>Human-readable view. Search engines read the underlying XML.</p>
        <table>
          <thead>
            <tr>
              <th>URL</th>
              <th>Last modified</th>
              <th>Change frequency</th>
              <th>Priority</th>
            </tr>
          </thead>
          <tbody>
            <xsl:for-each select="s:urlset/s:url">
              <tr>
                <td><a href="{s:loc}"><xsl:value-of select="s:loc"/></a></td>
                <td><xsl:value-of select="s:lastmod"/></td>
                <td><xsl:value-of select="s:changefreq"/></td>
                <td><xsl:value-of select="s:priority"/></td>
              </tr>
            </xsl:for-each>
          </tbody>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
