<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Rating Modal -->
  <div id="ratingModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Rate Your Satisfaction</h2>
      <div class="rating">
        <span class="star" data-rating="1">&#9733;</span>
        <span class="star" data-rating="2">&#9733;</span>
        <span class="star" data-rating="3">&#9733;</span>
        <span class="star" data-rating="4">&#9733;</span>
        <span class="star" data-rating="5">&#9733;</span>
      </div>
      <button id="submitRatingBtn" class="btn">Submit Rating</button>
    </div>
  </div>

  <!-- View Rating Button -->
  <button id="viewRatingBtn" class="btn">View Rating</button>

  <script src="script.js"></script>
</body>
</html>

/* Styles for Rating Modal */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 300px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.rating {
  margin-bottom: 20px;
}

.star {
  font-size: 24px;
  cursor: pointer;
}

/* Additional Styles */
.btn {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

// Rating Modal
var ratingModal = document.getElementById("ratingModal");

// View Rating Button
var viewRatingBtn = document.getElementById("viewRatingBtn");

// Close Modal
var closeBtn = ratingModal.getElementsByClassName("close")[0];
closeBtn.onclick = function() {
  ratingModal.style.display = "none";
};

// Open Modal when View Rating Button is clicked
viewRatingBtn.onclick = function() {
  ratingModal.style.display = "block";
};

// Handle Rating Submission
var stars = ratingModal.getElementsByClassName("star");
var submitRatingBtn = document.getElementById("submitRatingBtn");

// Add event listener to each star
for (var i = 0; i < stars.length; i++) {
  stars[i].addEventListener("click", function() {
    var rating = parseInt(this.getAttribute("data-rating"));
    submitRating(rating);
  });
}

// Submit Rating
function submitRating(rating) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "submitRating.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Rating submitted successfully
      console.log(xhr.responseText);
      // Perform any desired action here (e.g., display success message)
      // Close the modal after successful submission
      ratingModal.style.display = "none";
    } else if (xhr.readyState === 4 && xhr.status !== 200) {
      // Error occurred while submitting rating
      console.log("Error submitting rating");
      // Perform any desired error handling here (e.g., display error message)
    }
  };
  xhr.send("rating=" + rating);
}
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["rating"])) {
    $rating = $_POST["rating"];
    // Process the rating as per your requirements
    // Save it to the database, perform calculations, etc.
    // You can use the $rating value here and execute necessary code
    // Return a success message or appropriate response
    echo "Rating submitted successfully";
  } else {
    // Rating not provided
    echo "Error: Rating not provided";
  }
} else {
  // Invalid request method
  echo "Error: Invalid request method";
}
?>
