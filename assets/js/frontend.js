function showPopup(index) {
    var popups = document.getElementsByClassName("popup");
    if (index >= popups.length) {
      // Reset the index to 0 when all notifications have been shown
      index = 0;
    }
  
    popups[index].style.display = "block";
  
    // Schedule hiding the current popup after 10 seconds
    setTimeout(function() {
      popups[index].style.display = "none";
  
      // Schedule showing the next popup after 5 seconds
      setTimeout(function() {
        showPopup(index + 1);
      }, 2000);
    }, 3000);
  }
  
  // Show the first popup after 5 seconds
  setTimeout(function() {
    showPopup(0);
  }, 2000);