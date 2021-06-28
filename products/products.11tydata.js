const fs = require("fs");
const path = require("path");

function getFolderFilePaths(folder) {
    paths = [];
    fs.readdirSync(folder).forEach(file => {
        let path = `${folder}/${file}`;
        paths.push(path);
    });

    return paths;
}

function getFolderFilePathsWithNames(folder) {
    paths = [];
    fs.readdirSync(folder).forEach(file => {
        let file_path = `${folder}/${file}`;
        paths.push({
            "path": file_path,
            "name": path.parse(file).name
        });
    });
    return paths;
}

module.exports = {
    "archdec_2": getFolderFilePaths("images/products/archdec_2/icons"),
    "archdec": getFolderFilePaths("images/products/models/interior"),
    "spaceships": getFolderFilePaths("images/products/models/spaceships"),
    "dielectrics": getFolderFilePathsWithNames("images/products/materials/dielectrics"),
    "metals": getFolderFilePathsWithNames("images/products/materials/metals"),
    "textures": getFolderFilePathsWithNames("images/products/materials/textures"),
    "grass": getFolderFilePathsWithNames("images/products/grass/grass"),
    "weeds": getFolderFilePathsWithNames("images/products/grass/weeds"),
    "trees": getFolderFilePathsWithNames("images/products/trees/icons"),
    "rocks": getFolderFilePathsWithNames("images/products/rocks/icons")
};