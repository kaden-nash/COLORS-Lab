const js = require("@eslint/js");

module.exports = [
    js.configs.recommended,
    {
        languageOptions: {
            // Tells ESLint you are writing modern JavaScript
            ecmaVersion: "latest", 
            sourceType: "module",
        },
        rules: {
            // Warns you if you create a variable but never use it
            "no-unused-vars": "warn", 
            // Warns you if you use a variable that doesn't exist
            "no-undef": "warn",
            // Allows you to leave console.log() in your code without failing the build
            "no-console": "off" 
        }
    }
];