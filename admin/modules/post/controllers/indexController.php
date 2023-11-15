<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}
function list_postAction()
{
    //Tác vụ
    if (isset($_POST['btn_apply'])) {
        if (!empty($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = 0;
        }
        if (!empty($_POST['checkitem'])) {
            foreach ($_POST['checkitem'] as $item) {
                update_action($action, $item);
            }
        }
    }
    //
    $data['num_posts'] = num_posts();
    $data['num_posts_posted'] = num_posts_posted();
    $data['num_posts_pending'] = num_posts_pending();
    $status = (!empty($_GET['status'])) ? $_GET['status'] : null;
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 5;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['start'] = $start;
    $data['list_posts'] = list_posts($start, $num_rows, $status);
    load_view("list_post", $data);
}

function add_postAction()
{
    global $error, $title, $slug, $file, $status, $file, $desc;
    if (isset($_POST['add-post'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống";
        } else {
            $slug = $_POST['slug'];
        }
        ////Kiểm tra desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống";
        } else {
            $desc = $_POST['desc'];
        }
        ////Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $error['file'] = "Không được để trống";
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = 'Ảnh không đúng định dạng';
            }
        }
        ////Kiểm tra status
        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống";
        } else {
            $status = $_POST['status'];
        }
        //Kết luận
        if (empty($error)) {
            $creator = $_SESSION['admin_login'];
            $data_post = [
                'post_title' => $title,
                'slug' => $slug,
                'post_img' => $file,
                'status' => $status,
                'creator' => $creator,
                'post_content' => $desc
            ];
            add_post_data($data_post);
            $error['account'] = "Thêm bài viết thành công";
        }
    }
    load_view("add_post");
}
function list_catAction()
{
    load_view("list_cat");
}


function update_postAction()
{
    $id = $_GET['id'];
    $data['post'] = get_post_by_id($id);
    global $error, $title, $slug, $file, $status, $file, $desc;
    if (isset($_POST['update-post'])) {
        $error = [];
        //Kiểm tra title
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống";
        } else {
            $title = $_POST['title'];
        }
        //Kiểm tra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống";
        } else {
            $slug = $_POST['slug'];
        }
        ////Kiểm tra desc
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống";
        } else {
            $desc = $_POST['desc'];
        }
        ////Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $file = $data['post']['post_img'];
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = "Ảnh không đúng định dạng";
            }
        }
        ////Kiểm tra status
        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống";
        } else {
            $status = $_POST['status'];
        }
        //Kết luận
        if (empty($error)) {
            $creator = $_SESSION['admin_login'];
            $data_post = [
                'post_title' => $title,
                'slug' => $slug,
                'post_img' => $file,
                'status' => $status,
                'creator' => $creator,
                'post_content' => $desc
            ];
            update_post_data($data_post, $id);
            $error['account'] = "Sửa bài viết thành công";
        }
    }
    $data['post'] = get_post_by_id($id);
    load_view("update_post", $data);
}

function delete_postAction()
{
    $id = $_GET['id'];
    delete_post($id);
    redirect("?mod=post&action=list_post");
}
