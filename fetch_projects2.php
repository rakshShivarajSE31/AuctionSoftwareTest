<?php

// Enable error reporting for troubleshooting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root"; // Default for XAMPP
$password = "";     // Default for XAMPP
$dbname = "chad";   // Name of your database

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'chad');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get sort and page parameters
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'recent';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 2;
$offset = ($page - 1) * $items_per_page;

// Determine sorting order
switch ($sort_by) {
    case 'category_name':
        $order_by = 'c.category_name ASC';
        break;
    case 'username':
        $order_by = 'u.username ASC';
        break;
    case 'project_title':
        $order_by = 'p.project_title ASC';
        break;
    case 'recent':
    default:
        $order_by = 'p.date_added DESC'; // Assuming `date_added` indicates recency
        break;
}

// SQL query for joining tables with sorting and pagination
$sql = "SELECT p.project_title, u.username, c.category_name
        FROM ilance_projects AS p
        JOIN ilance_users AS u ON p.user_id = u.user_id
        LEFT JOIN ilance_categories AS c ON p.cid = c.cid
        ORDER BY $order_by
        LIMIT $items_per_page OFFSET $offset";

$result = $conn->query($sql);
$projects = [];

while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($projects);
