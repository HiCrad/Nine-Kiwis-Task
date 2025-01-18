document.getElementById("simulateUpload").addEventListener("click", () => {
    // Example image to simulate drag and drop (can be from local or other sources)
    const imageUrl = "https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg";

    // Call the function to simulate the drag and drop
    simulateDragAndDrop(imageUrl);
});

function simulateDragAndDrop(imageUrl) {
    // Directly create a File object from a Blob or URL
    // createFileFromUrl(imageUrl).then(imageFile => {

        let b64image = "data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==";

        // Convert base64 string to Blob
        const byteCharacters = atob(b64image.split(',')[1]);
        const byteArrays = [];

        for (let offset = 0; offset < byteCharacters.length; offset++) {
        const byteArray = byteCharacters.charCodeAt(offset);
        byteArrays.push(byteArray);
        }

        const blob = new Blob([new Uint8Array(byteArrays)], { type: 'image/png' });

        // Create a File from the Blob (this will be added to DataTransfer)
        const file = new File([blob], "image.png", { type: 'image/png' });


        // Create a DataTransfer object to simulate the drag event
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file); // Add the image file to DataTransfer

        // Create a custom drag event and trigger it
        const dragEvent = new DragEvent("drop", {
            dataTransfer: dataTransfer,
            bubbles: true,
            cancelable: true
        });

       // Get all <span> elements
        const spans = document.querySelectorAll('span');

        // Find the <span> element that contains "or drag and drop"
        const uploadArea = Array.from(spans).find(span => span.textContent.includes("or drag and drop"));

        console.log(uploadArea);


        // Ensure that the target element exists before dispatching the event
        if (uploadArea) {
            // Dispatch the drop event to the target
            // uploadArea.dispatchEvent(dragEvent);
            console.log("Simulated drag and drop event triggered!");
        } else {
            console.error("Upload area element not found.");
        }
    // }).catch(error => {
    //     console.error("Error creating file from image URL", error);
    // });
}

