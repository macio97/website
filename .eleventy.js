
module.exports = function(eleventyConfig) {
    /* Eleventy only copies pages by default (.html, .njk, .md, etc.).
     * We need to specify the files/folders to copy through. */
    eleventyConfig.addPassthroughCopy("images");
    eleventyConfig.addPassthroughCopy("scripts");
    eleventyConfig.addPassthroughCopy("styles");

    /* Add a filter to remove .html from urls. */
    eleventyConfig.addFilter("prettyURL", function(url) {
        return url.replace(".html", "");
    });

    /* This setting should be default in future versions of eleventy.
     * It allows the data in the files to behave nicer. */
    eleventyConfig.setDataDeepMerge(true);
};