chrome.runtime.onMessage.addListener((message, sender, sendResponse) => {
    if (message.action === "fetchUserPendingSalePosts") {
      fetch('http://localhost:8000/api/sale-posts')
        .then(response => response.json())
        .then(data => sendResponse({ success: true, data }))
        .catch(error => sendResponse({ success: false, error: error.message }));
      return true;
    }
  });
  