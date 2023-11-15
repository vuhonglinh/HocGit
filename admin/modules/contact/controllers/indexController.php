<?php
function construct()
{
    load_module("index");
}

function ajaxAction()
{
    $data = get_list_customers();
    $string = "";
    foreach ($data as $item) {
        if ($item['status'] == 1) {
            $status = "<p class='text-success'>Đang hoạt động</p>";
        } else {
            $status = "<p class='text-danger'>Không hoạt động</p>";
        }
        $string .= "<tr><td class='mailbox-star'>{$item['fullname']}</td>" .
            "<td class='mailbox-star'>{$item['email']}</td>" .
            "<td class='mailbox-star'>{$item['phone_number']}</td>" .
            "<td class='mailbox-star'>{$item['address']}</td>" .
            "<td class='mailbox-date'>" . $status . "</td>" .
            "<td class='mailbox-date'>" .
            "<a href='?mod=contact&action=detail&id=" . $item['id'] . "'>" .
            "<img src='public/img/messenger.png' alt=''>" .
            "</a>" .
            "</td>" .
            "</tr>";
    }
    echo $string;
}
function indexAction()
{
    $data['list_customers'] = get_list_customers();
    load_view("main", $data);
}


function chatAjaxAction()
{
    $customer_id = $_POST['customer_id'];
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $data = [
            'message' => $message,
            'customer_id' => $customer_id,
            'status' => 1,
        ];
        add_chat($data);
    }
    $string = "";
    $result = get_list_chat_by_id($customer_id);
    foreach ($result as $item) {
        if ($item['status'] == 0) {
            $string .= "<div class='direct-chat-msg'>" .
                "<div class='direct-chat-infos clearfix'>" .
                "<span class='direct-chat-name float-left'>" . $item['fullname'] . "</span>" .
                "<span class='direct-chat-timestamp float-right'>" . $item['time'] . "</span>" .
                "</div>" .
                "<img class='direct-chat-img' src='img/" . $item['img'] . "' alt='message user image'>" .
                " <div class='direct-chat-text'>" . $item['message'] . "</div>" .
                "</div>";
        }
        ///
        if ($item['status'] == 1) {
            $string .= "<div class='direct-chat-msg right'>" .
                "<div class='direct-chat-infos clearfix'>" .
                "<span class='direct-chat-name float-right'>Quản trị viên</span>" .
                "<span class='direct-chat-timestamp float-left'>" . $item['time'] . "</span>" .
                "</div>" .
                "<img class='direct-chat-img' src='public/img/Group 43.png' alt='message user image'>" .
                "<div class='direct-chat-text'>" . $item['message'] . "</div>" .
                "</div>";
        }
    }

    echo $string;
}

function detailAction()
{
    $id = $_GET['id'];
    $data['list_chat'] = get_list_chat_by_id($id);
    // show_array($data['list_chat']);
    load_view("detail", $data);
}
