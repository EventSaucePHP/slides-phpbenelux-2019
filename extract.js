const fs = require('fs');
const path = require('path');
const betterTrim = require('./trim');
const { JSDOM } = require('jsdom');
const indexPath = path.join(__dirname, '/index.html');

function extract() {
    const html = fs.readFileSync(indexPath).toString();
    const dom = new JSDOM(html);
    const nodes = dom.window.document.querySelectorAll('[data-filename]');
    const base = path.join(__dirname, 'scripts');
    const Entities = require('html-entities').XmlEntities;
    const entities = new Entities();

    Array.from(nodes).forEach(node => {
        if (node.hasAttribute('data-filename') === false || node.parentNode.hasAttribute('data-line')) {
            return;
        }

        const filename = path.join(base, node.getAttribute('data-filename'));
        const include = node.hasAttribute('data-include') ? `require __DIR__.'/../includes/${node.getAttribute('data-include')}';\n\n` : '';
        const contents = `<?php
if(function_exists('xdebug_disable')) 
{ 
    xdebug_disable();
    ini_set("xdebug.overload_var_dump", "off"); 
}

include __DIR__ . '/../vendor/autoload.php';
        
${include}${betterTrim(entities.decode(node.innerHTML))}`;
        fs.writeFile(filename, contents, () => {
            console.log(`Updated ${filename}.`);
        });
    });
}

extract();

if (process.argv.includes('--watch')) {
    console.log('watching...');
    fs.watchFile(indexPath, () => {
        console.log('extracting due to change');
        extract();
    });
}