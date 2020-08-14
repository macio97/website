/* Adapted from https://jec.fyi/blog/customizing-file-structure-urls-browsersync
 * Thanks! */

const fs = require('fs');
const url = require('url');

module.exports = (output) => ({
    server: {
      baseDir: "_site",
      serveStaticOptions: {
        extensions: ["html"]
      }
    },

    middleware: [
      function(req, res, next) {
        console.log("GET:", req.url);
        let u = url.parse(req.url);
        parsed = u.pathname;

        if (parsed.match(/\/+$/)) {
          parsed = parsed.replace(/\/+$/, '');
          parsed = `${output}${parsed}.html`;
          
          /* Check if that page exists. */
          if (fs.existsSync(parsed)) {
            console.log(parsed);
            const content = fs.readFileSync(parsed);
            res.write(content);
            res.writeHead(200);
            res.end();
          }
          else {
            return next();
          }

        }
        next();
      }
    ]
  });
