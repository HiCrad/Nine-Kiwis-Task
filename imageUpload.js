document.getElementById("simulateUpload").addEventListener("click", () => {
    chrome.tabs.query({ active: true, currentWindow: true }, (tabs) => {
        chrome.scripting.executeScript({
            target: { tabId: tabs[0].id },
            func: simulateDragAndDrop,
        });
    });
});

async function simulateDragAndDrop() {
    const imageUrl = "https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg"; // Image URL

    try {
        const response = await fetch(imageUrl);
        if (!response.ok) {
            throw new Error('Failed to fetch the image');
        }
        const blob = await response.blob();

        const file = new File([blob], "image.jpeg", { type: 'image/jpeg' });

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        const dragEvent = new DragEvent("drop", {
            dataTransfer: dataTransfer,
            bubbles: true,
            cancelable: true
        });

        const spans = document.querySelectorAll('span');
        let uploadArea = Array.from(spans).find(span => span.textContent.includes("or drag and drop"));

        if (!uploadArea) {
            uploadArea = Array.from(spans).find(span => span.textContent.includes("Add photo"));
        }

        if (uploadArea) {
            uploadArea.dispatchEvent(dragEvent);
            console.log("Simulated drag and drop event triggered!");
        } else {
            console.error("Upload area element not found.");
        }

    } catch (error) {
        console.error("Error:", error);
    }
}
