<?php
$data = db_fetch_array("SELECT * FROM `tb_menu` ORDER BY `number_order`");
function has_child($data, $id)
{
    foreach ($data as $item) {
        if ($item['parent_id'] == $id) {
            return true;
        }
    }
    return false;
}
function render_menu($data, $parent_id = 0)
{
    if ($parent_id == 0) {
        $result = "<ul>";
    } else {
        $result = "  <ul class='tp-submenu'>";
    }
    foreach ($data as $value) {
        if ($value['parent_id'] == $parent_id) {
            $result .= "<li class='has-dropdown'>";
            $result .=  "<a href='{$value['url']}'>{$value['name']}</a>";
            if (has_child($data, $value['id'])) {
                $result .= render_menu($data, $value['id']);
            }
            $result .= "</li>";
        }
    }
    $result .= "</ul>";
    return $result;
}
echo render_menu($data);
?>
