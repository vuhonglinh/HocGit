<?php
function construct()
{
    load_module('index');
}

function indexAction()
{
}

function ajaxAction()
{
    if (!empty($_POST['number'])) {
        $number = $_POST['number'];
        $upload = "img/";
        $targetFile = $upload . basename($_FILES["file"]["name"]);
        $duoiFile = ['jpg', 'png', 'jpeg', 'gif', 'tiff'];
        $duoiImg = pathinfo($targetFile, PATHINFO_EXTENSION);
        if (in_array($duoiImg, $duoiFile)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                $data = [
                    'targetFile' => $targetFile,
                    'number' => $number,
                ];
                echo json_encode($data);
            } else {
                echo json_encode(array('status' => 'error', 'number' => $number,));;
            }
        } else {
            echo json_encode(array('status' => 'error', 'number' => $number,));;
        }
    }
}

function ajaxUploadImageAction()
{
    $images = $_FILES['images'];
    $result = [];
    foreach ($images['name'] as $key => $name) {
        $tmp_name = $images['tmp_name'][$key]; // Lấy phần tử cụ thể trong mảng tmp_name
        $uploadPath = "img/" . basename($name);
        $duoiFile = ['jpg', 'png', 'jpeg', 'gif', 'tiff'];
        $duoiImg = pathinfo($uploadPath, PATHINFO_EXTENSION);

        if (in_array(strtolower($duoiImg), $duoiFile)) { // Chuyển đuôi file về chữ thường và kiểm tra
            if (move_uploaded_file($tmp_name, $uploadPath)) {
                $result[] = $name;
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to move uploaded file.'));
                return false;
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid file type.'));
            return false;
        }
    }
    echo json_encode(array('status' => 'success', 'result' => $result));
}
function add_productAction() //Thêm sản phẩm
{
    global $error, $product_name, $product_code, $price, $product_desc, $file, $images, $product_content, $status, $parent_id;
    if (isset($_POST['add_product'])) {
        $error = [];
        //Kiểm tra product_name
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống";
        } else {
            $product_name = $_POST['product_name'];
        }
        //Kiểm tra product_code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống";
        } else {
            $product_code = $_POST['product_code'];
        }
        ////Kiểm tra price
        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống";
        } else {
            if (filter_var($_POST['price'], FILTER_VALIDATE_INT)) {
                $price = $_POST['price'];
            } else {
                $error['price'] = "Không đúng định dạng";
            }
        }
        ////Kiểm tra product_desc
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        ////Kiểm tra product_content
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được để trống";
        } else {
            $product_content = $_POST['product_content'];
        }
        ////Kiểm tra parent_id
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Không được để trống";
        } else {
            $parent_id = $_POST['parent_id'];
        }
        ////Kiểm tra status
        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống";
        } else {
            $status = $_POST['status'];
        }
        ////Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $error['file'] = "Không được để trống";
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], "img/" . $_FILES['file']['name']);
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = 'Không đúng định dạng ảnh';
            }
        }
        //Kiểm tra ảnh chi tiết
        if (empty($_FILES['images'])) {
            $error['images'] = "Không được để trống";
        } else {
            $images = $_FILES['images']['name'];
        }

        //Kiểm tra biến thể
        if (isset($_POST['ram_variants'])) {
            if (empty($_POST['ram_variants'])) {
                $error['variants'] = "Không được để trống biến thể";
            } else {
                foreach ($_POST['ram_variants'] as $item) {
                    if (empty($item['name'])) {
                        $error['variants'] = "Không được để trống biến thể";
                    } else {
                        $vartians = $_POST['ram_variants'];
                    }
                    if (isset($item['colors'])) {
                        if (empty($item['colors'])) {
                            $error['variants'] = "Không được để trống biến thể";
                        } else {
                            foreach ($item['colors'] as $v) {
                                if (empty($v['name']) || empty($v['price']) || empty($v['qty']) || empty($v['color'])) {
                                    $error['variants'] = "Không được để trống biến thể";
                                } else {
                                    $vartians = $_POST['ram_variants'];
                                }
                            }
                        }
                    } else {
                        $vartians = $_POST['ram_variants'];
                    }
                }
            }
        }
        //Kết luận
        if (empty($error)) {
            $data_product = [
                'product_name' => $product_name,
                'product_code' => $product_code,
                'price' => $price,
                'product_desc' => $product_desc,
                'product_thumb' => $file,
                'product_content' => $product_content,
                'status' => $status,
                'cat_id' => $parent_id,
                'creator' => $_SESSION['admin_login'],
            ];
            $id_product = add_product_data($data_product);
            foreach ($images as $value) { //Add ảnh chi tiết của sản phẩm
                $data_image = [
                    'product_id' => $id_product,
                    'image' => $value,
                ];
                add_detail_img($data_image);
            }
            if (isset($vartians)) {
                foreach ($vartians as $key => $item) { //Thêm biến thể ram
                    $data_ram = [
                        'product_id' => $id_product,
                        'ram_name' => $item['name'],
                    ];
                    $ram_id = add_ram_vartians($data_ram); //Thêm thuộc tính ram
                    if (isset($item['colors'])) {
                        if (is_array($item['colors'])) {
                            foreach ($item['colors'] as $v) {
                                $data_color = [
                                    'ram_id' => $ram_id,
                                    'product_id' => $id_product,
                                    'color_name' => $v['name'],
                                    'color_price' => $v['price'],
                                    'color' => $v['color'],
                                    'quantity' => $v['qty'],
                                ];
                                add_color_vartians($data_color); //Thêm biến thể màu sắc
                            }
                        }
                    }
                }
            }
            $error['account'] = "Thêm sản phẩm thành công";
        }
    }
    $data['list_category'] = list_category();
    load_view("add_product", $data);
}

