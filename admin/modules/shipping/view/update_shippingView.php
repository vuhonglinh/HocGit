<?php
get_header();
get_sidebar();
?>
<div class="content-wrapper">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">SỬA MENU</h3>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input class="form-control" type="text" name="title" id="title" value="<?php echo $menu["name"] ?>">
                    </div>
                    <?php echo form_error("title") ?>
                    <div class="form-group">
                        <label for="url_static">Đường dẫn Url</label>
                        <input class="form-control" type="text" name="url_static" id="url_static" value="<?php echo $menu["url"] ?>">
                    </div>
                    <?php echo form_error("url_static") ?>

                    <div class="form-group">
                        <label for="parent_id">Menu cha</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">-- Chọn --</option>
                            <?php foreach ($list_parent as $item) : ?>
                                <option <?php if ($item['id'] == $menu["id"]) echo "disabled"; ?> value="<?php echo $item['id'] ?>" <?php if ($menu["parent_id"] == $item['id']) echo "selected"  ?>><?php echo $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php echo form_error("parent_id") ?>

                    <div class="form-group">
                        <label for="menu_order">Thứ tự</label>
                        <input class="form-control" type="text" name="menu_order" id="menu_order" value="<?php echo $menu["number_order"] ?>">
                    </div>
                    <?php echo form_error("menu_order") ?>

                    <button type="submit" name="sm_update" class="btn btn-primary">Thêm mới</button>
                    <?php echo form_error("account") ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>