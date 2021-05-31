const moment = require('moment');

function find_product(name, all_products) {
    found_product = null;

    all_products.forEach(function(product) {
        if (product.data.name === name) {
            found_product = product;
        }
    });

    return found_product;
}

module.exports = function(eleventyConfig) {
    /* Eleventy only copies pages by default (.html, .njk, .md, etc.).
     * We need to specify the files/folders to copy through. */
    eleventyConfig.addPassthroughCopy("images");
    eleventyConfig.addPassthroughCopy("scripts");
    eleventyConfig.addPassthroughCopy("styles");
    eleventyConfig.addPassthroughCopy("products/download/")

    /* Add a filter to remove .html from urls. */
    eleventyConfig.addFilter("prettyURL", function(url) {
        return url.replace(".html", "");
    });

    eleventyConfig.addFilter("urlname", function(url) {
        parts = url.replace(".html", "").split("/");
        return parts[parts.length - 1];
    });

    eleventyConfig.setBrowserSyncConfig(
        require("./configs/browsersync.js")("_site")
    );

    /* This setting should be default in future versions of eleventy.
     * It allows the data in the files to behave nicer. */
    eleventyConfig.setDataDeepMerge(true);

    /* Ensure a fixed order for the products.
     * Modify the order in this array to change the order on the products page and in the navigation. */
    let products = ["Sky", "Grass", "Trees", "Rocks", "Environments", "ArchDec", "ArchDec 2", "Materials", "Camera", "Snow"];

    /* Reorder the product pages to match the above array. */
    eleventyConfig.addCollection("products", function(collectionApi) {
        let all_products = collectionApi.getFilteredByTag("product");
        let sorted_products = [];

        products.forEach(function(product) {
            found = find_product(product, all_products);
            if (found) {
                sorted_products.push(found);
            }
        });

        return sorted_products;
    });

    /* Format the date for the news page */
    eleventyConfig.addFilter("dateformat", date => {
        date = date.setHours(0, 0, 0);
        return moment.parseZone(date).format("YYYY-MM-DD");
    });
};