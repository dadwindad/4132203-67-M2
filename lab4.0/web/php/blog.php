<?php
header('Content-Type: application/json');

require 'condb.php';
include '_messages.php';

$method = $_SERVER['REQUEST_METHOD'];
$response = ['status' => 'error', 'message' => 'Invalid request'];

$page = 'blog';
$response_option = null;
$response_code = 200;
$response_err = null;

switch ($method) {
    case 'POST': // Insert new blog
        $title = $_POST['title'] ?? null;
        $post = $_POST['post'] ?? null;

        if ($title && $post) {
            $stmt = $conn->prepare("INSERT INTO tb_blog (title, post, createAt) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $title, $post);
            if (!$stmt->execute()) {
                $response_code = 500;
                $response_err = $conn->error;
            };
            $stmt->close();
        } else {
            $response_option = 'no-data';
        }

        $response = query_response($page, 'POST', $response_code, $response_option, $response_err);
        break;

        //curl -X POST -d "title=My Blog&post=This is my first post" http://localhost:8080/php/blog.php


    case 'DELETE': // Delete a blog
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'] ?? null;

        if ($id) {
            $stmt = $conn->prepare("DELETE FROM tb_blog WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response = ['status' => 'success', 'message' => $msg['blog']['delete']['success']];
                } else {
                    $response = ['status' => 'error', 'message' => $msg['blog']['delete']['not-found']];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Delete failed: ' . $conn->error];
            }
            $stmt->close();
        } else {
            $response = ['status' => 'error', 'message' => $msg['blog']['delete']['no-id']];
        }
        break;

        //curl -X DELETE -d "id=1" http://localhost:8080/php/blog.php

    default:
        $response = ['status' => 'error', 'message' => 'Unsupported request method'];
}

echo json_encode($response);
