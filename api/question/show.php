<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../models/question.php');

    $db = new db();
    $connect = $db->connect();

    $question = new Question($connect);
    
    $question->id = isset($_GET['id']) ? $_GET['id'] : die();
    /*Hàm isset() được dùng để kiểm tra một biến nào đó đã được khởi tạo trong bộ nhớ của máy tính hay chưa, 
        nếu nó đã khởi tạo (tồn tại) thì sẽ trả về TRUE và ngược lại sẽ trả về FALSE
    */
    $question->show();
    $question_item = array(
        'id' => $question->id,
        'title' => $question->title,
        'answer_a' => $question->answer_a,
        'answer_b' => $question->answer_b,
        'answer_c' => $question->answer_c,
        'answer_d' => $question->answer_d,
        'true_answer' => $question->true_answer,
    );
    echo json_encode($question_item);
?>