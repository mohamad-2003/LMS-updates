<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Review</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->


</head>
<body>
<div class="container mt-5">
    <h3>Submit a Review</h3>
    <div class="mb-3">
        <label for="courseId" class="form-label">Course ID</label>
        <input type="number" id="courseId" class="form-control" placeholder="Enter Course ID">
    </div>
    <div class="mb-3">
    <label for="userId" class="form-label">User ID</label>
    <input type="number" id="userId" class="form-control" placeholder="Enter User ID">
</div>

    <div class="mb-3">
        <label for="rating" class="form-label">Rating (1-5)</label>
        <input type="number" id="rating" class="form-control" placeholder="Enter Rating (1-5)" min="1" max="5">
    </div>
    <div class="mb-3">
        <label for="feedback" class="form-label">Feedback</label>
        <textarea id="feedback" class="form-control" rows="4" placeholder="Enter your feedback"></textarea>
    </div>
    <button class="btn btn-primary" id="submitReview">Submit Review</button>

    <div id="responseMessage" class="mt-3"></div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script>
   $(document).ready(function () {
    $('#submitReview').click(function () {
        const courseId = $('#courseId').val();
        const userId = $('#userId').val();
        const rating = $('#rating').val();
        const feedback = $('#feedback').val();

        if (!courseId || !userId || !rating || !feedback) {
            $('#responseMessage').html('<div class="alert alert-danger">All fields are required.</div>');
            return;
        }

        $.ajax({
            url: 'submit.php',
            method: 'POST',
            data: {
                course_id: courseId,
                user_id: userId,
                rating: rating,
                feedback: feedback
            },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.success) {
                    // Display on-page message
                    $('#responseMessage').html('<div class="alert alert-success">Thank you! Your review has been submitted.</div>');
                    
                    // Clear form inputs
                    $('#rating').val('');
                    $('#feedback').val('');

                    // Show pop-up modal
                    $('#thankYouModal').modal('show');
                } else {
                    $('#responseMessage').html('<div class="alert alert-danger">' + data.message + '</div>');
                }
            },
            error: function () {
                $('#responseMessage').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });
});

</script>

</body>
</html>
