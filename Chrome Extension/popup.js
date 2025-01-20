
function processSalePost(post) {

    const { title: productTitle, price: productPrice, description: productDescription, photos:images } = post;

    productCondition = "New"
    productCategory = "Tools"

    const title = document.querySelector('label[aria-label="Title"]');
    const price = document.querySelector('label[aria-label="Price"]');
    const conditionLabel = document.querySelector('label[aria-label="Condition"]');
    const categoryBox = document.querySelector('label[aria-label="Category"]');
        
    if (conditionLabel) {
        conditionLabel.click();
        
        setTimeout(() => {
            const options = document.querySelectorAll('div[role="option"]');
            
            options.forEach(option => {
                const optionText = option.querySelector('span').textContent.trim();
                
                if (optionText === productCondition) {
                    option.click();
                    console.log(`Selected condition: ${productCondition}`);
                }
            });
        }, 300);

    } else {
        console.log('Dropdown trigger not found');
    }


    if (categoryBox) {
        categoryBox.click();

        setTimeout(() => {
            const options = document.querySelectorAll('div[role="dialog"] div');

            options.forEach(option => {
                const optionText = option.querySelector('span')?.textContent.trim();

                if (optionText === productCategory) {
                    option.click();
                    console.log(`Selected category: ${productCategory}`);
                }
            });
        }, 300);

    } else {
        console.log('Category trigger not found');
    }

    // Running after category box is closed
    setTimeout(() => {
        const desciptionBox = document.querySelector('label[aria-label="Description"]');

        if (desciptionBox) {
            const descriptionInput = desciptionBox.querySelector('textarea');
            
            if (descriptionInput) {
                descriptionInput.focus();

                const simulateTyping = (text, element, index = 0) => {
                    if (index < text.length) {
                        element.value += text[index];

                        const event = new Event('input', { bubbles: true });
                        element.dispatchEvent(event);

                        setTimeout(() => simulateTyping(text, element, index + 1), 100);
                    }
                };

                simulateTyping(productDescription, descriptionInput);
            } else {
                console.log('Input not found within label');
            }
        } else {
            console.log('Label not found');
        }
    }, 2000)
  
    
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

            simulateTyping(productTitle, titleInput);
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

    async function processImages(images) {
        try {
            const promises = images.map(imageUrl => simulateDragAndDrop(imageUrl));
            await Promise.all(promises);
            console.log('All images have been processed.');
        } catch (error) {
            console.error('Error processing images:', error);
        }
    }
    
    processImages(images);

    async function simulateDragAndDrop(imageUrl) {

        try {
            const response = await fetch('http://localhost:8000/api/get-image?filepath='+imageUrl, {
                cors: 'no-cors'
            });
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
}


function fetchUserSalePostsData() {
    chrome.runtime.sendMessage({ action: "fetchUserPendingSalePosts" }, (response) => {
        if (response.success) {
            populateUserList(response.data);
        } else {
            console.error("Error fetching user's sale posts :", response.error);
        }
    });
}

function populateUserList(salePosts) {
    const salePostElement = document.getElementById('salePostElement');

    salePosts.forEach((post, index) => {
        const li = document.createElement('li');
        li.textContent = `${index+1}.${post.title} - ${post.category}`;

        li.addEventListener('click', () => {
            handleSalePostClick(post);
        });

        salePostElement.appendChild(li);
    });
}

function handleSalePostClick(post) {
    chrome.tabs.query({ active: true, currentWindow: true }, (tabs) => {
        chrome.scripting.executeScript({
            target: { tabId: tabs[0].id },
            func: processSalePost,
            args: [post]
            
        });
    });
}

fetchUserSalePostsData();

