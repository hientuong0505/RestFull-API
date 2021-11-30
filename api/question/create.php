<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    // header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,
    //     X-Requested-With');

    include_once('../../config/db.php');
    include_once('../../models/question.php');

    $db = new db();
    $connect = $db->connect();

    $question = new Question($connect);
    
    /*hàm json_decode để nhận và giải mã chuỗi đã mã hóa JSON
        Giải mã nói một cách đơn giản là khôi phục dữ liệu đã được mã hoá trở về bản gốc
    */
    $data = json_decode(file_get_contents("php://input"));
    $question->title = $data->title;
    $question->answer_a = $data->answer_a;
    $question->answer_b = $data->answer_b;
    $question->answer_c = $data->answer_c;
    $question->answer_d = $data->answer_d;
    $question->true_answer = $data->true_answer;

    if($question->create())
    {
        echo json_encode(array('message','Tạo thành công'));
    } else {
        echo json_encode(array('message','Tạo thất bại, hãy thử lại!!'));
    }
    

?>