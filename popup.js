
function simulateClick(firstName, productPrice) {
    console.log("Simulating click and setting input");

    productCondition = "New"

    const title = document.querySelector('label[aria-label="Title"]');
    const price = document.querySelector('label[aria-label="Price"]');
    const conditionLabel = document.querySelector('label[aria-label="Condition"]');
        
    if (conditionLabel) {
        conditionLabel.click();
        
        setTimeout(() => {
            // Find the options in the dropdown (div with role="option")
            const options = document.querySelectorAll('div[role="option"]');
            
            options.forEach(option => {
                // Check if the option text content matches the desired condition
                const optionText = option.querySelector('span').textContent.trim();
                
                if (optionText === productCondition) {
                    // Click the option to select it
                    option.click();
                    console.log(`Selected condition: ${productCondition}`);
                }
            });
        }, 300); // Wait for the dropdown to open before selecting

    } else {
        console.log('Dropdown trigger not found');
    }
    
  
    
    if (title) {
        const titleInput = title.querySelector('input');
        
        if (titleInput) {
            titleInput.focus();

            const simulateTyping = (text, element, index = 0) => {
                if (index < text.length) {
                    element.value += text[index];

                    const event = new Event('input', { bubbles: true });
                    element.dispatchEvent(event);

                    setTimeout(() => simulateTyping(text, element, index + 1), 100);
                }
            };

            simulateTyping(firstName, titleInput);
        } else {
            console.log('Input not found within label');
        }
    } else {
        console.log('Label not found');
    }

    if (price) {
        const priceInput = price.querySelector('input');
        
        if (priceInput) {
            priceInput.focus();

            const simulateTyping = (text, element, index = 0) => {
                if (index < text.length) {
                    element.value += text[index];

                    const event = new Event('input', { bubbles: true });
                    element.dispatchEvent(event);

                    setTimeout(() => simulateTyping(text, element, index + 1), 100);
                }
            };

            simulateTyping(productPrice, priceInput);
        } else {
            console.log('Input not found within label');
        }
    } else {
        console.log('Label not found');
    }
}


function fetchUserData() {
    chrome.runtime.sendMessage({ action: "fetchUsers" }, (response) => {
        if (response.success) {
            populateUserList(response.data.users);
        } else {
            console.error('Error fetching users:', response.error);
        }
    });
}

function populateUserList(users) {
    const userList = document.getElementById('userList');

    users.forEach((user) => {
        const li = document.createElement('li');
        li.textContent = `${user.firstName} ${user.lastName}`;

        li.addEventListener('click', () => {
            handleUserClick(user);
        });

        userList.appendChild(li);
    });
}

function handleUserClick(user) {
    const userDetails = `
        Name: ${user.firstName} ${user.lastName}
        Email: ${user.email}
        Phone: ${user.phone}
        Address: ${user.address.address}, ${user.address.city}, ${user.address.state}, ${user.address.country}
        Company: ${user.company.name}, Role: ${user.company.title}
        Crypto: ${user.crypto.coin}, Wallet: ${user.crypto.wallet}
    `;

    chrome.tabs.query({ active: true, currentWindow: true }, (tabs) => {
        chrome.scripting.executeScript({
            target: { tabId: tabs[0].id },
            func: simulateClick,
            args: [user.firstName, "12.26"]
        });
    });
}

fetchUserData();
