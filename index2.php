<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project List</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="index.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="background-image"></div>
    <div class="container">
        <!-- Logout Button -->
        <div class="logout">
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
        
        <h2>Project List</h2>
        
        <label for="sort_by">Sort By:</label>
        <select id="sort_by">
            <option value="recent">Recent Projects</option>
            <option value="category_name">Order By Category Name ASC</option>
            <option value="username">Order By Username ASC</option>
            <option value="project_title">Order By Project Title ASC</option>
        </select>
        
        <table id="project_table">
            <thead>
                <tr>
                    <th>Project Title</th>
                    <th>Username</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody id="project_list"></tbody>
        </table>
        
        <div class="pagination">
            <button id="prev_page" disabled>Previous</button>
            <button id="next_page" disabled>Next</button>
        </div>
    </div>

    <script>
        let currentPage = 1;

        function fetchProjects() {
            const sortBy = $('#sort_by').val();
            $.ajax({
                url: 'fetch_projects2.php',
                method: 'GET',
                data: { sort_by: sortBy, page: currentPage },
                dataType: 'json',
                success: function(response) {
                    $('#project_list').empty();
                    response.forEach(project => {
                        $('#project_list').append(`
                            <tr>
                                <td>${project.project_title || "Untitled"}</td>
                                <td>${project.username}</td>
                                <td>${project.category_name}</td>
                            </tr>
                        `);
                    });
                    $('#prev_page').prop('disabled', currentPage === 1);
                    $('#next_page').prop('disabled', response.length < 2);
                }
            });
        }

        $('#next_page').click(function() {
            currentPage++;
            fetchProjects();
        });

        $('#prev_page').click(function() {
            if (currentPage > 1) {
                currentPage--;
                fetchProjects();
            }
        });

        $('#sort_by').change(function() {
            currentPage = 1;
            fetchProjects();
        });

        fetchProjects();
    </script>
</body>
</html>
