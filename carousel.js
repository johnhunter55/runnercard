document.addEventListener("DOMContentLoaded", () => {
    const downloadBtn = document.getElementById("downloadBtn");
  
    // Function to enable the download button to work for the current image
    function setupDownloadButton(imagePath) {
      downloadBtn.onclick = () => {
        const link = document.createElement("a");
        link.href = imagePath;
        link.download = imagePath.split("/").pop(); // Extracts the filename from the path
        link.click();
      };
    }
  
    // This function will update the download button every time the image changes
    window.updateDownloadButton = function(imagePath) {
      setupDownloadButton(imagePath); // Set the download button for the current image
    };
  });
  