function delete_productAction() //Xóa sản phẩm
{
    $id = (int)$_GET['id'];
    delete_product($id);
    delete_related($id); //Xóa các thuộc tính liên quan đến sản phẩm
    redirect("?mod=product&action=list_product");
}

function update_productAction() //Sửa sản phẩm
{
    global $error, $product_name, $product_code, $price, $product_desc, $file, $product_content, $status, $parent_id;
    $id = $_GET['id'];
    $data['product'] = get_product_by_id($id); //Lấy sản phẩm
    $data['list_ram_var'] = get_ram_variants($id); //Lấy thuộc tính ram của sản phẩm theo id
    // $data['list_color_var'] = get_color_variants($id); //Lấy thuộc tính màu sắc của sản phẩm theo id
    $data['list_category'] = list_category();
    if (isset($_POST['update_product'])) {
        $error = [];
        //Kiểm tra product_name
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Không được để trống";
        } else {
            $product_name = $_POST['product_name'];
        }
        //Kiểm tra product_code
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống";
        } else {
            $product_code = $_POST['product_code'];
        }
        ////Kiểm tra price
        if (empty($_POST['price'])) {
            $error['price'] = "Không được để trống";
        } else {
            $price = $_POST['price'];
        }
        ////Kiểm tra product_desc
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        ////Kiểm tra product_content
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được để trống";
        } else {
            $product_content = $_POST['product_content'];
        }
        ////Kiểm tra parent_id
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Không được để trống";
        } else {
            $parent_id = $_POST['parent_id'];
        }
        ////Kiểm tra status
        if (empty($_POST['status'])) {
            $error['status'] = "Không được để trống";
        } else {
            $status = $_POST['status'];
        }
        //Kiểm tra file
        if (empty($_FILES['file']['name'])) {
            $file  = $data['product']['product_thumb'];
        } else {
            if (is_file_img($_FILES['file']['name'])) {
                $file = $_FILES['file']['name'];
            } else {
                $error['file'] = 'Không đúng định dạng ảnh';
            }
        }
        //Kiểm tra ảnh chi tiết khi sửa
        if (isset($_FILES['detail_img'])) {
            $detail_img = $_FILES['detail_img']['name'];
            foreach ($detail_img as $key => $value) {
                if (!empty($value)) {
                    if (is_file_img($value)) {
                        $detail_img = $_FILES['detail_img']['name'];
                    } else {
                        $error['images'] = 'Không đúng định dạng ảnh';
                    }
                }
            }
        }
        //Kiểm tra ảnh chi tiết khi được thêm
        if (isset($_FILES['images']['name'])) {
            foreach ($_FILES['images']['name'] as $key => $value) {
                if (is_file_img($value)) {
                    $images = $_FILES['images']['name'];
                } else {
                    $error['images'] = 'Không đúng định dạng ảnh';
                }
            }
        }
        //Kiểm tra biến thể
        // show_array($_POST['update_ram_variants']);
        $string_id = "";
        // show_array($_POST['update_ram_variants']);
        if (isset($_POST['update_ram_variants'])) {
            foreach ($_POST['update_ram_variants'] as $key => $item) {
                $string_id_color = "";
                $string_id .= "{$key},";
                if (isset($item['colors'])) {
                    foreach ($item['colors'] as $k => $v) {
                        $string_id_color .= "$k,";
                        $data_update_color = [
                            'color_name' => $v['name'],
                            'color_price' => $v['price'],
                            'color' => $v['color'],
                            'quantity' => $v['qty'],
                        ];
                        update_variants_color($data_update_color, $k); //Cập nhật biến thể màu sắc theo id
                    }
                    if (!empty($string_id_color)) {
                        $string_id_color = substr($string_id_color, 0, -1);
                        delete_variant_color_isset_by_id("tb_color_variants", $string_id_color, $key, $id); //Xóa danh sach id ram không tồn tại
                    }
                } else {
                    delete_all_variant_color($key); //Xóa toàn bộ biến thể màu theo ram_id
                }
                if (isset($item['update'])) {
                    foreach ($item['update'] as $k => $vl) {
                        $data_add_color = [
                            'ram_id' => $key,
                            'product_id' => $id,
                            'color_name' => $vl['name'],
                            'color_price' => $vl['price'],
                            'color' => $vl['color'],
                            'quantity' => $vl['qty'],
                        ];
                        add_variants_color($data_add_color); //Thêm biến thể màu sắc theo id ram cũ
                    }
                }
            }

            if (!empty($string_id)) {
                $string_id = substr($string_id, 0, -1);
                delete_variant_isset_by_id("tb_ram_variants", $string_id,  $id); //Xóa danh sach id ram không tồn tại
            }
        } else {
            delete_all_variant_ram($id); //Xóa toàn bộ thuộc tính của sản phẩm theo product_id
        }
        //Kiểm tra biến thể
        if (isset($_POST['ram_variants'])) {
            if (empty($_POST['ram_variants'])) {
                $error['variants'] = "Không được để trống biến thể";
            } else {
                foreach ($_POST['ram_variants'] as $item) {
                    if (empty($item['name'])) {
                        $error['variants'] = "Không được để trống biến thể";
                    } else {
                        $vartians = $_POST['ram_variants'];
                    }
                    if (isset($item['colors'])) {
                        if (empty($item['colors'])) {
                            $error['variants'] = "Không được để trống biến thể";
                        } else {
                            foreach ($item['colors'] as $v) {
                                if (empty($v['name']) || empty($v['price']) || empty($v['qty']) || empty($v['color'])) {
                                    $error['variants'] = "Không được để trống biến thể";
                                } else {
                                    $vartians = $_POST['ram_variants'];
                                }
                            }
                        }
                    } else {
                        $vartians = $_POST['ram_variants'];
                    }
                }
            }
        }
        //Kết luận
        if (empty($error)) {
            //Cập nhật sản phẩm
            $data_product = [
                'product_name' => $product_name,
                'product_code' => $product_code,
                'price' => $price,
                'product_desc' => $product_desc,
                'product_thumb' => $file,
                'product_content' => $product_content,
                'status' => $status,
                'cat_id' => $parent_id,
            ];
            update_product($id, $data_product); //Cập nhật sản phẩm
            // Kiểm tra ảnh chi tiết
            if (isset($detail_img)) {
                $string_id = "";
                foreach ($detail_img as $key => $value) {
                    $string_id .= $key . " ,"; //Danh sách id ảnh tồn tại khi cập nhật
                    if (!empty($value)) { //Những file chữa ảnh được update
                        $data_detail_img = [
                            'image' => $value,
                        ];
                        update_detail_img_by_id($key, $data_detail_img); ////Cập nhật ảnh chi tiết cảu sản phẩm theo id anh chi tiết
                    }
                }
                $string_id = substr($string_id, 0, -1);
                remove_interval_detail_img($string_id, $id); //Xóa các id ảnh chi tiết nếu không tồn tại trong danh sách
            }
            if (isset($images)) { //Add ảnh chi tiết của sản phẩm
                foreach ($images as $value) {
                    $data_image = [
                        'product_id' => $id,
                        'image' => $value,
                    ];
                    add_detail_img($data_image);
                }
            }
            if (isset($vartians)) {
                foreach ($vartians as $key => $item) { //Thêm biến thể ram
                    $data_ram = [
                        'product_id' => $id,
                        'ram_name' => $item['name'],
                    ];
                    $ram_id = add_ram_vartians($data_ram); //Thêm thuộc tính ram
                    if (isset($item['colors'])) {
                        if (is_array($item['colors'])) {
                            foreach ($item['colors'] as $v) {
                                $data_color = [
                                    'ram_id' => $ram_id,
                                    'product_id' => $id,
                                    'color_name' => $v['name'],
                                    'color_price' => $v['price'],
                                    'color' => $v['color'],
                                    'quantity' => $v['qty'],
                                ];
                                add_color_vartians($data_color); //Thêm biến thể màu sắc
                            }
                        }
                    }
                }
            }
            $error['account'] = "Sửa sản phẩm thành công";
        }
    }
    $data['list_ram_var'] = get_ram_variants($id); //Lấy thuộc tính ram của sản phẩm theo id
    $data['list_color_var'] = get_color_variants($id); //Lấy thuộc tính màu sắc của sản phẩm theo id
    $data['img_detail'] = get_detail_img_by_id($id); //Lấy ảnh chi tiết theo id sp
    $data['product'] = get_product_by_id($id);
    $data['list_category'] = list_category();
    load_view("update_product", $data);
}

