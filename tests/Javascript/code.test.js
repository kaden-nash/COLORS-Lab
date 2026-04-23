/**
 * @jest-environment jsdom
 */

const fs = require('fs');
const path = require('path');

const codePath = path.resolve(__dirname, '../../public/js/code.js');
const codeContent = fs.readFileSync(codePath, 'utf8');

describe('code.js unit tests', () => {
    beforeEach(() => {
        // Setup mock DOM elements that code.js expects
        document.body.innerHTML = `
            <input id="loginName" value="testUser" />
            <input id="loginPassword" value="password123" />
            <div id="loginResult"></div>
            <input id="colorText" value="Blue" />
            <div id="colorAddResult"></div>
            <input id="searchText" value="Bl" />
            <div id="colorSearchResult"></div>
            <p></p>
        `;
        
        // Evaluate the script in the document context
        // Functions declared with 'function' will be attached to the window object
        const script = document.createElement('script');
        script.textContent = codeContent;
        document.head.appendChild(script);
        
        // Mock window.location since JSDOM doesn't support changing it directly
        delete window.location;
        window.location = { href: '' };
        
        // Reset document cookie
        Object.defineProperty(document, 'cookie', {
            writable: true,
            value: ''
        });
    });

    afterEach(() => {
        document.head.innerHTML = '';
        document.body.innerHTML = '';
        jest.restoreAllMocks();
    });

    test('doLogout should clear cookies and redirect to index.html', () => {
        // Act: call the globally attached function
        window.doLogout();
        
        // Assert: cookie should have an expiration date in the past
        expect(document.cookie).toContain("expires = Thu, 01 Jan 1970 00:00:00 GMT");
        // Assert: should redirect to index.html
        expect(window.location.href).toBe("index.html");
    });

    test('readCookie should redirect to index.html if userId is not found in cookie', () => {
        // Arrange: set cookie without userId
        document.cookie = "firstName=John,lastName=Doe";
        
        // Act
        window.readCookie();
        
        // Assert: should redirect to index.html due to missing userId
        expect(window.location.href).toBe("index.html");
    });
});