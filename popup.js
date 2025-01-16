document.getElementById('clickButton').addEventListener('click', () => {
    chrome.tabs.query({ active: true, currentWindow: true }, (tabs) => {
        chrome.scripting.executeScript({
            target: { tabId: tabs[0].id },
            func: simulateClick
        });
    });
});
function simulateClick(title, price, condition, category, categoryDetails) {
    console.log("click input")
    const label = document.querySelector('label[aria-label="Title"]');

    if (label) {
        const input = label.querySelector('input');

        if (input) {
            input.focus();

            const simulateTyping = (text, element, index = 0) => {
                if (index < text.length) {
                        element.value += text[index];

                        const event = new Event('input', { bubbles: true });
                        element.dispatchEvent(event);

                        setTimeout(() => simulateTyping(text, element, index + 1), 100);  // 100ms delay between keystrokes
                }
            };

            simulateTyping('T shirt', input);
        } else {
            console.log('Input not found within label');
        }
    } else {
    console.log('Label not found');
    }
}

  
// popup.js

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
  
  alert(userDetails);

  simulateClick(title, price, condition, category, categoryDetails)
}

fetchUserData();
  