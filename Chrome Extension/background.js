chrome.runtime.onMessage.addListener((message, sender, sendResponse) => {
    if (message.action === "fetchUsers") {
      fetch('https://dummyjson.com/users/search?q=John')
        .then(response => response.json())
        .then(data => sendResponse({ success: true, data }))
        .catch(error => sendResponse({ success: false, error: error.message }));
      // Return true to indicate we're sending a response asynchronously
      return true;
    }
  });
  