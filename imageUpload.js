document.getElementById("simulateUpload").addEventListener("click", () => {
    // Example image to simulate drag and drop (can be from local or other sources)
    const imageUrl = "https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg";

    // Call the function to simulate the drag and drop
    simulateDragAndDrop(imageUrl);
});

function simulateDragAndDrop(imageUrl) {
    // Directly create a File object from a Blob or URL
    createFileFromUrl(imageUrl).then(imageFile => {
        // Create a DataTransfer object to simulate the drag event
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(imageFile); // Add the image file to DataTransfer

        // Create a custom drag event and trigger it
        const dragEvent = new DragEvent("drop", {
            dataTransfer: dataTransfer,
            bubbles: true,
            cancelable: true
        });

        // Improved querySelector for more specificity in selecting the upload area
        const uploadArea = document.querySelector('span:contains("or drag and drop")'); // More specific selection

        // Ensure that the target element exists before dispatching the event
        if (uploadArea) {
            // Dispatch the drop event to the target
            uploadArea.dispatchEvent(dragEvent);
            console.log("Simulated drag and drop event triggered!");
        } else {
            console.error("Upload area element not found.");
        }
    }).catch(error => {
        console.error("Error creating file from image URL", error);
    });
}

function createFileFromUrl(url) {
    return new Promise((resolve, reject) => {
        const image = new Image();
        image.src = url;
        image.crossOrigin = "Anonymous";  // Add this line to handle CORS issues

        image.onload = () => {
            // Once the image is loaded, create a Blob from the image data (using canvas)
            const canvas = document.createElement('canvas');
            canvas.width = image.width;
            canvas.height = image.height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(image, 0, 0);

            // Convert the canvas to a Blob (you can specify different formats)
            canvas.toBlob(blob => {
                if (blob) {
                    // Resolve with a File created from the Blob
                    const file = new File([blob], "image.jpeg", { type: "image/jpeg" });
                    resolve(file);
                } else {
                    reject("Failed to convert canvas to Blob");
                }
            }, 'image/jpeg');
        };

        image.onerror = () => {
            reject("Failed to load the image from the URL");
        };
    });
}
