const BACKENDSERVER = 'http://localhost:8000/'

chrome.runtime.onMessage.addListener((message, sender, sendResponse) => {
    if (message.action === "fetchUserPendingSalePosts") {
      fetch(BACKENDSERVER+'api/sale-posts')
        .then(response => response.json())
        .then(data => sendResponse({ success: true, data }))
        .catch(error => sendResponse({ success: false, error: error.message }));
      return true;
    }
  });
  