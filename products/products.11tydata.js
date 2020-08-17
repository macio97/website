const fs = require("fs");

function getFolderFilePaths(folder) {
    paths = [];
    fs.readdirSync(folder).forEach(file => {
        let path = `${folder}/${file}`;
        paths.push(path);
    });

    return paths;
}

module.exports = {
    "archdec_2": getFolderFilePaths("images/archdec_2/icons")
    };