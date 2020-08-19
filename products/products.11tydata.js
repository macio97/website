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
    "archdec_2": getFolderFilePaths("images/archdec_2/icons"),
    "archdec": getFolderFilePaths("images/archdec/icons"),
    "dielectrics": getFolderFilePathsWithNames("images/materials/dielectrics"),
    "metals": getFolderFilePathsWithNames("images/materials/metals"),
    "textures": getFolderFilePathsWithNames("images/materials/textures"),
    "grass": getFolderFilePathsWithNames("images/grass/grass"),
    "weeds": getFolderFilePathsWithNames("images/grass/weeds"),
    "trees": getFolderFilePathsWithNames("images/trees/icons")
};