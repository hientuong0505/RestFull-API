<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../models/question.php');

    $db = new db();
    $connect = $db->connect();

    $question = new Question($connect);
    $read = $question->read();

    $num = $read->rowCount();
    //Phương thức rowCount() trả về số lượng row bị tác động sau khi thực hiện các thao tác DELETE, INSERT và UPDATE.

    if($num>0)
    {
        $question_array = [];
        $question_array['question'] = [];

        /*  fetch lấy ra 1 dòng dữ liệu, kết quả là 1 array
            PDO::FETCH_ASSOC: Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database) 
        */
        while($row = $read->fetch(PDO::FETCH_ASSOC)) 
        {
            extract($row);
            //extract() được sử dụng để nhập các biến từ một mảng vào trong bảng biểu tượng hiện tại

            $question_item = array(
                'id' => $id,
                'title' => $title,
                'answer_a' => $answer_a,
                'answer_b' => $answer_b,
                'answer_c' => $answer_c,
                'answer_d' => $answer_d,
                'true_answer' => $true_answer,
            );
            array_push($question_array['question'], $question_item);
            //array_push() dùng để thêm một phần tử mới vào cuối mảng
        }
        echo json_encode($question_array);
        //json_encode để conver giá trị chỉ định thành định dạng JSON
    }
?>