function list_productAction() //Danh sách sản phẩm
{
    //Tác vụ
    if (isset($_POST['btn_apply'])) {
        if (!empty($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = 0;
        }
        if (!empty($_POST['checkitem'])) {
            $checkitem = $_POST['checkitem'];
            foreach ($checkitem as $item) {
                update_action($action, $item);
            }
        }
    }
    //Lấy danh sách danh mục sản phẩm
    $data['list_cat'] = get_list_cat();
    //lấy sô lượng bản ghi
    $data['num_products'] = num_products();
    $data['num_products_posted'] = num_products_posted();
    $data['num_products_pending'] = num_products_pending();
    //
    $status =  (!empty($_GET['status'])) ? $_GET['status'] : null;
    $cat_id =  (!empty($_GET['cat_id'])) ? $_GET['cat_id'] : null;
    $page =  (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $num_rows = 5;
    $start = ($page - 1) * $num_rows;
    $data['num_rows'] = $num_rows;
    $data['start'] = $start;
    $data['list_products'] = get_list_products($start, $num_rows, $status, $cat_id); //Lấy danh sách sản phẩm
    load_view("list_product", $data);
}

function list_commentsAction()
{
    $id = $_GET['id'];
    $status = (!empty($_GET['status'])) ? $_GET['status'] : null;
    //Tác vụ
    if (isset($_POST['btn_apply'])) {
        if (!empty($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = 0;
        }
        if (!empty($_POST['checkitem'])) {
            $checkitem = $_POST['checkitem'];
            foreach ($checkitem as $item) {
                update_action_comment($action, $item);
            }
        }
    }
    //
    $data['product'] = get_product_by_id($id);
    $data['list_comments'] = list_comments($id, $status);
    load_view("list_comments", $data);
}

function delete_commentsAction()
{
    $delete = $_GET['delete'];
    $id = $_GET['id'];
    delete_comment_id($delete);
    redirect("?mod=product&action=list_comments&id={$id}");
}

function result_seachAction()
{
    $seach = (!empty($_POST['seach'])) ? $_POST['seach'] : null;
    redirect("?mod=product&action=seach_product&seach={$seach}");
}

function seach_productAction()
{
    $seach = (!empty($_GET['seach'])) ? $_GET['seach'] : null;
    //Tác vụ
    if (isset($_POST['btn_apply'])) {
        if (!empty($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = 0;
        }
        if (!empty($_POST['checkitem'])) {
            $checkitem = $_POST['checkitem'];
            foreach ($checkitem as $item) {
                update_action($action, $item);
            }
        }
    }
    $data['list_cat'] = get_list_cat();
    //lấy sô lượng bản ghi
    $data['num_products'] = num_products();
    $data['num_products_posted'] = num_products_posted();
    $data['num_products_pending'] = num_products_pending();
    //
    $data['list_seach'] = seach_product($seach);
    load_view('seach_product', $data);
}
