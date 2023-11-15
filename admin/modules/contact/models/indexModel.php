<?php
function get_list_customers() //Lấy danh sách khách hàng
{
    $sql = db_fetch_array("SELECT * FROM `tb_customers`");
    return $sql;
}

function get_list_chat_by_id($id) //Lấy danh sách tin nhắn theo id
{
    $sql = db_fetch_array("SELECT tb_customers.fullname as fullname, tb_messages.message as message, tb_messages.created_at as time, 
    tb_customers.img as img, tb_messages.status as status  FROM `tb_messages` JOIN `tb_customers` ON tb_messages.customer_id = tb_customers.id WHERE customer_id = {$id}");
    return $sql;
}
function add_chat($data) //Thêm nọi dung cuộc trò chuyện
{
    db_insert("tb_messages", $data);
}
