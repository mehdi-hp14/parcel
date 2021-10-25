const tasks = [
    'admin',
    'auth' ,
    'customer' ,
    'site' ,
];

// Execute Task by running `npm run watch -- --desktop`

for (task of tasks) {
    if (process.argv.includes('--' + task)) {
        require(`./tasks/${task}`);
    }
}
