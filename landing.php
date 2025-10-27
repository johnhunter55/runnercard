<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Carousel</title>
    <link rel="stylesheet" href="sec.css">
</head>
<body>
<div class="body">
    <div class="carousel">
        <div class="arrows">
            <button class="btn prev"><</button>
            <div class="slides"></div>
            <button class="btn next">></button>
        </div>
        <div class="button-bar">
            <button class="btn download" id="downloadBtn">DOWNLOAD</button>
        </div>
    </div>
</div>
<!-- script starts no longer html --> 
    <script>
        const slides = document.querySelector(".slides");
const prevBtn = document.querySelector(".prev");
const nextBtn = document.querySelector(".next");
const downloadBtn = document.getElementById("downloadBtn"); // Select the download button
let currentIndex = 0;
let files = [];

// Fetch image data based on the clicked image
function fetchImageData() {
    const urlParams = new URLSearchParams(window.location.search);
    const file = urlParams.get('file');  // Getting the image file name passed in the URL

    return fetch(`get_images.php?file=${encodeURIComponent(file)}`)
        .then(response => response.json())
        .then(data => {
            files = data.files;
            return files;
        })
        .catch(error => {
            console.error('Error fetching image data:', error);
        });
}

// Display the current slide
function showSlide(index) {
    slides.innerHTML = `<img src="${files[index]}" alt="Carousel Image">`;

    // Create the close button dynamically and append it
    const closeButton = document.createElement("button");
    closeButton.classList.add("btn", "close");
    closeButton.textContent = "X";
    closeButton.onclick = () => window.location.href = 'index.php';

    slides.appendChild(closeButton); // Append close button to slides
    updateDownloadButton(files[index]); // Update download button
}


// Update the download button
function updateDownloadButton(imagePath) {
    downloadBtn.onclick = () => {
        const link = document.createElement("a");
        link.href = imagePath;  // The image source
        link.download = imagePath.split("/").pop();  // Use the file name as the download name
        link.click();  // Trigger the download
    };
}

// Initialize the carousel
function initCarousel() {
    fetchImageData().then(() => {
        if (files.length === 0) {
            slides.innerHTML = "<p>No images available</p>";
            return;
        }

        showSlide(currentIndex);

        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + files.length) % files.length;
            showSlide(currentIndex);
        });

        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % files.length;
            showSlide(currentIndex);
        });
    });
}

initCarousel();

    </script>
</body>
</html>
