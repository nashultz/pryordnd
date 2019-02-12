const mix = require('laravel-mix');
let recursiveReadSync = require('recursive-readdir-sync'), files;

// Get the paths
var compilePaths = getPaths();

// If paths are not available, the defined site string was not valid.
if (!compilePaths) {
    console.error('The site that was specified to compile is not valid.');
    process.exit();
}

//////////////////////////////////////////////////////////////////////////////////////////

// Options to pass to Mix when compiling Sass
var mixSassOptions = {
    includePaths: [
        `resources/assets/scss/${compilePaths.assetFolderName}`,
        'node_modules',
    ],
};

// List all vendor libraries to be loaded externally in the main JS only
var mainJsModules = compilePaths.mainJsVendor;

// Scan the SCSS and JS directories for files to compile.
// We no longer need to comment and uncomment the files we want to recompile.
// Since all assets are compiled at build-time, we want to accuratly mimic
// what will happen in production, so everything will recompile. This means
// all JS and CSS will be watched.

try {
    var folderListings = {
        scssPages: recursiveReadSync(`./resources/assets/scss/${compilePaths.assetFolderName}/pages`),
        jsPages: recursiveReadSync(`./resources/assets/js/${compilePaths.assetFolderName}/pages`),
    };
} catch(err) {
    if (err.errno === 34) {
        console.log('Path does not exist');
    } else {
        // Something else went wrong. Throw an error.
        throw err;
    }
}

// Create an array containing the modules for the main JS plus the actual main JS file.
var webpackEntry = {};
webpackEntry[compilePaths.mainJsFilename] = mainJsModules.concat([`resources/assets/js/${compilePaths.assetFolderName}/${compilePaths.mainJsFilename}.js`]);


//////////////////////////////
//          FONTS           //
//////////////////////////////

// Copy fonts from assets folder to public folder
mix.copyDirectory('resources/assets/fonts', 'public/fonts');

//////////////////////////////
//          STYLES          //
//////////////////////////////

// Main/Global styles
mix.sass(`resources/assets/scss/${compilePaths.assetFolderName}/${compilePaths.mainCssFilename}.scss`, `css/${compilePaths.publicFolderName}/${compilePaths.mainCssFilename}.css`, mixSassOptions);

// Scan for page-specific source files
for (var i = 0, len = folderListings.scssPages.length; i < len; i++) {
    var destPath = folderListings.scssPages[i].replace(`resources/assets/scss/${compilePaths.assetFolderName}/`, '').replace('scss', 'css');
    // Only compile if this file does not start with a period
    if (destPath.split('/').pop().indexOf('.') != 0) mix.sass(folderListings.scssPages[i], `css/${compilePaths.publicFolderName}/${destPath}`, mixSassOptions);
}

//////////////////////////////
//        JAVASCRIPT        //
//////////////////////////////

// Scan for page-specific source files
for (var i = 0, len = folderListings.jsPages.length; i < len; i++) {
    var destPath = folderListings.jsPages[i].replace(`resources/assets/js/${compilePaths.assetFolderName}/`, '');
    // Only compile if this file does not start with an underscore or period
    if (destPath.split('/').pop().indexOf('_') != 0 && destPath.split('/').pop().indexOf('.') != 0) mix.js(folderListings.jsPages[i], `js/${compilePaths.publicFolderName}/${destPath}`);
}

//////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////
//        HELPER FUNCTIONS        //
////////////////////////////////////

function getPaths(input) {
    return {
        publicFolderName: 'pryordnd',
        assetFolderName: 'pryordnd',
        mainCssFilename: 'global',
        mainJsFilename: 'global',
        mainJsVendor: []
    }
}