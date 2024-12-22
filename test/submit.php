<?php
include('testing.php');
include('db.php');
$course_id = $_POST['course_id'] ?? null;
$user_id = $_POST['user_id'] ?? null;
$rating = $_POST['rating'] ?? null;
$feedback = $_POST['feedback'] ?? null;

if (empty($course_id) || empty($user_id) || empty($rating) || empty($feedback)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

try {
    $checkSql = "SELECT COUNT(*) FROM reviews WHERE course_id = :course_id AND user_id = :user_id";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([':course_id' => $course_id, ':user_id' => $user_id]);
    $alreadyReviewed = $checkStmt->fetchColumn();

    if ($alreadyReviewed > 0) {
        echo json_encode(['success' => false, 'message' => 'You have already submitted a review for this course.']);
        exit;
    }

    $sql = "INSERT INTO reviews (course_id, user_id, rating, feedback) VALUES (:course_id, :user_id, :rating, :feedback)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([':course_id' => $course_id, ':user_id' => $user_id, ':rating' => $rating, ':feedback' => $feedback])) {
        echo json_encode(['success' => true, 'message' => 'Review submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit review.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
